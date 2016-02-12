<?php
include_once "./db_info.php";
$select_sql=array();
$select_sql[]="select token_id from prq_token_id ";
$select_sql[]="where phone like '".$phone."' ";
//$select_sql[]="order by regdate desc limit 1;";
$sql=join("",$select_sql);
//echo $sql;
$query1 = mysql_query($sql);

$registration_ids = array();
while($list = mysql_fetch_assoc($query1)){
$registration_ids[] = $list['token_id'];
}

//print_r($registration_ids);
//$message = array();

include_once "./GCM.php";
$gcm = new GCM();

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
/*
CREATE TABLE `prq_gcm_log` (
  `gc_no` int(11) NOT NULL AUTO_INCREMENT,
  `gc_subject`  varchar(255) DEFAULT NULL COMMENT '발송 제목',
  `gc_content`  text COMMENT '발송 내용',
  `gc_ismms` enum('false','true') NOT NULL DEFAULT 'false'  COMMENT 'GCM만 혹은 MMS 같이 전송여부',
  `gc_receiver`  varchar(16) DEFAULT NULL DEFAULT '0' COMMENT '수신번호',
  `gc_sender`  varchar(16) DEFAULT NULL DEFAULT '0' COMMENT '발신번호',
  `gc_imgurl`  varchar(255) DEFAULT NULL DEFAULT '' COMMENT '이미지 전송 URL',
  `gc_result` varchar(255) NOT NULL COMMENT '전송결과',
  `gc_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `gc_status` char(1) NOT NULL  DEFAULT 'I',
  `gc_ipaddr` varchar (15) NOT NULL DEFAULT '',
  PRIMARY KEY (`gc_no`)
) DEFAULT CHARSET=utf8  COMMENT='GCM LOG';
*/
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
	$sql[]="gc_datetime=now();";
	mysql_query(join("",$sql));
?>