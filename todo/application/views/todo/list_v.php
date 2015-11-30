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
		</blockquote><!-- Header End -->

		<nav id="gnb"><!-- gnb Start -->
			<ul>
				<li><a rel="external" href="/todo/index.php/main/lists/">todo 애플리케이션 프로그램</a></li> </ul>
		</nav><!-- gnb End -->
		<article id="board_area">
			<header>
				<h1>Todo 목록</h1>
			</header>


<div class="container-fluid">
<div class="row">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-8">.col-sm-8</div>
</div>

	<div class="row">
		<div class="col-lg-3">left-3</div>
		<div class="col-lg-9">right-9
			<table cellspacing="0" cellpadding="0" class="table table-striped" width=>
				<thead>
					<tr>
						<th scope="col">번호</th>
						<th scope="col">내용</th>
						<th scope="col">시작일</th>
						<th scope="col">종료일</th>
					</tr>
				</thead>
				<tbody>
				<?php
				foreach ($list as $lt) {?>
					<tr>
						<td><?php echo $lt->id;?></td>
						<!-- <td><a rel="external" href="/todo/index.php/main/view/<?php echo $lt->id;?>"><?php echo $lt->content;?></a></td> -->
						<td><a rel="external" href="/todo/main/view/<?php echo $lt->id;?>"><?php echo $lt->content;?></a></td>
						<td><time datetime="<?php echo mdate("%Y-%M-%j",human_to_unix($lt->created_on));?>"><?php echo $lt->created_on;?></time></td>
						<td><time datetime="<?php echo mdate("%Y-%M-%j",human_to_unix($lt->due_date));?>"><?php echo $lt->due_date;?></time></td>
					</tr>
					<?php }?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="4"><a href="/todo/index.php/main/write/" class="btn btn-success">쓰기</a></th>
					</tr>
				</tfoot>
			</table>
			<div>
				<p></p>
			</div>
			</div><!-- .r9 -->
			</div><!-- .row -->
</div><!-- .container -->
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