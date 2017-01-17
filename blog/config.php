<?php

$client_id = 'qfvtBcPswnXE4O0veCZU'; // 오픈 API 키 발급받은 client ID
$client_secret = 'PK6SrAhm8o'; // 오픈 API 키 발급받은 client secrete

$authorize_url = 'https://nid.naver.com/oauth2.0/authorize';
$access_token_url = 'https://nid.naver.com/oauth2.0/token';

// 오픈 API 키 등록 시 입력한 callback 주소, tutorial에서는 "도메인주소/callback.php".
$callback_uri = 'http://prq.co.kr/blog/callback.php';
$index_uri = 'http://prq.co.kr/blog/index.php'; // tutorial에서는 "도메인주소/index.php"

$list_category_api_uri = 'https://openapi.naver.com/blog/listCategory.json';
$write_post_api_uri = 'https://openapi.naver.com/blog/writePost.json';

?>