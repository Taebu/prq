<?php
/**
* 2017-01-11 (수) 15:16:17 
* 부로 중지 java 로 개발 완료 
* 2017-02-02 (목) 15:01:27 
* 중지 된 줄 착각, java에서 호출하도록 되어 있다.
* - PRQ_CDR.src.kr.co.prq.prq_cdr.Prq_cmd_queue.java
* - 에서 URLConnection POST 방식으로 호출하게 되어 있다.
* happycall
*/
include_once "./db_info.php";

/*
1.*/
$select_sql=array();
$select_sql[]="select token_id from prq_token_id ";
$select_sql[]=" where phone like '".$phone."' ";
$select_sql[]=" order by regdate desc ";
$select_sql[]=" limit 1;";
$sql=join("",$select_sql);

$query1 = mysql_query($sql);

$registration_ids = array();
while($list = mysql_fetch_assoc($query1)){
$registration_ids[] = $list['token_id'];
}

//print_r($registration_ids);
//$message = array();
/*선행 조건 2016-03-08 (화)
여태까지 보낸 로그를 카운트 모바일에서 보낸 것을 합산 하여서 제한 갯수를 초과한 경우 보내지 않도록 설계

*/
include_once "./GCM.php";
$gcm = new GCM();

/* 자동 전송 crontab java scheduler -
PRQ_CDR.src.kr.co.prq.prq_cdr.PRQ_CDR.class */
if($mode=="crontab")
{
$is_happycall=false;
if($happycall==true){
$is_happycall=$happycall;
}
$messages = array( 
	"title" =>$title,
	"message" =>$message,
	"is_mms" =>$is_mms,
	"receiver_num" =>$receiver_num,
	"img_url" =>$img_url,
	"happycall" =>$is_happycall
);
$json=array();
/*prq_gcm_log 발생*/
//echo  $gcm->send_notification($registration_ids, $message);
$push= json_decode($gcm->send_notification($registration_ids, $messages));
$p_temp=isset($push->results[0]->message_id)?$push->results[0]->message_id:"";
$result= (strpos($p_temp,"0:")!==false)?true:false;
$result_msg= ($result)?"전달 성공":"전송 실패";
$gc_ipaddr='123.142.52.91';
$sql=array();
$sql[]="INSERT INTO `prq_gcm_log` SET ";
$sql[]="gc_subject='".$title."',";
$sql[]="gc_content='".$message."',";
$sql[]="gc_ismms='".$is_mms."',";
$sql[]="gc_receiver='".$receiver_num."',";
$sql[]="gc_sender='".$phone."',";
$sql[]="gc_imgurl='".$img_url."',";
$sql[]="gc_result='".$result_msg."',";
$sql[]="gc_ipaddr='".$gc_ipaddr."',";
$sql[]="gc_stno='".$st_no."',";
$sql[]="gc_datetime=now();";
$result=mysql_query(join("",$sql));
$json=array();
$json['success']=$result;
//$json['sql']=join("",$sql);

echo json_encode($json);

}
/* if($mode=="crontab"){...} */

/* 수동 단일 전송 */
if($mode=="manual"&&$spim_yn=="off")
{

if($mno_type=="LG"){
	//$message=str_replace(array("\r\n", "\r",'<br />','<br>'), '\n', $message);
	//$message=str_replace(array("\r\n", "\r", "\n"), '<br>', $message);
	//LG도 아무것도 하지 않는다
}else if($mno_type=="KT"){
	$message=str_replace(array("\r\n", "\r", "\n"), '<br>', $message);
}else if($mno_type=="SK"){
	// SK 는 아무것도 하지 않는다
}
/* if($mno_type=="KT"){...} */
$is_happycall=false;
if($happycall==true){
$is_happycall=$happycall;
}

$messages = array( 
	"title" =>$title,
	"message" =>$message,
	"is_mms" =>$is_mms,
	"receiver_num" =>$receiver_num,
	"img_url" =>$img_url,
	"happycall" =>$is_happycall
);

/*prq_gcm_log 발생*/
//echo  $gcm->send_notification($registration_ids, $message);
$push= json_decode($gcm->send_notification($registration_ids, $messages));
//print_r($push);
if(isset($push->results[0]->message_id)){
$p_temp=$push->results[0]->message_id;
$result= (strpos($p_temp,"0:")!==false)?true:false;
}else{
$result=false;
}
$json['success']=$result;
$json['push']=$push;
$json['sql']=$sql;

echo json_encode($json);


$result_msg= ($result)?"전달 성공":"전송 실패";
$gc_ipaddr='123.142.52.91';
$sql=array();
$sql[]="INSERT INTO `prq_gcm_log` SET ";
$sql[]="gc_subject='".$title."',";
$sql[]="gc_content='".$message."',";
$sql[]="gc_ismms='".$is_mms."',";
$sql[]="gc_receiver='".$receiver_num."',";
$sql[]="gc_sender='".$phone."',";
$sql[]="gc_imgurl='".$img_url."',";
$sql[]="gc_result='".$result_msg."',";
$sql[]="gc_ipaddr='".$gc_ipaddr."',";
$sql[]="gc_stno='".$st_no."',";
$sql[]="gc_datetime=now();";
mysql_query(join("",$sql));
}
/* if($mode=="manual"){...} */

/* 수동 대량 전송 */
if($mode=="manual"&&$spim_yn=="on")
{
$success_cnt=0;
$false_cnt=0;
if($mno_type=="LG"){
	//$message=str_replace(array("\r\n", "\r",'<br />','<br>'), '\n', $message);
	//$message=str_replace(array("\r\n", "\r", "\n"), '<br>', $message);
	//LG도 아무것도 하지 않는다
}else if($mno_type=="KT"){
	$message=str_replace(array("\r\n", "\r", "\n"), '<br>', $message);
}else if($mno_type=="SK"){
	// SK 는 아무것도 하지 않는다
}
/* if($mno_type=="KT"){...} */
$is_happycall=false;
if($happycall==true){
$is_happycall=$happycall;
}


$mh=explode("\r\n",$many_hp);
foreach($mh as $m){

$messages = array( 
	"title" =>$title,
	"message" =>$message,
	"is_mms" =>$is_mms,
	"receiver_num" =>$m,
	"img_url" =>$img_url,
	"happycall" =>$is_happycall
);
$push= json_decode($gcm->send_notification($registration_ids, $messages));
if(isset($push->results[0]->message_id)){
$p_temp=$push->results[0]->message_id;
$result= (strpos($p_temp,"0:")!==false)?true:false;
	if($result)
	{
		$success_cnt++;
	}else{
		$false_cnt++;
	}
}else{
$result=false;
$false_cnt++;
}

$result_msg= ($result)?"전달 성공":"전송 실패";
$gc_ipaddr='123.142.52.91';
$sql=array();
$sql[]="INSERT INTO `prq_gcm_log` SET ";
$sql[]="gc_subject='".$title."',";
$sql[]="gc_content='".$message."',";
$sql[]="gc_ismms='".$is_mms."',";
$sql[]="gc_receiver='".$m."',";
$sql[]="gc_sender='".$phone."',";
$sql[]="gc_imgurl='".$img_url."',";
$sql[]="gc_result='".$result_msg."',";
$sql[]="gc_ipaddr='".$gc_ipaddr."',";
$sql[]="gc_stno='".$st_no."',";
$sql[]="gc_datetime=now();";
mysql_query(join("",$sql));

} /* foreach 갯수 만큼 */

$json['success']=$result;

$json['success_cnt']=$success_cnt;
$json['false_cnt']=$false_cnt;

$json['push']=$push;
$json['sql']=$sql;

echo json_encode($json);

}
/* if($mode=="manual"&&$spim_yn=="on"){...} */
?>