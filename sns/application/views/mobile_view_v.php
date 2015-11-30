
	<div data-role="header">
		<h1>SNS 프로젝트 : jQuery Mobile</h1>
	</div>
	<div data-role="content">
	<table data-role="table" id="my-table" data-mode="reflow">
		<thead>
			<tr>
				<th scope="col"><?php echo $views->subject;?></th>
				<th scope="col">이름 : <?php echo $views->user_id;?></th>
				<th scope="col">조회수 : <?php echo $views->hit;?></th>
				<th scope="col">등록일 : <?php echo $views->reg_date;?></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="4">
					<img src="/sns/uploads/<?php echo $views->file_name;?>"><br>
					<?php echo $views->contents;?><br><br>
					파일명 : <?php echo $views->original_name;?>
				</th>
			</tr>
		</tbody>
	</table>
	</div>
