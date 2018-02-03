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
		/* 2016-03-24 (목)
		* 가장 중요 별표 천개 짜리
		* 일 발송량 제한 기본값은 150 이며 임의로 
		* 발송 갯수를 설정하면 
		* 설정된 제한 갯수로 
		* 일 발송 갯수를 제한 할 수 있다. 
		*/
		$sql[]=" mn_mms_limit,  ";
		/* 동일 번호 발송일수 제한 0 이면 제한이 없이 발송 */
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
/* mn_dup_limit 0 이면 계속 발송한다.
*			$arrays=(object)array('mn_dup_limit'=>0,'mn_mms_limit'=>150);
*/
/* mn_dup_limit 7 이면  한번 발송한 사용자에게 7일 이후 발송한다.
**/
			$arrays=(object)array('mn_dup_limit'=>7,'mn_mms_limit'=>150);
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
	 * kt STORE 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $cd_id  콜로그 아이디
	 * @param string $cd_port 콜로그 포트
	 * @return array
	 */
 	function get_store_kt($array)
    {

		/*
		select * from prq.prq_store where 
		mb_id='0326110844@naver.com' 
		and st_tel_1='0326615917';
		*/
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
		$sql[]="and st_tel_1='".$array['calledid']."' ;";


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
		$sql[] = "cd_device_day_cnt='".$array['cd_device_day_cnt']."',";
		$sql[] = "cd_day_cnt='".$array['get_day_cnt']."' ";
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


	/**
	 * mms 디바이스 발송 갯수 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $st_hp 상점 핸드폰 번호
	 * @return array
	 */
	function get_mms_daily($st_hp)
    {
		/*
		| ml_no,ml_email,ml_monthly_limit,ml_daily_limit | ml_datetime         |
		*/
		$sql=array();
		$sql[]="SELECT ";
		$sql[]=" mm_daily_cnt ";
		$sql[]=" FROM ";
		$sql[]=" prq_mms_log ";
		$sql[]=" WHERE ";
		$sql[]=" mm_sender='".$st_hp."' ";
		$sql[]=" and date(mm_datetime)=date(now()) ";
		$sql[]=" ORDER BY ";
		$sql[]=" mm_datetime DESC ";
		$sql[]=" LIMIT 1;";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

     	//디바이스 발송 갯수 
		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
			$result = $query->row();
     	}else{
			$arrays=(object)array('mm_daily_cnt'=>0);
			$result = $arrays;
		}

		//지난 콜로그 반환
	    
    	return $result;
    }


	/**
	 * 처음 사용자 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_first()
    {
		/* 처음인 것만 조회 하여 처리 2016-05-19 (목) */
    	$sql = "SELECT * FROM `prq_first_log` WHERE pf_status='first' order by pf_no desc;";
    	$sql = "SELECT * FROM `prq_first_log` WHERE 1=1 order by pf_no desc;";
   		$query = $this->db->query($sql);

     	//댓글 리스트 반환
	    $result = $query->result();
		
		/*처리한 번호 핸드폰 발송 처리 */
		//$sql = "UPDATE `prq_first_log` SET pf_status='before_send' WHERE  pf_status='first';";
   		//$query = $this->db->query($sql);

     	//처음 사용자 리스트 반환
	    //$result2 = $query->result();
    	return $result;
    }


	/**
	 * first 로그 정보 갱신
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function set_firt_status($array)
    {
		$sql=array();
		$sql[] = "UPDATE prq_first_log SET ";
		$sql[] = "pf_status='".$array['pf_status']."' ";
		$sql[] = " WHERE pf_no='".$array['pf_no']."';";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);
    }

	/*
	set_ata($array)
	/prq/ajax/set_ata
	@param $array data
	@return json
	*/
	function set_ata($array)
	{

		
		$json=array();
		$json['success']=false;

		/*
			$ata_info = array(
			'pf_no'=>$li->pf_no,
			'msg'=>$msg,
			'mb_hp'=>$li->pf_hp,
			'tel'=>$li->pf_tel,
			'subject'=>"TEST"
		);*/

		/* Biztalk 전송 */
		$sql=array();
		$sql[]="INSERT INTO biztalk.em_mmt_tran SET ";
		$sql[]="date_client_req=SYSDATE(), ";
		$sql[]="date_client_req=SYSDATE(), ";
//		$sql[]="template_code='R00001',";	//구 @배달맛톡 템플릿
		$sql[]="template_code='T00006',";
		$sql[]="content='".$array['msg']."',";
		$sql[]="recipient_num='".$array['mb_hp']."',";
		$sql[]="callback='".$array['tel']."',";
		$sql[]="msg_status='1',";
		$sql[]="subject=' ', ";
//		$sql[]="sender_key='70b606cac13417a4dccc7577fb8d5f177e9ab8e3', ";
		$sql[]="sender_key='dbae1c54597868639f649ecc40d68dd45d100cb7', "; //@배달톡톡 키
		$sql[]="service_type='3', ";
		$sql[]="msg_type='1008';";
		$join_sql=join("",$sql);
		$json['query']=$join_sql;
		$query = $this->db->query($join_sql);
		$insert_id = $this->db->insert_id();
		$status=$query?"성공":"실패";

		$array['pf_status']=$status?"sended":"send_fail";
		$sql=array();
		$sql[] = "UPDATE prq_first_log SET ";
		$sql[] = "pf_status='".$array['pf_status']."' ";
		$sql[] = " WHERE pf_no='".$array['pf_no']."';";
		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

		$sql=array();
		$sql[]="INSERT INTO `prq_ata_log` SET ";
		$sql[]=" at_subject='".$array['subject']."', ";
		$sql[]=" at_content='".$array['msg']."', ";
		$sql[]=" at_receiver='".$array['mb_hp']."', ";
		$sql[]=" at_sender='".$array['tel']."', ";
		$sql[]=" at_mmt_no='".$insert_id."', ";
		$sql[]=" at_datetime=now(); ";
		$join_sql=join("",$sql);
		$query = $this->db->query($join_sql);
		if($query)
		{
			$json['result']="성공.";
			$json['sql']=$join_sql;
			$json['success']=true;
		}else{
			$json['result']="실패.";
		}

		echo json_encode($json);
	}

	/**
	 * 블로그 url on/off 사용 여부
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $st_no  상점아이디
	 * @return array
	 */
 	function get_blog_yn($st_no)
    {

		$sql=array();
		$sql[]="select ";
		$sql[]="pv_value ";
		$sql[]="from ";
		$sql[]="prq_values ";
		$sql[]="where ";
		$sql[]="pv_code='5002' ";
		$sql[]="and pv_no='".$st_no."';";

		$str_sql=join("",$sql);
   		$query = $this->db->query($str_sql);

		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
			$result = $query->row();
			//$result->cd_date=$result->cd_date;
     	}else{
			$arrays=(object)array('pv_value'=>'off');
			$result = $arrays;
		}

		//지난 콜로그 반환
    	return $result;
    }



	/**
	 * 알림톡 전송 대기 리스트 가져오기
	 *
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_ata()
    {
			/* 알림톡 전송 대기 인것 가져오기  */
			$sql = "SELECT * FROM `prq_ata_log` WHERE 1=1 and at_status in (1,2) order by at_no desc limit 15;";
			$query = $this->db->query($sql);

			//댓글 리스트 반환
			$result = $query->result();
			return $result;
    }


	/*
	set_ata_pay($array)
	/prq/ajax/set_ata_pay
	@param $array data
	@return json
	*/
	function set_ata_pay($array)
	{

		
		$json=array();
		$json['success']=false;
		/* msg_status 2 ATA전송 */
		if($array['at_status']=="2")
		{
			/* Biztalk 전송 */
			$sql=array();
			$sql[]="INSERT INTO biztalk.em_mmt_tran SET ";
			$sql[]=sprintf("date_client_req='%s', ",$array['date_client_req']);
			$sql[]="template_code='T00006',";
			$sql[]=sprintf("subject='%s', ",$array['subject']);
			$sql[]="content='".$array['msg']."',";
			$sql[]="recipient_num='".$array['mb_hp']."',";
			$sql[]="callback='".$array['tel']."',";
			$sql[]="msg_status='1',";
			$sql[]="sender_key='dbae1c54597868639f649ecc40d68dd45d100cb7', "; //@배달톡톡 키
			$sql[]="service_type='3', ";
			$sql[]="msg_type='1008';";
			$join_sql=join("",$sql);
			$json['query']=$join_sql;
			$query = $this->db->query($join_sql);
			$insert_id = $this->db->insert_id();
			$status=$query?"성공":"실패";
			$sql=array();
			$sql[]="UPDATE `prq_ata_log` SET ";
			$sql[]=" at_subject='".$array['subject']."', ";
			$sql[]=" at_content='".$array['msg']."', ";
			$sql[]=" at_receiver='".$array['mb_hp']."', ";
			$sql[]=" at_sender='".$array['tel']."', ";
			$sql[]=" at_mmt_no='".$insert_id."', ";
			$sql[]=sprintf(" at_status='%s', ",$array['at_status']);
			$sql[]=" at_datetime=now() ";
			$sql[]=sprintf(" where at_no='%s';",$array['at_no']);
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);
		}

		/* msg_status 3 ATA결과 
			상태가 3 전송확인이고
			전송 상태가 Y,N인 경우만 갱신.
			공백이면 갱신하지 않는다.
		*/
		if($array['at_status']=="3"&&$array['at_success']=="Y"||$array['at_status']=="3"&&$array['at_success']=="N")
		{
			/* 알림톡 페이 갱신 */
			$sql=array();
			$sql[]="UPDATE `prq_ata_pay` SET ";
			if($array['at_success']=="Y"){
				$sql[]=" ap_limit_cnt=ap_limit_cnt+1 ";
			}else if($array['at_success']=="N"){
				$sql[]=" ap_false_cnt=ap_false_cnt+1 ";
			}
			$sql[]=sprintf(" where ap_no='%s';",$array['ap_no']);
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);

			/*알림톡 로그 상태 갱신 */
			$sql=array();
			$sql[]="UPDATE `prq_ata_log` SET ";
			$sql[]=sprintf(" at_result='%s', ",$array['at_result']);
			$sql[]=sprintf(" at_status='%s' ",$array['at_status']);
			$sql[]=sprintf(" where at_no='%s';",$array['at_no']);
			$join_sql=join("",$sql);

			$query = $this->db->query($join_sql);
		}

		/* msg_status 4 ATA결과 
			상태가 4 전송초과
		*/
		if($array['at_status']=="4")
		{
			/* 알림톡 페이 갱신 */
			/*
			$sql=array();
			$sql[]="UPDATE `prq_ata_pay` SET ";
			if($array['at_success']=="Y"){
				$sql[]=" ap_limit_cnt=ap_limit_cnt+1 ";
			}else if($array['at_success']=="N"){
				$sql[]=" ap_false_cnt=ap_false_cnt+1 ";
			}
			$sql[]=sprintf(" where ap_no='%s';",$array['ap_no']);
			$join_sql=join("",$sql);
			$query = $this->db->query($join_sql);
			*/
			/*알림톡 로그 상태 갱신 */
			$sql=array();
			$sql[]="UPDATE `prq_ata_log` SET ";
			$sql[]=sprintf(" at_result='%s', ",$array['at_result']);
			$sql[]=sprintf(" at_status='%s' ",$array['at_status']);
			$sql[]=sprintf(" where at_no='%s';",$array['at_no']);
			$join_sql=join("",$sql);

			$query = $this->db->query($join_sql);
		}
		if($query)
		{
			$json['result']="성공.";
			$json['sql']=$join_sql;
			$json['success']=true;
		}else{
			$json['result']="실패.";
		}

		echo json_encode($json);
	}


	/**
	* ATA 코드 정보 가져 오기
	*
	* @author Taebu,Moon <mtaebu@gmail.com>
	* @param string $table 게시판 테이블
	* @param string $id 게시물번호
	* @return array
	*/
	function get_mmt_id($no, $datetime)
	{
		$datecode=date("Ym",strtotime($datetime));
		$sql = "SELECT mt_report_code_ib FROM biztalk.em_mmt_log_".$datecode." WHERE mt_pr='".$no."';";
		$query = $this->db->query($sql) or die("test");
		
		//댓글 리스트 반환
		$result = $query->result();
		$count = $query->num_rows();
		$result['count']=$count;
		if($count==0)
		{
			
				 $sql = "SELECT mt_report_code_ib FROM biztalk.em_mmt_tran WHERE mt_pr='".$no."';";
					$query = $this->db->query($sql);
					$result = $query->result();
			
		}
		return $result;
	}

	/*
	작성일 : 2016-04-26 (화)
	fn getAtaCode()
	@status=""
	*/
	function getAtaCode($status="")
	{
		/* OLD ATA V.1.0.4 전송결과코드 */
		$array['1000']="성공"; /* 1000 성공에 대하여서만 과금. */
		$array['2000']="전송 시간 초과";
		$array['2001']="메시지 전송 불가 (예기치 않은 오류 발생)카카오톡을 사용하지 않는 사용자72시간 이내에 카카오톡 사용 이력이 없는 사용자알림톡 차단을 선택한 사용자";
		$array['3009']="메시지 형식 오류";
		$array['3014']="알 수 없는 메시지 상태";
		$array['3023']="메시지 문법 오류";
		$array['3024']="발신 프로필 키가 유효하지 않음";
		$array['3025']="메시지 전송 실패 (테스트 시, 친구관계가 아닌 경우)";
		$array['3026']="메시지와 템플릿의 일치성 확인시 오류 발생";
		$array['3027']="카카오톡을 사용하지 않는 사용자 (전화번호 오류)카카오톡을 사용하지 않는 사용자 (050 안심번호)";
		$array['3029']="메시지가 존재하지 않음";
		$array['3030']="메시지 일련번호가 중복됨";
		$array['3031']="메시지가 비어 있음";
		$array['3032']="메시지 길이 제한 오류 (공백 포함 1000 자)";
		$array['3033']="템플릿을 찾을 수 없음";
		$array['3034']="메시지가 템플릿과 일치하지 않음";
		$array['3035']="5 초 이내에 메시지를 중복 발송";
		$array['1001']="Server Busy (RS 내부 저장 Queue Full)";
		$array['1002']="수신번호 형식 오류";
		$array['1003']="회신번호 형식 오류";
		$array['1009']="CLIENT_MSG_KEY 없음";
		$array['1010']="CONTENT 없음";
		$array['1012']="RECIPIENT_INFO 없음";
		$array['1013']="SUBJECT 없음";
		$array['1018']="전송 권한 없음";
		$array['1019']="TTL 초과";
		$array['1020']="charset conversion error";
		$array['1099']="인증 실패";
		$array['E901']="수신번호가 없는 경우";
		$array['E903']="제목 없는 경우";
		$array['E904']="메시지가 없는 경우";
		$array['E905']="회신번호가 없는 경우";
		$array['E906']="메시지키가 없는 경우";
		$array['E915']="중복메시지";
		$array['E916']="인증서버 차단번호";
		$array['E917']="고객DB 차단번호";
		$array['E918']="USER CALLBACK FAIL";
		$array['E919']="발송 제한 시간인 경우, 메시지 재발송 처리가 금지 된 경우";
		$array['E920']="서비스 타입이 알림톡인 경우, 메시지 테이블에 파일그룹키가 있는 경우";
		$array['E999']="기타오류";

		/* NEW ATA V.1.0.5 전송결과코드 */
		$array['1000']="성공";
		$array['2000']="전송 시간 초과";
		$array['2001']="메시지 전송 불가 (예기치 않은 오류 발생)";
		$array['3009']="메시지 형식 오류";
		$array['3014']="알 수 없는 메시지 상태";
		$array['3023']="메시지 문법 오류(JSON형식오류)";
		$array['3024']="발신 프로필 키가 유효하지 않음";
		$array['3025']="메시지 전송 실패 (테스트 시, 친구관계가 아닌 경우)";
		$array['3026']="메시지와 템플릿의 일치성 확인시 오류 발생";
		$array['3027']="카카오톡을 사용하지 않는 사용자 (전화번호 오류 / 050 안심번호)";
		$array['3029']="메시지가 존재하지 않음";
		$array['3030']="메시지 일련번호가 중복됨";
		$array['3031']="메시지가 비어 있음";
		$array['3032']="메시지 길이 제한 오류 (공백 포함 1000 자)";
		$array['3033']="템플릿을 찾을 수 없음";
		$array['3034']="메시지가 템플릿과 일치하지 않음";
		$array['3035']="5 초 이내에 메시지를 중복 발송";
		$array['3040']="허브 파트너 키가 유효하지 않음";
		$array['3041']="Request Body에서 Name을 찾을수 없음";
		$array['3042']="발신 프로필을 찾을 수 없음";
		$array['3043']="삭제된 발신 프로필";
		$array['3044']="차단 상태의 발신 프로필";
		$array['3045']="차단 상태의 옐로아이디";
		$array['3046']="닫힘 상태의 옐로아이디";
		$array['3047']="삭제된 옐로아이디";
		$array['3048']="계약정보를 찾을수 없음";
		$array['3049']="내부 시스템 오류로 메시지 전송 실패";
		$array['3050']="카카오톡을 사용하지 않는 사용자<br>72시간 이내에 카카오톡 사용 이력이 없는 사용자<br>알림톡 차단을 선택한 사용자";
		$array['3051']="메시지가 발송되지 않은 상태";
		$array['3052']="메시지 확인 정보를 찾을 수 없음";
		$array['3054']="메시지 발송 가능한 시간이 아님";
		$array['3055']="메시지 그룹 정보를 찾을 수 없음";
		$array['3056']="메시지 전송 결과를 찾을 수 없음";
		$array['9998']="시스템에 문제가 발생하여 담당자가 확인중(현재 서비스 제공중이 아님)";
		$array['9999']="시스템에 문제가 발생하여 담당자가 확인중(시스템에 알 수 없는 오류 발생)";
		$array['1001']="Server Busy (RS 내부 저장 Queue Full)";
		$array['1002']="수신번호 형식 오류";
		$array['1003']="회신번호 형식 오류";
		$array['1009']="CLIENT_MSG_KEY 없음";
		$array['1010']="CONTENT 없음";
		$array['1012']="RECIPIENT_INFO 없음";
		$array['1013']="SUBJECT 없음";
		$array['1018']="전송 권한 없음";
		$array['1019']="TTL 초과";
		$array['1020']="charset conversion error";
		$array['1099']="인증 실패";
		$array['E901']="수신번호가 없는 경우";
		$array['E903']="제목 없는 경우";
		$array['E904']="메시지가 없는 경우";
		$array['E905']="회신번호가 없는 경우";
		$array['E906']="메시지키가 없는 경우";
		$array['E915']="중복메시지";
		$array['E916']="인증서버 차단번호";
		$array['E917']="고객DB 차단번호";
		$array['E918']="USER CALLBACK FAIL";
		$array['E919']="발송 제한 시간인 경우, 메시지 재발송 처리가 금지 된 경우";
		$array['E920']="서비스 타입이 알림톡인 경우, 메시지 테이블에 파일그룹키가 있는 경우";
		$array['E999']="기타오류";	
		
		/* 사용자 정의 코드*/
		$array['0000']="전송대기";	
		$array['9999']="할당전송초과";	

		if (array_key_exists($key, $array)) {
			$result=$array[$key];
		}else{
			$result="기타오류";
		}

		return $result;
	}

	function get_ap_limit_cnt($ap_no)
  {
		$ap_limit_cnt=0;
		$sql=array();
		$sql[]="select ap_limit_cnt from prq.prq_ata_pay ";
		$sql[]="where ap_no=".$ap_no." limit 1;";

		$str_sql=join("",$sql);
 		$query = $this->db->query($str_sql);

		if ( $query->num_rows() > 0 )
		{
			//맞는 데이터가 있다면 해당 내용 반환
			$result = $query->row();
			$ap_limit_cnt=$result->ap_limit_cnt;
		}

		//지난 콜로그 반환
	    
    	return $ap_limit_cnt;
    }

	/**
	 * 알림톡 전송 설정 리스트 가져오기
	 * /prq/crontab/ata_pay crontab -e 에서 하루에 매장 계약 정보에 따라 초기화 하는 과정을 거친다.
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function get_ata_pay()
    {
			/* 알림톡 전송 대기 인것 가져오기  */
			$sql = "SELECT * FROM `prq_ata_pay` where ap_status='join';";
			$query = $this->db->query($sql);

			//댓글 리스트 반환
			$result = $query->result();
			return $result;
    }

	/**
	 * 알림톡 전송 설정 정보 
	 * /prq/crontab/ata_pay crontab -e 에서 하루에 매장 계약 정보에 따라 초기화 하는 과정을 거친다.
	 * @author Taebu Moon <mtaebu@gmail.com>
	 * @param string $table 게시판 테이블
	 * @param string $id 게시물번호
	 * @return array
	 */
    function insert_ata_pay($array)
    {
		$sql=array();
		$sql[] = "update prq_ata_pay SET ";
		$sql[] = sprintf("`ap_status`='%s' ","expire");
		$sql[] = sprintf(" where ap_no='%s';",$array['ap_no']);
		$str_sql=join("",$sql);
		$query = $this->db->query($str_sql);
		$sql=array();
		$sql[] = "insert into prq_ata_pay SET ";
		$sql[] = sprintf("`st_no`='%s',",$array['st_no']);
		$sql[] = sprintf("`st_name`='%s',",$array['st_name']);
		$sql[] = sprintf("`prq_fcode`='%s',",$array['prq_fcode']);
		$sql[] = sprintf("`ap_name`='%s',",$array['ap_name']);
		$sql[] = sprintf("`ap_price`='%s',",$array['ap_price']);
		$sql[] = sprintf("`ap_limit`='%s',",$array['ap_limit']);
		$sql[] = sprintf("`ap_limit_cnt`='%s',",$array['ap_limit_cnt']);
		$sql[] = sprintf("`ap_false_cnt`='%s',",$array['ap_false_cnt']);
		$sql[] = sprintf("`ap_status`='%s',",$array['ap_status']);
		$sql[] = sprintf("`terminate_date`='%s',",$array['`terminate_date']);
		$sql[] = sprintf("`stop_date`='%s',",$array['stop_date']);
		$sql[] = sprintf("`join_date`='%s',",$array['join_date']);
		$sql[] = sprintf("`ap_autobill_YN`='%s',",$array['ap_autobill_YN']);
		$sql[] = sprintf("`ap_autobill_date`='%s',",$array['ap_autobill_date']);
		$sql[] = sprintf("`ap_reserve`='%s',",$array['ap_reserve']);
		$sql[] = "`ap_datetime`=now();";
		$str_sql=join("",$sql);
   	$query = $this->db->query($str_sql);
    }
}

/* End of file crontab_m.php */
/* Location: ./prq/application/models/crontab_m.php */