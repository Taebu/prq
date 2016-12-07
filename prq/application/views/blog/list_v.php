list.php
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status()"></th>
					<th scope="col">이름</th>
					<th scope="col">핸드폰</th>
					<th scope="col">상점번호</th>
					<th scope="col">작성일</th>
				</tr>
			</thead>
			<tbody>

<?php
foreach ($list as $lt)
{
?>
<tr>
	<td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->bl_no;?>" onclick="chk_btn_status()"></td>
	<td><a rel="external" href="/prq/blog/view/<?php echo $lt->bl_no;?>"><?php echo $lt->bl_name;?></a></td>
	<td><?php echo $lt->st_no;?></td>
	<td><?php echo $lt->bl_hp;?></td>
	<td><?php echo $lt->bl_datetime;?></td>
</tr>
<?php
}
$list=null;
if(!$list){
echo "<tr><td colspan=5 style='text-align:center'>블로그 리뷰 리스트가 존재 하지 않습니다.</td></tr>";
}
?>
</table>