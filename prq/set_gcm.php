<?php
include_once "./db_info.php";
$select_sql=array();
$select_sql[]="select token_id from prq_token_id ";
$select_sql[]="where phone like '".$phone."' ";
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

if($mode=="crontab")
{
$messages = array( 
	"title" =>$title,
	"message" =>$message,
	"is_mms" =>$is_mms,
	"receiver_num" =>$receiver_num,
	"img_url" =>$img_url
);

/*prq_gcm_log 발생*/
//echo  $gcm->send_notification($registration_ids, $message);
$push= json_decode($gcm->send_notification($registration_ids, $messages));
$p_temp=$push->results[0]->message_id;
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
mysql_query(join("",$sql));
}
/* if($mode=="crontab"){...} */

if($mode=="manual")
{

if($mno_type=="KT"){
	$message=str_replace(array("\r\n", "\r", "\n"), '<br>', $message);
 }else{
	$message=str_replace(array("\r\n", "\r",'<br />','<br>'), '\n', $message);
}
/* if($mno_type=="KT"){...} */

$messages = array( 
	"title" =>$title,
	"message" =>$message,
	"is_mms" =>$is_mms,
	"receiver_num" =>$receiver_num,
	"img_url" =>$img_url
);

/*prq_gcm_log 발생*/
//echo  $gcm->send_notification($registration_ids, $message);
$push= json_decode($gcm->send_notification($registration_ids, $messages));
$p_temp=$push->results[0]->message_id;
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
mysql_query(join("",$sql));
}
/* if($mode=="crontab"){...} */
?>