<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 공통 로그에서 CID , GCM, MMS, ACT(action) 로그 리스트 출력
 * 작성 :2016-02-12 (금)
 * 수정 : 
 * 
 * @CID	cid	logs/cid
 * @GCM	gcm	logs/gcm
 * @MMS	mms	logs/mms
 * @ACT	act	logs/act
 * 
 * @author Taebu,Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Logs_m extends CI_Model
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
		$order="";
		$sword= ' WHERE 1=1 ';
		$sword= ' ';

		if($table=="gcm"){
			$table='prq_gcm_log';
		}else if($table=="mms"){
			$table='prq_mms_log';
		}else 	if($table=="act"){
			$table='prq_log';
		}else 	if($table=="cid"){
			$table='prq_cdr';
		}

		//검색어가 있을 경우의 처리
		if ( $search_word != '' )
     	{

			if($table=="gcm"){
				$sword .= ' and gc_sender like "%'.$search_word.'%" or gc_receiver like "%'.$search_word.'%" ';
			}else if($table=="mms"){
				/*
				mysql> desc prq_mms_log;
				+----------------+-------------------------+------+-----+---------------------+----------------+
				| Field          | Type                    | Null | Key | Default             | Extra          |
				+----------------+-------------------------+------+-----+---------------------+----------------+
				| mm_no          | int(11)                 | NO   | PRI | NULL                | auto_increment |
				| mm_subject     | varchar(255)            | YES  |     | NULL                |                |
				| mm_content     | text                    | YES  |     | NULL                |                |
				| mm_type        | enum('mms','sms','lms') | NO   |     | mms                 |                |
				| mm_receiver    | varchar(16)             | YES  |     | 0                   |                |
				| mm_sender      | varchar(16)             | YES  |     | 0                   |                |
				| mm_imgurl      | varchar(255)            | YES  |     |                     |                |
				| mm_result      | varchar(255)            | NO   |     | NULL                |                |
				| mm_datetime    | datetime                | NO   |     | 0000-00-00 00:00:00 |                |
				| mm_status      | char(1)                 | YES  |     | I                   |                |
				| mm_ipaddr      | varchar(15)             | NO   |     |                     |                |
				| mm_stno        | int(11)                 | NO   |     | 0                   |                |
				| mm_monthly_cnt | varchar(255)            | YES  |     |                     |                |
				| mm_daily_cnt   | varchar(255)            | YES  |     |                     |                |
				+----------------+-------------------------+------+-----+---------------------+----------------+
				*/
				$sword .= ' and mm_sender like "%'.$mm_sender.'%" or mm_receiver like "%'.$mm_receiver.'%" ';
			}else 	if($table=="act"){
				$sword .= ' and gc_sender like "%'.$search_word.'%" or gc_receiver like "%'.$search_word.'%" ';
			}else 	if($table=="cid"){
				$sword .= ' and gc_sender like "%'.$search_word.'%" or gc_receiver like "%'.$search_word.'%" ';
			}

     	}
		if($this->input->cookie('mb_gcode', TRUE)!="G1"){
		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		if( strlen($prq_fcode)>2){
			$sword .= ' and prq_fcode= "'.$prq_fcode.'" ';
		}
		}
    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}else{
		
		}

		$sql=array();
		$sql[]="SELECT * ";
		$sql[]=" FROM ".$table." ";
		if($table=="prq_gcm_log"){
			$sql[]=" where gc_status='I' ";
			if ( $search_word != '' )
     		{
			$sql[]=$sword;
			}
			$sql[]=" order by gc_no desc ";
		}else if($table=="prq_mms_log"){
			$sql[]=" order by mm_no desc ";
		}else if($table=="prq_cdr"){
			$sql[]=" order by cd_date desc ";
		}else if($table=="prq_log"){
			$sql[]=" order by lo_datetime desc ";
		}

		
		$sql[] =$limit_query.";";

   		$query = $this->db->query(join("",$sql));

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
	 * @param string $search_array 검색어
	 * @return array
	 */
    function get_list2($table='prq_member', $type='', $offset='', $limit='', $search_array=array())
    {
		$order="";
		$sword= ' WHERE 1=1 ';
		$sword= ' ';
		if($table=="gcm"){
		$table='prq_gcm_log';
		}else if($table=="mms"){
		$table='prq_mms_log';
		}else 	if($table=="act"){
		$table='prq_log';
		}else 	if($table=="cid"){
		$table='prq_cdr';
		}

		if($table=='prq_gcm_log')
		{
			if ( $search_array['gc_sender'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and gc_sender like "%'.$search_array['gc_sender'].'%" ';
			}
			
			if ( $search_array['gc_receiver'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and gc_receiver like "%'.$search_array['gc_receiver'].'%" ';
			}
		}
		/*
			mysql> select * from prq_cdr order by cd_date desc limit 1\G;
			*************************** 1. row ***************************
			cd_date: 2016-02-18 15:39:11
			cd_id: prq001@naver.com
			cd_port: 1
			cd_callerid: 01022932389
			cd_calledid:
			cd_state: 1
			cd_name: 배터지는생돈까스
			cd_tel: 0553639245
			cd_hp: 01028365246
			1 row in set (0.00 sec)
		*/
		if($table=='prq_cdr')
		{
			if ( $search_array['cd_id'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and cd_id like "%'.$search_array['cd_id'].'%" ';
			}
			
			if ( $search_array['cd_name'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and cd_name like "%'.$search_array['cd_name'].'%" ';
			}

			if ( $search_array['cd_callerid'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and cd_callerid like "%'.$search_array['cd_callerid'].'%" ';
			}
		}

		if($table=='prq_mms_log')
		{
			if ( $search_array['mm_subject'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and mm_subject like "%'.$search_array['mm_subject'].'%" ';
			}
			
			if ( $search_array['mm_content'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and mm_content like "%'.$search_array['mm_content'].'%" ';
			}

			if ( $search_array['mm_receiver'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and mm_receiver like "%'.$search_array['mm_receiver'].'%" ';
			}

			if ( $search_array['mm_sender'] != '' )
			{
				//검색어가 있을 경우의 처리
				$sword .= ' and mm_sender like "%'.$search_array['mm_sender'].'%" ';
			}

		}
		
		if($this->input->cookie('mb_gcode', TRUE)!="G1"){
		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		if( strlen($prq_fcode)>2){
			$sword .= ' and prq_fcode= "'.$prq_fcode.'" ';
		}
		}
    	$limit_query = '';

    	if ( $limit != '' OR $offset != '' )   
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}else{
		
		}

		$sql=array();
		$sql[]="SELECT * ";
		$sql[]=" FROM ".$table." ";
		if($table=="prq_gcm_log"){
			$sql[]=" where gc_status='I' ";
			if ( $search_array != '' )
     		{
			$sql[]=$sword;
			}
			$sql[]=" order by gc_no desc ";
		}else if($table=="prq_mms_log"){
			$sql[]=" where 1=1 ";
			if ( $search_array != '' )
     		{
			$sql[]=$sword;
			}
			$sql[]=" order by mm_no desc ";
		}else if($table=="prq_cdr"){
			$sql[]=" where 1=1 ";
			if ( $search_array != '' )
     		{
			$sql[]=$sword;
			}
			$sql[]=" order by cd_date desc ";
		}else if($table=="prq_log"){
			$sql[]=" order by lo_datetime desc ";
		}

		
		$sql[] =$limit_query.";";

		//echo join("",$sql);
   		$query = $this->db->query(join("",$sql));

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
//    	$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
//   		$this->db->query($sql0);

    	$sql = "SELECT * FROM ".$table." WHERE mb_no='".$id."'";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }



	/**
	 * 게시물 입력
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_distributors($arrays)
 	{
		$sql_array = array(
			'mb_pcode' => $arrays['mb_pcode']
		);

		$sql_array=array();
		$sql_array[]="INSERT INTO ".$arrays['table']." SET ";
		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="mb_name='".$arrays['mb_name']."',";
		$sql_array[]="prq_fcode='".$arrays['prq_fcode']."',";
		$sql_array[]="mb_gtype='".$arrays['mb_gtype']."',";
		$sql_array[]="mb_gcode='".$arrays['mb_gcode']."',";
		$sql_array[]="mb_gname_eng='".$arrays['mb_gname_eng']."',";
		$sql_array[]="mb_gname_kor='".$arrays['mb_gname_kor']."',";
		$sql_array[]="mb_email ='".$arrays['mb_email']."',";
		$sql_array[]="mb_addr1 ='".$arrays['mb_addr1']."',";
		$sql_array[]="mb_addr2 ='".$arrays['mb_addr2']."',";
		$sql_array[]="mb_addr3 ='".$arrays['mb_addr3']."',";
		$sql_array[]="mb_ceoname ='".$arrays['mb_ceoname']."',";
		$sql_array[]="mb_password=password('".$arrays['mb_password']."'),";
		$sql_array[]="mb_hp ='".$arrays['mb_hp']."',";
		$sql_array[]="mb_business_num ='".$arrays['mb_business_num']."',";
		$sql_array[]="mb_exactcaculation_ratio ='".$arrays['mb_exactcaculation_ratio']."',";
		$sql_array[]="mb_bankname ='".$arrays['mb_bankname']."',";
		$sql_array[]="mb_banknum ='".$arrays['mb_banknum']."',";
		$sql_array[]="mb_bankholder='".$arrays['mb_bankholder']."',";
		$sql_array[]="mb_bigo='".$arrays['mb_bigo']."',";
		$sql_array[]="mb_business_paper='".$arrays['mb_business_paper']."',";
		$sql_array[]="mb_distributors_paper ='".$arrays['mb_distributors_paper']."',";
		$sql_array[]="mb_bank_paper ='".$arrays['mb_bank_paper']."',";
		$sql_array[]="mb_business_paper_size='".$arrays['mb_business_paper_size']."',";
		$sql_array[]="mb_distributors_paper_size ='".$arrays['mb_distributors_paper_size']."',";
		$sql_array[]="mb_bank_paper_size ='".$arrays['mb_bank_paper_size']."',";
		$sql_array[]="mb_imgprefix='".$arrays['mb_imgprefix']."',";
		$sql_array[]="mb_datetime=now();";
		$sql=join("",$sql_array);
		$result = $this->db->query($sql);
		//결과 반환
		return $result;
 	}

	/**
	 * 회원 코드 입력
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_code($arrays)
 	{
		/*
		$prq_code['mb_gcode']: G8
		mb_code: TS0000
		mb_gname_eng:
		mb_gname_kor:
		
		mysql> select * from prq_member_code;
		+-------+---------+-------+----------+---------------------+
		| mb_no | mb_code | mb_id | mb_pcode | mb_datetime         |
		+-------+---------+-------+----------+---------------------+
		|     1 | DS0001  | erm00 | DS       | 2015-12-21 12:30:40 |
		|     2 | DS0002  | erm01 | DS       | 2015-12-21 12:31:14 |
		|     1 | AD0001  | admin | AD       | 2015-12-21 12:32:23 |
		+-------+---------+-------+----------+---------------------+
		*/
		
		$sql_array=array();
		$sql_array[]="INSERT INTO prq_member_code SET ";
		$sql_array[]="mb_no='".$arrays['mb_no']."',";
		$sql_array[]="mb_gtype='".$arrays['mb_gtype']."',";
		$sql_array[]="mb_pcode='".$arrays['mb_pcode']."',";
		$sql_array[]="mb_code='".$arrays['mb_code']."',";
		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="mb_datetime=now();";
		$sql=join("",$sql_array);
		
		$result = $this->db->query($sql);
		/*
		
		*/
		//결과 반환
		return $result;
 	}

	/**
	 * 멤버의 회원 가입 코드를 가져온다. 
	 * 1. 조회 : 기존 코드의 최대값을 조회
	 * 2. 실제 적용될 코드값 조회

	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 멤버아이디 , 멤버가입코드
	 * @return row 입력 성공한 코드 반환.
	 */
	function get_code($arrays)
 	{
		/* 1. 조회 : 기존 코드의 최대값+1 을 조회 */
		$sql_array=array();
		$sql_array[]="SELECT MAX(mb_no)+1 mb_no FROM prq_member_code where ";
		$sql_array[]="`mb_pcode`='".$arrays['mb_pcode']."';";

		$sql=join("",$sql_array);
		$query = $this->db->query($sql);
		$row = $query->row();
		$mb_no=$row->mb_no;
		
		if($mb_no=="null"||$mb_no==""){
			$mb_no=1;
		}
		/* 2. 실제 적용될 코드값 조회 */
		$sql_array=array();
		$sql_array[]="select ";
		$sql_array[]="concat('".$arrays['mb_pcode']."',";
		$sql_array[]="substring(10000+".$mb_no.",2,5)) ";
		$sql_array[]="mb_code;";

		$sql=join("",$sql_array);
		$query = $this->db->query($sql);
		$row = $query->row();
		$result=$row->mb_code;
		$GLOBALS['mb_code']=$result;
		$GLOBALS['mb_no']=$mb_no;
		//결과 반환
		return $result;
 	}


	/**
	 * 멤버의 총판 가입 코드를 가져온다. 
	 * 1. 조회 : 기존 코드의 최대값을 조회
	 * 2. 실제 적용될 코드값 조회

	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 멤버아이디 , 멤버가입코드
	 * @return row 입력 성공한 코드 반환.
	 */
	function get_dscode()
 	{
		/* 1. 조회 : 기존 코드의 최대값+1 을 조회 */
		$sql_array=array();
		$sql_array[]="select concat('DS',substring(10000+substring(max(ds_code),3,5)+1,2,5)) max_dscode  ";
		$sql_array[]="from prq_dscode;";

		$sql=join("",$sql_array);
		$query = $this->db->query($sql);
		$row = $query->row();
		$ds_code=$row->max_dscode;
		
		if($ds_code=="null"||$ds_code==""){
			$ds_code="DS0001";
		}

		//결과 반환
		return $ds_code;
 	}
	/**
	 * 멤버의 회원 가입 코드를 가져온다. 
	 * 1. 조회 : 기존 코드의 최대값을 조회
	 * 2. 실제 적용될 코드값 조회

	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 멤버아이디 , 멤버가입코드
	 * @return row 입력 성공한 코드 반환.
	 */
	function get_member_code($code)
 	{
//		if(isset($code)
		/* 1. 조회 : 기존 코드의 최대값을 조회 */
		$sql_array=array();
		$sql_array[]="select * ";
		$sql_array[]="from prq_code ";
		$sql_array[]="where mb_pcode='".$code."';";

		$sql=join("",$sql_array);
		$query = $this->db->query($sql);
		$row = $query->row();

		//결과 반환
		return $row;
 	}
	/**
	 * 게시물 수정
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param array $arrays 테이블명, 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function modify_distributors($arrays)
 	{
/*
		$modify_array = array(
				'subject' => $arrays['subject'],
				'contents' => $arrays['contents']
		);

		$where = array(
				'board_id' => $arrays['board_id']
		);

		$result = $this->db->update($arrays['table'], $modify_array, $where);
*/

		$sql_array=array();
		$sql_array[]="UPDATE ".$arrays['table']." SET ";
//		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="mb_name='".$arrays['mb_name']."',";
		$sql_array[]="mb_email ='".$arrays['mb_email']."',";
		$sql_array[]="mb_addr1 ='".$arrays['mb_addr1']."',";
		$sql_array[]="mb_addr2 ='".$arrays['mb_addr2']."',";
		$sql_array[]="mb_addr3 ='".$arrays['mb_addr3']."',";
		$sql_array[]="mb_ceoname ='".$arrays['mb_ceoname']."',";
//		$sql_array[]="mb_password=password('".$arrays['mb_password']."'),";
		$sql_array[]="mb_hp ='".$arrays['mb_hp']."',";
		$sql_array[]="mb_business_num ='".$arrays['mb_business_num']."',";
		$sql_array[]="mb_exactcaculation_ratio ='".$arrays['mb_exactcaculation_ratio']."',";
		$sql_array[]="mb_bankname ='".$arrays['mb_bankname']."',";
		$sql_array[]="mb_banknum ='".$arrays['mb_banknum']."',";
		$sql_array[]="mb_bankholder='".$arrays['mb_bankholder']."',";
		$sql_array[]="mb_bigo='".$arrays['mb_bigo']."',";
		$sql_array[]="mb_business_paper='".$arrays['mb_business_paper']."',";
		$sql_array[]="mb_distributors_paper ='".$arrays['mb_distributors_paper']."',";
		$sql_array[]="mb_bank_paper ='".$arrays['mb_bank_paper']."',";
		$sql_array[]="mb_business_paper_size='".$arrays['mb_business_paper_size']."',";
		$sql_array[]="mb_distributors_paper_size ='".$arrays['mb_distributors_paper_size']."',";
		$sql_array[]="mb_bank_paper_size ='".$arrays['mb_bank_paper_size']."',";
		$sql_array[]="mb_datetime=now() ";
		$sql_array[]="where mb_no='".$arrays['mb_no']."' ";
		$sql=join("",$sql_array);
		$result = $this->db->query($sql);
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
		$sql = "SELECT mb_id FROM ".$table." WHERE mb_no = '".$board_id."'";

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
    	$sql = "SELECT * FROM ".$table." WHERE mb_no='".$id."' ORDER BY mb_no DESC";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }
}

/* End of file member_m.php */
/* Location: ./prq/application/models/member_m.php */