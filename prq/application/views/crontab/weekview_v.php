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
foreach($list as $li)
{
	/*SELECT TIMESTAMPDIFF(DAY,'2009-05-18','2009-07-29');*/
	echo "<p>".$li->gc_no."</p>";
	echo "<p>".$li->gc_subject."</p>";
	echo "<p>".$li->gc_content."</p>";
	echo "<p>".$li->gc_ismms."</p>";
	echo "<p>".$li->gc_receiver."</p>";
	echo "<p>".$li->gc_sender."</p>";
	echo "<p>".$li->gc_imgurl."</p>";
	echo "<p>".$li->gc_result."</p>";
	echo "<p>".$li->gc_datetime."</p>";
	echo "<p>".$li->gc_status."</p>";
	echo "<p>".$li->gc_ipaddr."</p>";

	$config = array(
	//페이지네이션 기본 설정
	'cd_id'=> $li->cd_id,
	'cd_port' =>$li->cd_port
	);
	
	//수신거부 여부 체크
	if(in_array($li->cd_callerid,$black_arr))
	{
		return;
	}
	echo $li->cd_date;
	$store=$controller->crontab_m->get_store($config);


	foreach($store as $st)
	{
		//$breaks = array("<br />","<br>","<br/>","\r\n");
	    //$st->st_middle_msg = str_ireplace($breaks, "<br>", $st->st_middle_msg);  
		echo "st_tel : ".$st->st_tel_1."<br>";
		echo "st_hp : ".$st->st_hp_1."<br>";
		$msg=array();
		$msg[]=$st->st_top_msg;
		//$msg[]=nl2br($st->st_middle_msg,true);
		if($st->st_mno=="KT"){
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
		if($st->st_mno=="KT"){	
		$msg=join("\n",$msg);
		}else{
		$msg=join("<br>",$msg);
		}
		echo $msg;
		$config=array(
			'is_mms'=>'true',
			'message'=>$msg,
			'title'=>'web',
			'receiver_num'=>$li->cd_callerid,
			'phone'=>$li->cd_hp,
			'img_url'=>"http://prq.co.kr/prq/uploads/TH/".$st->st_thumb_paper
		);
		//$curl=$controller->curl->simple_post('http://prq.co.kr/prq/set_gcm.php', $config, array(CURLOPT_BUFFERSIZE => 10)); 
		echo $curl;
	}/* foreach($store as $st){...}*/
}/*foreach($list as $li){...}*/
?>
</body>
</html>