<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 모두톡톡 메세지 어플 가입 신청서
 * 작성 : 2017-05-22 (월) 16:55:50 
 * 수정 : 
 * 
 * 1.1 모두톡톡 메세지 어플 가입 신청서
 * @author Taebu, Moon <mtaebu@gmail.com>
 * @version 1.1
 */
class Appjoin_m extends CI_Model
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
		$table='modu_agreement';
		/* select * from modu_agreement; */
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
//		$table="ci_board";
    	//$sql = "SELECT * FROM ".$table.$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
		$sql = "SELECT * FROM ".$table." ".$sword."  ORDER BY ma_no DESC".$limit_query;
   		$query = $this->db->query($sql);
		//.	echo $sql;
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
	 * @author Taebu, Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_view($table, $id)
    {
    	//조회수 증가
//    	$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
//   		$this->db->query($sql0);

    	$sql = "SELECT * FROM ".$table." WHERE ma_no='".$id."'";

   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }



	/**
	 * 게시물 입력
	 * @author Taebu, Moon <mtaebu@gmail.com>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_appjoin($arrays)
 	{
		$sql_array=array();
		$sql_array[]="INSERT INTO ".$arrays['table']." SET ";
		$sql_array[]="ma_isbdtt='".$arrays['ma_isbdtt']."',";
		$sql_array[]="ma_isttmsg='".$arrays['ma_isttmsg']."',";
		$sql_array[]="ma_isnavermap='".$arrays['ma_isnavermap']."',";
		$sql_array[]="ma_isblogreview='".$arrays['ma_isblogreview']."',";
		$sql_array[]="st_name='".$arrays['st_name']."',";
		$sql_array[]="st_minpay='".$arrays['st_minpay']."',";
		$sql_array[]="st_delivery='".$arrays['st_delivery']."',";
		$sql_array[]="st_address='".$arrays['st_address']."',";
		$sql_array[]="st_category='".$arrays['st_category']."',";
		$sql_array[]="st_origin='".$arrays['st_origin']."',";
		$sql_array[]="st_closingdate='".$arrays['st_closingdate']."',";
		$sql_array[]="st_open='".$arrays['st_open']."',";
		$sql_array[]="st_closed='".$arrays['st_closed']."',";
		$sql_array[]="st_alltime='".$arrays['st_alltime']."',";
		$sql_array[]="st_bizno='".$arrays['st_bizno']."',";
		$sql_array[]="st_bizname='".$arrays['st_bizname']."',";
		$sql_array[]="st_ceoname='".$arrays['st_ceoname']."',";
		$sql_array[]="st_bizaddress='".$arrays['st_bizaddress']."',";
		$sql_array[]="st_taxemail='".$arrays['st_taxemail']."',";
		$sql_array[]="st_bizhp='".$arrays['st_bizhp']."',";
		$sql_array[]="st_bdtthp='".$arrays['st_bdtthp']."',";
		$sql_array[]="st_mno='".$arrays['st_mno']."',";
		$sql_array[]="st_info='".$arrays['st_info']."',";
		$sql_array[]="ma_blogprice='".$arrays['ma_blogprice']."',";
		$sql_array[]="ma_ispost='".$arrays['ma_ispost']."',";
		$sql_array[]="ma_ispoint='".$arrays['ma_ispoint']."',";
		$sql_array[]="ma_naverid='".$arrays['ma_naverid']."',";
		$sql_array[]="ma_naverpwd='".$arrays['ma_naverpwd']."',";
		$sql_array[]="ma_isnaver='".$arrays['ma_isnaver']."',";
		$sql_array[]="ma_ktuser='".$arrays['ma_ktuser']."',";
		$sql_array[]="ma_ktbirth='".$arrays['ma_ktbirth']."',";
		$sql_array[]="ma_name='".$arrays['ma_name']."',";
		$sql_array[]="ma_adminname='".$arrays['ma_adminname']."',";
		$sql_array[]="ma_adminhp='".$arrays['ma_adminhp']."',";
		$sql_array[]="ma_cmsprice='".$arrays['ma_cmsprice']."',";
		$sql_array[]="mb_birth='".$arrays['mb_birth']."',";
		$sql_array[]="mb_bankname='".$arrays['mb_bankname']."',";
		$sql_array[]="mb_banknum='".$arrays['mb_banknum']."',";
		$sql_array[]="ma_dateofpayment='".$arrays['ma_dateofpayment']."',";
		$sql_array[]="mb_bankholder='".$arrays['mb_bankholder']."',";
		$sql_array[]="mb_email='".$arrays['mb_email']."',";
		$sql_array[]="ma_signaturepad='".$arrays['ma_signaturepad']."',";
		$sql_array[]="ma_datetime=now();";
		$sql=join("",$sql_array);
		$result = $this->db->query($sql);
		
		$last_id=$this->db->insert_id();
		
		//결과 반환
		return $last_id;
 	}

	/**
	 * 회원 코드 입력
	 * @author Taebu, Moon <mtaebu@gmail.com>
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
		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="mb_code='".$arrays['mb_code']."',";
		$sql_array[]="mb_pcode='".$arrays['mb_pcode']."',";
		$sql_array[]="mb_datetime=now();";
		$sql=join("",$sql_array);
		$result = $this->db->query($sql);
		//결과 반환
		return $result;
 	}

	/**
	 * 멤버의 회원 가입 코드를 가져온다. 
	 * 1. 조회 : 기존 코드의 최대값을 조회
	 * 2. 실제 적용될 코드값 조회

	 *
	 * @author Taebu, Moon <mtaebu@gmail.com>
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
	 * 멤버의 회원 가입 코드를 가져온다. 
	 * 1. 조회 : 기존 코드의 최대값을 조회
	 * 2. 실제 적용될 코드값 조회

	 *
	 * @author Taebu, Moon <mtaebu@gmail.com>
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
	 * @author Taebu, Moon <mtaebu@gmail.com>
	 * @param array $arrays 테이블명, 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function modify_appjoin($arrays)
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
		$sql_array[]="ma_isbdtt='".$arrays['ma_isbdtt']."',";
		$sql_array[]="ma_isttmsg='".$arrays['ma_isttmsg']."',";
		$sql_array[]="ma_isnavermap='".$arrays['ma_isnavermap']."',";
		$sql_array[]="ma_isblogreview='".$arrays['ma_isblogreview']."',";
		$sql_array[]="st_name='".$arrays['st_name']."',";
		$sql_array[]="st_minpay='".$arrays['st_minpay']."',";
		$sql_array[]="st_delivery='".$arrays['st_delivery']."',";
		$sql_array[]="st_address='".$arrays['st_address']."',";
		$sql_array[]="st_category='".$arrays['st_category']."',";
		$sql_array[]="st_origin='".$arrays['st_origin']."',";
		$sql_array[]="st_closingdate='".$arrays['st_closingdate']."',";
		$sql_array[]="st_open='".$arrays['st_open']."',";
		$sql_array[]="st_closed='".$arrays['st_closed']."',";
		$sql_array[]="st_alltime='".$arrays['st_alltime']."',";
		$sql_array[]="st_bizno='".$arrays['st_bizno']."',";
		$sql_array[]="st_bizname='".$arrays['st_bizname']."',";
		$sql_array[]="st_ceoname='".$arrays['st_ceoname']."',";
		$sql_array[]="st_bizaddress='".$arrays['st_bizaddress']."',";
		$sql_array[]="st_taxemail='".$arrays['st_taxemail']."',";
		$sql_array[]="st_bizhp='".$arrays['st_bizhp']."',";
		$sql_array[]="st_bdtthp='".$arrays['st_bdtthp']."',";
		$sql_array[]="st_mno='".$arrays['st_mno']."',";
		$sql_array[]="st_info='".$arrays['st_info']."',";
		$sql_array[]="ma_blogprice='".$arrays['ma_blogprice']."',";
		$sql_array[]="ma_ispost='".$arrays['ma_ispost']."',";
		$sql_array[]="ma_ispoint='".$arrays['ma_ispoint']."',";
		$sql_array[]="ma_naverid='".$arrays['ma_naverid']."',";
		$sql_array[]="ma_naverpwd='".$arrays['ma_naverpwd']."',";
		$sql_array[]="ma_isnaver='".$arrays['ma_isnaver']."',";
		$sql_array[]="ma_ktuser='".$arrays['ma_ktuser']."',";
		$sql_array[]="ma_ktbirth='".$arrays['ma_ktbirth']."',";
		$sql_array[]="ma_name='".$arrays['ma_name']."',";
		$sql_array[]="ma_adminname='".$arrays['ma_adminname']."',";
		$sql_array[]="ma_adminhp='".$arrays['ma_adminhp']."',";
		$sql_array[]="ma_cmsprice='".$arrays['ma_cmsprice']."',";
		$sql_array[]="mb_birth='".$arrays['mb_birth']."',";
		$sql_array[]="mb_bankname='".$arrays['mb_bankname']."',";
		$sql_array[]="mb_banknum='".$arrays['mb_banknum']."',";
		$sql_array[]="ma_dateofpayment='".$arrays['ma_dateofpayment']."',";
		$sql_array[]="mb_bankholder='".$arrays['mb_bankholder']."',";
		$sql_array[]="mb_email='".$arrays['mb_email']."',";
		$sql_array[]="ma_signaturepad='".$arrays['ma_signaturepad']."' ";
		$sql_array[]="where ma_no='".$arrays['ma_no']."' ";
		$sql=join("",$sql_array);
		$result = $this->db->query($sql);
		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 삭제
	 *
	 * @author Taebu, Moon <mtaebu@gmail.com>
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
	 * @author Taebu, Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $board_id 게시물번호
	 * @return string 작성자 아이디
	 */
	function writer_check($table, $board_id)
	{
		$sql = "SELECT ma_no FROM ".$table." WHERE ma_no = '".$board_id."'";

		$query = $this->db->query($sql);

		return $query->row();
	}

	/**
	 * 댓글 입력
	 *
	 * @author Taebu, Moon <mtaebu@gmail.com>
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
	 * @author Taebu, Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_comment($table, $id)
    {
    	$sql = "SELECT * FROM ".$table." WHERE ma_no='".$id."' ORDER BY ma_no DESC";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

	/**
	 * 가맹점 코드 이름 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @return array
	 */
    function get_frcode()
    {
    	$sql = "select * from prq_frcode;";
   		$query = $this->db->query($sql);

		$result = $query->result();

   	return $result;
    }

	/**
	 * 대리점 코드 이름 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @return array
	 */
    function get_ptcode()
    {
    	$sql = "select * from prq_ptcode;";
   		$query = $this->db->query($sql);

		$result = $query->result();

    	return $result;
    }


	/**
	 * 총판 코드 이름 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @return array
	 */
    function get_dscode()
    {
    	$sql = "select * from prq_dscode;";
   		$query = $this->db->query($sql);

		$result = $query->result();

    	return $result;
    }

	/**
	 * 그룹별 상점갯수
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @return array
	 */
    function get_groupcnt()
    {
    	$sql = "select st_status,count(*) cnt from prq_store group by st_status;";
   		$query = $this->db->query($sql);

		$result = $query->result();

    	return $result;
    }

	/**
	 * 싱크 상점 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @return array
	 */
    function get_syncstore()
    {
    	$sql = "select * from sync_store;";
   		$query = $this->db->query($sql);

		$result = $query->result();

   		return $result;
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
    /**
	 * 원산지 정보 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param $array['table'] 상점 테이블, 멤버
	 * @param $array['st_no'] 상점 이름
	 * @return list
	 */
    function get_origin($array)
    {
		//$arrays=(array)$array;
		$arrays=json_decode(json_encode($array), True);
		//print_r($arrays);
		
		$object=array();
		$object[]=0;
		foreach($arrays as $key => $value)
		{
			$object[]=$value['st_no'];
			//echo $key." :".$value;
		}

    	$sql = "SELECT pv_no,pv_value FROM prq_values WHERE pv_code='5001' and pv_no in (".join(",",$object).");";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->result();

		return $result;
    }
    /**
	 * 블로그 url 사용 여부 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param $array['table'] 상점 테이블, 멤버
	 * @param $array['st_no'] 상점 이름
	 * @return list
	 */
    function get_blogurl($array)
    {
		//$arrays=(array)$array;
		$arrays=json_decode(json_encode($array), True);
		//print_r($arrays);
		
		$object=array();
		$object[]=0;
		foreach($arrays as $key => $value)
		{
			$object[]=$value['st_no'];
			//echo $key." :".$value;
		}

    	$sql = "SELECT pv_no,pv_value FROM prq_values WHERE pv_code='5001' and pv_no in (".join(",",$object).");";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->result();

		return $result;
    }

    /**
	 * 블로그 관련 상세 정보 가져오기
	 *
	 * @author Taebu <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_blogapi($arrays)
    {
    	//조회수 증가
//    	$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
//   		$this->db->query($sql0);

    	$sql = "SELECT * FROM code_values WHERE pv_code in (5003,5004) ";
		$sql.= " and ";
   		$query = $this->db->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }
}

/* End of file appjoin_m.php */
/* Location: ./prq/application/models/appjoin_m.php */