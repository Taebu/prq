<?php
/*
* 한꺼번에 들어오는 데이터를 증가 처리 하게 하기 위해 작성
* create : 2016-03-18 (금)
* file : maxcnt_v.php
* 
**/

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
extract($_POST);
$ROOT = $_SERVER['DOCUMENT_ROOT'];
header("Content-Type:text/html;charset=utf-8");

$sql="SET @MAX_CNT=1;";
mysql_query($sql);



$sql="SET @MAX_CNT=@MAX_CNT+1;";
mysql_query($sql);

$sql="SET @MAX_CNT=@MAX_CNT+1;";
mysql_query($sql);

$sql="SET @MAX_CNT=@MAX_CNT+1;";
mysql_query($sql);

$sql="SET @MAX_CNT=@MAX_CNT+1;";
mysql_query($sql);

$sql="select @MAX_CNT as cnt;";
$query=mysql_query($sql);
$row =mysql_fetch_assoc($query);

echo $row['cnt'];
?>
