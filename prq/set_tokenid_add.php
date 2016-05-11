<?php
include_once "./db_info.php";

if(isset($phone)&&isset($token_id)){
$query = "SELECT count(*) cnt FROM prq_token_id WHERE phone='$phone' and token_id='$token_id';";
$row = mysql_fetch_assoc(mysql_query($query));

if ($row['cnt'] == 0){ // 없음
	if($token_id!=""&&strlen($token_id)>5&&strlen($phone)>5){
	$sql="delete from prq_token_id where phone='".$phone."';";
	$query = mysql_query($sql);
	
	$sql="insert into prq_token_id (phone, token_id, regdate) values('$phone', '$token_id', now());";
	$query = mysql_query($sql);
	echo "true";
	}
}else if($row['cnt']>0&&strlen($token_id)>5&&strlen($phone)>5){
	$sql="delete from prq_token_id where phone='".$phone."';";
	$query = mysql_query($sql);

	echo "false";
}
}else{
	echo "false";
}
?>