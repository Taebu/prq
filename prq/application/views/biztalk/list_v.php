<?php
/*
블로그 리뷰 리스트 목록 
2017-07-07 (금) 14:41:54  
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
				var act = '/prq/blog/lists/cid/q/'+$("#st_name").val()+'/page/1';
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
		});

		/*blog를 검색합니다.*/
		function search_form(p,type){
			$("#page").val(p);
			if(type=="search"){
				//prq/franchise/lists/prq_member/page/1
			var act = '/prq/blog/lists/prq_member/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/blog/lists/prq_member/page/'+p;
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
<table cellspacing="0" cellpadding="0" class="table table-striped">
 <thead>
		<tr>
			<th scope="col">
			<div class="checkbox checkbox-primary">
			<input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status()" id="chk_all"><label for="chk_all"></label>
			</div>
			</th>
			<th scope="col">플러스친구</th>
			<th scope="col">센더키</th>
			<th scope="col">등록상태</th>
			<th scope="col">등록일</th>
			<th scope="col">정지일</th>
			<th scope="col">해지일</th>
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
		?>
		<tr>
			<td><div class="checkbox checkbox-primary">
			<input type="checkbox" name="chk_seq[]" value="<?php echo $lt->bp_no;?>" onclick="chk_btn_status()"  id="chk_<?php echo $lt->bp_no;?>">
			<label for="chk_<?php echo $lt->bp_no;?>"></label></div>
			</td>
			<td><?php printf("%s(%s)",$lt->bp_plusid,$lt->bp_appid);?></td>
			<td><a rel="external" href="/prq/biztalk/view/<?php echo $lt->bp_no;?>" style="color:#676a6c;">
				<?php echo $lt->bp_senderid;?>
				</a>
			</td>
			<td><span class="btn btn-xs btn-<?php echo $lt->bp_status;?>"><?php echo chg_code_status($lt->bp_status);?></span></td>
			<td><?php echo $lt->bp_datetime;?></td>
			<td><?php echo $lt->bp_terminate_date;?></td>
			<td><?php echo $lt->bp_stop_date;?></td>
		</tr>
		<?php
		}

		if(!$list){
		echo "<tr><td colspan=7 style='text-align:center'>플러스친구 리스트가 존재 하지 않습니다.</td></tr>";
		}
		?>
</table>
<div class="row">
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('wa');">정상</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('wa');">중지</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('wa');">해지</button>

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

</script>