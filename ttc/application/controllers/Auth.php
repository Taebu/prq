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
    $this->load->model('Auth_m');
		$this->load->helper('form');
    $this->load->helper('cookie');


		
		$this->load->helper('Alert');
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
		/*
		1. 자동로그인이냐?
		1.1. 예
		- ttc/auth/login을 호출한다.
		1.1.1. 쿠키에 저장된 userid를 불러 온다.
		1.1.2. userid 값을 session userid에 담는다.
		1.1.3. 쿠키에 저장된 password를 불러 온다.
		1.1.4. password 값을 session password에 담는다.
		1.1.5. 자동으로 userid,password 값을 담아 비동기로 로그인을 시도한다.
		1.1.6. 로그인에 성공했다면 해당 아이디와 비밀번호로 쿠키를 다시 userid, password를 저장한다.
		- 자동 로그인시 쿠키저장 기본 값은 365일이다. 자동 로그인으로 로그인 시도시 365일 씩 갱신된다.
		1.1.6.1. 해당 가맹점이 관리하는 페이지로 10초 후 이동한다.
		1.1.7. 자동로그인에 실패 했다면 로그인 페이지에 잔존한다. "자동로그인 실패" 아이디와 비밀번호가 일치하지 않습니다. 경고 문구 호출.

		1.2. 아니오
		1.2.1. 쿠키에 저장된 userid를 파괴한다.
		1.2.2. 쿠키에 저장된 password를 파괴한다.
		1.2.3. 로그인 페이지로 이동한다.

		2. 로그아웃시 
		2.1. 쿠키에 저장된 userid를 파괴한다.
		2.2. 쿠키에 저장된 password를 파괴한다.
		2.3. 로그인 페이지로 이동한다.

		*/
		$is_autologin=$this->input->cookie('autologin_YN', TRUE)=="Y"||$this->input->post('autologin_YN', TRUE)=="Y";


	
		if($is_autologin)
		{
//			alert("자동 로그인 중", '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
//			alert($this->input->cookie('userid', TRUE));
//echo @$this->input->cookie('userid', TRUE);
//echo @$this->input->cookie('password', TRUE);
//		exit;
			/*		
			1.1.1. 쿠키에 저장된 userid를 불러 온다.
			1.1.2. userid 값을 session userid에 담는다.
			1.1.3. 쿠키에 저장된 password를 불러 온다.
			1.1.4. password 값을 session password에 담는다.*/

	 		$auth_data = array(
				'userid' => @$this->input->cookie('userid', TRUE),
				'password' => @$this->input->cookie('password', TRUE)
			);

			/*
			1.1.5. 자동으로 userid,password 값을 담아 비동기로 로그인을 시도한다.
			*/
			$member = $this->Auth_m->login($auth_data);
		
			if($member)
			{
				if($is_autologin)
				{
	//				alert($member->mb_gname_eng."자동 로그인 중", '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
				//세션 생성
				$newdata = array(
					 'username'  => $member->mb_gname_eng,
					 'name'  => $member->mb_id,
					 'mb_name'  => $member->mb_name,
					 'email'     => $member->mb_email,
					 'mb_gcode'     => $member->mb_gcode,
					 'prq_fcode'     => $member->prq_fcode,
					 'mb_code'     => $member->mb_code,
					 'logged_in' => TRUE
				);

				$this->session->set_userdata($newdata);

				 /* 쿠키에 autologin_YN을 Y값으로 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'autologin_YN',
						 'value'  => 'Y',
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);

					$cookie= array(
						 'name'   => 'mb_name',
						 'value'  => $member->mb_name,
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);
				
				 /* 쿠키에 username을 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'userid',
						 'value'  => $this->input->post('userid', TRUE),
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);

				 /* 쿠키에 username을 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'password',
						 'value'  => $this->input->post('password', TRUE),
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);
				}/*  if($is_autologin){...} */
	//			alert('자동 로그인 되었습니다.', '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
			}
		}
		
		//폼 검증할 필드와 규칙 사전 정의

		$this->form_validation->set_rules('userid', '아이디', 'required');
		$this->form_validation->set_rules('password', '비밀번호', 'required');

		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';

		if ( $this->form_validation->run() == TRUE )
  	{
	 		$auth_data = array(
				'userid' => $this->input->post('userid', TRUE),
				'password' => $this->input->post('password', TRUE)
			);

			$member = $this->Auth_m->login($auth_data);

			if ( $member )
			{
				//세션 생성
				$newdata = array(
					'username' =>$member->mb_gname_eng,
					'name'     =>$member->mb_id,
					'mb_name'  =>$member->mb_name,
					'email'    =>$member->mb_email,
					'mb_gcode' =>$member->mb_gcode,
					'prq_fcode'=>$member->prq_fcode,
					'mb_code'  =>$member->mb_code,
					'logged_in'=>TRUE
				);

				$this->session->set_userdata($newdata);
			
			if($is_autologin)
			{
				 /* 쿠키에 autologin_YN을 Y값으로 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'autologin_YN',
						 'value'  => 'Y',
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);
					
				 /* 쿠키에 username을 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'userid',
						 'value'  => $this->input->post('userid', TRUE),
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);

				 /* 쿠키에 username을 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'password',
						 'value'  => $this->input->post('password', TRUE),
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);
				}/*  if($is_autologin){...} */

				$mb_gcode=$member->mb_gcode;
				
				/*관리자 인 경우*/
				if($mb_gcode=="G1"||$mb_gcode=="G2")
				{
				alert('로그인 되었습니다.', '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
				/*총판 인 경우*/
				}else if($mb_gcode=="G3"){
				alert('로그인 되었습니다.', '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
				/* 대리점인 경우*/
				}else if($mb_gcode=="G4"){
				alert('로그인 되었습니다.', '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
				/* 가맹점인 경우*/
				}else if($mb_gcode=="G5"){
				alert('로그인 되었습니다.', '/ttc/mobile/lists/bbd_talktalkclick_pc_log/page/1');
				}
  				exit;

   			}
   			else
   			{
   				//실패시
  				alert('아이디나 비밀번호를 확인해 주세요.', '/ttc/auth');
  				exit;
   			}
				/*if($member){...로그인 성공...}else{아이디 확인}*/
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

		/* 세션을 파괴합니다. */
		$this->session->sess_destroy();
		//$this->input->delete_cookie('autologin_YN');		

		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		alert('로그아웃 되었습니다.', '/ttc/auth/login');
  		exit;
	}

	/**
	 * 아이디 중복 체크
	 */
	public function chk_id()
	{
		$this->load->helper('alert');
		$username=$this->input->post('username', TRUE);
		
		$auth_data = array(
		'mb_id' => $username
		);

		$result = $this->auth_m->chk_id($auth_data);
		$json=array();
		$json['success']=$result;
		$json['array']=$result;
		$json['mb_id']=$username;
		$json['num_row']=$result['num_row'];
		//alert('체크.'.$result."  ->".$this->input->post('mb_id', TRUE), '/prq/');
		echo  json_encode($json);
	}

	public function json_login()
	{
	 		$auth_data = array(
				'userid' => $this->uri->segment(3),
				'password' => $this->uri->segment(4)
			);
			/*
			1.1.5. 자동으로 userid,password 값을 담아 비동기로 로그인을 시도한다.
			*/
			$json=array();
			$json['success']=false;
			$json['msg']="로그인 실패";
			$member = $this->Auth_m->login($auth_data);		
			if($member)
			{
			$json['success']=true;
			$json['msg']=$member->mb_name;
			$newdata = array(
				 'username'  => $member->mb_gname_eng,
				 'name'  => $member->mb_id,
				 'mb_name'  => $member->mb_name,
				 'email'     => $member->mb_email,
				 'mb_gcode'     => $member->mb_gcode,
				 'prq_fcode'     => $member->prq_fcode,
				 'mb_code'     => $member->mb_code,
				 'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);
				 /* 쿠키에 autologin_YN을 Y값으로 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'autologin_YN',
						 'value'  => 'Y',
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);

					$cookie= array(
						 'name'   => 'mb_name',
						 'value'  => $member->mb_name,
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);
				
				 /* 쿠키에 username을 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'userid',
						 'value'  => $this->uri->segment(3),
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);

				 /* 쿠키에 username을 365일 저장합니다. */
				 $cookie= array(
						 'name'   => 'password',
						 'value'  => $this->uri->segment(4),
						 'expire' => 86400*365,
						 'secure' => TRUE
				 );
					$this->input->set_cookie($cookie);
			}

			echo json_encode($json);
	}	
}

/* End of file auth.php */
/* Location: ./bbs/application/controllers/auth.php */