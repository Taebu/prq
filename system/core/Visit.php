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

}
