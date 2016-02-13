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
	 * @author Jongwon Byun <advisor@cikorea.net>
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
	 * GCM 리스트 가져오기
	 *
	 * @author Jongwon Byun <advisor@cikorea.net>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_gcm()
    {
    	$sql = "SELECT * FROM prq_gcm_log";
   		$query = $this->db->query($sql);

     	//gcm log 리스트 반환
	    $result = $query->result();

    	return $result;
    }


	function get_store($array)
    {
		$sql=array();
		$sql[]="select ";
		$sql[]=" st_mno,";
		$sql[]=" st_thumb_paper,";
		$sql[]=" st_top_msg, ";
		$sql[]=" st_middle_msg,";
		$sql[]=" st_bottom_msg, ";
		$sql[]=" st_modoo_url ";

		$sql[]=" from ";
		$sql[]="prq_store ";
		$sql[]="where ";
		$sql[]="mb_id='";
		$sql[]=$array['cd_id'];
		$sql[]="' ";
		$sql[]="and st_port='".$array['cd_port']."'; ";
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