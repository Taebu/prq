<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
require 'config.php';

header("Content-Type: text/html; charset=UTF-8");


// CSRF 방지를 위해 state token을 생성합니다.
function generate_state() 
{
$mt = microtime();
$rand = mt_rand();

return md5($mt . $rand);
}

session_start();
if($_SESSION['access_token']) {
include "list.php"; // 이미 사용자 인증이 되어 있는 경우라면 메뉴를 보여줍니다.
} else {
$state = generate_state();

// state token은 추후 검증을 위해 세션에 저장되어야 합니다.
$_SESSION['state'] = $state;

$encoded_callback_uri = urlencode($callback_uri);
$auth_url = sprintf("%s?client_id=%s&response_type=code&redirect_uri=%s&state=%s",$authorize_url,$client_id, $encoded_callback_uri,$state);

// 사용자 인증이 되어 있지 않으면 인증 페이지로 redirect 시켜줍니다.
header('Location: ' . $auth_url);
}
?>
</body>
</html>