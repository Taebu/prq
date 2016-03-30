<?php
/********************************************************
* 1분마다 콜로그를 조회하여 gcm과 mms 를 전송하는 페이지 크론탭에 등록 되어 있습니다.
* location : /prq/application/views/crontab/view_v.php
* url : /prq/crontab/view
* 작성일2016-03-30 (수)
*
********************************************************/
$host_name="localhost";
$db_name="prq";
$user_name="root";
$db_password="hanna0987";
$connect=mysql_connect($host_name, $user_name, $db_password);
define("CONNECT",$connect);
mysql_select_db($db_name, $connect);
mysql_query("set names utf8;") ;
extract($_REQUEST);
extract($_GET);
extract($_POST);
$ROOT = $_SERVER['DOCUMENT_ROOT'];
header("Content-Type:text/html;charset=utf-8");
?>
<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>PRQ crontab/view_v MMS Sender</title>
 </head>
 <body>
<p>이 문서는 /prq/application/views/crontab/view_v.php 에 위치 합니다. </p>
<p>crontab -e 에서 </p>
<p><input type="checkbox" name="" id="" checked>구현] * * * * * /etc/sh/set_mms.sh로 돌아가도록 설정 되어 있으며, 1분마다 구동 설정 되어 있습니다.</p>
<p><input type="checkbox" name="" id="" checked>구현] 그래서 curl -u http://prq.co.kr/prq/crontab/view 링크를 실행</p>
<p><input type="checkbox" name="" id="" checked>구현] 조회시 prq_cdr을 조회하여 gcm으로 변경하여 cd_state가 1 인)</p>
<p><input type="checkbox" name="" id="" checked>구현] 핸드폰 번호인 경우만 mms 를 요청하도록 gcm을 가맹점 사장의 핸드폰에 전송</p>
<p><input type="checkbox" name="" id="" checked>구현]  prq application이 이를 감지하여 해당 잔여 mms를 전송합니다.</p>
<p><input type="checkbox" name="" id="" checked>구현] 제한 된 문자 인 기본값 하루 150건까지 전송 되며 제한이 되면 전송을 중지하도록 루프를 종료하도록 설계 해야 합니다.0 </p>
<p><input type="checkbox" name="" id="">미구현] 목적 : callerid.cdr에서 만들어진 로그가 trigger에 의해서 작동된 다음 prq.prq_cdr에 prq.prq_store 정보를 kt cid prq cid 장비에 따라 불러와서 prq.cdr에 등록 된 정보를 조회 하여 gcm을 생성 한다.</p>
<p><input type="checkbox" name="" id="">미구현] 2016-03-16 (수) KT.dat 파일에서 불러 오는 경우 카운트가 0으로 한꺼번에 처리 된다. 한꺼번에 처리해도 순차 처리 될 수 있도록 프로그래밍 할것.</p>

select date(DATE_SUB(NOW(), INTERVAL 7 DAY);<br>
가맹점.<br>
일주일 전 혹은 세팅한 prq.prq_mno 테이블에 mn_dup_limit 날짜를 초과하지 않는 핸드폰 번호를 조회하여 mms 를 발송한다.<br>
<br>
select * from prq_gcm_log where date(gc_datetime)>date(DATE_SUB(NOW(), INTERVAL 7 DAY)) and gc_receiver='01032740790';<br>
mysql> SELECT TIMESTAMPDIFF(DAY,now(),'2016-02-01');

<?php 
/****************************************************************************** 
* 1. 블랙 리스트 가져오기 
* 
******************************************************************************/
$black_list=$controller->crontab_m->get_black();
$black_arr=array();


foreach($black_list as $bl){
	$black_arr[]=$bl->bl_hp;
}

/******************************************************************************
*
* 2. 콜 리스트 조회 일부는 조회한 후 필터링 
* 조건
* 1. mn_dup_limit 날짜를 기준으로 상점의 번호와 아이디 번호를 조회해 결과 리스트가 없으면 발송
* 2. 해당 리스트 발송에 대하여 GCM MMS 로그를 발생 수발신 성공 여부 기록 
*
*******************************************************************************/

/******************************************************************************
* 
* 3. select max
* SET @max_count=7;
* SET @max_count=@max_count+1;
*
*******************************************************************************/
echo "<table border=1 style='padding:0;margin:0'>";
echo "<tr>";
echo "<th>날짜</th>";
echo "<th>아이디</th>";
echo "<th>포트</th>";
echo "<th>전화1</th>";
echo "<th>전화2</th>";
echo "<th>cd_state</th>";
echo "<th>cd_name</th>";
echo "<th>cd_tel</th>";
echo "<th>cd_hp</th>";
echo "<th>query</th>";
echo "<th>중복발송제한</th>";
echo "<th>결과</th>";
echo "</tr>";

/*****************************************************
* 
* 2-1. 리스트가 없으면 없는 값 출력
* 
*****************************************************/
if(count($list)==0){
	echo '<tr><td scope="row" colspan="12" style="text-align:center"> 조회한 prq_cdr `log`가 없습니다.</td></tr>';
}

foreach($list as $li)
{
	/*****************************************************
	* 2-2. 리스트 출력 
	* SELECT TIMESTAMPDIFF(DAY,'2009-05-18','2009-07-29');
	***************************************************/
	echo "<tr>";
	echo "<td>".$li->cd_date."</td>";
	echo "<td>".$li->cd_id."</td>";
	echo "<td>".$li->cd_port."</td>";
	echo "<td>".$li->cd_callerid."</td>";
	echo "<td>".$li->cd_calledid."</td>";
	echo "<td>".$li->cd_state."</td>";
	echo "<td>".$li->cd_name."</td>";
	echo "<td>".$li->cd_tel."</td>";
	echo "<td>".$li->cd_hp."</td>";
	echo "<td>".$li->cd_day_cnt."</td>";
	echo "<td>".$li->cd_day_limit."</td>";

	/*******************************************************************************
	* 3. get_last_cdr 
	* - 마지막 바로 전 cdr 정보 조회 
	* - 지금 들어온 데이터는 당연 예외 처리 값을 비교한 값만을 참조하고,
	* - 처음 보내는 것은 first_send로 명명한다.
	*******************************************************************************/
	$cdr_info = array(
	'cd_date'=> $li->cd_date,
	'cd_tel'=> $li->cd_tel,
	'cd_hp' =>$li->cd_hp,
	'cd_callerid' =>$li->cd_callerid
	);
	$last_cdr=$controller->crontab_m->get_last_cdr($cdr_info);

	

//	$today_mms_cnt=$controller->crontab_m->get_send_cnt($array);
//	$today_mms_cnt
	
	/*******************************************************************************
	* 4. get_mno_limit
	* - 중복 발송일 수 조회 기본값은 0인데  
	* - 값이 mn_dup_limit 만약 3이라면, 
	* - 마지막 콜로그와 대조해 보아서 
	* - 3일 동안 보내지 않습니다.  
	* - NEW] mn_limit_
	********************************************************************************/
	$array=array('mb_hp'=>$li->cd_hp);
	$get_mno_limit=$controller->crontab_m->get_mno_limit($li->cd_id);

	/********************************************************************************
	* 5. array get_send_cnt
	* - 이번달 발송 수 조회 
	********************************************************************************/
	$array=array('mb_hp'=>$li->cd_hp);
	$get_day_cnt=$controller->crontab_m->get_send_cnt($array);
	
	/********************************************************************************
	* 6-1. array get_mms_daily
	* - mms_daily 정보 가져 오기
	********************************************************************************/
	$mno_device_daily=$controller->crontab_m->get_mms_daily($li->cd_hp);
	echo "<td>".$mno_device_daily->mm_daily_cnt."</td>";

	/********************************************************************************
	* 6-2. void set_cdr
	* - cdr 정보 세팅
	********************************************************************************/
	$get_mno_limit->mn_mms_limit=$get_mno_limit->mn_mms_limit?$get_mno_limit->mn_mms_limit:150;
	$cdr_info = array(
		'cd_date'=> $li->cd_date,
		'cd_tel'=> $li->cd_tel,
		'cd_hp' =>$li->cd_hp,
		'cd_device_day_cnt' =>$mno_device_daily->mm_daily_cnt,
		'cd_day_limit'=> $get_mno_limit->mn_mms_limit,
		'get_day_cnt' =>$get_day_cnt->cnt);       
	$controller->crontab_m->set_cdr($cdr_info);
	echo "<td>".$li->cd_port."</td>";
	$cd_date=$last_cdr->cd_date;
	echo "<td>".$get_day_cnt->cnt."/".$get_mno_limit->mn_mms_limit."</td>";
	echo "<td>".$cd_date."</td>";
	echo "<td>".$get_mno_limit->mn_mms_limit."</td>";
	echo "<td>".$get_mno_limit->mn_dup_limit."</td>";
	$chk_limit_date=$get_mno_limit->mn_dup_limit>$cd_date?"보내면 안됨":"보냄";
	echo "<td>".$chk_limit_date."</td>";


	/********************************************************************************
	* 
	* 7.array get_store 
	* - 기기 CID인 경우( * KT_CID 아닌 경우)
	* - 이메일과 포트 번호로 상점 정보 조회
	*
	********************************************************************************/
	$config = array(
	'cd_id'=> $li->cd_id,
	'cd_port' =>$li->cd_port);
	$store=$controller->crontab_m->get_store($config);

	/* 콜로그가 KT 장비 인 경우*/
	foreach($store as $st)
	{

		$st_hp=$st->st_hp_1;
		if($li->cd_port=="0")
		{
			/********************************************************************************
			* 8. void set_cdr_kt 
			* - KT_CID 포트 구분이 없다.
			* - PRQ_CID 역시 포트 구분이 없다.
			* - 개발 당시 한번의 핸드폰 건만 하루 전송하고 이외에 콜은 인정하지 않는다.
			* - cdr kt 세팅
			********************************************************************************/
			$cdr_info = array(
			//페이지네이션 기본 설정
			'cd_date'=>$li->cd_date,
			'cd_callerid'=>$li->cd_callerid,
			'cd_calledid'=>$li->cd_calledid,
			'st_name'=> $st->st_name,
			'st_tel_1'=> $st->st_tel_1,
			'st_hp_1' =>$st->st_hp_1
			);
			$controller->crontab_m->set_cdr_kt($cdr_info);
			$li->cd_hp=$st->st_hp_1;
		}/* if($li->cd_port=="0"){...} */

		/*mms 발송 여부*/
		$chk_mms=true;
		$msg=array();
		$msg[]=$st->st_top_msg;
		if($st->st_mno=="LG"){
			$msg[]=str_replace(array("\r\n", "\r",'<br />','<br>'), '\n', $st->st_middle_msg);
		}else{
			$msg[]=str_replace(array("\r\n", "\r", "\n"), '<br>', $st->st_middle_msg);		
		}
		$msg[]=$st->st_bottom_msg;
		$msg[]=$st->st_modoo_url;
		$param=array();
		$param['url']="http://prq.co.kr/prq/set_gcm.php";
		$param['return_type']='';
		if($st->st_mno=="LG"){	
		$msg=join("\n",$msg);
		}else{
		$msg=join("<br>",$msg);
		}
		//echo $msg;

		/********************************************************************************
		* 9. void set_gcm_log
		* - gcm 로그에 따라 prq DB에 gcm_log 발생
		*
		********************************************************************************/
		$img_url="http://prq.co.kr/prq/uploads/TH/".$st->st_thumb_paper;
		//수신거부 여부 체크
		if(in_array($li->cd_callerid,$black_arr))
		{
			/*gcm 로그 발생*/
			$result_msg= "수신거부";
			$gc_ipaddr='123.142.52.91';
			$sql=array();

			if($li->cd_port==0)
			{
				$li->cd_hp=$st->st_hp_1;
			}
			$sql[]="INSERT INTO `prq_gcm_log` SET ";
			$sql[]="gc_subject='web',";
			$sql[]="gc_content='".$msg."',";
			$sql[]="gc_ismms='true',";
			$sql[]="gc_receiver='".$li->cd_callerid."',";
			$sql[]="gc_sender='".$li->cd_hp."',";
			$sql[]="gc_imgurl='".$img_url."',";
			$sql[]="gc_result='".$result_msg."',";
			$sql[]="gc_ipaddr='".$gc_ipaddr."',";
			$sql[]="gc_stno='".$st->st_no."',";
			$sql[]="gc_datetime=now();";
			echo join("",$sql);
			mysql_query(join("",$sql));
			$chk_mms=false;
		}

		/********************************************************************************
		* 9-1. void set_gcm_log
		* 중복 제한 보내면 안됨
		* prq_gcm_log 중복제한 로그 발생
		********************************************************************************/
		if($get_mno_limit->mn_dup_limit>$cd_date){
			/*gcm 로그 발생*/
			$result_msg= $cd_date."/".$get_mno_limit->mn_dup_limit."일 중복 제한";
			$gc_ipaddr='123.142.52.91';
			$sql=array();
			if($li->cd_port==0)
			{
				$li->cd_hp=$st->st_hp_1;
			}

			$sql[]="INSERT INTO `prq_gcm_log` SET ";
			$sql[]="gc_subject='web',";
			$sql[]="gc_content='".$msg."',";
			$sql[]="gc_ismms='true',";
			$sql[]="gc_receiver='".$li->cd_callerid."',";
			$sql[]="gc_sender='".$li->cd_hp."',";
			$sql[]="gc_imgurl='".$img_url."',";
			$sql[]="gc_result='".$result_msg."',";
			$sql[]="gc_ipaddr='".$gc_ipaddr."',";
			$sql[]="gc_stno='".$st->st_no."',";
			$sql[]="gc_datetime=now();";
			mysql_query(join("",$sql));
			$chk_mms=false;
		}

		/********************************************************************************
		* 9-2. void set_gcm_log
		* 150건 제한
		* prq_gcm_log 150건 제한 로그 발생
		********************************************************************************/
		/* 일간 mms 발송건 초기값 */
		$daily_mms_cnt=0;
		/* 일간 mms 발송건 디바이스 값 */
		$daily_mms_cnt+=$mno_device_daily->mm_daily_cnt;
		/* 일간 mms 발송건 prq 값 */
		$daily_mms_cnt+=$li->cd_day_cnt;
		
		//if($get_mno_limit->mn_dup_limit>$cd_date){
		if($daily_mms_cnt>$get_mno_limit->mn_mms_limit){
			/*gcm 로그 발생*/
			$result_msg= $li->cd_day_cnt."/".$get_mno_limit->mn_mms_limit."건 제한";
			$gc_ipaddr='123.142.52.91';
			$sql=array();
			if($li->cd_port==0)
			{
				$li->cd_hp=$st->st_hp_1;
			}

			$sql[]="INSERT INTO `prq_gcm_log` SET ";
			$sql[]="gc_subject='web',";
			$sql[]="gc_content='".$msg."',";
			$sql[]="gc_ismms='true',";
			$sql[]="gc_receiver='".$li->cd_callerid."',";
			$sql[]="gc_sender='".$li->cd_hp."',";
			$sql[]="gc_imgurl='".$img_url."',";
			$sql[]="gc_result='".$result_msg."',";
			$sql[]="gc_ipaddr='".$gc_ipaddr."',";
			$sql[]="gc_stno='".$st->st_no."',";
			$sql[]="gc_datetime=now();";
			mysql_query(join("",$sql));
			$chk_mms=false;
		}		

		/********************************************************************************
		*
		* 9-3. curl->simple_post('http://prq.co.kr/prq/set_gcm.php')
		* - 수신거부 중복, 150건 제한 혹은 설정한 일수 제한 아닌 경우만
		* - $chk_mms = true;
		*********************************************************************************/
		if($chk_mms)
		{
			/********************************************************************************
			* 10. void set_gcm
			* - curl 전송
			********************************************************************************/
			$config=array(
				'is_mms'=>'true',
				'message'=>$msg,
				'st_no'=>$st->st_no,
				'title'=>'web',
				'receiver_num'=>$li->cd_callerid,
				'phone'=>$li->cd_hp,
				'img_url'=>"http://prq.co.kr/prq/uploads/TH/".$st->st_thumb_paper,
				'mode'=>'crontab'
			);
			
			$curl=$controller->curl->simple_post('http://prq.co.kr/prq/set_gcm.php', $config, array(CURLOPT_BUFFERSIZE => 10)); 
			echo $curl;
		}/*if($chk_mms){...}*/
	}/* foreach($store as $st){...}*/
	echo "</tr>";
}/*foreach($list as $li){...}*/
echo "</table>";
?>
</body>
</html>