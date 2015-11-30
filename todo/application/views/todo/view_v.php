<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no" />
	<title>CodeIgniter</title>
	<!--[if lt IE 9]>
	<script type="text/javascript" src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<link type="text/css" rel="stylesheet" href="/include/css/bootstrap.css" />
</head>
<body>
<div id="main">
	<header id="header" data-role="header" data-position="fixed"><!-- Header Start -->
		<blockquote>
			<p>만들면서 배우는 CodeIgniter</p>
			<small>실행 예제</small>
		</blockquote><!-- Header End -->

		<nav id="gnb"><!-- gnb Start -->
			<ul>
				<li><a rel="external" href="/todo/index.php/main/lists/">todo 애플리케이션 프로그램</a></li> </ul>
		</nav><!-- gnb End -->
		<article id="board_area">
			<header>
				<h1>Todo 목록</h1>
			</header>
			<table cellspacing="0" cellpadding="0" class="table table-striped">
				<thead>
					<tr>
						<th scope="col"><?php echo $views[0]->id;?>번 할 일</th>
						<th scope="col">시작일 : <?php echo $views[0]->created_on;?></th>
						<th scope="col">종료일 : <?php echo $views[0]->due_date;?></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="3"><?php echo $views[0]->content;?></td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4">
						<a href="/todo/main/lists/" class="btn btn-primary">목록</a>
						<a href="/todo/main/delete/<?php echo $this->uri->segment(3);?>" class="btn btn-danger">삭제</a>
						<a href="/todo/main/write/" class="btn btn-success">쓰기</a>
						</th>
					</tr>
				</tfoot>
			</table>
			<div>
				<p></p>
			</div>
		</article>
		
		<footer id="footer">
			<bockquote>
				<p><a href="http:/www.cikorea.net/" class="azubu" target="blank">CodeIgniter한국사용자 포럼</a></p>
				<small>Copyright by <em class="black"><a href="mailto:advisoer@cikorea.net"></a></em></small>
			</bockquote>
		</footer>
	</header>
</div><!-- #main -->
</body>
</html>