<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Crontab controller.
 * 생성 : 2016-02-03 (수)
 * @author Taebu,Moon<mtaebu@gmail.com>
 */
class Crontab extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('crontab_m');
		$this->load->helper('form');
		$this->load->helper(array('url','date'));
		$this->load->library('curl'); 
		$this->load->library('typography');
	}

	/**
	 * 주소에서 메소드가 생략되었을 때 실행되는 기본 메소드
	 */
	public function index()
	{
		//view();
	}

	/**
	 * 사이트 헤더, 푸터를 자동으로 추가해준다.
	 *
	 */
	public function _remap($method)
 	{
		$this->{"{$method}"}();
		
    }
	/**
	 * 게시물 보기
	 */
	function view()
 	{
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
		$data['list'] = $this->crontab_m->get_cdr();
		$data['controller']=$this; 

 		//view 호출
 		$this->load->view('crontab/view_v', $data);
 	}

	/**
	 * 게시물 보기
	 */
	function weekview()
 	{
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
		$data['list'] = $this->crontab_m->get_all_cdr();
		//$data['list'] = $this->crontab_m->get_gcm();
		$data['controller']=$this; 

 		//view 호출
 		$this->load->view('crontab/weekview_v', $data);
 	}

}

/* End of file call.php */
/* Location: ./application/controllers/call.php */