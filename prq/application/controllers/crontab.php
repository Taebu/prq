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
	 * 처음인 사용자 보기
	 */
	function first()
 	{
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
		$data['list'] = $this->crontab_m->get_first();
		$data['controller']=$this; 

 		//view 호출
 		$this->load->view('crontab/first_v', $data);
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

	/**
	 * analytics 보기
	 */
	function analytics()
 	{
 		//analytics보기
		$data['list'] = $this->crontab_m->get_cdr();
		$data['controller']=$this; 

 		//view 호출
 		$this->load->view('crontab/analytics_v', $data);
 	}

	/**
	 * analytics 보기
	 */
	function get_send()
 	{
 		//analytics보기
		$data['mb_hp'] = $this->uri->segment(3);

 		//view 호출
 		$data['list'] =$this->crontab_m->get_send_cnt($data);

		//view 호출
 		$this->load->view('crontab/send_v', $data);
 	}

	/**
	 * maxcnt 보기
	 */
	function maxcnt()
 	{
		$data['key']="1";

 		//view 호출
 		$this->load->view('crontab/maxcnt_v', $data);
 	}

	/**
	 * 알림톡 리스트 가져오기 
	 */
	function ata()
 	{
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		
		$data['list'] = $this->crontab_m->get_ata();
		$data['controller']=$this; 

 		//view 호출
 		$this->load->view('crontab/ata_v', $data);
 	}

	/**
	 * 알림톡 리스트 가져오기 
	 */
	function ata_pay()
 	{
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
		$data['list'] = $this->crontab_m->get_ata_pay();
		$data['controller']=$this; 

 		//view 호출
 		$this->load->view('crontab/ata_pay_v', $data);
 	}
	
}

/* End of file call.php */
/* Location: ./application/controllers/call.php */