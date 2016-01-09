<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 사용자 인증 controller.
 *
 * @author Jongwon, Byun <advisor@cikorea.net>
 */
class Auth extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
        $this->load->model('auth_m');
		$this->load->helper('form');
	}

	/**
	 * 주소에서 메소드가 생략되었을 때 실행되는 기본 메소드
	 */
	public function index()
	{
		$this->login();
	}

	/**
	 * 사이트 헤더, 푸터를 자동으로 추가해준다.
	 *
	 */
	public function _remap($method)
 	{
 		//헤더 include
//        $this->load->view('header_v');

		if( method_exists($this, $method) )
		{
			$this->{"{$method}"}();
		}

		//푸터 include
//		$this->load->view('footer_v');
    }

	/**
	 * 로그인 처리
	 */
	public function login()
	{
		//폼 검증 라이브러리 로드
		$this->load->library('form_validation');

		$this->load->helper('alert');
		
		$this->load->helper('cookie');

		//폼 검증할 필드와 규칙 사전 정의
		$this->form_validation->set_rules('username', '아이디', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', '비밀번호', 'required');

		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		if ( $this->form_validation->run() == TRUE )
  		{


	 		$auth_data = array(
				'username' => $this->input->post('username', TRUE),
			  	'password' => $this->input->post('password', TRUE)
	  		);

	  		$result = $this->auth_m->login($auth_data);

			if ( $result )
   			{
   				//세션 생성
				$newdata = array(
                   'username'  => $result->mb_gname_eng,
                   'name'  => $result->mb_id,
                   'mb_name'  => $result->mb_ceoname,
                   'email'     => $result->mb_email,
                   'mb_gcode'     => $result->mb_gcode,
                   'prq_fcode'     => $result->prq_fcode,
                   'mb_code'     => $result->mb_code,
                   'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);

				//쿠키 생성
				$cookie = array(
                   'name'   => 'username',
                   'value'  => $result->mb_gname_eng,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );
				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'mb_gcode',
                   'value'  => $result->mb_gcode,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );
				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'mb_code',
                   'value'  => $result->mb_code,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );
				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'mb_name',
                   'value'  => $result->mb_ceoname,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );

				set_cookie($cookie);
				$cookie = array(
                   'name'   => 'name',
                   'value'  => $result->mb_id,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );

				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'email',
                   'value'  => $result->mb_email,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );

				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'logged_in',
                   'value'  => TRUE,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );

				set_cookie($cookie);

				$cookie = array(
                   'name'   => 'prq_fcode',
                   'value'  => $result->prq_fcode,
                   'expire' => '86500',
                   'domain' => $_SERVER['HTTP_HOST'],
                   'path'   => '/prq/',
                   'prefix' => '',
               );

				set_cookie($cookie);


  				alert('로그인 되었습니다.', '/prq/');
  				exit;
   			}
   			else
   			{
   				//실패시
  				alert('아이디나 비밀번호를 확인해 주세요.', '/prq/');
  				exit;
   			}

  		}
  		else
  		{
	 		//쓰기폼 view 호출
	 		$this->load->view('auth/login_v');
		}
	}

	/*
	fn logout();
	로그 아웃을 합니다.	*/
	public function logout()
	{
		$this->load->helper('alert');

		$this->session->sess_destroy();
		
		$this->load->helper('cookie');
		//쿠키 파괴
		$cookie = array(
		   'name'   => 'username',
		   'value'  => '',
		   'expire' => '0',
		   'domain' => $_SERVER['HTTP_HOST'],
		   'path'   => '/prq/',
		   'prefix' => '',
	   );

		set_cookie($cookie);
		$cookie = array(
		   'name'   => 'name',
		   'value'  => '',
		   'expire' => '0',
		   'domain' => $_SERVER['HTTP_HOST'],
		   'path'   => '/prq/',
		   'prefix' => '',
	   );

		set_cookie($cookie);

		$cookie = array(
		   'name'   => 'email',
		   'value'  => '',
		   'expire' => '0',
		   'domain' => $_SERVER['HTTP_HOST'],
		   'path'   => '/prq/',
		   'prefix' => '',
	   );

		set_cookie($cookie);
		$cookie = array(
		   'name'   => 'logged_in',
		   'value'  => FALSE,
		   'expire' => '0',
		   'domain' => $_SERVER['HTTP_HOST'],
		   'path'   => '/prq/',
		   'prefix' => '',
	   );

		set_cookie($cookie);

		
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		alert('로그아웃 되었습니다.', '/prq/');
  		exit;
	}

	/**
	 * 아이디 중복 체크
	 */
	public function chk_id()
	{
		$this->load->helper('alert');
		$mb_id=$this->input->post('mb_id', TRUE);
		$auth_data = array(
		'mb_id' => $this->input->post('mb_id', TRUE)
		);
		$result = $this->auth_m->chk_id($auth_data);
		$json=array();
		$json['success']=$result;
		$json['mb_id']=$mb_id;
		
		//alert('체크.'.$result."  ->".$this->input->post('mb_id', TRUE), '/prq/');
		echo  json_encode($json);
	}
}

/* End of file auth.php */
/* Location: ./bbs/application/controllers/auth.php */