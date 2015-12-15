<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>
<link rel="stylesheet" type="text/css" href="/include/css/style.css" media="all">
</head>
<body>

<div id="container">
<!-- 	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/Welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>


	</div> -->
	
	<h1>PRQ 추가 2015-12-02 (수) 부터 시작</h1>
		<div id="body">
		<p><a href="/todo/">todo project 2015-07-16 (목) - 29일 완료</a></p>
		<p><a href="/bbs/board/lists/ci_board">CHAPTER_2~4 bbs project, 2015-07-29 (수) - 2015-11-27 (금) 완료</a></p>
		<p><a href="/bbs/test">CHAPTER_5. 폼 검증하기  2015-11-27 (금) -2015-11-27 (금) 완료 </a></p>
		<p><a href="/bbs/auth/login">CHAPTER_7. 사용자 인증(로그인), 2015-11-27 (금) - 2015-11-27 (금) 완료</a></p>
		<p><a href="/bbs/ajax_board/test">CHAPTER_8. Ajax 구현:XMLHttpRequest, 1) TEST 2015-11-27 (금) - 2015-11-27 (금) 완료</a></p>
		<p><a href="/bbs/board/view/ci_board/board_id/31/page/1">CHAPTER_8. Ajax 구현:XMLHttpRequest, 2)ajax comment</a></p>
		<p><a href="/bbs/board/view/ci_board/board_id/31/page/1">CHAPTER_8. Ajax 구현:XMLHttpRequest, 3)댓글 삭제 Ajax로 구현하기</a></p>
		<p><a href="/bbs/board/view/ci_board/board_id/31/page/1">CHAPTER_9. Ajax :jQuery</a></p>
		<p><a href="/sns/">CHAPTER_10. 사진 SNS 프로젝트 2015-11-30 (월), 2015-11-30 (월) 완료</a></p>
		<p><a href="/sns/controlls/lists">CHAPTER_11. 모바일 웹프로젝트 프로젝트 (jQuery Mobile)2015-11-30 (월), 2015-11-30 (월) 완료</a></p>
		<p><a href="/prq/">PRQ</a></p>
		<p>코드 이그나이터를 설치후 볼 수 있는 화면 입니다. </p>
		<p><?php echo getcwd();?></p>
		</div><!-- #body -->

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. 
{memory_usage}
	<?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>