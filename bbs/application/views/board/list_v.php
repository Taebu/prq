	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/bbs/board/lists/ci_board/q/'+$("#q").val()+'/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});
		});

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}
	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">
<div class="row">
  <div class="col-sm-4">.col-sm-4</div>
  <div class="col-sm-8">.col-sm-8</div>
</div>

	<div class="row">
		<div class="col-lg-3">left-3
		<?php echo date("Y-m-d H:i:s");?>
		<?php

		?>
		</div>
		<div class="col-lg-9">right-9
				<div>

<?php
			echo form_open('bbs/board/lists/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));
?>
			<!--form id="bd_search" method="post" class="well form-search" -->
				<i class="icon-search"></i> <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> <input type="button" value="검색" id="search_btn" class="btn btn-primary" />
			</form>
		</div>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">제목</th>
					<th scope="col">작성자</th>
					<!-- <th scope="col">조회수</th> -->
					<th scope="col">등록일</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($list as $lt)
{
?>
				<tr>
					<th scope="row">
						<?php echo $lt->board_id;?>
					</th>
					<td>
					<a rel="external" href="/bbs/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $lt->board_id;?>/page/<?php echo $page;?>"><?php echo $lt->subject;?></a></td>
					<td><?php echo $lt->user_name;?></td>
					<!-- <td><?php echo $lt->hits;?></td> -->
<!-- 					<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time></td> -->
 					<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%y-%m-%d",human_to_unix($lt->reg_date));?></time></td> 
				</tr>
<?php
}
?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="5"><?php echo $pagination;?></th>
				</tr>
			</tfoot>
		</table>
		<div><p><a href="/bbs/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(5);?>" class="btn btn-success">쓰기</a></p></div>
	</article>
</div>
</div>
</div><!-- .container-fluid -->