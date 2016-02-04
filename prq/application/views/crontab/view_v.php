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
 <?php 
foreach($list as $li){
	$config = array(
	//페이지네이션 기본 설정
	'cd_id'=> $li->cd_id,
	'cd_port' =>$li->cd_port
	);

	echo $li->cd_date;
	$store=$controller->crontab_m->get_store($config);
    

	foreach($store as $st)
	{
		//$breaks = array("<br />","<br>","<br/>","\r\n");
	    //$st->st_middle_msg = str_ireplace($breaks, "<br>", $st->st_middle_msg);  

		$msg=array();
		$msg[]=$st->st_top_msg;
		//$msg[]=nl2br($st->st_middle_msg,true);
		$msg[]=str_replace(array("\r\n", "\r", "\n"), '<br>', $st->st_middle_msg);
		$msg[]=$st->st_bottom_msg;
		$msg[]=$st->st_modoo_url;
		$param=array();
		$param['url']="http://prq.co.kr/prq/set_gcm.php";
		$param['return_type']='';
		$config=array(
			'is_mms'=>'true',
			'message'=>join("<br>",$msg),
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