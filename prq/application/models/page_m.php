<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 상점 모바일 델리 페이지 참고모델 (이미지 포함)
 * http://dlpg.kr/web/?s=b0o9
 * 작성 :2016-02-16 (화)
 * 수정 : 
 * 
 * @author Taebu,Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Page_m extends CI_Model
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

    	$sql = "SELECT * FROM ".$table." WHERE st_no='".$id."'";
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
	function insert_store($arrays)
 	{
		$sql_array=array();
		$sql_array[]="INSERT INTO ".$arrays['table']." SET ";
		$sql_array[]="prq_fcode='".$arrays['prq_fcode']."',";
		$sql_array[]="st_category='".$arrays['st_category']."',";
		$sql_array[]="st_name='".$arrays['st_name']."',";
		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="st_tel='".$arrays['st_tel']."',";
		$sql_array[]="st_open='".$arrays['st_open']."',";
		$sql_array[]="st_closed='".$arrays['st_closed']."',";
		$sql_array[]="st_alltime='".$arrays['st_alltime']."',";
		$sql_array[]="st_mno='".$arrays['st_mno']."',";
		$sql_array[]="st_closingdate='".$arrays['st_closingdate']."',";
		$sql_array[]="st_destination='".$arrays['st_destination']."',";
		$sql_array[]="st_intro='".$arrays['st_intro']."',";
		$sql_array[]="st_password='".$arrays['st_password']."',";
		$sql_array[]="st_nick='".$arrays['st_nick']."',";
		$sql_array[]="st_nick_date='".$arrays['st_nick_date']."',";
		$sql_array[]="st_email='".$arrays['st_email']."',";
		$sql_array[]="st_homepage='".$arrays['st_homepage']."',";
		$sql_array[]="st_business_name='".$arrays['st_business_name']."',";
		$sql_array[]="st_business_paper='".$arrays['st_business_paper']."',";
		$sql_array[]="st_business_paper_size='".$arrays['st_business_paper_size']."',";
		$sql_array[]="st_thumb_paper='".$arrays['st_thumb_paper']."',";
		$sql_array[]="st_thumb_paper_size='".$arrays['st_thumb_paper_size']."',";
		$sql_array[]="st_menu_paper='".$arrays['st_menu_paper']."',";
		$sql_array[]="st_menu_paper_size='".$arrays['st_menu_paper_size']."',";
		$sql_array[]="st_main_paper='".$arrays['st_main_paper']."',";
		$sql_array[]="st_main_paper_size='".$arrays['st_main_paper_size']."',";
		$sql_array[]="st_modoo_url='".$arrays['st_modoo_url']."',";
		$sql_array[]="st_top_msg='".$arrays['st_top_msg']."',";
		$sql_array[]="st_middle_msg='".$arrays['st_middle_msg']."',";
		$sql_array[]="st_bottom_msg='".$arrays['st_bottom_msg']."',";
		$sql_array[]="st_business_num='".$arrays['st_business_num']."',";
		$sql_array[]="st_datetime=now();";
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
	function modify_store($arrays)
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
		$sql_array[]="prq_fcode='".$arrays['prq_fcode']."',";
		$sql_array[]="st_category='".$arrays['st_category']."',";
		$sql_array[]="st_name='".$arrays['st_name']."',";
		$sql_array[]="st_tel='".$arrays['st_tel']."',";
		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="st_tel_1='".$arrays['st_tel_1']."',";
		$sql_array[]="st_hp_1='".$arrays['st_hp_1']."',";
		$sql_array[]="st_cidtype='".$arrays['st_cidtype']."',";
		$sql_array[]="st_open='".$arrays['st_open']."',";
		$sql_array[]="st_closed='".$arrays['st_closed']."',";
		$sql_array[]="st_alltime='".$arrays['st_alltime']."',";
		$sql_array[]="st_mno='".$arrays['st_mno']."',";
		$sql_array[]="st_closingdate='".$arrays['st_closingdate']."',";
		$sql_array[]="st_destination='".$arrays['st_destination']."',";
		$sql_array[]="st_intro='".$arrays['st_intro']."',";
		$sql_array[]="st_password='".$arrays['st_password']."',";
		$sql_array[]="st_nick='".$arrays['st_nick']."',";
		$sql_array[]="st_nick_date='".$arrays['st_nick_date']."',";
		$sql_array[]="st_email='".$arrays['st_email']."',";
		$sql_array[]="st_homepage='".$arrays['st_homepage']."',";
		$sql_array[]="st_business_name='".$arrays['st_business_name']."',";
		$sql_array[]="st_business_paper='".$arrays['st_business_paper']."',";
		$sql_array[]="st_business_paper_size='".$arrays['st_business_paper_size']."',";
		$sql_array[]="st_thumb_paper='".$arrays['st_thumb_paper']."',";
		$sql_array[]="st_thumb_paper_size='".$arrays['st_thumb_paper_size']."',";
		$sql_array[]="st_menu_paper='".$arrays['st_menu_paper']."',";
		$sql_array[]="st_menu_paper_size='".$arrays['st_menu_paper_size']."',";
		$sql_array[]="st_main_paper='".$arrays['st_main_paper']."',";
		$sql_array[]="st_main_paper_size='".$arrays['st_main_paper_size']."',";
		$sql_array[]="st_modoo_url='".$arrays['st_modoo_url']."',";
		$sql_array[]="st_top_msg='".$arrays['st_top_msg']."',";
		$sql_array[]="st_middle_msg='".$arrays['st_middle_msg']."',";
		$sql_array[]="st_bottom_msg='".$arrays['st_bottom_msg']."',";
		$sql_array[]="st_business_num='".$arrays['st_business_num']."' ";
		$sql_array[]="where st_no='".$arrays['st_no']."' ";
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
		$sql = "SELECT st_no FROM ".$table." WHERE st_no = '".$board_id."'";

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
    	$sql = "SELECT * FROM ".$table." WHERE st_no='".$id."' ORDER BY st_no DESC";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

	/**
	 * 원산지 정보 가져오기
	 *
@author Taebu <mtaebu@gmail.com>
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_origin($id)
    {

    	$sql = "SELECT pv_value FROM prq_values WHERE pv_no='".$id."' and pv_code='5001';";
   		$query = $this->db->query($sql);
		$cnt=$query->num_rows();
     	//게시물 내용 반환
		if($cnt==0){
		$result = (object)array('pv_value'=>'.');
		}else{
	    $result = $query->row();
		}
    	return $result;
    }

}

/* End of file page_m.php */
/* Location: ./prq/application/models/page_m.php */