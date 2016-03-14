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
extract($_POST);
$ROOT = $_SERVER['DOCUMENT_ROOT'];
header("Content-Type:text/html;charset=utf-8");
?>
<?php
$array=array("abc1@naver.com","prq001@naver.com","erm00@naver.com","erm02@naver.com","erm001@naver.com","leesukkee@naver.com","siheung0001@naver.com","anptown@gmail.com","erm02@naver.com","siheung0003@naver.com","siheung0004@naver.com","siheung0005@naver.com","siheung006@naver.com ","siheung005@naver.com ","siheung008@naver.com ","hscity001@naver.com","hscity002@naver.com","hscity003@naver.com","0313112440@naver.com ","0313169797@naver.com ","0313176977@naver.com ","0314049929@naver.com ","0313179992@naver.com ","0313188292@naver.com ","0313130966@naver.com ","029094979@naver.com");

print_r($array);
foreach($array as $as)
{
	for($i=44;$i<45;$i++){
		$sql1="select cd_day_cnt from prq_cdr where date(cd_date)=date(DATE_SUB(now(), INTERVAL ".$i." DAY)) and cd_state=1 and cd_id='".$as."';";
		$sql2="SET @cnt=0;";
		$sql3="update prq_cdr set cd_day_cnt=@cnt:=@cnt+1 where date(cd_date)=date(DATE_SUB(now(), INTERVAL ".$i." DAY)) and cd_state=1 and cd_id='".$as."';";
/*
		echo $sql1;
		echo "<br>";
		echo $sql2;
		echo "<br>";
		echo $sql3;
		echo "<br>";
*/
mysql_query($sql1);
mysql_query($sql2);
mysql_query($sql3);
	}/* for($i=1;$i<43;$i++){...}*/
}
?>