<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ajax 처리 controller.
 *
 * @author Jongwon, Byun <advisor@cikorea.net>
 */
class Ajax_board extends CI_Controller {

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
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />';
		$name = $this->input->post("name");
		echo $name."님 반갑습니다!";
	}

	public function ajax_comment_add()
	{
		if( @$this->session->userdata('logged_in') == TRUE )
		{
			$this->load->model('board_m');

			$table = $this->input->post("table", TRUE);;
			$board_id = $this->input->post("board_id", TRUE);;
			$comment_contents = $this->input->post("comment_contents", TRUE);

			if ( $comment_contents != '')
			{
				$write_data = array(
					'table' => $table, //게시판 테이블명
					'board_pid' => $board_id, //원글 번호
					'subject' => '',
					'contents' => $comment_contents,
					'user_id' => $this->session->userdata('username')
				);

				$result = $this->board_m->insert_comment($write_data);

				if ( $result )
				{
					//글 작성 성공시 댓글 목록 만들어 화면 출력
					$sql = "SELECT * FROM ".$table." WHERE board_pid = '".$board_id."' ORDER BY board_id DESC";
					$query = $this->db->query($sql);
?>
	<table cellspacing="0" cellpadding="0" class="table table-striped" id="comment_table">
<?php
foreach ($query->result() as $lt)
{
?>
			<tr id="row_num_<?php echo $lt->board_id;?>">
				<th scope="row">
					<?php echo $lt->user_id;?>
				</th>
				<td><?php echo $lt->contents;?></a></td>
				<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
				<td><a href="#" class="comment_delete" vals="<?php echo $lt->board_id;?>"><i class="icon-trash"></i>삭제</a></td>
			</tr>
<?php
}
?>

	</table>
<?php
				}
				else
				{
					//글 실패시
					echo "2000";
				}

			}
			else
			{
				//글 내용이 없을 경우
				echo "1000";
			}
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