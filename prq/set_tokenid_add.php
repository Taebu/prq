<?php
include_once "./db_info.php";

if(isset($phone)&&isset($token_id)){
	$sql="insert into prq_token_id set ";
	$sql.=sprintf("phone='%s',",$phone);
	$sql.=sprintf("token_id='%s',",$token_id);
	$sql.=" regdate=now()  ";
	$sql.=" on duplicate key update ";
	$sql.=sprintf("token_id='%s',",$token_id);
	$sql.=" regdate=now();";
	$query = mysql_query($sql);
	echo $query?"true":"false";
}else{
	echo "false";
}
?>