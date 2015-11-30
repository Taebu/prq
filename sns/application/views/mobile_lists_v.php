<div data-role="content" class="jqm-content">
	<h1>SNS 프로젝트 : jQeury Mobile</h1>
	<ul data-role="listview" data-inset="true" data-divider-theme="d">
		<li data-role="list-divider">SNS 목록</li>
<?php
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
		<li><a rel="external" href="/sns/controlls/view/<?php echo $lt->id;?>"><img src="<?php echo $thumb_img;?>" width="80" height="60"> <?php echo $lt->subject;?> <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo mdate("%M. %j, %Y", human_to_unix($lt->reg_date));?></time></a></li>
<?php
}
?>
	</ul>
</div>
