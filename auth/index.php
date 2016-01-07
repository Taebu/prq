<?php
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
echo json_encode($json);
?>