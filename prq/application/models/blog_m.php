<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 공통 멤버 총판에서 가맹점 모델 (이미지 포함)
 * 작성 :2016-11-14 (월)
 * 수정 : 
 * 
 * 총판	blog	DS
 * 대리점	Partner	PT
 * 가맹점	Franchise	FR
 * 
 * @author Taebu Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Blog_m extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->prq = $this->load->database('default', TRUE);
        $this->cashq = $this->load->database('cashq', TRUE);
    }

	/**
	 * 게시물 목록 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
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
//     		$sword .= ' and subject like "%'.$search_word.'%" or contents like "%'.$search_word.'%" ';
			$sword .= ' and bl_hp like "%'.$search_word.'%" ';
			$sword .= ' or st_name like "%'.$search_word.'%" ';
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
//		$table="ci_board";
    	//$sql = "SELECT * FROM ".$table.$sword." AND board_pid = '0' ORDER BY board_id DESC".$limit_query;
		$sql = "SELECT * FROM ".$table.$sword."  ORDER BY bl_no DESC".$limit_query;
   		$query = $this->prq->query($sql);

		if ( $type == 'count' )
     	{
     		//리스트를 반환하는 것이 아니라 전체 게시물의 갯수를 반환
	    	$result = $query->num_rows();

	    	//$this->prq->count_all($table);
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
    	//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		//$this->prq->query($sql0);

    	$sql = "SELECT * FROM ".$table." WHERE bl_no='".$id."'";
   		$query = $this->prq->query($sql);

     	//게시물 내용 반환
	    $result = $query->row();

    	return $result;
    }



	/**
	 * 게시물 입력
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param array $arrays 테이블명, 게시물제목, 게시물내용, 아이디 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function insert_blog($arrays)
 	{
		$result=$this->input->post(null, TRUE);
		$sql_array=array();
		$sql_array[]="INSERT INTO prq_blog SET ";
		$sql_array[]="st_no='".$arrays['st_no']."',";
		$sql_array[]="st_name='".$arrays['st_name']."',";
		$sql_array[]="bl_imgprefix='".$arrays['bl_imgprefix']."',";
		$sql_array[]="bl_file='".$arrays['bl_file']."',";
		$sql_array[]="bl_name='".$arrays['bl_name']."',";
		$sql_array[]="bl_hp='".$arrays['bl_hp']."',";
		$sql_array[]="bl_status='review',";
		$sql_array[]="bl_content1='".$arrays['content1']."',";
		$sql_array[]="bl_content2='".$arrays['content2']."',";
		$sql_array[]="bl_content3='".$arrays['content3']."',";
		$sql_array[]="bl_datetime=now();";
		$sql=join("",$sql_array);
		$result = $this->prq->query($sql);
		$insert_id = $this->prq->insert_id();
		//prq_store.st_hp_1;
		$msg="블로그 리뷰 확인\n";
		$msg.="http://prq.co.kr/prq/blog/view/".$insert_id;

		$array=array('st_no'=>$arrays['st_no']);
		$store=$this->get_store($array);
		$store=json_decode(json_encode($store),true);
		//print_r($store);
		//echo $store['st_hp_1'];
		$st_hp=$store['st_hp_1'];
		$result_msg="test";
		$sql_array=array();
		$sql_array[]="insert into `site_push_log` set ";
		$sql_array[]="stype='SMS',";
		$sql_array[]="biz_code='central',";
		$sql_array[]="caller='15999495',";
		$sql_array[]="called='".$st_hp."',";
		$sql_array[]="wr_subject='".$msg."',";
		$sql_array[]="wr_content='push를 테스트 합니다.',";
		$sql_array[]="regdate=now(),";
		$sql_array[]="result='".$result_msg."';";
		$sql=join("",$sql_array);
		$results = $this->cashq->query($sql);
		
		$sql_array=array();
		$sql_array[]="insert into SMSQ_SEND set";
		$sql_array[]="	msg_type='S', ";
		$sql_array[]="	dest_no='".$st_hp."',";
		$sql_array[]="	call_back='15999495',";
		$sql_array[]="	msg_contents='".$msg."' , ";
		$sql_array[]="	sendreq_time=now();";

		$sql=join("",$sql_array);
		$results = $this->cashq->query($sql);
		$results = true;
		$sms_result=$results?"성공":"실패";
		$sql_array=array();
		$sql_array[]="INSERT INTO prq_sms_log SET ";
		$sql_array[]="`sm_subject`='사장문자 확인',";
		$sql_array[]="`sm_content`='".$msg."',";
		$sql_array[]="`sm_type`='SMS',";
		$sql_array[]="`sm_receiver`='".$st_hp."',";
		$sql_array[]="`sm_sender`='0215999495',";
		$sql_array[]="`sm_result`='".$sms_result."',";
		$sql_array[]="`sm_datetime`=now(),";
		$sql_array[]="`sm_status`='I',";
		$sql_array[]="`sm_ipaddr`='".$this->input->ip_address()."',";
		$sql_array[]="`sm_stno`='".$arrays['st_no']."';";

		$sql=join("",$sql_array);
		$results = $this->prq->query($sql);

		$result=array(
			'result' => $results,
			'insert_id' => $insert_id
		);

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
		
		$result = $this->prq->query($sql);
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
		$query = $this->prq->query($sql);
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
		$query = $this->prq->query($sql);
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
	 * @author Taebu Moon <mtaebu@gmail.com>
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
		$query = $this->prq->query($sql);
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
		$query = $this->prq->query($sql);
		$row = $query->row();

		//결과 반환
		return $row;
 	}
	/**
	 * 게시물 수정
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param array $arrays 테이블명, 게시물번호, 게시물제목, 게시물내용 1차 배열
	 * @return boolean 입력 성공여부
	 */
	function modify_blog($arrays)
 	{
/*
		$modify_array = array(
				'subject' => $arrays['subject'],
				'contents' => $arrays['contents']
		);

		$where = array(
				'board_id' => $arrays['board_id']
		);

		$result = $this->prq->update($arrays['table'], $modify_array, $where);
					'table' => "prq_blog",
					'st_no' => $this->input->post('st_no', TRUE),
					'bl_imgprefix' => $this->input->post('bl_imgprefix', TRUE),
					'bl_file' => $this->input->post('bl_file', TRUE),
					'bl_name' => $this->input->post('bl_name', TRUE),
					'bl_hp' => $this->input->post('bl_hp', TRUE),
					'content1' => $array_content[0],
					'content2' => $array_content[1],
					'content3' => $array_content[2],
					'post_data' => $this->input->post(null, TRUE),
*/

		$sql_array=array();

		$sql_array[]="UPDATE ".$arrays['table']." SET ";
		$sql_array[]="bl_imgprefix='".$arrays['bl_imgprefix']."',";
		$sql_array[]="bl_file='".$arrays['bl_file']."',";
		$sql_array[]="bl_name='".$arrays['bl_name']."',";
		$sql_array[]="bl_hp='".$arrays['bl_hp']."',";
		$sql_array[]="bl_content1='".$arrays['content1']."',";
		$sql_array[]="bl_content2='".$arrays['content2']."',";
		$sql_array[]="bl_content3='".$arrays['content3']."' ";
		$sql_array[]="WHERE bl_no='".$arrays['bl_no']."';";
		$sql=join("",$sql_array);
		$result = $this->prq->query($sql);
		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 삭제
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 테이블명
	 * @param string $no 게시물번호
	 * @return boolean 삭제 성공여부
	 */
	function delete_content($table, $no)
 	{
		$delete_array = array(
			'board_id' => $no
		);

		$result = $this->prq->delete($table, $delete_array);

		//결과 반환
		return $result;
 	}

	/**
	 * 게시물 작성자 아이디 반환
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $board_id 게시물번호
	 * @return string 작성자 아이디
	 */
	function writer_check($table, $board_id)
	{
		$sql = "SELECT mb_id FROM ".$table." WHERE mb_no = '".$board_id."'";

		$query = $this->prq->query($sql);

		return $query->row();
	}

	/**
	 * 댓글 입력
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
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

		$this->prq->insert($arrays['table'], $insert_array);

		$board_id = $this->prq->insert_id();

		//결과 반환
		return $board_id;
 	}

	/**
	 * 댓글 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_comment($table, $id)
    {
    	$sql = "SELECT * FROM ".$table." WHERE mb_no='".$id."' ORDER BY mb_no DESC";
   		$query = $this->prq->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

	/**
	 * 대리점 갯수 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_frcnt()
    {
    	$sql = "select mb_pcode,count(*) cnt from prq_member where mb_gcode='G4' group by mb_pcode;";
   		$query = $this->prq->query($sql);

     	//상점 갯수 반환
		//$result = $query->row();
		$result = $query->result();
    	return $result;
    }



	/**
	 * 파일 입력
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param array $arrays 이미지 파일 정보 일체
	 * @return boolean 입력 성공여부
	 */
	function insert_file($arrays)
 	{

		$sql_array=array();
		$sql_array[]="INSERT INTO prq_file SET ";
		$sql_array[]="pr_table='".$arrays['pr_table']."',";
		$sql_array[]="bl_no='".$arrays['bl_no']."',";
		$sql_array[]="bf_no='".$arrays['bf_no']."',";
		$sql_array[]="bf_source='".$arrays['bf_source']."',";
		$sql_array[]="bf_file='".$arrays['bf_file']."',";
		$sql_array[]="bf_download='".$arrays['bf_download']."',";
		$sql_array[]="bf_content='".$arrays['bf_content']."',";
		$sql_array[]="bf_filesize='".$arrays['bf_filesize']."',";
		$sql_array[]="bf_width='".$arrays['bf_width']."',";
		$sql_array[]="bf_height='".$arrays['bf_height']."',";
		$sql_array[]="bf_type='".$arrays['bf_type']."',";
		$sql_array[]="bf_datetime=now();";
		$sql=join("",$sql_array);
		
		$result = $this->prq->query($sql);

		//결과 반환
		return $sql;
 	}

    /**
	 * 파일 정보 가져 오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_files($arrays)
    {
    	//조회수 증가
    	//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		//$this->prq->query($sql0);

    	$sql = "SELECT * FROM prq_file WHERE bl_no='".$arrays['bl_no']."'";
   		$query = $this->prq->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

    /**
	 * 상점 정보 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_store($arrays)
    {
    	//조회수 증가
    	//$sql0 = "UPDATE ".$table." SET hits=hits+1 WHERE board_id='".$id."'";
   		//$this->prq->query($sql0);

    	$sql = "SELECT * FROM prq_store WHERE st_no='".$arrays['st_no']."'";
   		$query = $this->prq->query($sql);

     	//댓글 리스트 반환
	    $result = $query->row();

    	return $result;
    }

	/**
	 * 파일 삭제
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param array $arrays 이미지 파일 정보 일체
	 * @return boolean 입력 성공여부
	 */
	function delete_file($arrays)
 	{
		$sql_array=array();
		$sql_array[]="DELETE FROM prq_file ";
		$sql_array[]="WHERE bl_no='".$arrays['bl_no']."';";
		$sql=join("",$sql_array);
		
		$result = $this->prq->query($sql);

		//결과 반환
		return $sql;
 	}

    /**
	 * 대리점 정보 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_member($arrays)
    {
		$prq_fcode=substr($arrays['prq_fcode'], 0, 12);
    	$sql = "SELECT * FROM prq_member ";
		$sql.=" where mb_gcode='G4' ";
		$sql.=" and prq_fcode='".$prq_fcode."' limit 1;";
   		$query = $this->prq->query($sql);

     	//멤버 리스트 반환
	    $result = $query->row();

    	return $result;
    }


    /**
	 * get_access_token
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $naver_id 네이버 아이디
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_access_token($naver_id)
    {
    	$sql = "select access_token from prq_blogapi ";
		$sql.=" where pb_naver_id='{$naver_id}';";
   		$query = $this->prq->query($sql);

     	//access_token 반환
	    $result = $query->row();

    	return $result;
    }

	 /**
	 * blog refresh_token 
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_refresh_token($naver_id)
    {
    	$sql = "select refresh_token from prq_blogapi ";
		$sql.=" where pb_naver_id='{$naver_id}';";
   		$query = $this->prq->query($sql);

     	//refresh_token 반환
	    $result = $query->row();

    	return $result;
    }

    /**
	 * blog refresh_token 
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function set_access_token($arrays)
    {
		$sql_array=array();
		$sql_array[]="UPDATE prq_blogapi SET ";
		$sql_array[]="access_token='".$arrays['access_token']."',";
		$sql_array[]="pb_datetime=now() ";
		$sql_array[]="WHERE  pb_naver_id='".$arrays['naver_id']."';";
		$sql=join("",$sql_array);
		$result = $this->prq->query($sql);
		//결과 반환
		return $result;
    }


    /**
	 * set_category 
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param naver_id
	 * @param pb_category 네이버 블로그에 등록된 카테고리 json 정보 
	 * @return array
	 */
    function set_category($arrays)
    {
		$sql_array=array();
		$sql_array[]="UPDATE prq_blogapi SET ";
		$sql_array[]="pb_category='".$arrays['pb_category']."',";
		$sql_array[]="pb_datetime=now() ";
		$sql_array[]="WHERE  pb_naver_id='".$arrays['naver_id']."';";
		$sql=join("",$sql_array);
		$result = $this->prq->query($sql);
		//결과 반환
		return $result;
    }
	
	/**
	* set_post_log
	* 포스팅한 로그를 기록 합니다. 실제 포스팅 기록이며 중복 포스팅에 대한 방지와 에러상태를 알기위해 기록합니다.
	*/
	function set_post_log($arrays)
	{
		$sql_array=array();
		$sql_array[]="INSERT INTO prq_post_log SET ";
		$sql_array[]="`po_subject`='".$arrays['po_subject']."',";
		$sql_array[]="`po_content`='".addslashes($arrays['po_content'])."',";
		$sql_array[]="`po_status`='".$arrays['po_status']."',";
		$sql_array[]="`na_code`='".$arrays['na_code']."',";
		$sql_array[]="`na_http`='".$arrays['na_http']."',";
		$sql_array[]="`na_message`='".$arrays['na_message']."',";
		$sql_array[]="`bl_url`='".$arrays['bl_url']."',";
		$sql_array[]="`bl_naver_id`='".$arrays['bl_naver_id']."',";
		$sql_array[]="`bl_category`='".$arrays['bl_category']."',";
		$sql_array[]="`st_no`='".$arrays['st_no']."',";
		$sql_array[]="`bl_no`='".$arrays['bl_no']."',";
		$sql_array[]="`po_datetime`=now();";
		$sql=join("",$sql_array);
		$results = $this->prq->query($sql);
	}


}

/* End of file member_m.php */
/* Location: ./prq/application/models/member_m.php */