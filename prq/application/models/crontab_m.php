<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 크론탭 구현 자동 mms 
 * 작성 :2016-02-03 (수)
 * 수정 : 

 * 
 * @author Taebu,Moon <mtaebu@gmail.com>
 * @version 1.0
 */
class Crontab_m extends CI_Model
{
    function __construct()
    { 
        parent::__construct();
    }


	/**
	 * 콜 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_cdr()
    {
    	$sql = "SELECT * FROM prq_cdr WHERE cd_state=0;";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

		$sql = "UPDATE prq_cdr SET cd_state=1 WHERE cd_state=0;";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    //$result2 = $query->result();
    	return $result;
    }
    
	/**
	 * 모든 콜 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_all_cdr()
    {
//    	$sql = "SELECT * FROM prq_cdr order by cd_date desc limit 100;";
    	$sql = "SELECT * FROM prq_cdr order by cd_date desc;";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();

    	return $result;
    }

	/**
	 * GCM 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_gcm()
    {
    	$sql = "SELECT * FROM prq_gcm_log order by gc_no desc;";
   		$query = $this->db->query($sql);

     	//gcm log 리스트 반환
	    $result = $query->result();

    	return $result;
    }

	/**
	 * 지난 콜 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $cd_id  콜로그 아이디
	 * @param string $cd_port 콜로그 포트
	 * @return array
	 */
 	function get_last_cdr($array)
    {

		// select cd_date from prq_cdr where cd_tel='0313768936' and cd_hp='01089602214' and cd_callerid='01091675141' order by cd_date desc limit 1;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" cd_date  ";
		$sql[]=" FROM ";
		$sql[]="prq_cdr ";
		$sql[]="WHERE ";
		$sql[]="cd_tel='".$array['cd_tel']."' ";
		$sql[]="and cd_hp='".$array['cd_hp']."' ";
		$sql[]="and cd_callerid='".$array['cd_callerid']."' ";
		$sql[]=" order by cd_date desc limit 1,1;";


		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
			$result = $query->row();
			$result->cd_date=$result->cd_date;
			
			$sql=array();
			$last_date=$result->cd_date;
			$sql[]="SELECT TIMESTAMPDIFF(DAY,'".$result->cd_date."','".$array['cd_date']."') as cd_date;";
			$str_sql=join("",$sql);
			$query = $this->db->query($str_sql);
			$result = $query->row();
			//절대값 처리 
			$result->cd_date=abs($result->cd_date);
     	}else{
			$arrays=(object)array('cd_date'=>'first_sent');
			$result = $arrays;
		}

		//지난 콜로그 반환
	    
    	return $result;
    }


	/**
	 * mno 정보 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $cd_id  콜로그 아이디
	 * @param string $cd_port 콜로그 포트
	 * @return array
	 */
 	function get_mno_limit($email)
    {

		// select cd_date from prq_cdr where cd_tel='0313768936' and cd_hp='01089602214' and cd_callerid='01091675141' order by cd_date desc limit 1;
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" mn_dup_limit  ";
		$sql[]=" FROM ";
		$sql[]="prq_mno ";
		$sql[]="WHERE ";
		$sql[]="mn_email='".$email."';";

		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
			$result = $query->row();
     	}else{
			$arrays=(object)array('mn_dup_limit'=>0);
			$result = $arrays;
		}

		//지난 콜로그 반환
	    
    	return $result;
    }

	/**
	 * STORE 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $cd_id  콜로그 아이디
	 * @param string $cd_port 콜로그 포트
	 * @return array
	 */
 	function get_store($array)
    {

		$sql=array();
		$sql[]="select ";
		$sql[]=" st_no,";
		$sql[]=" st_mno,";
		$sql[]=" st_tel_1,";
		$sql[]=" st_hp_1,";
		$sql[]=" st_thumb_paper,";
		$sql[]=" st_top_msg, ";
		$sql[]=" st_middle_msg,";
		$sql[]=" st_bottom_msg, ";
		$sql[]=" st_modoo_url ";
		$sql[]=" from ";
		$sql[]="prq_store ";
		$sql[]="where ";
		$sql[]="mb_id='".$array['cd_id']."' ";
		$sql[]="and st_port='".$array['cd_port']."' ;";


		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

     	//상점 정보 리스트 반환
	    $result = $query->result();

    	return $result;
    }


	function get_black()
    {
		$sql=array();
		$sql[]="select ";
		$sql[]="bl_hp ";
		$sql[]="from ";
		$sql[]="`callerid`.black_hp ";
		$sql[]="where ";
		$sql[]="bl_dnis='0801308119';";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

     	//블랙 리스트 반환
	    $result = $query->result();

    	return $result;
    }


}

/* End of file crontab_m.php */
/* Location: ./prq/application/models/crontab_m.php */