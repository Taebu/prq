<?php
include_once "./db_info.php";

function generateRandomString($length = 10) {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$json['auth']=generateRandomString(6);
if(isset($_GET['phone'])){
$json['phone']=$_GET['phone'];
}


$select_sql=array();
$select_sql[]="select token_id from prq_token_id ";
$select_sql[]="where phone like '".$_GET['phone']."' ";

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
	"title" =>'PRQ 인증번호',
	"message" =>$json['auth'],
	"is_mms" =>'false',
	"receiver_num" =>'',
	"img_url" =>''
);

$gcm->send_notification($registation_ids, $message);

echo json_encode($json);
?>