<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Visit Class
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/libraries/config.html
 */
class CI_Visit{

	/**
	 * List of cached URI segments
	 *
	 * @var	array
	 */
	public $visit = array();
	/**
	 * List of cached URI segments
	 *
	 * @var	 boolean
	 */
	public $is_referer = false;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		log_message('info', 'Visit Class Initialized');
		$this->db_conn();
		$this->test();
	}

	public function db_conn()
	{
		$host_name="localhost";
		$db_name="prq";
		$user_name="root";
		$db_password="hanna0987";
		$connect=mysql_connect($host_name, $user_name, $db_password);
		define("CONNECT",$connect);
		mysql_select_db($db_name, $connect);
		mysql_query("set names utf8;") ;
		extract($_REQUEST);
		extract($_GET);
		extract($_POST);
		$ROOT = $_SERVER['DOCUMENT_ROOT'];
		header("Content-Type:text/html;charset=utf-8");
	}

	// --------------------------------------------------------------------

	/**
	 * __get magic
	 *
	 * Allows Visits to access CI's loaded classes using the same
	 * syntax as controllers.
	 *
	 * @param	string	$key
	 */
	public function __get($key)
	{
		// Debugging note:
		//	If you're here because you're getting an error message
		//	saying 'Undefined Property: system/core/Visit.php', it's
		//	most likely a typo in your Visit code.
		return get_instance()->$key;
	}

	public function test()
	{

		if(isset($_SERVER['HTTP_REFERER'])) 
		{
			//do what you need to do here if it's set    
			$this->visit['REMOTE_ADDR']=$_SERVER['REMOTE_ADDR'];
			$this->visit['HTTP_USER_AGENT']=$_SERVER['HTTP_USER_AGENT'];
			$this->visit['HTTP_REFERER']=$_SERVER['HTTP_REFERER'];
			$this->visit['REQUEST_TIME']=$_SERVER['REQUEST_TIME'];		
			$this->is_referer=true;
		}
		
		if(!isset($_SERVER['HTTP_REFERER'])) 
		{
			//it was not sent, perform your default actions here
			$this->visit['REMOTE_ADDR']=$_SERVER['REMOTE_ADDR'];
			$this->visit['HTTP_USER_AGENT']=$_SERVER['HTTP_USER_AGENT'];
			$this->visit['REQUEST_TIME']=$_SERVER['REQUEST_TIME'];
			
		}

//		print_r($this->visit);
		$this->set_visit($this->visit);
		//print_r($_SERVER);
	}

	public function index()
	{
		$this->test();
	}

	public function set_visit($array)
	{
	$timestamp=$array['REQUEST_TIME'];
	$vi_date=gmdate("Y-m-d", $timestamp);
	$vi_time=gmdate("H:i:s", $timestamp);
	$sql="select max(vi_id) vi_cnt from prq_visit;";
	$cnt=mysql_fetch_assoc(mysql_query($sql));
	$cnt['vi_cnt']++;
	$sql=array();
	$sql[]="INSERT INTO `prq_visit` SET ";
	$sql[]="vi_id= '".$cnt['vi_cnt']."',";

	if($this->is_referer)
	{
	$sql[]="vi_referer= '".$array['HTTP_REFERER']."',";
	}
	$sql[]="vi_ip= '".$array['REMOTE_ADDR']."',";
	$sql[]="vi_agent= '".$array['HTTP_USER_AGENT']."',";
	$sql[]="vi_time= '".$vi_time."',";
	$sql[]="vi_date= '".$vi_date."';";

	$str_sql=join("",$sql);
	$result=mysql_query($str_sql);
	}

	// 방문자수 출력
	public function visit($skin_dir='basic')
	{
		global $config, $g5;

		// visit 배열변수에
		// $visit[1] = 오늘
		// $visit[2] = 어제
		// $visit[3] = 최대
		// $visit[4] = 전체
		// 숫자가 들어감
		preg_match("/오늘:(.*),어제:(.*),최대:(.*),전체:(.*)/", $config['cf_visit'], $visit);
		settype($visit[0], "integer");
		settype($visit[1], "integer");
		settype($visit[2], "integer");
		settype($visit[3], "integer");

		ob_start();
		if(G5_IS_MOBILE) {
			$visit_skin_path = G5_MOBILE_PATH.'/'.G5_SKIN_DIR.'/visit/'.$skin_dir;
			$visit_skin_url = G5_MOBILE_URL.'/'.G5_SKIN_DIR.'/visit/'.$skin_dir;
		} else {
			$visit_skin_path = G5_SKIN_PATH.'/visit/'.$skin_dir;
			$visit_skin_url = G5_SKIN_URL.'/visit/'.$skin_dir;
		}
		include_once ($visit_skin_path.'/visit.skin.php');
		$content = ob_get_contents();
		ob_end_clean();

		return $content;
	}

	// get_browser() 함수는 이미 있음
	public function get_brow($agent)
	{
		$agent = strtolower($agent);

		//echo $agent; echo "<br/>";

		if (preg_match("/msie ([1-9][0-9]\.[0-9]+)/", $agent, $m)) { $s = 'MSIE '.$m[1]; }
		else if(preg_match("/firefox/", $agent))            { $s = "FireFox"; }
		else if(preg_match("/chrome/", $agent))             { $s = "Chrome"; }
		else if(preg_match("/x11/", $agent))                { $s = "Netscape"; }
		else if(preg_match("/opera/", $agent))              { $s = "Opera"; }
		else if(preg_match("/gec/", $agent))                { $s = "Gecko"; }
		else if(preg_match("/bot|slurp/", $agent))          { $s = "Robot"; }
		else if(preg_match("/internet explorer/", $agent))  { $s = "IE"; }
		else if(preg_match("/mozilla/", $agent))            { $s = "Mozilla"; }
		else { $s = "기타"; }

		return $s;
	}

	public function get_os($agent)
	{
		$agent = strtolower($agent);

		//echo $agent; echo "<br/>";

		if (preg_match("/windows 98/", $agent))                 { $s = "98"; }
		else if(preg_match("/windows 95/", $agent))             { $s = "95"; }
		else if(preg_match("/windows nt 4\.[0-9]*/", $agent))   { $s = "NT"; }
		else if(preg_match("/windows nt 5\.0/", $agent))        { $s = "2000"; }
		else if(preg_match("/windows nt 5\.1/", $agent))        { $s = "XP"; }
		else if(preg_match("/windows nt 5\.2/", $agent))        { $s = "2003"; }
		else if(preg_match("/windows nt 6\.0/", $agent))        { $s = "Vista"; }
		else if(preg_match("/windows nt 6\.1/", $agent))        { $s = "Windows7"; }
		else if(preg_match("/windows nt 6\.2/", $agent))        { $s = "Windows8"; }
		else if(preg_match("/windows 9x/", $agent))             { $s = "ME"; }
		else if(preg_match("/windows ce/", $agent))             { $s = "CE"; }
		else if(preg_match("/mac/", $agent))                    { $s = "MAC"; }
		else if(preg_match("/linux/", $agent))                  { $s = "Linux"; }
		else if(preg_match("/sunos/", $agent))                  { $s = "sunOS"; }
		else if(preg_match("/irix/", $agent))                   { $s = "IRIX"; }
		else if(preg_match("/phone/", $agent))                  { $s = "Phone"; }
		else if(preg_match("/bot|slurp/", $agent))              { $s = "Robot"; }
		else if(preg_match("/internet explorer/", $agent))      { $s = "IE"; }
		else if(preg_match("/mozilla/", $agent))                { $s = "Mozilla"; }
		else { $s = "기타"; }

		return $s;
	}
}
