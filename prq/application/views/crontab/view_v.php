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
 select date(DATE_SUB(NOW(), INTERVAL 7 DAY);
 가맹점.<br>
 일주일 전 혹은 세팅한 prq.prq_mno 테이블에 mn_dup_limit 날짜를 초과하지 않는 핸드폰 번호를 조회하여 mms 를 발송한다.<br>
<br>

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
foreach($list as $li){
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
		echo $msg;
		$config=array(
			'is_mms'=>'true',
			'message'=>$msg,
			'title'=>'web',
			'receiver_num'=>$li->cd_callerid,
			'phone'=>$li->cd_hp,
			'img_url'=>"http://prq.co.kr/prq/uploads/TH/".$st->st_thumb_paper
		);
		$curl=$controller->curl->simple_post('http://prq.co.kr/prq/set_gcm.php', $config, array(CURLOPT_BUFFERSIZE => 10)); 
		echo $curl;
	}/* foreach($store as $st){...}*/
}/*foreach($list as $li){...}*/
?>
</body>
</html>

