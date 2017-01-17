<?php
require 'config.php';

header("Content-Type: text/html; charset=UTF-8");

session_start();

$access_token = $_SESSION['access_token'];

$r = new HttpRequest($write_post_api_uri, HttpRequest::METH_POST);

// oAuth2.0 인증 토큰을 헤더에 삽입해 줍니다.
$r->setHeaders(array('Authorization' => 'Bearer ' . $access_token));

$r->addPostFields(array(
'blogId' => $_POST['blogId'],
'title' => $_POST['title'],
'contents' => $_POST['contents'],
'options.openType' => $_POST['options_openType'],
));

if($_FILES['image']) {
$tmp_folder = '/tmp/' . time() . '/';
mkdir($tmp_folder);

$file_count = count($_FILES['image']['tmp_name']);

for($i=0; $i < $file_count; $i++) {
if($_FILES['image']['tmp_name'][$i]) {
move_uploaded_file($_FILES['image']['tmp_name'][$i],
$tmp_folder . $_FILES['image']['name'][$i]);

// 이미지 파일은 'image'라는 파라미터 이름으로 첨부할 수 있습니다.
$r->addPostFile('image', $tmp_folder . $_FILES['image']['name'][$i]);
}
}
}

$api_result = json_decode($r->send()->getBody());

// API 호출이 성공한 경우 응답 json에 result라는 항목이 있습니다.
if(isset($api_result->message) && isset($api_result->message->result)) {
$post_url = $api_result->message->result->postUrl;

echo '<b>글이 작성되었습니다.</b><br/>';
echo sprintf('<a href="%s">작성된 글 보러가기</a>', $post_url, $post_url);
} else {
echo "오류가 발생했습니다.";
}
?>