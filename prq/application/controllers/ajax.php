<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ajax 처리 controller.
 *
 * @author Jongwon, Byun <advisor@cikorea.net>
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
		if( @$this->session->userdata('logged_in') == TRUE )
		{

			
			$table=$this->uri->segment(3);

			$chk_seq = $this->input->post("chk_seq", TRUE);
			$mb_status = $this->input->post("mb_status", TRUE);
			$ds_name = $this->input->post("ds_name", TRUE);

			$mb_reason = $this->input->post("mb_reason", TRUE);
			$mb_id = $this->input->cookie('name', TRUE);
			$join_chk_seq=join(",",$chk_seq);
			$join_ds_code=join("','",$chk_seq);

//			if ( $comment_contents != '')
//			{
				$write_data = array(
					'prq_table'=>$table,
					'mb_status'=>$mb_status,
					'ds_name'=>$ds_name,
					'mb_id'=>$mb_id,
					'mb_reason'=>$mb_reason,
					'join_chk_seq' => $join_chk_seq,
					'join_ds_code' => $join_ds_code
				);

//				$result = $this->board_m->insert_comment($write_data);
				if($table=="prq_member"){
					$result = $this->ajax_m->chg_status($write_data);
				}else if($table!="prq_member"){
					$result = $this->ajax_m->chg_status_code($write_data);
				}
//			}
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
		if( @$this->session->userdata('logged_in') == TRUE )
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
		$result = $this->ajax_m->get_frcode();
		echo $result;
	}

	/* set_ptcode */
	public function set_ptcode()
	{
		$json['success']=false;
		if( @$this->session->userdata('logged_in') == TRUE )
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
		if( @$this->session->userdata('logged_in') == TRUE )
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

			
//			$mb_email=$this->uri->segment(3);
//			$mac_addr=$this->uri->segment(4);

			$mb_email=$this->input->get("mb_email", TRUE);
			$mac_addr=$this->input->get("mb_addr", TRUE);

			$write_data = array(
				'mb_email'=>$mb_email,
				'mac_addr'=>$mac_addr
			);
			$result = $this->ajax_m->get_email($write_data);
			echo $result;
	}
}

/* End of file ajax_board.php */
/* Location: ./bbs/application/controllers/ajax_board.php */