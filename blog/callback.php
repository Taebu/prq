<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require 'config.php';

include_once "./db_info.php";
header("Content-Type: text/html; charset=UTF-8");

session_start();

$code = $_GET['code'];
$state = $_GET['state'];

if($state == $_SESSION['state']) {
$r = new HttpRequest($access_token_url, HttpRequest::METH_GET);

$r->addQueryData(array(
'client_id' => $client_id,
'client_secret' => $client_secret,
'grant_type' => 'authorization_code',
'state' => $state,
'code' => $code
));

$r -> addSslOptions(array(
'version' => HttpRequest::SSL_VERSION_SSLv3
));

$auth_token_result = json_decode($r->send()->getBody());

if($auth_token_result->access_token) {
// 튜토리얼에서는 access_token값만 사용하였지만 실제 어플레케이션에서는 유효 기간 관리가 필요합니다.
$_SESSION['access_token'] = $auth_token_result->access_token;

$access_token=$auth_token_result->access_token;
echo "access_token<br>";
echo $access_token."<br>";
echo "<br>";
$refresh_token=$auth_token_result->refresh_token;
echo "refresh_token<br>";
echo $auth_token_result->refresh_token;
$sql=array();
$sql[]="INSERT INTO naver_auth SET ";
$sql[]="client_id='{$client_id}',";
$sql[]="client_secret='{$client_secret}',";
$sql[]="state='{$state}',";
$sql[]="access_token='{$access_token}',";
$sql[]="refresh_token='{$refresh_token}',";
$sql[]="code='{$code}',";
$sql[]="na_datetime=now();";
$result=mysql_query(join("",$sql));

//header('Location: ' . $index_uri);
} else {
echo '인증 실패했습니다.';
}
} else {
echo '인증 실패했습니다.';
}
?>
</body>
</html>
