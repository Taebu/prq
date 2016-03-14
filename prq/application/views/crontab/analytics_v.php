<?php
/**
* 크론텝에 매일 한번 MMS 보낸 항목 합산하기
* 작성 : 2016-03-10 (목) mtb
*
*/
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
?>
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
analytics_v.php<br>
<?php
$now=date("Y-m-d");
$last_day= date("Y-m-d", strtotime($now.' - 1day')); 
$sql="INSERT INTO prq_stat select '".$last_day."',gc_sender,count(*) cnt from prq_gcm_log where date('".$last_day."')=date(gc_datetime) group by gc_sender;";
echo $sql;

$result=mysql_query($sql);

/*
mysql> 
select count(*) from prq_gcm_log wher date(now())=date(gc_datetime);
select sum(st_cnt) cnt from prq_stat where st_sender='01066983139' and date_format(st_date, '%Y-%m')=date_format(now(), '%Y-%m');
select sum(st_cnt) cnt from prq_stat where st_sender='01077430009' and date_format(st_date, '%Y-%m')=date_format(now(), '%Y-%m');

select sum(st_cnt) cnt from prq_stat where st_sender='01077430009' and date_format(st_date, '%Y-%m')=date_format(now(), '%Y-%m');
prq_gcm_log
*/

?>
</body>
</html>