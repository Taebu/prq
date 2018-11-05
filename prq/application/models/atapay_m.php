<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 모델명 : Atapay_m
 * 기능 : 알림톡 모델
 * 작성 : 2018-02-08 (목) 14:48:38 
 * 수정 : 
 * 
 *
 * 1.0 
 * 
 * @author Taebu, Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Atapay_m extends CI_Model
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
    function get_list($table='prq_store', $type='', $offset='', $limit='', $search_word='')
    {
		$sword= ' WHERE 1=1 ';
		if($table==""){
		$table='prq_store';
		}
		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword = ' WHERE subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
     	}


		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		$mb_gcode=$this->input->cookie('mb_gcode', TRUE);

		/*총판인 경우*/
		if( $mb_gcode=="G3"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		/*대리점인 경우*/
		}else if( $mb_gcode=="G4"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		/*가맹점인 경우*/
		}else if( $mb_gcode=="G5"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		}

    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}else{
		
		}
//		$table="ci_board";
    	//$sql = "SELECT * FROM ".$table.$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
		$sql = "SELECT * FROM ".$table." ".$sword."  ORDER BY st_no DESC".$limit_query;
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
    function get_list2($table='prq_store', $type='', $offset='', $limit='', $search_array=array())
    {
		$sword= ' WHERE 1=1 ';
		if($table==""){
		$table='prq_store';
		}
		if (empty($search_array))
     	{
     		//검색어가 있을 경우의 처리
     		$sword = ' WHERE subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
     	}


		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		$mb_gcode=$this->input->cookie('mb_gcode', TRUE);

		/*총판인 경우*/
		if( $mb_gcode=="G3"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		/*대리점인 경우*/
		}else if( $mb_gcode=="G4"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		/*가맹점인 경우*/
		}else if( $mb_gcode=="G5"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		}

		if ( $search_array['mb_id'] != '' )
		{
			//검색어가 있을 경우의 처리
			$sword .= ' and mb_id like "%'.$search_array['mb_id'].'%" ';
		}
		
		if ( $search_array['st_name'] != '' )
		{
			//검색어가 있을 경우의 처리
			$sword .= ' and st_name like "%'.$search_array['st_name'].'%" ';
		}

		if ( $search_array['prq_fcode'] != '' )
		{
			//검색어가 있을 경우의 처리
			$sword .= ' and prq_fcode like "%'.$search_array['prq_fcode'].'%" ';
		}

    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}else{
		
		}

		if($table=='prq_store')
		{
			$order=" ORDER BY st_no DESC ";
		}else{
			$order=" ORDER BY ap_no DESC ";
		}
//		$table="ci_board";
    	//$sql = "SELECT * FROM ".$table.$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
		$sql = "SELECT * FROM ".$table." ".$sword.$order.$limit_query;
   		$query = $this->db->query($sql);
		//echo $sql;
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
	 * @author Taebu Moon <erm00@naver.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_view($table, $id)
    {
    	//조회수 증가
//    	$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
//   		$this->db->query($sql0);

    	$sql = "SELECT * FROM ".$table." WHERE ap_no='".$id."'";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }



	/**
	 * 게시물 입력
	 * @author Taebu Moon <erm00@naver.com>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_store($arrays)
 	{
		$result = $this->db->insert($arrays['table'], $arrays); 
		$last_id=$this->db->insert_id();
		//결과 반환
		return $last_id;
 	}


	/**
	 * ATAPAY 수정
	 *
	 * @author Taebu Moon <erm00@naver.com>
	 * @param array $arrays 테이블명, 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function modify_atapay($arrays)
 	{
		$modify_array = $arrays;
		$where = array(
				'ap_no' => $arrays['ap_no']
		);
		$table=$arrays['table'];
		$modify_array=array_diff_key($modify_array, array('table' => ""));
		$result = $this->db->update($table, $modify_array, $where);
		//결과 반환
		return $result;
 	}
	/**
	 * 게시물 삭제
	 *
	 * @author Taebu Moon <erm00@naver.com>
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
	 * @author Taebu Moon <erm00@naver.com>
	 * @param string $table 게시판 테이블
	 * @param string $board_id 게시물번호
	 * @return string 작성자 아이디
	 */
	function writer_check($table, $board_id)
	{
		$sql = "SELECT st_no FROM ".$table." WHERE st_no = '".$board_id."'";

		$query = $this->db->query($sql);

		return $query->row();
	}

    /**
	 * 로그 정보 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param $array['table'] 상점 테이블, 멤버
	 * @param $array['st_no'] 상점 이름
	 * @return list
	 */
    function get_logs($array)
    {

    	$sql = "SELECT * FROM prq_log WHERE prq_table='prq_store' and mb_no='".$array['st_no']."';";
		//echo $sql;
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->result();

    	return $result;
    }
		/**/
		function insert_atapay($arrays)
	 	{
			$ap_limit=$arrays['ap_price']/10;
			$sql_array=array();
			$sql_array[]="INSERT INTO ".$arrays['table']." SET ";
			$sql_array[]="prq_fcode='".$arrays['prq_fcode']."',";
			$sql_array[]="st_name='".$arrays['st_name']."',";
			$sql_array[]="st_no='".$arrays['st_no']."',";
			$sql_array[]="ap_price='".$arrays['ap_price']."',";
			$sql_array[]=sprintf("ap_limit='%s',",$ap_limit);
			$sql_array[]="ap_reserve='".$arrays['ap_reserve']."',";
			$sql_array[]="ap_autobill_yn='".$arrays['ap_autobill_yn']."',";
			$sql_array[]="ap_autobill_date='".$arrays['ap_autobill_date']."',";
			$sql_array[]="ap_status='".$arrays['ap_status']."',";
			$sql_array[]="ap_datetime=now();";
			$sql=join("",$sql_array);
			$result = $this->db->query($sql);
			
			$last_id=$this->db->insert_id();
			
			/* 상점 정보 갱신 */
			$sql_array=array();
			$sql_array[]="UPDATE `prq`.`prq_store` SET ";
			$sql_array[]="`st_ata_YN`='Y' ";
			$sql_array[]="WHERE `st_no`='".$arrays['st_no']."';";
			$sql=join("",$sql_array);
			$result = $this->db->query($sql);

			//결과 반환
			return $last_id;
			
 	}


	/**
	 * 그룹별 상점갯수
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @return array
	 */
    function get_groupcnt($table)
    {
    	if($table=="prq_store")
			{
				$sql = "select st_status,count(*) cnt from prq_store group by st_status;";
			}else if($table=="prq_ata_pay"){
				$sql = "select ap_status,count(*) cnt from prq_ata_pay group by ap_status;";
			}
   		$query = $this->db->query($sql);

			$result = $query->result();

    	return $result;
    }

	/**
	* 상점 정보 가져오기
	*
	* @author Taebu Moon <mtaebu@gmail.com>
	* @param string $table 게시판 테이블
	* @param string $id 게시물번호
	* @return array
	*/
	function get_appids($arrays)
	{
		//조회수 증가
		//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
		//$this->prq->query($sql0);

		$sql = "SELECT * FROM bc_plusfriend ";
		$query = $this->db->query($sql);

		//댓글 리스트 반환
		return $query->result();
	}

    /**
	 * 상점 정보 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_store()
    {
    	//조회수 증가
    	//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		//$this->prq->query($sql0);

    	$sql = "SELECT * FROM `prq_store` ";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
      return $query->result();
    }
    /**
	 * 대리점 정보 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_member()
    {
    	$sql = "SELECT * FROM `prq_member` ";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
      return $query->result();
    }


    /**
	 * 상점 정보 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_plusfriend()
    {
    	//조회수 증가
    	//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		//$this->prq->query($sql0);

    	$sql = "SELECT * FROM `bt_plusfriend` ";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
      return $query->result();
    }
    /**
	 * 상점 정보 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_template()
    {
    	//조회수 증가
    	//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		//$this->prq->query($sql0);

    	$sql = "SELECT * FROM `bt_template` ";
    	$sql = "SELECT * FROM `bt_template` group by bt_code;";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
      return $query->result();
    }
}

/* End of file store_m.php */
/* Location: ./prq/application/models/atapay_m.php */