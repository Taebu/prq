	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/board/lists/ci_board/q/'+$("#q").val()+'/page/1';
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


<?php
			echo form_open('prq/board/lists/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));
?>
			<!--form id="bd_search" method="post" class="well form-search" -->

<div class="row">
		<div class="row col-lg-6">
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
		</div>
</div>
<div class="row">
		<div class="row col-lg-6">
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
				<input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> 
		</div>
</div>
<div class="row">
		<div class="row col-lg-12">
				<input type="button" value="검색" id="search_btn" class="btn btn-primary" />
		</div>
</div>

			</form><!-- #bd_search -->

		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><input type="checkbox" name="chk_"></th>
					<th scope="col">No</th>
					<th scope="col">등록일자</th>
					<th scope="col">총판ID</th>
					<th scope="col">총판코드</th>
					<th scope="col">구분</th>
					<th scope="col">대리점</th>
					<th scope="col">총판상태</th>
					<th scope="col">비고</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($list as $lt)
{
?>
				<tr>
					<td scope="col"><input type="checkbox" name="chk_"></td>
					<td scope="row"><?php echo $lt->board_id;?>
					</td>
					<td>
					<a rel="external" href="/prq/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $lt->board_id;?>/page/<?php echo $page;?>"><?php echo $lt->subject;?></a></td>
					<td><?php echo $lt->user_name;?></td>
					<!-- <td><?php echo $lt->hits;?></td> -->
<!-- 					<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time></td> -->
 					<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%y-%m-%d",human_to_unix($lt->reg_date));?></time></td> 
 					<td>총판</td> 
 					<td>46</td> 
 					<td>정상</td> 
 					<td>-</td> 
				</tr>
<?php
}
?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="5" style="text-align:center">
					<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
				</tr>
			</tfoot>
		</table>



</div>
		<div><p><a href="/prq/board/write/prq_member/page/<?php echo $this->uri->segment(5);?>" class="btn btn-success">쓰기</a></p></div>
	</article>
</div>
</div>
</div><!-- .container-fluid -->