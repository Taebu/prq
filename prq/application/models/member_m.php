<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 공통 멤버 총판에서 가맹점 모델 (이미지 포함)
 * 작성 :2015-12-16 (수)
 * 수정 : 
 * 
 * 총판	Distributors	DS
 * 대리점	Partner	PT
 * 가맹점	Franchise	FR
 * 
 * @author Taebu,Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Memeber_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

	/**
	 * 게시물 목록 가져오기
	 *
	 * @author Taebu <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $type 총 게시물 수 또는 게시물 배열을 반환할 지를 결정하는 구분자
	 * @param string $offset 게시물 가져올 순서
	 * @param string $limit 한 화면에 표시할 게시물 갯수
	 * @param string $search_word 검색어
	 * @return array
	 */
    function get_list($table='prq_member', $type='', $offset='', $limit='', $search_word='')
    {
		$sword= ' WHERE 1=1 ';

		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword = ' WHERE subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
     	}

    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}
		$table='ci_board';
    	//$sql = "SELECT * FROM ".$table.$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
		$sql = "SELECT * FROM ".$table." ".$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
   		$query = $this->db->query($sql);

		if ( $type == 'count' )
     	{
     		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
	    	$result = $query->num_rows();

	    	//$this->db->count_all($table);
     	}
     	else
     	{
     		//게시물 리스트 반환
	    	$result = $query->result();
     	}

    	return $result;
    }

    /**
	 * 게시물 상세보기 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_view($table, $id)
    {
    	//조회수 증가
    	$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		$this->db->query($sql0);

    	$sql = "SELECT * FROM ".$table." WHERE board_id='".$id."'";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }

	/**
	 * 게시물 입력
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_board($arrays)
 	{
		$insert_array = array(
			'mb_id' => $arrays['mb_id'],
			'mb_email' => $arrays['mb_email'],
			'mb_addr1' => $arrays['mb_addr1'],
			'mb_addr2' => $arrays['mb_addr2'],
			'mb_addr3' => $arrays['mb_addr3'],
			'password' => $arrays['password'],
			'mb_hp' => $arrays['mb_hp'],
			'mb_business_num' => $arrays['mb_business_num'],
			'mb_exactcaculation_ratio' => $arrays['mb_exactcaculation_ratio'],
			'mb_bankname' => $arrays['mb_bankname'],
			'mb_banknum' => $arrays['mb_banknum'],
			'mb_bankholder' => $arrays['mb_bankholder'],
			'mb_bigo' => $arrays['mb_bigo'],
			'mb_business_paper' => $arrays['mb_business_paper'],
			'mb_distributors_paper' => $arrays['mb_distributors_paper'],
			'mb_bank_paper' => $arrays['mb_bank_paper']
		);

		$result = $this->db->insert($arrays['table'], $insert_array);

		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 수정
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 테이블명, 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function modify_board($arrays)
 	{
		$modify_array = array(
				'subject' => $arrays['subject'],
				'contents' => $arrays['contents']
		);

		$where = array(
				'board_id' => $arrays['board_id']
		);

		$result = $this->db->update($arrays['table'], $modify_array, $where);

		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 삭제
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 테이블명
	 * @param string $no 게시물번호
	 * @return boolean 삭제 성공여부
	 */
	function delete_content($table, $no)
 	{
		$delete_array = array(
				'board_id' => $no
		);

		$result = $this->db->delete($table, $delete_array);

		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 작성자 아이디 반환
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $board_id 게시물번호
	 * @return string 작성자 아이디
	 */
	function writer_check($table, $board_id)
	{
		$sql = "SELECT user_id FROM ".$table." WHERE board_id = '".$board_id."'";

		$query = $this->db->query($sql);

		return $query->row();
	}

	/**
	 * 댓글 입력
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_comment($arrays)
 	{
		$insert_array = array(
			'board_pid' => $arrays['board_pid'], //원글번호 입력
			'user_id' => $arrays['user_id'],
			'user_name' => $arrays['user_id'],
			'subject' => $arrays['subject'],
			'contents' => $arrays['contents'],
			'reg_date' => date("Y-m-d H:i:s")
		);

		$this->db->insert($arrays['table'], $insert_array);

		$board_id = $this->db->insert_id();

		//결과 반환
		return $board_id;
 	}

	/**
	 * 댓글 리스트 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_comment($table, $id)
    {
    	$sql = "SELECT * FROM ".$table." WHERE board_pid='".$id."' ORDER BY board_id DESC";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }
}

/* End of file board_m.php */
/* Location: ./application/models/board_m.php */