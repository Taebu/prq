<?php
extract($_GET);

include_once "./db_info.php";

$json=array();
$json['success']=false;
if(isset($va_hp)&&isset($va_uri)&&isset($va_result))
{
	//http://prq.co.kr/prq/chk_vali.php?phone=1&imageUri=1&result=1
	$sql="insert into prq_vali_log set ";
	$sql.="va_hp='".$va_hp."', ";
	$sql.="va_uri='".$va_uri."', ";
	$sql.="va_result='".$va_result."', ";
	$sql.="va_datetime=now(); ";
	$query=mysql_query($sql);
	$json['success']=$query;
	$json['sql']=$sql;
}


echo json_encode($json);
?>