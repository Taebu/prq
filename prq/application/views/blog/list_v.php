<style type="text/css">
	.black {
		color:#676a6c;
	}
	.blue {
		color:#10cdf4;
	}
</style>

<div class="row wrapper border-bottom white-bg page-heading">
<!-- 	<div style="border:0px solid red;text-align:center;">
		<img src="/prq/img/new/view_top.png" width="100%">
	</div> -->
</div>
<ul style="margin:0;padding:10px 0 10px 0;list-style:none;text-align:center;">
	<li style="font-weight:bold;font-size:27px;">리뷰 리스트</li>
	<li>BLOG Review</li>
</ul>
<!-- list.php -->
<table cellspacing="0" cellpadding="0" class="table table-striped">
	<!-- <thead>
		<tr>
			<th scope="col"><input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status()"></th>
			<th scope="col">상점이름</th>
			<th scope="col" style="text-align:center;">핸드폰</th>
			<th scope="col" style="width:45px;text-align:center;">번호</th>
			<th scope="col" style="text-align:center;">작성일</th>
		</tr>
	</thead> -->
	<tbody>

		<?php
		foreach ($list as $lt)
		{
		?>
		<tr>
			<!-- <td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->bl_no;?>" onclick="chk_btn_status()"></td> -->
			<!-- <td><?php echo $lt->bl_name;?></td> -->
			<td style="font-size:15px;background:#fff;">상호 : <b><a rel="external" href="/prq/blog/view/<?php echo $lt->bl_no;?>" style="color:#676a6c;">
				<font onMouseOver="this.className='blue';" onMouseOut="this.className='black';">	
				<?php echo $lt->st_name;?>
				</font>
				</a></b>
			</td>
			<td style="text-align:right;font-weight:bold;font-size:11px;background:#fff;">No.<?php echo $lt->st_no;?></td>
			<td style="text-align:right;font-weight:bold;font-size:11px;background:#fff;"><?php echo get_status_blog($lt->bl_status);?></td>
		</tr>
		<tr>
			<td style="width:62%;"><img src="/prq/img/new/tel.png" style="width:12px;margin-top:-3px;"> <?php echo $lt->bl_hp;?></td>
			<td style="text-align:right;font-size:11px;"><?php echo $lt->bl_datetime;?></td>
		</tr>
		<?php
		}

		if(!$list){
		echo "<tr><td colspan=5 style='text-align:center'>블로그 리뷰 리스트가 존재 하지 않습니다.</td></tr>";
		}
		?>
</table>
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">포스팅</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">사장승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">사장거부</button>

<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('ad');">일반 승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">일반 거부</button>

<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('ad');">포인트 승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">포인트 거부</button>
<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination -->

<?php
function get_blog_status($key){
	$code['view']='포스팅';
	$code['ceo_allow']='사장승인';
	$code['ceo_deny']='사장거부';
	$code['co_blog_allow']='일반 승인';
	$code['co_blog_deny']='일반 거부';
	$code['po_blog_allow']='포인트 승인';
	$code['po_blog_deny']='포인트 거부';

	if (array_key_exists($key, $code)) {
		$result=$code[$key];
	}else{
		$result="알수 없는 코드";
	}
	return $result;
}
?>
<script type="text/javascript">
function get_status(code)
{
	var object=[];
	object['view']='사용자 포스팅 등록';
	object['ceo_allow']='사장승인';
	object['ceo_deny']='사장거부';
	object['co_blog_allow']='일반 승인';
	object['co_blog_deny']='일반 거부';
	object['po_blog_allow']='포인트 승인';
	object['po_blog_deny']='포인트 거부';
	return object[code];
}

function chg_list(v)
{
	alert(v);
}
</script>