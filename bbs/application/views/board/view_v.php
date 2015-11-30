	<!--<script type="text/javascript" src="/bbs/include/js/httpRequest.js"></script>-->
	<script type="text/javascript">
	$(function(){
		$("#comment_add").click(function(){
			$.ajax({
				url: "/bbs/ajax_board/ajax_comment_add",
				type: "POST",
				data:{
					"comment_contents":encodeURIComponent($("#input01").val()),
					"csrf_test_name":getCookie('csrf_cookie_name'),
					"table":"<?php echo $this->uri->segment(3);?>",
					"board_id":"<?php echo $this->uri->segment(5);?>"
				},
				dataType: "html",
				complete:function(xhr, textStatus){
					if (textStatus == 'success')
					{
						if ( xhr.responseText == 1000 )
						{
							alert('댓글 내용을 입력하세요');
						}
						else if ( xhr.responseText == 2000 )
						{
							alert('다시 입력하세요');
						}
						else if ( xhr.responseText == 9000 )
						{
							alert('로그인하여야 합니다.');
						}
						else
						{
							$("#comment_area").html(xhr.responseText);
							$("#input01").val('');
						}
					}
				}
			});
		});

		$(".comment_delete").click(function(){
			$.ajax({
				url: "/bbs/ajax_board/ajax_comment_delete",
				type: "POST",
				data:{
					"csrf_test_name":getCookie('csrf_cookie_name'),
					"table":"<?php echo $this->uri->segment(3);?>",
					"board_id":$(this).attr("vals")
				},
				dataType: "text",
				complete:function(xhr, textStatus){
					if (textStatus == 'success')
					{
						if ( xhr.responseText == 9000 )
						{
							alert('로그인하여야 합니다.');
						}
						else if ( xhr.responseText == 8000 )
						{
							alert('본인의 댓글만 삭제할 수 있습니다.');
						}
						else if ( xhr.responseText == 2000 )
						{
							alert('다시 삭제하세요.');
						}
						else
						{
							$('#row_num_'+xhr.responseText).remove();
							alert('삭제되었습니다.');
						}
					}
				}
			});
		});
	});

	function getCookie( name )
	{
		var nameOfCookie = name + "=";
		var x = 0;

		while ( x <= document.cookie.length )
		{
			var y = (x+nameOfCookie.length);

			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
				if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
					endOfCookie = document.cookie.length;

				return unescape( document.cookie.substring( y, endOfCookie ) );
			}

			x = document.cookie.indexOf( " ", x ) + 1;

			if ( x == 0 )

			break;
		}

		return "";
	}
	</script>


	<article id="board_area">
		<header>
			<h1></h1>
		</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><?php echo $views->subject;?></th>
					<th scope="col">이름 : <?php echo $views->user_name;?></th>
					<th scope="col">조회수 : <?php echo $views->hits;?></th>
					<th scope="col">등록일 : <?php echo $views->reg_date;?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="4">
						<?php echo nl2br($views->contents);?>
					</th>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4"><a href="/bbs/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a> <a href="/bbs/board/modify/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a> <a href="/bbs/board/delete/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a> <a href="/bbs/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a></th>
				</tr>
			</tfoot>
		</table>

		<form class="form-horizontal" method="post" action="" name="com_add">
		  <fieldset>
		    <div class="control-group">
		      <label class="control-label" for="input01">댓글</label>
		      <div class="controls">
		        <textarea class="input-xlarge" id="input01" name="comment_contents" rows="3"></textarea>
				<input class="btn btn-primary" type="button" id="comment_add" value="작성">
		        <p class="help-block"></p>
		      </div>
		    </div>
		  </fieldset>
		</form>
		<div id="comment_area">
			<table cellspacing="0" cellpadding="0" class="table table-striped" id="comment_table">
<?php
foreach ($comment_list as $lt)
{
?>
				<tr id="row_num_<?php echo $lt->board_id;?>">
					<th scope="row">
						<?php echo $lt->user_id;?>
					</th>
					<td><?php echo $lt->contents;?></a></td>
					<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
					<td><a href="#" class="comment_delete" vals="<?php echo $lt->board_id;?>"><i class="icon-trash"></i>삭제</a></td>
				</tr>
<?php
}
?>
			</table>
		</div>
	</article>