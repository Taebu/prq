<?php
include_once "./db_info.php";
$select_sql=array();
$select_sql[]="select token_id from prq_token_id ";
$select_sql[]="where phone like '".$phone."' ";
//$select_sql[]="order by regdate desc limit 1;";
$sql=join("",$select_sql);
//echo $sql;
$query1 = mysql_query($sql);

$registation_ids = array();
while($list = mysql_fetch_assoc($query1)){
$registation_ids[] = $list['token_id'];
}

//print_r($registation_ids);
//$message = array();

include_once "./GCM.php";
$gcm = new GCM();

$message = array( 
	"title" =>$title,
//	"message" =>$message,
	"message" =>str_replace(array("\r\n", "\r", "\n"), '<br>', $message),
	"is_mms" =>$is_mms,
	"receiver_num" =>$receiver_num,
	"img_url" =>$img_url
);


echo  $gcm->send_notification($registation_ids, $message);
?>