<?php
// 세션 초기화
// session_name("something")을 사용한다면, 잊지 마십시오!
session_start();

// 모든 세션 변수 해제
$_SESSION = array();

// 세션을 없애려면, 세션 쿠키도 지웁니다.
// 주의: 이 동작은 세션 데이터뿐이 아닌, 세션 자체를 파괴합니다!
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// 마지막으로, 세션 파괴.
session_destroy();
?>