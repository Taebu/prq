<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 공통 멤버 총판에서 가맹점 모델 (이미지 포함)
 * 작성 :2016-01-04 (월)
 * 수정 : 
 * 
 * 총판	Distributors	DS
 * 대리점	Partner	PT
 * 가맹점	Franchise	FR
 * 
 * @author Taebu,Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Codes_m extends CI_Model
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
		if($table==""){
		$table='prq_member';
		}
		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword .= ' and subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
     	}
		if($this->input->cookie('mb_gcode', TRUE)!="G1"){
		$mb_code=$this->input->cookie('mb_code', TRUE);
		if( strlen($mb_code)>2){
			$sword .= ' and mb_code= "'.$mb_code.'" ';
		}
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
//		$sql = "SELECT * FROM ".$table.$sword."  ORDER BY mb_no DESC".$limit_query;
		$prq_code=$this->uri->segment(3);
		switch($prq_code)
		{
			case "prq_dscode":
			$order="  ORDER BY ds_code ";
			break;
			case "prq_ptcode":
			$order="  ORDER BY pt_code ";
			break;
			case "prq_frcode":
			$order="  ORDER BY fr_code ";
			break;
		}
		//$order="";
		$sql = "SELECT * FROM ".$table.$sword.$order.$limit_query;
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
	function insert_codes($arrays)
 	{
		$sql_array=array();
		if($arrays['table']=="prq_dscode")
		{
			$sql = "select count(*) from prq_dscode where ds_code = '".$arrays['ds_code']."' ";
			$result_count = $this->db->query($sql);
			$cat_count = mysql_result($result_count, 0,0);
			if($cat_count > 0) 
			{ 
				echo "<script>alert('\\n코드 $mid_code 은(는) 이미 생성된 코드이니, 목록에서 처리하세요.\\t');</script>";
			} else { 
				$sql_array[]="INSERT INTO ".$arrays['table']." SET ";
				$sql_array[]="ds_name='".$arrays['ds_name']."',";
				$sql_array[]="ds_code='".$arrays['ds_code']."';";
			}
		}
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
	function modify_codes($arrays)
 	{

		$sql_array=array();
		$sql_array[]="UPDATE ".$arrays['table']." SET ";
		$sql_array[]="ds_name='".$arrays['ds_name']."',";
		$sql_array[]="where ds_code='".$arrays['ds_code']."' ";
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

	/**
	 * 최대 코드값 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @return array
	 */
    function get_max_dscode()
    {
    	$sql = "select max(ds_code) max_ds_code from prq_dscode;";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

}

/* End of file member_m.php */
/* Location: ./prq/application/models/member_m.php */