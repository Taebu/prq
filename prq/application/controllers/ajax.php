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
class Ajax extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->model('ajax_m');
	}

	/**
	 * Ajax 테스트
	 */
	public function test()
	{
		$this->load->view('ajax/test_v');
	}

	public function ajax_action()
	{
		$name = $this->input->post("name");
		echo $name."님 반갑습니다!";
	}

	public function chg_status()
	{
			if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{

			
			$table=$this->uri->segment(3);

			$chk_seq = $this->input->post("chk_seq", TRUE);
			$mb_status = $this->input->post("mb_status", TRUE);
			$ds_name = $this->input->post("ds_name", TRUE);

			$mb_reason = $this->input->post("mb_reason", TRUE);
			$bl_url = $this->input->post("bl_url", TRUE);
			$st_hp_1 = $this->input->post("st_hp_1", TRUE);
			$mb_hp = $this->input->post("mb_hp", TRUE);
			$bl_hp = $this->input->post("bl_hp", TRUE);
			$mb_id = $this->input->cookie('name', TRUE);
			$join_chk_seq=join(",",$chk_seq);
			$join_ds_code=join("','",$chk_seq);

			$st_no = $this->input->post("st_no", TRUE);
			$pv_code = $this->input->post("pv_code", TRUE);
			$pv_value = $this->input->post("pv_value", TRUE);

			$write_data = array(
				'prq_table'=>$table,
				'mb_status'=>$mb_status,
				'ds_name'=>$ds_name,
				'mb_id'=>$mb_id,
				'mb_reason'=>$mb_reason,
				'bl_url'=>$bl_url,
				'st_hp_1'=>$st_hp_1,
				'mb_hp'=>$mb_hp,
				'bl_hp'=>$bl_hp,
				'join_chk_seq' => $join_chk_seq,
				'join_ds_code' => $join_ds_code,
				'pv_no'=>$st_no,
				'pv_code'=>$pv_code,
				'pv_value'=>$pv_value
			);

			if($table=="prq_member"){
				$result = $this->ajax_m->chg_status($write_data);
			}else if($table=="prq_store"){
				$result = $this->ajax_m->chg_status($write_data);
			}else if($table=="prq_blog"){
				$result = $this->ajax_m->chg_status($write_data);
			}else if($table=="prq_isblog"){
				$result = $this->ajax_m->chg_status_blog($write_data);
			}else if($table=="prq_isblogauto"){
				$result = $this->ajax_m->chg_status_blog($write_data);
			}else if($table!="prq_member"){
				$result = $this->ajax_m->chg_status_code($write_data);
			}

			
//			else
//			{
//				//글 내용이 없을 경우
//				echo "1000";
//			}
		}
		else
		{
			echo "9000"; //로그인 필요 에러
		}
	}

	public function chg_status_naver()
	{
			if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{

			
			$table=$this->uri->segment(3);

			$chk_seq = $this->input->post("chk_seq", TRUE);
			$mb_status = $this->input->post("mb_status", TRUE);
			$ds_name = $this->input->post("ds_name", TRUE);

			$mb_reason = $this->input->post("mb_reason", TRUE);
			$bl_url = $this->input->post("bl_url", TRUE);
			$st_hp_1 = $this->input->post("st_hp_1", TRUE);
			$mb_hp = $this->input->post("mb_hp", TRUE);
			$bl_hp = $this->input->post("bl_hp", TRUE);
			$mb_id = $this->input->cookie('name', TRUE);
			$join_chk_seq=join(",",$chk_seq);
			$join_ds_code=join("','",$chk_seq);

			$st_no = $this->input->post("st_no", TRUE);
			$pv_code = $this->input->post("pv_code", TRUE);
			$pv_value = $this->input->post("pv_value", TRUE);
			$naver_id = $this->input->post("pb_naver_id", TRUE);

			//if ( $comment_contents != '')
			//{
				$write_data = array(
					'prq_table'=>$table,
					'mb_status'=>$mb_status,
					'ds_name'=>$ds_name,
					'mb_id'=>$mb_id,
					'mb_reason'=>$mb_reason,
					'bl_url'=>$bl_url,
					'st_hp_1'=>$st_hp_1,
					'mb_hp'=>$mb_hp,
					'bl_hp'=>$bl_hp,
					'join_chk_seq' => $join_chk_seq,
					'join_ds_code' => $join_ds_code,
					'pv_no'=>$st_no,
					'pv_code'=>$pv_code,
					'pv_value'=>$pv_value,
					'naver_id'=>$naver_id
				);

				//				$result = $this->board_m->insert_comment($write_data);

				if($table=="prq_member"){
					$result = $this->ajax_m->chg_status($write_data);
				}else if($table=="prq_store"){
					$result = $this->ajax_m->chg_status($write_data);
				}else if($table=="prq_blog"){
					$result = $this->ajax_m->chg_status_naver($write_data);
				}else if($table=="prq_isblog"){
					$result = $this->ajax_m->chg_status_blog($write_data);
				}else if($table!="prq_member"){
					$result = $this->ajax_m->chg_status_code($write_data);
				}

				//echo $result;
//			else
//			{
//				//글 내용이 없을 경우
//				echo "1000";
//			}
		}
		else
		{
			echo "9000"; //로그인 필요 에러
		}
	}

	public function ajax_comment_delete()
	{
		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			$this->load->model('board_m');

			$table = $this->input->post("table", TRUE);;
			$board_id = $this->input->post("board_id", TRUE);;

			//글 작성자가 본인인지 검증
			$writer_id = $this->board_m->writer_check($table, $board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				echo "8000"; //본인이 작성한 글이 아닙니다.
			}
			else
			{
				$result = $this->board_m->delete_content($table, $board_id);

				if ( $result )
				{
					echo $board_id;
				}
				else
				{
					//글 실패시
					echo "2000";
				}

			}
		}
		else
		{
			echo "9000"; //로그인 필요 에러
		}
	}

	function mb_pcode()
	{
		$mb_code=$this->input->get("mb_code", TRUE);
		$write_data = array(
			'mb_gcode'=>'G1'
		);

//		$result = $this->board_m->insert_comment($write_data);
		$result = $this->ajax_m->get_pcode($write_data);
		echo $result;
	}

	/* get_dscode() */
	function get_dscode()
	{
		$dscode=$this->uri->segment(3);
		$result = $this->ajax_m->get_dscode($dscode);
		echo $result;
	}

	/* get_used_dscode() */
	function get_used_dscode()
	{
		$result = $this->ajax_m->get_used_dscode();
		echo $result;
	}

	/* get_ptcode() */
	function get_ptcode()
	{
		$ptcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_ptcode($ptcode);
		echo $result;
	}

	/* get_used_ptcode() */
	function get_used_ptcode()
	{
		$ptcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_used_ptcode($ptcode);
		echo $result;
	}


	/* get_frcode() */
	function get_frcode()
	{
		$ptcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_frcode($ptcode);
		echo $result;
	}
	/* get_frcode() */
	function get_frmail()
	{
		$result = $this->ajax_m->get_frmail();
		echo $result;
	}

	/* get_used_frcode() */
	function get_used_frcode()
	{
		$ptcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_used_frcode($ptcode);
		echo $result;
	}

	/* get_cidinfo() */
	function get_cidinfo()
	{
		$prq_fcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_cidinfo($prq_fcode);
		echo $result;
	}

	/* set_cidinfo */
	public function set_cidinfo()
	{
		$json['success']=false;
		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			
			//$table=$this->uri->segment(3);

			$st_no = $this->input->post("st_no", TRUE);
			$st_port = $this->input->post("st_port", TRUE);

			$write_data = array(
				'st_port'=>$st_port,
				'st_no'=>$st_no
			);
			$result = $this->ajax_m->set_cidinfo($write_data);
			echo $result;
		}
		else
		{
			echo json_encode($json); //로그인 필요 에러
		}
	}

	/* set_ptcode */
	public function set_ptcode()
	{
		$json['success']=false;
		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			
			$table=$this->uri->segment(3);

			$mode = $this->input->post("mode", TRUE);
			$pt_code_new = $this->input->post("pt_code_new", TRUE);
			$pt_name = $this->input->post("pt_name", TRUE);
			$edit_pt_name = $this->input->post("edit_pt_name", TRUE);

			$write_data = array(
				'mode'=>$mode,
				'pt_code_new'=>$pt_code_new,
				'pt_name'=>$pt_name,
				'edit_pt_name'=>$edit_pt_name
			);
			$result = $this->ajax_m->insert_ptcode($write_data);
			echo $result;
		}
		else
		{
			echo json_encode($json); //로그인 필요 에러
		}
	}

	/* set_frcode */
	public function set_frcode()
	{
		$json['success']=false;
		if( @$this->session->userdata('logged_in') == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
		{
			
			$table=$this->uri->segment(3);

			$mode = $this->input->post("mode", TRUE);
			$fr_code_new = $this->input->post("fr_code_new", TRUE);
			$fr_name = $this->input->post("fr_name", TRUE);
			$edit_fr_name = $this->input->post("edit_fr_name", TRUE);

			$write_data = array(
				'mode'=>$mode,
				'fr_code_new'=>$fr_code_new,
				'fr_name'=>$fr_name,
				'edit_fr_name'=>$edit_fr_name
			);
			$result = $this->ajax_m->insert_frcode($write_data);
			echo $result;
		}
		else
		{
			echo json_encode($json); //로그인 필요 에러
		}
	}


	/* get_id */
	public function get_id()
	{
		$json['success']=false;

			$user_id=$this->uri->segment(3);
			$mac_addr=$this->uri->segment(4);

			$write_data = array(
				'user_id'=>$user_id,
				'mac_addr'=>$mac_addr
			);
			$result = $this->ajax_m->get_id($write_data);
			echo $result;
	}

	/* get_email */
	public function get_email()
	{
		$json['success']=false;
		
//		$mb_email=$this->uri->segment(3);
//		$mac_addr=$this->uri->segment(4);

		$mb_email=$this->input->get("mb_email", TRUE);
		$mb_password=$this->input->get("mb_password", TRUE);
		$mac_addr=$this->input->get("mb_addr", TRUE);

		$write_data = array(
			'mb_email'=>$mb_email,
			'mb_password'=>$mb_password,
			'mac_addr'=>$mac_addr
		);
		$result = $this->ajax_m->get_email($write_data);
		echo $result;
	}

	/* get_id */
	public function get_mb_id()
	{
		$json['success']=false;

			
			$mb_id=$this->uri->segment(3);
			$mb_password=$this->uri->segment(4);
			$mb_hp=$this->uri->segment(5);

			$write_data = array(
				'mb_id'=>$mb_id,
				'mb_hp'=>$mb_hp,
				'mb_password'=>$mb_password
			);
			$result = $this->ajax_m->get_mb_id($write_data);
			echo $result;
	}

	/* get_member() */
	function get_member()
	{
		//$ptcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_member();
		echo $result;
	}

	/* get_store() */
	function get_store()
	{
		//$ptcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_store();
		echo $result;
	}

	/**
	 * 블랙 리스트 추가
	 */
	function black()
 	{
		//http://prq.co.kr/prq/ajax/black/01012345678 
		/*
		이용자가 SMS수신거부 신청시 데이터를 실시간으로 전달받기 원할 경우
		HTTP 프로토콜 POST방식으로 SMS수신거부신청 폰번호를 파라미터로 전달해줍니다.
		파라미터명은 다음과 같읍니다.
		gubun: 수신거부/회원탈퇴 구분(1:수신거부 2.회원탈퇴)
		phoneno : 수신거부폰번호
		dnis : 접속080번호 
		duration : 통화시간(초단위)
		그리고 리턴페이지에서 해당처리후 페이지호출성공여부 체크용으로 html테그없이 0 또는 1값을 뿌려주시면 되겠읍니다.

		궁금한 사항은 dhkim97@hanmail.net 으로 문의하시기 바랍니다.
		*/
		$gubun = $this->input->get("gubun", TRUE);
		$phoneno = $this->input->get("phoneno", TRUE);
		$dnis = $this->input->get("dnis", TRUE);
		$duration = $this->input->get("duration", TRUE);
/*
		$gubun = $this->input->post("gubun", TRUE);
		$phoneno = $this->input->post("phoneno", TRUE);
		$dnis = $this->input->post("dnis", TRUE);
		$duration = $this->input->post("duration", TRUE);
*/
		$write_data = array(
			'gubun'=>$gubun,
			'phoneno'=>$phoneno,
			'dnis'=>$dnis,
			'duration'=>$duration
		);

		$result = $this->ajax_m->set_black($write_data);
 	}


	function get_app()
 	{

		$this->load->view('ajax/comapp_v');
 	}

	/* set_mno */
	public function set_mno()
	{
		$json['success']=false;

		$mn_id= $this->input->post("mn_id", TRUE);
		$mn_email= $this->input->post("mn_email", TRUE);
		$mn_hp= $this->input->post("mn_hp", TRUE);
		$mn_operator= $this->input->post("mn_operator", TRUE);
		$mn_model= $this->input->post("mn_model", TRUE);
		$mn_version= $this->input->post("mn_version", TRUE);
		$mn_mms_limit= $this->input->post("mn_mms_limit", TRUE);
		$mn_dup_limit= $this->input->post("mn_dup_limit", TRUE);
		$mn_appvcode = $this->input->post("mn_appvcode ", TRUE);
		$mn_appvname= $this->input->post("mn_appvname", TRUE);

		$write_data = array(
			'mn_id'=>$mn_id,
			'mn_email'=>$mn_email,
			'mn_hp'=>$mn_hp,
			'mn_operator'=>$mn_operator,
			'mn_model'=>$mn_model,
			'mn_version'=>$mn_version,
			'mn_mms_limit'=>$mn_mms_limit,
			'mn_dup_limit'=>$mn_dup_limit,
			'mn_appvcode'=>$mn_appvcode ,
			'mn_appvname'=>$mn_appvname
		);
		$result = $this->ajax_m->set_mno($write_data);
		echo $result;
	}
	
	/* get_mnonfo() */
	function get_mnoinfo()
	{
		$mn_id=$this->uri->segment(3);
		$result = $this->ajax_m->get_mnoinfo($mn_id);

		echo $result;
	}
	
	/* set_mms */
	public function set_mms()
	{
		$json['success']=false;

		$mm_subject= $this->input->post("mm_subject", TRUE);
		$mm_content= $this->input->post("mm_content", TRUE);
		$mm_type= $this->input->post("mm_type", TRUE);
		$mm_receiver= $this->input->post("mm_receiver", TRUE);
		$mm_sender= $this->input->post("mm_sender", TRUE);
		$mm_imgurl= $this->input->post("mm_imgurl", TRUE);
		$mm_result= $this->input->post("mm_result", TRUE);
		$mm_ipaddr= $this->input->post("mm_ipaddr", TRUE);	
		/*전송량 추가 2016-03-08 (화) */
		$mm_monthly_cnt= $this->input->post("mm_monthly_cnt", TRUE);	
		$mm_daily_cnt= $this->input->post("mm_daily_cnt", TRUE);	

		$write_data = array(
			'mm_subject'=>$mm_subject,
			'mm_content'=>$mm_content,
			'mm_type'=>$mm_type,
			'mm_receiver'=>$mm_receiver,
			'mm_sender'=>$mm_sender,
			'mm_imgurl'=>$mm_imgurl,
			'mm_result'=>$mm_result,
			'mm_monthly_cnt'=>$mm_monthly_cnt,
			'mm_daily_cnt'=>$mm_daily_cnt,
			'mm_ipaddr'=>$mm_ipaddr
		);
		$result = $this->ajax_m->set_mms($write_data);
		echo $result;
	}

	/* get_franchise() */
	function get_franchise()
	{
		$prq_fcode=$this->uri->segment(3);
		$result = $this->ajax_m->get_franchise($prq_fcode);

		echo $result;
	}

	/* get_stat() */
	function get_stat()
	{
		$mb_hp=$this->uri->segment(3);
		$result = $this->ajax_m->get_stat($mb_hp);

		echo $result;
	}



	/* set_cdr */
	public function set_cdr()
	{
		$json['success']=false;
		/* http://prq.co.kr/prq/ajax/set_cdr/?
		port=1&
		callerid=01050421183&
		userid=0319044084@naver.com&
		calledid=01020135535&
		comname=COM3
		*/
		$UserID= $this->input->post("userid", TRUE);
		$port= $this->input->post("port", TRUE);
		$callerid= $this->input->post("callerid", TRUE);
		$calledid = $this->input->post("calledid", TRUE);
		$comname = $this->input->post("comname", TRUE);

		$write_data = array(
			'UserID'=>$UserID,
			'port'=>$port,
			'callerid'=>$callerid,
			'calledid'=>$calledid,
			'comname'=>$comname
		);
		$result = $this->ajax_m->set_cdr($write_data);
		echo $result;
	}

	/* set_ata */
	public function set_ata()
	{
		$json['success']=false;
		$msg= $this->input->post("message", TRUE);
		$subject= $this->input->post("subject", TRUE);
		$mb_hp= $this->input->post("mb_hp", TRUE);
		$tel= $this->input->post("tel", TRUE);

		$write_data = array(
			'subject'=>$subject,
			'msg'=>$msg,
			'mb_hp'=>$mb_hp,
			'tel'=>$tel
		);

		$result = $this->ajax_m->set_ata($write_data);
		echo $result;
	}

	/* set_device_info */
	public function set_device_info()
	{
		$json['success']=false;

		$mn_id= $this->input->post("mn_id", TRUE);
		$mn_hp= $this->input->post("mn_hp", TRUE);
		$mn_operator= $this->input->post("mn_operator", TRUE);
		$mn_model= $this->input->post("mn_model", TRUE);
		$mn_version= $this->input->post("mn_version", TRUE);
		$mn_mms_limit= $this->input->post("mn_mms_limit", TRUE);
		$mn_dup_limit= $this->input->post("mn_dup_limit", TRUE);
		$mn_appvcode = $this->input->post("mn_appvcode ", TRUE);
		$mn_appvname= $this->input->post("mn_appvname", TRUE);

		$write_data = array(
			'mn_id'=>$mn_id,
			'mn_hp'=>$mn_hp,
			'mn_operator'=>$mn_operator,
			'mn_model'=>$mn_model,
			'mn_version'=>$mn_version,
			'mn_mms_limit'=>$mn_mms_limit,
			'mn_dup_limit'=>$mn_dup_limit,
			'mn_appvcode'=>$mn_appvcode ,
			'mn_appvname'=>$mn_appvname
		);
		$result = $this->ajax_m->set_device_info($write_data);
		echo $result;
	}

	/* get_mnonfo2() */
	function get_mnoinfo2()
	{
		$mn_hp=$this->uri->segment(3);
		$result = $this->ajax_m->get_mnoinfo2($mn_hp);

		echo $result;
	}

	/* del_mno */
	public function del_mno()
	{
		$json['success']=false;
		$mn_no=$this->uri->segment(3);


		$write_data = array(
			'mn_no'=>$mn_no
		);
		$result = $this->ajax_m->del_mno($write_data);
		echo $result;
	}

	/* download */
	public function download()
	{
		$json['success']=false;
		//$url_no=$this->uri->segment(3);
		$setup_id=$this->input->post("setup_id", TRUE);
		$setup_pw=$this->input->post("setup_pw", TRUE);
		$setup_v=$this->input->post("setup_v", TRUE);


		$write_data = array(
			'success_yn'=>'N',
			'cause'=>'fail',
			'setup_id'=>$setup_id,
			'setup_pw'=>$setup_pw,
			'setup_v'=>$setup_v
		);
		$result = $this->ajax_m->get_login($write_data);
		echo $result;
	}

	/* get_storeno() */
	function get_storeno()
	{
		$st_no=$this->uri->segment(3);
		$result = $this->ajax_m->get_storeno($st_no);
		echo $result;
	}

	/* set_blog_status() */
	function set_blog_status()
	{
		$bl_no=$this->input->post("bl_no", TRUE);
		$bl_status=$this->input->post("bl_status", TRUE);

		$write_data = array(
			'bl_no'=>$bl_no,
			'bl_status'=>$bl_status,
		);
		$result = $this->ajax_m->set_blog_status($write_data);
		echo $result;
	}

	//get_origin
	function get_origin()
	{
		$pv_no=$this->uri->segment(3);
		$write_data = array(
			'pv_no'=>$pv_no,
			'pv_code'=>'5001',

		);
		$result = $this->ajax_m->get_origin($write_data);
		echo $result;
 	}

	//set_origin
	function set_origin()
	{
		$pv_no=$this->input->post("pv_no", TRUE);
		$pv_value=$this->input->post("pv_value", TRUE);

		$write_data = array(
			'pv_no'=>$pv_no,
			'pv_code'=>'5001',
			'pv_value'=>$pv_value,
		);
		$result = $this->ajax_m->set_origin($write_data);
		echo $result;
	}
	
	//get_values
	function get_values()
	{
		$pv_no=$this->input->post("pv_no", TRUE);
		$pv_code=$this->input->post("pv_code", TRUE);
		$write_data = array(
			'pv_no'=>$pv_no,
			'pv_code'=>$pv_code,
		);
		$result = $this->ajax_m->get_values($write_data);
		echo $result;
	}

	//set_values
	function set_values()
	{
		$pv_no=$this->input->post("pv_no", TRUE);
		$pv_value=$this->input->post("pv_value", TRUE);
		$pv_code=$this->input->post("pv_code", TRUE);

		$write_data = array(
			'pv_no'=>$pv_no,
			'pv_code'=>$pv_code,
			'pv_value'=>$pv_value,
		);
		$result = $this->ajax_m->set_values($write_data);
		echo $result;
	}

	/**
	 * curl refresh token
	 */
	function get_curl()
	{
		// Get cURL resource
		$curl = curl_init();
		$param="grant_type=refresh_token";
		$param.="&client_id=qfvtBcPswnXE4O0veCZU";
		$param.="&client_secret=PK6SrAhm8o";
		$param.="&refresh_token=giippIgHGQ7pZuisXnY7zbn5GffmhiiL5ip1YWMQmEiilYYiiSCuZip1QO6jxEiswVD6ip7CXpgDXMGWm1xHzx47ipOUkkbk768AkVlKHLL9fyXUKiiQVkie";

		$url = "https://nid.naver.com/oauth2.0/token?".$param;
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_URL => $url,
			CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		
		// Close request to clear up some resources
		curl_close($curl);

		return json_decode($resp, true);
	}

	function set_blog()
	{
	  $this->load->model('blog_m');		
	  $naver_id=$this->input->post("pb_naver_id", TRUE);
	  $pb_category=$this->input->post("pb_category", TRUE);

	  $token=$this->blog_m->get_access_token($naver_id);
	  if(count($token)==0)
	  {
		  $json=array();
		  $json['error_code']="999";
		  $json['message']="블로그API 회원정보가 없습니다.";
		$response=json_encode($json);
		echo $response;
	  }else{
	  $access_token=$token->access_token;
	  
	  $header = array('Authorization: Bearer '.$access_token);
	  $header = "Bearer ".$access_token; // Bearer 다음에 공백 추가

	  $title=$this->input->post("pb_title", TRUE);
	  $contents=$this->input->post("hidden_contents", TRUE);
	  $pb_naver_id=$this->input->post("pb_naver_id", TRUE);
	  $pb_category=$this->input->post("pb_category", TRUE);
	  $st_no=$this->input->post("st_no", TRUE);
	  $bl_no=$this->input->post("bl_no", TRUE);

	  $postvars = "title=".$title."&contents=".$contents;
	  $postvars.= "&categoryNo=".$pb_category;
	  $is_post = true;
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, "https://openapi.naver.com/blog/writePost.json");
	  curl_setopt($ch, CURLOPT_POST, $is_post);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
	  $headers[] = "Authorization: ".$header;
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	  $response = curl_exec ($ch);
	  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	//  echo "status_code:".$status_code."";
	  curl_close ($ch);
	  if($status_code == 200) {
		echo $response;
	  } else {
		echo "Error 내용:".$response;
	  }

	$de_response=json_decode($response);

/*
실패

{"message":"Authentication failed. (인증에 실패했습니다.)","error_code":"024"}
*/
//echo "de_response->message->result->logNo : (".intval($de_response->message->result->logNo).")";
//echo "<br>";
/* 실패 */
if(isset($de_response->error_code)&&$de_response->error_code=="024")
{
	$po_subject=$title;
	$po_content=$contents;
	$po_status="f";
	$na_code="";
	$na_http=$de_response->error_code;
	$na_message=$de_response->message;
	$bl_url="";
	$bl_naver_id=$pb_naver_id;
	$bl_category=$pb_category;
	$st_no=$st_no;
	$bl_no=$bl_no;
}else if(intval($de_response->message->result->logNo)>0){
/*
성공 : 실패
{"message":
	{ 
		"@type":"response", 
		"@service":"korea.naverkoreaservice.community.blog", 
		"@version":"1.0.0", 
		"result" : 
		{
			"blogId":"erm00",
			"logNo":220970797583,
			"postUrl":"http://erm00.blog.me/220970797583"
		} 
	}
}
*/
	$po_subject=$title;
	$po_content=$contents;
	$po_status="s";
	$na_code="";
	$na_http="200";
	$na_message="등록 되었습니다.";
	$bl_url=$de_response->message->result->postUrl;
	$bl_naver_id=$pb_naver_id;
	$bl_category=$pb_category;
	$st_no=$st_no;
	$bl_no=$bl_no;
}


	$write_data = array(
		'po_subject'=>$po_subject,
		'po_content'=>$po_content,
		'po_status'=>$po_status,
		'na_code'=>$na_code,
		'na_http'=>$na_http,
		'na_message'=>$na_message,
		'bl_url'=>$bl_url,
		'bl_naver_id'=>$bl_naver_id,
		'bl_category'=>$bl_category,
		'st_no'=>$st_no,
		'bl_no'=>$bl_no,
	);
	  $this->blog_m->set_post_log($write_data);
	  }
	}


	function get_refresh_token()
	{
	  $refresh_token="";
	  $this->load->model('blog_m');
	  $naver_id=$this->input->post("naver_id", TRUE);
	  $token=$this->blog_m->get_refresh_token($naver_id);
	  $refresh_token=$token->refresh_token;
	 
	  // Get cURL resource
	  $curl = curl_init();
	  $param="grant_type=refresh_token";
	  $param.="&client_id=qfvtBcPswnXE4O0veCZU";
	  $param.="&client_secret=PK6SrAhm8o";
	  $param.="&refresh_token=".$refresh_token;
	  
	  $url = "https://nid.naver.com/oauth2.0/token?".$param;
	  // Set some options - we are passing in a useragent too here
	  curl_setopt_array($curl, array(
	  	CURLOPT_RETURNTRANSFER => true,
	  	CURLOPT_URL => $url,
	  	CURLOPT_USERAGENT => 'Codular Sample cURL Request'
	  ));
	  // Send the request & save response to $resp
	  $resp = curl_exec($curl);
	  
	  // Close request to clear up some resources
	  curl_close($curl);
	  
	  $array=json_decode($resp, true);
	  $write_data = array(
	  	'naver_id'=>$naver_id,
	  	'access_token'=>$array['access_token']
	  );
	  $result = $this->blog_m->set_access_token($write_data);
	}
	
	/* set_category 
	네이버에서 불러온 카테고리 정보를 네이버  blogapi에 갱신한다.

	*/
	function set_category()
	{
	  $this->load->model('blog_m');		
	  $naver_id=$this->input->post("pb_naver_id", TRUE);
	  $token=$this->blog_m->get_access_token($naver_id);
	  $access_token=$token->access_token;
	  $header = "Bearer ".$access_token; // Bearer 다음에 공백 추가
	  $blogId =$naver_id;// 회원프로필 조회에서 얻은 네이버 ID값
	  $url = "https://openapi.naver.com/blog/listCategory.json?blogId=".$blogId;
	  $is_post = false;
	  $ch = curl_init();
	  curl_setopt($ch, CURLOPT_URL, $url);
	  curl_setopt($ch, CURLOPT_POST, $is_post);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	  $headers = array();
	  $headers[] = "Authorization: ".$header;
	  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	  $response = curl_exec ($ch);
	  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
	  //echo "status_code:".$status_code."";

	  curl_close ($ch);
	  if($status_code == 200) {
		  $write_data = array(
			'naver_id'=>$naver_id,
			'pb_category'=>$response
		  );
		  $result = $this->blog_m->set_category($write_data);
	  } else {

	  }
		echo $response;
	}

	
	//get_naver_cat
	function get_naver_cat()
	{
		$pb_naver_id=$this->input->post("pb_naver_id", TRUE);
		$write_data = array(
			'pb_naver_id'=>$pb_naver_id
		);
		$result = $this->ajax_m->get_naver_cat($write_data);
		echo $result;
	}

	
	//get_naverapi_id
	function get_naverapi_id()
	{
		$result = $this->ajax_m->get_naverapi_id();
		echo $result;
	}

		function is_posting()
	{
		$bl_no=$this->uri->segment(3);
		$write_array=array(
			'bl_no'=>$bl_no
		);
 		//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
 		$return=$this->ajax_m->is_posting($write_array);
		echo $return[0]->cnt;
	}

}
/* End of file ajax_board.php */
/* Location: ./bbs/application/controllers/ajax_board.php */