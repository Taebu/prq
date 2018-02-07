<?php
/*
템플릿 리뷰 리스트 목록 
2018-02-05 (월) 10:38:38 
조회 리스트 페이지 기능 개선

*/

function get_gifticon($code)
{
	switch ($code) {
	case "cu_2000":
		$result='<button type="button" class="btn btn-success btn-xs">CU상품권</button>';
		break;
	case "cash_2000":
		$result='<button type="button" class="btn btn-danger btn-xs">현금</button>';
		break;
	}
	return $result;
}
?>
<script type="text/javascript" src="http://prq.co.kr/prq/include/js/jquery-2.1.1.js"></script>
<script type="text/javascript">
		$(document).ready(function(){
			$("#search_btn").click(function(){
				var act = '/prq/template/lists/cid/q/'+$("#st_name").val()+'/page/1';
					$("#bd_search").attr('action', act).submit();
			});


		  $("ul.pagination a").click(function() {
			var kk=$(this).attr('href').split("/");

			var search_key=6;
			if(kk.length == 7){
			search_form(kk[6],'page');
			}else{
			search_form(kk[8],'search');
			}
			

			return false;
		  });  
			
			chk_btn_status();
		});

		/*blog를 검색합니다.*/
		function search_form(p,type){
			$("#page").val(p);
			if(type=="search"){
				//prq/franchise/lists/prq_member/page/1
			var act = '/prq/template/lists/bc_template/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/template/lists/bc_template/page/'+p;
			}
			$("#bd_search").attr('action', act).submit();
		}
		
		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}
</script>
<style type="text/css">
	.black {
		color:#676a6c;
	}
	.blue {
		color:#10cdf4;
	}
	.btn-access{background:#1c84c6;color:#fff}
.btn-stop{background:#f7ac59;color:#fff}
.btn-terminate{background:#ed5565;color:#fff}
</style>
<div class="board_area">
    <div class='row'>
	<?php
	echo form_open('blog/lists/prq_member/', array('id'=>'bd_search', 'class'=>'well form-search'));
?>

<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="FR">
<input type="hidden" name="table" id="table" value="prq_member">
<!-- id="my-awesome-dropzone" class="" -->
<div class="wrapper wrapper-content animated fadeInRight">

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>비즈톡 리스트 입니다. <small>
<?php 
//$search=array("mb_id" => 'one',"mb_name"=>"","mb_email"=>"","mb_hp"=>"");
$my_search = array_filter($search);
$count_search= count($my_search);
/*  */
if($count_search>0){
echo "검색한 값 \"".join("\",\"",$my_search)."\" 결과 입니다.";
}else{
echo "가맹점의 정보 및 계약서를 작성해 주세요.";
}?>
</small></h5>
<div class="ibox-tools">
<a class="collapse-link">
<i class="fa fa-chevron-up"></i>
</a>
<a class="dropdown-toggle" data-toggle="dropdown" href="#">
<i class="fa fa-wrench"></i>
</a>
<ul class="dropdown-menu dropdown-user">
<li><a href="#">Config option 1</a>
</li>
<li><a href="#">Config option 2</a>
</li>
</ul>
<a class="close-link">
<i class="fa fa-times"></i>
</a>
</div>
</div><!-- .ibox-title -->
<div class="ibox-content">
<?php ?>
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title">상점이름(st_name)</label>
                <input class="form-control" id="st_name" name="st_name" size="30" type="text" value="<?php echo $search['st_name'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="mb_name">상점번호(st_no)</label>
                <input class="form-control" id="st_no" name="st_no" required="true" size="30" type="text"  value="<?php echo $search['st_no'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="mb_hp">휴대폰(bl_hp)</label>
                <input class="form-control" id="mb_hp" name="mb_hp" required="true" size="30" type="text"  value="<?php echo $search['mb_hp'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
	<div class='col-sm-12 right'>
            <div class='form-group'><input type="button" value="검색" id="search_btn" class="btn btn-primary" /> </div>
        </div>
    </div>
			</form><!-- #bd_search -->
</div>
	</div>
	</div><!-- .row -->
</div><!-- .board_area -->
<?php 
$attributes = array(
	'class' => 'form-horizontal', 
	'id' => 'write_action',
	'name' => 'write_action'
);
echo form_open('board/write/ci_board', $attributes);
?>
<div class="row wrapper border-bottom white-bg page-heading">
<!-- 	<div style="border:0px solid red;text-align:center;">
		<img src="/prq/img/new/view_top.png" width="100%">
	</div> -->
	<ul>
<li>체크박스로 여러개의 템플릿을 선택하여 삭제할 수 있습니다.</li>
<li>검색된 항목의 템플릿을 다운받을 수 있습니다.</li>
<li>템플릿내용에 마우스를 올리면 전체 내용을 확인할 수 있습니다.</li>
<li>등록상태에 마우스를 올리면 반려 사유를 확인할 수 있습니다.</li>
<li>기 승인된 문구 및 반려된 문구는 삭제 처리가 되지 않습니다(템플릿 새로 추가 등록 요망).</li>
</ul>
</div>
		<?php 
			$attributes = array(
				'class' => 'form-horizontal', 
				'id' => 'write_action',
				'name' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
<ul style="margin:0;padding:10px 0 10px 0;list-style:none;text-align:center;">
	<li style="font-weight:bold;font-size:27px;">비즈톡 친구 리스트</li>
	<li>Biztalk &gt plusFriend &gt list</li>
</ul>
<!-- list.php -->
<div class="btn_area">
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('wa');">정상</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('wa');">중지</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('wa');">해지</button>
</div><!-- .btn_area -->
<table cellspacing="0" cellpadding="0" class="table table-striped">
 <thead>
		<tr>
			<th scope="col">
			<div class="checkbox checkbox-primary">
			<input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status()" id="chk_all"><label for="chk_all"></label>
			</div>
</th>
<th>플러스친구</th>
<th>템플릿코드<br>템플릿타입</th>
<th>템플릿명</th>
<th>템플릿내용</th>
<th>등록상태<br>적립타입</th>
<th>정규식</th>
<th>등록일</th>
</tr>
	</thead>
	<tbody>

		<?php
		function chg_code_status($key)
{
	$array['access']="정상";
	$array['stop']="정지";
	$array['terminate']="해지";
	$array['0']='<span class="btn btn_secondary">미적립</span>';
	$array['1']='<span class="btn btn_access">사용가능</span>';
	$array['2']='<span class="btn btn_info">신청중</span>';
	$array['3']='<span class="btn btn_success">현금지급</span>';
	$array['4']='<span class="btn btn_black">삭제</span>';
	if (array_key_exists($key, $array)) {
		$result=$array[$key];
	}else{
		$result="정상";
	}
	return $result;
}
		foreach ($list as $lt)
		{
			$bt_datetime=date("Y-m-d",strtotime($lt->bt_datetime));
			$bt_regex=explode("&",$lt->bt_regex);
			$bt_regex=join("<br>",$bt_regex);
			/*
			$bt_datetime=date("Y-m-d",strtotime($list['bt_datetime']));
$btn_type=$list['bt_type']=="gcm"?"btn_primary":"btn_warning";
echo '<tr>';
printf('<td><input type="checkbox" name="chk_seq[]" value="%s"></td>',$list['bt_no']);
echo '<td>'.$list['bt_plusid'].'</td>';
echo '<td>'.$list['bt_code'].'<br><span class="btn '.$btn_type.'">'.$list['bt_type'].'</span></td>';
printf('<td><a href="./view.php?bt_no=%s" class="template_link">%s</a></td>',$list['bt_no'],$list['bt_name']);

echo '<td>'.nl2br($list['bt_content']).'</td>';
printf('<td><a class="btn btn_%s">%s</a>',$list['bt_status'],chg_code_status($list['bt_status']));
echo '<br><br>'.chg_code_status($list['po_status']).'</td>';
echo '<td>'.$bt_regex.'</td>';
echo '<td>'.$bt_datetime.'</td>';
echo '</tr>';
			*/
		?>
		<tr>
			<td><div class="checkbox checkbox-primary">
			<input type="checkbox" name="chk_seq[]" value="<?php echo $lt->bt_no;?>" onclick="chk_btn_status()"  id="chk_<?php echo $lt->bt_no;?>">
			<label for="chk_<?php echo $lt->bt_no;?>"></label></div>
			</td>
			<td><?php print $lt->bt_plusid;?></td>
			<td><a rel="external" href="<?php printf("/prq/template/view/bt_template/bt_no/%s/page/%s",$lt->bt_no,$page);?>" style="color:#676a6c;">
				<?php echo $lt->bt_name;?>
				<?php echo nl2br($lt->bt_content);?>
				</a>
			</td>
			<td><span class="btn btn-xs btn-<?php echo $lt->bt_status;?>"><?php echo chg_code_status($lt->bt_status);?></span></td>
			<td><?php echo $bt_regex;?></td>
			<td><?php echo $bt_datetime;?></td>
		</tr>
		<?php
		}

		if(!$list){
		echo "<tr><td colspan=7 style='text-align:center'>플러스친구 리스트가 존재 하지 않습니다.</td></tr>";
		}
		?>
</table>
<div class="row">
<div class="btn_area">
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('access');">정상</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('stop');">중지</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('terminate');">해지</button>
</div><!-- .btn_area -->
<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination -->
<div style="margin:20px;padding:30px"></div>
</div>
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
	object['access']='정상';
	object['stop']='정지';
	object['terminate']='해지';
	return object[code];
}

function chg_list(code)
{
	var param=$("#write_action").serialize();

	if(param=="")
	{
		alert("하나 이상 선택 하셔야 합니다.");
		return;
	}
	
	/* sweet alert */
	swal_status(code);

	//alert(code+" : "+param);
}

function swal_status(code)
{
	swal({
		title: "정말 변경 하시겠습니까?",
		text: "해당 리스트를 \""+get_status(code)+"\"(으)로 변경 됩니다.<br> 진행 하시겠습니까?<br>변경 사유를 작성해 주세요.",
		html:true,
		type: "input",
		showCancelButton: true,
		closeOnConfirm: true,
		cancelOnConfirm: true,
		confirmButtonText: "네, 변경할래요!",
		cancelButtonText: "아니요, 취소할래요!",
		animation: "slide-from-top",
		showLoaderOnConfirm: true,
		allowEscapeKey:true,
		inputPlaceholder: "변경 사유는 로그에 기록 됩니다."
		}, function(inputValue){
		//if (inputValue === false) return false;
		if(!inputValue){
			swal("취소!", "취소 하였습니다.", "error");
		}else if (inputValue.length<3) {
			swal.showInputError("3자이상 사유를 적어 주세요.");
		}else{
			var param=$("#write_action").serialize();
			param=param+"&mb_status="+code;
			/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
			param=param+"&mb_reason="+inputValue;
			$.ajax({
			url:"/prq/ajax/chg_status_template/bt_template",
				data:param,
				dataType:"json",
				type:"POST",
				success:function(data){
					if(data.success){
						//alert("변경에 성공하였습니다.");
						swal("변경!", "변경에 성공하였습니다.. 변경 사유 : "+inputValue, "success");
						$.each(data.posts,function(key,val){
							$("#status_"+val.mb_no).html(val.mb_status);
						});
					}
					if(!data.success){
						//alert("변경에 실패하였습니다.");
						swal("변경!", "변경에 실패하였습니다. 변경 사유 : "+inputValue, "warning");
					}
				}
			});
		}
	}); /* swal */
}
/*
 *
 *   Main 
 *   version 1.0
 *    2016-04-15 Fri
 */

/* 전체 선택 */
function checkAll(formname){
	var df = document[formname];
	for(var i=0;i<df.elements.length;i++){
		if(df[i].type=="checkbox"){
//			(df[i].checked == true)?df[i].checked = false:df[i].checked = true;
			df[i].checked = document.getElementById("chk_all").checked;;

		}
	}
}

function chk_btn_status(){
	var param=$("#write_action").serialize();
	
	if(param.indexOf("chk_seq")<0)
	{
		$(".btn_area [class*='btn-']").addClass("disabled").prop('disabled', true); 
	}else{
		$(".btn_area [class*='btn-']").removeClass("disabled").prop('disabled', false); 
	}
}
</script>