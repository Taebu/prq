<!DOCTYPE html>
<html>
<head>
<title>ListCategory API</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
require 'config.php';

header("Content-Type: text/html; charset=UTF-8");

session_start();

$access_token = $_SESSION['access_token'];

$r = new HttpRequest($list_category_api_uri, HttpRequest::METH_GET);

// oAuth2.0 인증 토큰을 헤더에 삽입해 줍니다.
$r->setHeaders(array('Authorization' => 'Bearer ' . $access_token));

$r->addQueryData(array(
'blogId' => $_GET['blogId'],
));

$api_result = json_decode($r->send()->getBody());

// API 호출이 성공한 경우 응답 json에 result라는 항목이 있습니다.
if(isset($api_result->message) && isset($api_result->message->result)) {
$categories = $api_result->message->result;

echo '<h3>카테고리 목록 조회</h3>';
echo '<table>';
echo '<thead><tr><th>카테고리명</th><th>카테고리 번호</th></tr></thead>';

echo '<tbody>';
foreach ($categories as $category) {
echo sprintf("<tr><td>%s</td><td>%s</td></tr>", $category->name, $category->categoryNo);

foreach ($category->subCategories as $sub_category) {
echo sprintf("<tr><td>%s</td><td>%s</td></tr>", $sub_category->name, $sub_category->categoryNo);
}
}

echo '</tbody>';
echo '</table>';
} else {
echo "오류가 발생했습니다.";
}

?>
</body>
</html>