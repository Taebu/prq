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
  <link rel="stylesheet" href="/include/css/bootstrap.min.css">
    <script src="/include/js/jquery.min.js"></script>
  <script src="/include/js/bootstrap.min.js"></script>
</head>
<body>
<div id="main">

	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
		<blockquote>
			<p>만들면서 배우는 CodeIgniter</p>
			<small>실행 예제</small>
			<p>
<?php
if( @$this->session->userdata['logged_in'] == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE)
{
?>
"<?php 
//echo $this->session->userdata['name']?>
<?php echo $this->input->cookie('name', TRUE);
echo $this->input->cookie('username', TRUE);
?>
"님 환영합니다. <a href="/bbs/auth/logout" class="btn">로그아웃</a>
<?php
} else {
?>
<a href="/bbs/auth/login" class="btn btn-primary">로그인</a>
<?php
}
?>
		</p>
		</blockquote>
	</header><!-- Header End -->

	<nav id="gnb"><!-- gnb Start -->
		<ul>
			<li><a rel="external" href="/bbs/<?php echo $this->uri->segment(1);?>/lists/<?php echo $this->uri->segment(3);?>">게시판 프로젝트</a></li>
		</ul>
	</nav><!-- gnb End -->