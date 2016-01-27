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
$ROOT = $_SERVER['DOCUMENT_ROOT'];
header("Content-Type:text/html;charset=utf-8");
//header("Content-Type: text/html; charset=UTF-8");
//print_r($_GET);


if(isset($phone)&&isset($token_id)){
$query = "SELECT count(*) cnt FROM prq_token_id WHERE phone='$phone' and token_id='$token_id';";
$row = mysql_fetch_assoc(mysql_query($query));

if ($row['cnt'] == 0){ // 없음
	if($token_id!=""&&strlen($token_id)>5&&strlen($phone)>5){
	$sql="insert into prq_token_id (phone, token_id, regdate) values('$phone', '$token_id', now());";
	$query = mysql_query($sql);
	echo "true";
	}
}else if($row['cnt']>0&&strlen($token_id)>5&&strlen($phone)>5){
	echo "false";
}
}else{
	echo "false";
}
?>