	<script>
	$(document).ready(function(){
		$("#search_btn").click(function(){
			if($("#q").val() == ''){
				alert('검색어를 입력해주세요.');
				return false;
			} else {
				var act = '/sns/controlls/lists/q/'+$("#q").val()+'/page/1';
				$("#bd_search").attr('action', act).submit();
			}
		});
	});

	function board_search_enter(form) {
		var keycode = window.event.keyCode;
		if(keycode == 13) $("#search_btn").click();
	}

	function lastPostFunc()	{
		var last_id = $(".wrdLatest:last").attr("id") ;

		$('div#lastPostsLoader').html('<img src="/sns/images/bigLoader.gif">');
		$.post("/sns/ajax_board/more_list/"+last_id,

		function(data){
			if (data != "") {
			$(".wrdLatest:last").after(data);
			}
			$('div#lastPostsLoader').empty();
		});
	}
	$(window).scroll(function(){
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			lastPostFunc();
		}
	});
	</script>
	<article id="board_area">
		<div><p></p></div>
		<div>
			<form id="bd_search" method="post" class="well form-search" >
				<i class="icon-search"></i> <input type="text" name="search_word" id="q" onkeypress="board_search_enter(document.q);" class="input-medium search-query" /> <input type="button" value="검색" id="search_btn" class="btn btn-primary" /> <a href="/sns/controlls/upload_photo/page/<?php echo $this->uri->segment(5);?>" class="btn btn-success" style="margin-left:370px;">쓰기</a>
			</form>

		</div>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<tbody>
			<tr class="wrdLatest">
<?php
$i=1;
foreach ($list as $lt)
{
	$file_info = explode(".", $lt->file_name);
	if(is_file('./uploads/'.$file_info[0]."_thumb.".$file_info[1]))
	{
		$thumb_img = '/sns/uploads/'.$file_info[0]."_thumb.".$file_info[1];
	}
	else
	{
		$thumb_img = '/sns/uploads/'.$lt->file_name;
	}
?>

				<th scope="row">
					<img src="<?php echo $thumb_img;?>"><br>
					<a rel="external" href="/sns/controlls/view/<?php echo $lt->id;?>"><?php echo $lt->subject;?></a> <br>
					<time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time>
				</th>
<?php
	if($i % 2 == 0)
	{
?>
			</tr>
			<tr class="wrdLatest" id="<?php echo $i?>">
<?php
	}
	$i++;
}
?>
			</tr>
			</tbody>

		</table>
		<div id="lastPostsLoader"></div>
	</article>
