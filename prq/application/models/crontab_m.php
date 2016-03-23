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
		/* 핸드폰 번호인 것만 조회 하여 처리 2016-03-10 (목) */
    	$sql = "SELECT * FROM prq_cdr WHERE cd_state=0 and cd_callerid like '01%';";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();
		
		/*처리한 번호 핸드폰 발송 처리 */
		$sql = "UPDATE prq_cdr SET cd_state=1 WHERE cd_state=0 and cd_callerid like '01%';";
   		$query = $this->db->query($sql);

		/*처리한 번호 일반 번호  미발송  처리 cd_state=2 */
		$sql = "UPDATE prq_cdr SET cd_state=2 WHERE cd_state=0 and cd_callerid not like '01%';";
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
	 * @param string $email 이메일정보로 키를 반영한다.
	 * @return array
	 */
 	function get_mno_limit($email)
    {

		// select cd_date from prq_cdr where cd_tel='0313768936' and cd_hp='01089602214' and cd_callerid='01091675141' order by cd_date desc limit 1;
		// SELECT  mn_dup_limit  FROM prq_mno WHERE mn_email='leesukkee@naver.com';
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
		$sql[]=" st_name,";
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

	/**
	 * 블랙 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * 080-130-8119
	 * @param string $cd_port 콜로그 포트
	 * @return array
	 */
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

	/**
	 * mms 제한 갯수 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $mb_email 이메일 정보
	 * @return array
	 */
	function get_mms_limit($mb_email)
    {
		/*
		| ml_no,ml_email,ml_monthly_limit,ml_daily_limit | ml_datetime         |
		*/
		$sql=array();
		$sql[]="select ";
		$sql[]=" ml_monthly_limit,ml_daily_limit ";
		$sql[]="from ";
		$sql[]=" prq_mms_limit ";
		$sql[]="where ";
		$sql[]="ml_email='".$mb_email."';";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

     	//블랙 리스트 반환
	    $result = $query->row();

    	return $result;
    }

	/**
	 * gcm 으로 보낸 mms 이번달 합산 
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * 080-130-8119
	 * @param string $mb_email 이메일 정보
	 * @return array
	 */
	function get_send_cnt($array)
    {
		/*
		| ml_no,ml_email,ml_monthly_limit,ml_daily_limit | ml_datetime         |
			;
			select count(*) from prq_gcm_log where date(now())=date(gc_datetime) and gc_sender='01066983139';
			select count(*) from prq_gcm_log where date(now())=date(gc_datetime) and gc_sender='01077430009';
		*/
		/*
		$sql=array();
		$sql[]="select ";
		$sql[]="sum(st_cnt) cnt ";
		$sql[]="from ";
		$sql[]="prq_stat ";
		$sql[]="where st_sender='".$array['mb_hp']."' ";
		$sql[]="and date_format(st_date, '%Y-%m')=date_format(now(), '%Y-%m');";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);
		*/
     	//지난 번호에 대한 이번 달 합산
	    //$last_sum = $query->row();
		
		$sql=array();
		$sql[]="select ";
		$sql[]="count(*) cnt ";
		$sql[]="from ";
		$sql[]="prq_gcm_log ";
		$sql[]="where date(now())=date(gc_datetime) ";
		$sql[]="and gc_sender='".$array['mb_hp']."';";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);
		$today_sum = $query->row();
		/*
		echo "번호 : ".$array['mb_hp']."<br>";
		echo "이번달 지난 합산 : ".$last_sum->cnt."<br>";
		echo "오늘 합산 : ".$today_sum->cnt."<br>";
		$total=$today_sum->cnt+$last_sum->cnt;
		echo "이번달 전체 합산 : ".$total."<br>";
		*/
    	//return $result;
    	return $today_sum;
    }
	
	/**
	 * 금일 보낸 발송 갯수 갱신
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function set_cdr($array)
    {
		/*
		//CDR 정보 조회
		$cdr_info = array(
		'cd_date'=> $li->cd_date,
		'cd_tel'=> $li->cd_tel,
		'cd_hp' =>$li->cd_hp,
		'get_day_cnt' =>$get_day_cnt->cnt);
		*/
		
		/* 조회한 콜로그의 일 발송량 갱신 */
		$sql=array();
		$sql[] = "UPDATE prq_cdr SET ";
//		$sql[] = "cd_day_limit=".$array['cd_day_limit'].",";
		$sql[] = "cd_day_cnt=".$array['get_day_cnt']." ";
		$sql[] = " WHERE cd_date='".$array['cd_date']."' ";
		$sql[] = " and cd_tel='".$array['cd_tel']."' ";
		$sql[] = " and cd_hp='".$array['cd_hp']."' ;";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);
		//echo $str_sql;

     	//댓글 리스트 반환
	    //$result = $query->row();
    	//return $result;
    }

	/**
	 * kt로 온 cdr 정보 갱신
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function set_cdr_kt($array)
    {

		$sql=array();
		$sql[] = "UPDATE prq_cdr SET ";
		$sql[] = "cd_name='".$array['st_name']."',";
		$sql[] = "cd_tel='".$array['st_tel_1']."',";
		$sql[] = "cd_hp='".$array['st_hp_1']."' ";
		$sql[] = " WHERE cd_date='".$array['cd_date']."' ";
		$sql[] = " and cd_port='0' ;";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);
    }

	
}

/* End of file crontab_m.php */
/* Location: ./prq/application/models/crontab_m.php */