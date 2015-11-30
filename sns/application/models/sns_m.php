<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * sns 모델
 */
class Sns_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	/**
	 * SNS 쓰기
	 *
	 * @param array $arrays 업로드 파일 정보 및 글내용
	 * @return string 글번호
	 */
	function insert_sns($arrays)
	{
		//업로드파일 기타 정보
		$detail = array(
			'file_size'=>(int)$arrays['file_size'],
			'image_width'=>$arrays['image_width'],
			'image_height'=>$arrays['image_height'],
			'file_ext'=>$arrays['file_ext']
		);

		$insert_array = array(
			'user_id' => $arrays['user_id'],
			'subject' => $arrays['subject'],
			'contents' => $arrays['contents'],
			'file_path' => $arrays['file_path'],
			'file_name' => $arrays['file_name'],
			'original_name' => $arrays['orig_name'],
			'detail_info' => serialize($detail),
			'reg_date' => date("Y-m-d H:i:s")
		);
		$this->db->insert('sns_files', $insert_array);

		$result = $this->db->insert_id();

		//결과 반환
		return $result;
	}

	/**
	 * SNS 내용 가져오기
	 *
	 * @param string $id sns_files id
	 * @return array 글내용
	 */
	function gett_sns($arrays)
	{
		$query = $this->db->get_where('sns_files', array('id'=>$id));

		return $query->row_array();
	}

	/**
	 * SNS 리스트 가져오기
	 *
	 * @return array 리스트
	 */
	function get_sns_list($table, $type='', $offset='', $limit='', $search_word='')
	{
		$sword= '';

		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword = ' and (subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" or original_name like "%'.$search_word.'%")';
     	}

    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}

    	$sql = "SELECT * FROM ".$table." WHERE pid = '0' ".$sword." ORDER BY id DESC".$limit_query;
   		$query = $this->db->query($sql);

		if ( $type == 'count' )
     	{
     		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
	    	$result = $query->num_rows();
     	}
     	else
     	{
     		//게시물 리스트 반환
	    	$result = $query->result();
     	}

    	return $result;
	}

	 /**
	 * 상세보기 가져오기
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_view($id)
    {
    	//조회수 증가
    	$sql0 = "UPDATE sns_files SET hit=hit+1 WHERE id='".$id."'";
   		$this->db->query($sql0);

    	$sql = "SELECT * FROM sns_files WHERE id='".$id."'";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }

	/**
	 * 댓글 입력
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_comment($arrays)
 	{
		$insert_array = array(
			'pid' => $arrays['pid'], //원글번호 입력
			'user_id' => $arrays['user_id'],
			'subject' => $arrays['subject'],
			'contents' => $arrays['contents'],
			'reg_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert('sns_files', $insert_array);

		$board_id = $this->db->insert_id();

		//결과 반환
		return $board_id;
 	}

	/**
	 * 게시물 작성자 아이디 반환
	 * @param string $board_id 게시물번호
	 * @return string 작성자 아이디
	 */
	function writer_check($board_id)
	{
		$sql = "SELECT user_id FROM sns_files WHERE id = '".$board_id."'";
		$query = $this->db->query($sql);

		return $query->row();
	}

	/**
	 * 댓글 리스트 가져오기
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_comment($id)
    {
    	$sql = "SELECT * FROM sns_files WHERE pid='".$id."' ORDER BY id DESC";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

	/**
	 * 게시물 삭제
	 * @param string $no 게시물번호
	 * @return boolean 삭제 성공여부
	 */
	function delete_content($no)
 	{
		$delete_array = array('id' => $no);

		$result = $this->db->delete('sns_files', $delete_array);

		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 수정
	 * @param array $arrays 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function update_sns($arrays)
 	{
		if(@$arrays['file_name'])
		{
			//업로드파일 기타 정보
			$detail = array(
				'file_size'=>(int)$arrays['file_size'],
				'image_width'=>$arrays['image_width'],
				'image_height'=>$arrays['image_height'],
				'file_ext'=>$arrays['file_ext']
			);

			$modify_array = array(
				'subject' => $arrays['subject'],
				'contents' => $arrays['contents'],
				'file_path' => $arrays['file_path'],
				'file_name' => $arrays['file_name'],
				'original_name' => $arrays['orig_name'],
				'detail_info' => serialize($detail),
				'reg_date' => date("Y-m-d H:i:s")
			);
		}
		else
		{
			$modify_array = array(
				'subject' => $arrays['subject'],
				'contents' => $arrays['contents']
			);
		}

		$where = array(
				'id' => $arrays['id']
		);

		$result = $this->db->update('sns_files', $modify_array, $where);

		//결과 반환
		return $result;
 	}
}

/* End of file sns_m.php */
/* Location: ./application/models/sns_m.php */