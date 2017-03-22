<?php
  // 네이버 로그인 콜백 예제
  $client_id = "qfvtBcPswnXE4O0veCZU";
  $client_secret = "PK6SrAhm8o";
  $code = $_GET["code"];
  $state = $_GET["state"];
  $redirectURI = urlencode("http://prq.co.kr/blog/callback.php");
  
  /* 네이버 url */
  $url = "https://nid.naver.com/oauth2.0/token";
  $url.= "?grant_type=authorization_code";
  $url.= "&client_id=".$client_id."";
  $url.= "&client_secret=".$client_secret."";
  $url.= "&redirect_uri=".$redirectURI."";
  $url.= "&code=".$code."";
  $url.= "&state=".$state;

  $url = "https://nid.naver.com/oauth2.0/token";
  $url.= "?grant_type=authorization_code";
  $url.= "&client_id={클라이언트 아이디}";
  $url.= "&client_secret={클라이언트 시크릿}";
  $url.= "&state={상태 토큰}";
  $url.= "&code={인증 코드}";
https://nid.naver.com/oauth2.0/token?grant_type=refresh_token&client_id=qfvtBcPswnXE4O0veCZU&client_secret=PK6SrAhm8o&refresh_token=AAAANbRM2ZlRadBHJomOO46ou6VOcNS+fARskWGo4sZRZ3I6AYWKIAx0ABaAR0DT8uLUaoFTbpvLeX

https://nid.naver.com/oauth2.0/token?grant_type=refresh_token
&client_id=jyvqXeaVOVmV
&client_secret=527300A0_COq1_XV33cf
&refresh_token=AAAANbRM2ZlRadBHJomOO46ou6VOcNS+fARskWGo4sZRZ3I6AYWKIAx0ABaAR0DT8uLUaoFTbpvLeX

  $is_post = false;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_POST, $is_post);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $headers = array();
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