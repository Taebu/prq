<?php
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
  <title>Document</title>
 </head>
 <body>
select date(DATE_SUB(NOW(), INTERVAL 7 DAY);<br>
가맹점.<br>
일주일 전 혹은 세팅한 prq.prq_mno 테이블에 mn_dup_limit 날짜를 초과하지 않는 핸드폰 번호를 조회하여 mms 를 발송한다.<br>
<br>
select * from prq_gcm_log where date(gc_datetime)>date(DATE_SUB(NOW(), INTERVAL 7 DAY)) and gc_receiver='01032740790';
<br>
mysql> SELECT TIMESTAMPDIFF(DAY,now(),'2016-02-01');

 <?php 

/* 블랙 리스트 조회 하기 */
$black_list=$controller->crontab_m->get_black();
$black_arr=array();
foreach($black_list as $bl){
	$black_arr[]=$bl->bl_hp;
}

/* 콜 리스트 조회 일부는 조회한 후 필터링 
조건
1. mn_dup_limit 날짜를 기준으로 상점의 번호와 아이디 번호를 조회해 결과 리스트가 없으면 발송
2. 해당 리스트 발송에 대하여 GCM MMS 로그를 발생 수발신 성공 여부 기록 
*/
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

foreach($list as $li)
{
	echo "<tr>";
	/*SELECT TIMESTAMPDIFF(DAY,'2009-05-18','2009-07-29');*/
	echo "<td>".$li->cd_date."</td>";
	echo "<td>".$li->cd_id."</td>";
	echo "<td>".$li->cd_port."</td>";
	echo "<td>".$li->cd_callerid."</td>";
	echo "<td>".$li->cd_calledid."</td>";
	echo "<td>".$li->cd_state."</td>";
	echo "<td>".$li->cd_name."</td>";
	echo "<td>".$li->cd_tel."</td>";
	echo "<td>".$li->cd_hp."</td>";

	$cdr_info = array(
	//CDR 정보 조회
	'cd_date'=> $li->cd_date,
	'cd_tel'=> $li->cd_tel,
	'cd_hp' =>$li->cd_hp,
	'cd_callerid' =>$li->cd_callerid
	);
	
	$last_cdr=$controller->crontab_m->get_last_cdr($cdr_info);
	$get_mno_limit=$controller->crontab_m->get_mno_limit($li->cd_id);
	
	$cd_date=$last_cdr->cd_date;
	echo "<td>".$cd_date."</td>";
	echo "<td>".$get_mno_limit->mn_dup_limit."</td>";
	$chk_limit_date=$get_mno_limit->mn_dup_limit>$cd_date?"보내면 안됨":"보냄";
	echo "<td>".$chk_limit_date."</td>";
	
	// select cd_date from prq_cdr where cd_tel='0313768936' and cd_hp='01089602214' and cd_callerid='01091675141' order by cd_date desc limit 1;

	//echo "<td>select * from prq_cdr where cd_tel='".$li->cd_tel."' and cd_hp='".$li->cd_hp."' and cd_callerid='".$li->cd_callerid."'</td>";
	$config = array(
	//페이지네이션 기본 설정
	'cd_id'=> $li->cd_id,
	'cd_port' =>$li->cd_port
	);
	
	$store=$controller->crontab_m->get_store($config);


	foreach($store as $st)
	{
		/*mms 발송 여부*/
		$chk_mms=true;
		//$breaks = array("<br />","<br>","<br/>","\r\n");
	    //$st->st_middle_msg = str_ireplace($breaks, "<br>", $st->st_middle_msg);  
		//echo "<td>".$st->st_tel_1."</td>";
		//echo "<td>".$st->st_hp_1."</td>";
		$msg=array();
		$msg[]=$st->st_top_msg;
		//$msg[]=nl2br($st->st_middle_msg,true);
		if($st->st_mno=="LG"){
			$msg[]=str_replace(array("\r\n", "\r",'<br />','<br>'), '\n', $st->st_middle_msg);
			//$msg[]="\"이용해주셔서 감사합니다.\"<br>\"이용해주셔서 감사합니다.\"<br>";
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

		$img_url="http://prq.co.kr/prq/uploads/TH/".$st->st_thumb_paper;
		//수신거부 여부 체크
		if(in_array($li->cd_callerid,$black_arr))
		{
			/*gcm 로그 발생*/
			$result_msg= "수신거부";
			$gc_ipaddr='123.142.52.91';
			$sql=array();

			$sql[]="INSERT INTO `prq_gcm_log2` SET ";
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
			continue;
			
		}

		/*보내면 안됨*/
		if($get_mno_limit->mn_dup_limit>$cd_date){
			/*gcm 로그 발생*/
			$result_msg= $cd_date."/".$get_mno_limit->mn_dup_limit."일 중복 제한";
			$gc_ipaddr='123.142.52.91';
			$sql=array();
			$sql[]="INSERT INTO `prq_gcm_log2` SET ";
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
			continue;
		}


		if($chk_mms)
		{
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
			//$curl=$controller->curl->simple_post('http://prq.co.kr/prq/set_gcm.php', $config, array(CURLOPT_BUFFERSIZE => 10)); 
			//echo $curl;
		}/*if($chk_mms){...}*/
	}/* foreach($store as $st){...}*/
	echo "</tr>";
}/*foreach($list as $li){...}*/
echo "</table>";
?>
</body>
</html>