<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>CodeIgniter</title>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<!-- 	<link rel='stylesheet' href="/bbs/include/css/bootstrap.css" /> -->
	<link rel='stylesheet' href="/include/css/bootstrap.min.css" />
</head>
<body>
<div id="main">

	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
		<blockquote>
			<p>만들면서 배우는 CodeIgniter</p>
			<small>실행 예제</small>
			<p>
<?php
if( @$this->session->userdata['logged_in'] == TRUE )
{
?>
<?php echo $this->session->userdata['username']?>님 환영합니다. <a href="/sns/auth/logout" class="btn">로그아웃</a>
<?php
} else {
?>
<a href="/sns/auth/login" class="btn btn-primary">로그인</a>
<?php
}
?>
		</p>
		</blockquote>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
		<ul>
			<li><a rel="external" href="/sns/controlls/lists/page/1">SNS 프로젝트</a></li>
		</ul>
	</nav><!-- gnb End -->