<!DOCTYPE html>
<html>
<head>
	<meta property="og:image" content="http://prq.co.kr/prq/img/new/meta_logo.png" />
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
<script type="text/javascript">
	console.log("header_va.php");
</script>
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
echo "\"".$this->session->userdata['name']."\"님 환영합니다. <a href=\"/bbs/auth/logout\" class=\"btn\">로그아웃</a>";
} else {
echo "<a href=\"/bbs/auth/login\" class=\"btn btn-primary\">로그인</a>";
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