<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Ajax 처리 controller.
 */
class Ajax_board extends CI_Controller {

 	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
		$this->load->library('session');
	}

	public function ajax_comment_add()
	{
		$this->load->model('sns_m');

		$board_id = $this->input->post("id", TRUE);;
		$comment_contents = $this->input->post("comment_contents", TRUE);

		if ( $comment_contents != '')
		{
			$write_data = array(
				'pid' => $board_id, //원글 번호
				'user_id' => $this->session->userdata('username'),
				'subject' => '',
				'contents' => $comment_contents,
			);

			$result = $this->sns_m->insert_comment($write_data);

			if ( $result )
			{
				//글 작성 성공시 댓글 목록 만들어 화면 출력
				$sql = "SELECT * FROM sns_files WHERE pid = '".$board_id."' ORDER BY id DESC";
				$query = $this->db->query($sql);
?>
<table cellspacing="0" cellpadding="0" class="table table-striped" id="comment_table">
<?php
foreach ($query->result() as $lt)
{
?>
		<tr id="row_num_<?php echo $lt->id;?>">
			<td><?php echo $lt->contents;?></a></td>
			<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
			<td><a href="#" class="comment_delete" vals="<?php echo $lt->id;?>"><i class="icon-trash"></i>삭제</a></td>
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

	public function ajax_comment_delete()
	{
		if( @$this->session->userdata('logged_in') == TRUE )
		{
			$this->load->model('sns_m');

			$table = 'sns_files';
			$board_id = $this->input->post("id", TRUE);;

			//글 작성자가 본인인지 검증
			$writer_id = $this->sns_m->writer_check($board_id);

			if( $writer_id->user_id != $this->session->userdata('username') )
			{
				echo "8000"; //본인이 작성한 글이 아닙니다.
			}
			else
			{
				$result = $this->sns_m->delete_content($board_id);

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

	function more_list()
	{
		$limit = 6;
		$last_id = $this->uri->segment(3);
		$i = $last_id + 1;

     	$sql = "SELECT * FROM sns_files WHERE pid = '0' ORDER BY id DESC LIMIT ".$last_id.", ".$limit;
   		$query = $this->db->query($sql);

		echo '<tr class="wrdLatest">';
		//var_dump($sql);
		foreach($query->result() as $lt)
		{
			$file_info = explode(".", $lt->file_name);
			if(is_file('./uploads/'.$file_info[0].'_thumb.'.$file_info[1]))
			{
				$thumb_img = '/sns/uploads/'.$file_info[0].'_thumb.'.$file_info[1];
			}
			else
			{
				$thumb_img = '/sns/uploads/'.$lt->file_name;
			}
?>
				<th scope="row">
					<img src="<?php echo $thumb_img;?>"><br>
					<a rel="external" href="/sns/controlls/view/<?php echo $lt->id;?>"><?php echo $lt->subject;?></a> <br>
					<time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time>
				</th>
<?php
			if($i % 2 == 0)
			{
?>
			</tr>
			<tr class="wrdLatest" id="<?php echo $i+2?>">
<?php
	     	}
			$i++;
		}
		echo '</tr>';
	}

	function mobile_more_list()
	{
		$limit = 6;
		$last_id = $this->uri->segment(3);
		$i = $last_id + 1;

     	$sql = "SELECT * FROM sns_files WHERE pid = '0' ORDER BY id DESC LIMIT ".$last_id.", ".$limit;
   		$query = $this->db->query($sql);


		foreach($query->result() as $lt)
		{
			$file_info = explode(".", $lt->file_name);
			if(is_file('./uploads/'.$file_info[0]."_thumb.".$file_info[1]))
			{
				$thumb_img = '/sns/uploads/'.$file_info[0]."_thumb.".$file_info[1];
			}
			else
			{
				$thumb_img = '/sns/uploads/'.$lt->file_name;
			}
		?>
				<li class="wrdLatest wrdLatest ui-btn ui-btn-up-c ui-btn-icon-right ui-li-has-arrow ui-li ui-li-has-thumb" id="<?php echo $i?>" data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="div" data-icon="arrow-r" data-iconpos="right" data-theme="c"><a rel="external" href="/sns/controlls/view/<?php echo $lt->id;?>"><img src="<?php echo $thumb_img;?>" width="80" height="60"> <?php echo $lt->subject;?> <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time></a></li>
		<?php
			$i++;
		}
	}

	function mobile_more_list2()
	{
     	$sql = "SELECT * FROM sns_files WHERE pid = '0' ORDER BY id DESC LIMIT 0, 6";
   		$query = $this->db->query($sql);

		$return = array();
		foreach($query->result() as $lt)
		{
			$file_info = explode(".", $lt->file_name);
			if(is_file('./uploads/'.$file_info[0]."_thumb.".$file_info[1]))
			{
				$thumb_img = 'http://192.168.0.2/sns/uploads/'.$file_info[0]."_thumb.".$file_info[1];
			}
			else
			{
				$thumb_img = 'http://192.168.0.2/sns/uploads/'.$lt->file_name;
			}
			$return[]['image'] = $thumb_img;
		}
		echo $_GET['callback'].'('.urldecode(json_encode(array('lists'=>$return))).')';
	}
}
/* End of file ajax_board.php */
/* Location: ./sns/application/controllers/ajax_board.php */