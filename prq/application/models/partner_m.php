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
class Partner_m extends CI_Model
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
		$sword= ' and  1=1 ';
		if($table==""){
		$table='prq_member';
		}
		if ( $search_word != '' )
     	{
     		//검색어가 있을 경우의 처리
     		$sword = ' and subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
     	}
		

		$mb_pcode=$this->input->cookie('mb_pcode', TRUE);
		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		$mb_gcode=$this->input->cookie('mb_gcode', TRUE);
		//echo "mb_pcode=>".$mb_pcode."<br/>";
		//echo "prq_fcode=>".$prq_fcode."<br/>";
		//echo "mb_gcode=>".$mb_gcode."<br/>";
		/* 총판인 경우 */
		if( $mb_gcode=="G3"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'PT%" ';
		}
		/* 가맹점인 경우 */
		if( $mb_gcode=="G4"&&strlen($prq_fcode)>5){
			$sword.= ' and prq_fcode like "'.$prq_fcode.'%" ';
		}
		
		$limit_query = '';

    	if ( $limit != '' OR $offset != '' )
     	{
     		//페이징이 있을 경우의 처리
     		$limit_query = ' LIMIT '.$offset.', '.$limit;
     	}else{
		
		}
		//$table="ci_board";
    	//$sql = "SELECT * FROM ".$table.$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
		$sql = "SELECT * FROM ".$table." WHERE 1=1 ".$sword."  ORDER BY mb_no DESC".$limit_query;
		//echo $sql;
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
	function insert_partner($arrays)
 	{
		$sql_array = array(
			'mb_pcode' => $arrays['mb_pcode']
		);

		$mb_code=$this->get_code($arrays);
		$prq_code=$this->get_member_code($arrays['mb_pcode']);
		/*
		$prq_code['mb_gcode']: G8
		mb_code: TS0000
		mb_gname_eng:
		mb_gname_kor:
		*/
		$sql_array=array();
		$sql_array[]="INSERT INTO ".$arrays['table']." SET ";
		$sql_array[]="mb_imgprefix='".$arrays['mb_imgprefix']."',";
		$sql_array[]="mb_id='".$arrays['mb_id']."',";
		$sql_array[]="mb_code='".$mb_code."',";
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
	function modify_board($arrays)
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
	function test()
	{
		$str='PT';
		return  $this->get_member_code($str);
	}
}

/* End of file partner_m.php */
/* Location: ./prq/application/models/partner_m.php */