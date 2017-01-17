// 네이버 블로그 Open API 예제 - 카테고리조회
<?php
session_start();
//echo $_SESSION['access_token'];?>
<?php
  $token = "YOUR_ACCESS_TOKEN"; // 네이버 로그인 API호출로 받은 접근 토큰값
  $token = "8b816c78d82c58b6fc4ed7b59ada3274"; // 네이버 로그인 API호출로 받은 접근 토큰값
  $token = $_SESSION['access_token']; // 네이버 로그인 API호출로 받은 접근 토큰값
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  $blogId = "erm00";// 회원프로필 조회에서 얻은 네이버 ID값
  $url = "https://openapi.naver.com/blog/listCategory.json?blogId=".$blogId;
  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
  $headers[] = "Authorization: ".$header;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  echo "status_code:".$status_code."
";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>
