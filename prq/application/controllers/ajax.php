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
			$this->load->model('ajax_m');

			$chk_seq = $this->input->post("chk_seq", TRUE);
			$mb_status = $this->input->post("mb_status", TRUE);
			$mb_reason = $this->input->post("mb_reason", TRUE);
			$join_chk_seq=join(",",$chk_seq);
//			if ( $comment_contents != '')
//			{
				$write_data = array(
					'mb_status'=>$mb_status,
					'mb_reason'=>$mb_reason,
					'join_chk_seq' => $join_chk_seq
				);

//				$result = $this->board_m->insert_comment($write_data);
				$result = $this->ajax_m->chg_status($write_data);
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
}

/* End of file ajax_board.php */
/* Location: ./bbs/application/controllers/ajax_board.php */