<?php session_start();?>
<?php
  $token = $_SESSION['access_token']; // 네이버 로그인 API호출로 받은 접근 토큰값
  $header = array('Authorization: Bearer '.$token);
  $header = "Bearer ".$token; // Bearer 다음에 공백 추가
  //echo $header;
  $url = "https://openapi.naver.com/blog/writePost.json";

  $title = urlencode("네이버 블로그 api Test php");
  $title = $_POST['title'];
  $contents = urlencode("네이버 블로그 api로 글을 블로그에 올려봅니다.");
  $contents = $_POST['contents'];
  $postvars = "title=".$title."&contents=".$contents;
  $is_post = true;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch,CURLOPT_POSTFIELDS, $postvars);
  $headers[] = "Authorization: ".$header;
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $response = curl_exec ($ch);
  $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
//  echo "status_code:".$status_code."";
  curl_close ($ch);
  if($status_code == 200) {
    echo $response;
  } else {
    echo "Error 내용:".$response;
  }
?>