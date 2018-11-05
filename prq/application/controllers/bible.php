<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* prq ajax 통신을 위한 클래스 입니다.
* file : /prq/application/controllers/ajax.php
* 작성 : 2015-03-05 (목)
* 수정 : 2016-05-17 (화)
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/
class Bible extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->model('ajax_m');
	}

	/**
	 * Bible 테스트
	 */
	public function test()
	{
		$data['bible']=$this->uri->segment(3);
		$this->load->view('bible/test_v',$data);
	}
}
/* End of file ajax.php */
/* Location: ./prq/application/controllers/ajax.php */