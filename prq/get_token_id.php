<?php
include_once "./db_info.php";


/*앱 정보에 따라 가져오기*/
function get_token_id_app($cell)
{
	$sql=array();

	$sql[]="select ";
	$sql[]="token_id ";
	$sql[]="from ";
	$sql[]="prq_token_id ";
	$sql[]="where ";
	$sql[]="phone like '%".$cell."%' ";
	$sql[]="order by regdate desc limit 1;";
	$sql=join($sql);

	$row=mysql_fetch_assoc(mysql_query($sql));
	return $row['token_id'];
}

$json['token_id']=get_token_id_app($phone);

echo json_encode($json);
?>