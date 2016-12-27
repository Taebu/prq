<?php
/**
* 총판 리스트 뷰 페이지
* file : /prq/application/views/distributors/list_v.php
* 작성 : 2015-03-05 (목)
* 수정 : 2016-04-27 (수)
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/
?>
	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/board/distributors/ci_board/q/'+$("#q").val()+'/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});
			/*버튼 비활성화.*/
			chk_btn_status();
		});

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/distributors/write/prq_member/page/1");
          $("#bd_search").submit();
		
		}


		function chg_list(code){
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
				closeOnConfirm: false,
				cancelOnConfirm: false,
				confirmButtonText: "네, 변경할래요!",
				cancelButtonText: "아니요, 취소할래요!",
				animation: "slide-from-top",   showLoaderOnConfirm: true,
				allowEscapeKey:true,
				inputPlaceholder: "변경 사유는 로그에 기록 됩니다." }, function(inputValue){
				if (inputValue === false) return false;
				if(!inputValue){
					swal("취소!", "취소 하였습니다.", "error");
				}
				if (inputValue.length<3) {
				  swal.showInputError("3자이상 사유를 적어 주세요.");
				  return false
				}

				var param=$("#write_action").serialize();
				param=param+"&mb_status="+code;
				console.log(param);
				/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
				param=param+"&mb_reason="+inputValue;
				$.ajax({
				url:"/prq/ajax/chg_status/prq_blog",
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
						console.log(data);
						console.log(data=="9000");
						if(data=="9000"){
							//swal("로그인!", "로그인 되지 않았습니다. 로그인 하시겠습니까?", "error");
							swal({   
								title: "로그인!",
								text: "로그인 되지 않았습니다. 로그인 하시겠습니까?",
								type: "warning",
								showCancelButton: true,
								closeOnConfirm: false,
								animation: "slide-from-top"
							}, 
							function(inputValue)
							{
								/*취소를 눌렀을 때*/
								if (inputValue === false) return false;

								swal("Nice!", "2초 뒤 로그인 페이지로 이동 합니다. ", "success");
								
								setTimeout(function(){console.log('setTimeout');$(location).attr('href', "/prq/auth/");}, 2000);
								;
							});	
						}

//						if(!data.success){
							//alert("변경에 실패하였습니다.");
//							swal("변경!", "변경에 실패하였습니다. 변경 사유 : "+inputValue, "warning");
//						}
					}
				});

//				swal("Nice!", "You wrote: " + inputValue, "success"); 
				});
			/*
			
			
			*/
			/*
			swal({
				title: "정말 변경 하시겠습니까?",
				text: "해당 "+get_status(code)+"로 변경 됩니다.\n 진행 하시겠습니까?\n변경 사유",
				type: "warning",
				html:true,
				showCancelButton: true,
				timer: 2000,
				showConfirmButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "네, 변경할래요!",
				closeOnConfirm: false
			}, function () {

				$.ajax({
				url:"/prq/ajax/chg_status",
					data:param,
					dataType:"json",
					type:"POST",
					success:function(data){
						if(data.success){
							//alert("변경에 성공하였습니다.");
							swal("변경!", "변경에 성공하였습니다..", "success");
							$.each(data.posts,function(key,val){
								$("#status_"+val.mb_no).html(val.mb_status);
							});
						}
						if(!data.success){
							//alert("변경에 실패하였습니다.");
							swal("변경!", "변경에 실패하였습니다.", "warning");
						}
					}
				});
			});
			*/
		}

		function chk_btn_status(){
			var param=$("#write_action").serialize();
//			$(".btn_area [lass*='btn-']").toggleClass("disabled",param.indexOf("chk_seq")<0).prop('disabled', param.indexOf("chk_seq")<0);
			
			if(param.indexOf("chk_seq")<0)
			{
				$(".btn_area [class*='btn-']").addClass("disabled").prop('disabled', true); 
			}else{
				$(".btn_area [class*='btn-']").removeClass("disabled").prop('disabled', false); 
			}
			
		}

		function get_status(code)
		{
			var object=[];
			object['wa']='대기';
			object['pr']='처리중';
			object['ac']='승인';
			object['ad']='승인거부';
			object['ec']='연계완료';
			object['ca']='해지';
			return object[code];
		}
		
		/* 총판 삭제 */
		function del_code()
		{
			var str=[];
			str.push("해당 총판에는 ");
			str.push("대리점 3개,");
			str.push("가맹점 1개,");
			str.push("하위 상점 22개 ");
			str.push("가 있습니다.");
			str.push("해당 `DS0001` 멤버를 삭제 하시면 ");
			str.push("위 모든 멤버및 상점이 삭제 됩니다.");
			str.push("");
			str.push("정말 이대로 진행 하시겠습니까?");

		swal({
				title: "정말 총판을 삭제 하시겠습니까?",
				text: str.join("<br>"),
				type: "warning",
				html:true,
				showCancelButton: true,
				showConfirmButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "네, 삭제 하겠습니다!!!",
				cancelButtonText: "아니요, 취소할래요!",
				closeOnConfirm: false,   
				closeOnCancel: false

			}, 	function(isConfirm){  
					if (isConfirm) {     
						/* 삭제를 눌렀다면 */
						swal("Deleted!", "10초 후 삭제를 진행합니다... 계속 진행 하시겠습니까?", "success");
						/* 총판 삭제 시도*/
						delete_ds();
					} else {     
						/* 취소를 눌렀다면 */
						swal("Cancelled!", "코드 삭제를 취소하였습니다.", "error");
					}
					}
			);
		}

		/* 총판 삭제 시도*/
		function delete_ds()
		{
			var str=[];
			str.push("삭제 중입니다. <br>");
			str.push("대리점 <span id='pt_deleted'>0</span> / <span id='pt_total'>1</span>개,<br>");
			str.push("가맹점 <span id='fr_deleted'>0</span> / <span id='fr_total'>1</span>개,<br>");
			str.push("상&nbsp;&nbsp;점 <span id='st_deleted'>0</span> / <span id='st_total'>1</span>개,<br>");
			str.push("삭제 중입니다...<br>");
			str.push("<br>");


			/* object progress bar */
			str.push('<div class="progress">');
			str.push('<div id="section_progress" ');
			str.push('class="progress-bar ');
			str.push('progress-bar-danger active" ');
			str.push('role="progressbar" ');
			str.push('aria-valuenow="70" ');
			str.push('aria-valuemin="0" ');
			str.push('aria-valuemax="100" ');
			str.push('style="width:20%">');
			str.push('70% Complete (danger)');
			str.push('</div>');
			str.push('</div>');


			/* total progress bar */
			str.push('<div class="progress">');
			str.push('<div id="total_progress" ');
			str.push('class="progress-bar ');
			str.push('progress-bar-success active" ');
			str.push('role="progressbar" ');
			str.push('aria-valuenow="70" ');
			str.push('aria-valuemin="0" ');
			str.push('aria-valuemax="100" ');
			str.push('style="width:20%">');
			str.push('70% Complete (danger)');
			str.push('</div>');
			str.push('</div>');

			str.push('<a class="btn btn-sm btn-default" href="javascript:up_bar(\'up\');">up</a>');
			str.push('<a class="btn btn-sm btn-default" href="javascript:up_bar(\'down\');">dn</a>');

/*			str.push('<div class="progress">');
			str.push('<div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:70%">');
			str.push('<span class="sr-only">70% Complete</span>');
			str.push('</div>');
			str.push('</div>');
*/
			swal({
				title: "Deleted!",
				text: str.join(""),
				html:true,
				type: "warning",
				showCancelButton: true,
				closeOnConfirm: false,
				cancelOnConfirm: false,
				confirmButtonText: "네, 변경할래요!",
				cancelButtonText: "아니요, 취소할래요!",
				animation: "slide-from-top",
				showLoaderOnConfirm: true,
				allowEscapeKey:true,
				inputPlaceholder: "변경 사유는 로그에 기록 됩니다." });


			//swal("Deleted!", "모두 삭제 되었습니다.", "success");
		}

		/* up_bar */
		var code_percent=0;
		function up_bar(mode)
		{
			if(mode=="up"){
			code_percent++;
			$(".progress-bar").width(code_percent+'%');
			$(".progress-bar").html(code_percent+'% Complete');
			
			}else if(mode=="down"){
			code_percent--;
			$(".progress-bar").width(code_percent+'%');
			$(".progress-bar").html(code_percent+'% Complete');
			}
		}


		
	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">

    <div class='row'>
	<?php echo form_open('prq/board/distributors/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));?>
			<!--form id="bd_search" method="post" class="well form-search" -->
<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->cookie('mb_code', TRUE);?>">
		<!-- id="my-awesome-dropzone" class="" -->
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
                <div class="col-lg-12">
					<?php
					//print_r($this->session);
					//print_r($this->input);
					?>
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><span class="mb_gname">총판</span> 등록 정보 입니다. <small><span class="mb_gname">총판</span>의 정보 및 계약서를 작성해 주세요.</small></h5>
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
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title">등록일자</label>
                <input class="form-control" id="user_title" name="user[title]" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname">상태</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title"><span class="mb_gname">총판</span>명</label>
                <input class="form-control" id="user_title" name="user[title]" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname"><span class="mb_gname">총판</span>ID</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for="user_email"><span class="mb_gname">총판</span> 목록</label>
                <input class="form-control required email" id="user_email" name="user[email]" required="true" size="30" type="text" />
            </div>
        </div>
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

<div class='row'>
<?php 
$attributes = array('class' => 'form-horizontal','name' => 'write_action','id' => 'write_action');
echo form_open('board/write/ci_board', $attributes);
?>
<div class='col-sm-12'>
<?php $mb_gcode=$this->input->cookie('mb_gcode', TRUE);
if($mb_gcode=="G1"||$mb_gcode=="G2")
{?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default"  onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary"  onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger"  onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info"      onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button>
<button type="button" class="btn btn-sm btn-danger"   onclick="del_code();">총판삭제</button>
</div><!-- .btn_area -->
<?php }?>
<div class="table-responsive">
<table cellspacing="0" cellpadding="0" class="table table-striped">
<thead>
<tr>
	<th scope="col"><input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status();return false;"></th>
	<th scope="col">No</th>
	<th scope="col">등록일자</th>
	<th scope="col">총판 ID</th>
	<th scope="col">코드</th>
	<th scope="col">총판 상태</th>
	<th scope="col">대리점</th>
</tr>
</thead>
<tbody>
<?php
if(count($list)==0){
echo "<tr><td colspan='12' style='text-align:center'>등록된 `총판`이 없습니다. </td>";
}

$array_fr = array_column($count, 'mb_pcode');
print_r($count);
$fr_cnt = array_column($count, 'cnt');

foreach ($list as $lt)
{
	$is_fr=array_search($lt->prq_fcode, $array_fr);
	$fr_count=$is_fr>-1?$fr_cnt[$is_fr]."개":"0개";
?>
<tr>
	<td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->mb_no;?>" onclick="chk_btn_status()"></td>
	<td scope="row"><?php echo $lt->mb_no;?></td>
	<td><a rel="external" href="/prq/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $lt->mb_no;?>/page/<?php echo $page;?>"><?php echo $lt->mb_datetime;?></a></td>
	<td><?php echo $lt->mb_id;?></td>
	<td><?php echo $lt->prq_fcode;?></td>
	<td><span id="status_<?php echo $lt->mb_no;?>"><?php echo $controllers->get_status($lt->mb_status);?></span></td>
	<td><?php echo $fr_count;?></td>
</tr>
<?php
}
?>
</tbody>
<tfoot>
<tr>
	<th colspan="12" style="text-align:left">
	<?php if($mb_gcode=="G1"){?>
	<div class="btn_area">
	<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
	<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
	<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
	<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
	<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
	<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button>
	<button type="button" class="btn btn-sm btn-danger" onclick="del_code();">총판삭제</button>
	</div><!-- .btn_area --><?php }?></th>
</tr>
<tr>
	<th colspan="12" style="text-align:center;border-top:0">
	<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
</tr>
</tfoot>
</table>
</div><!-- .table-responsive -->
</div>
</div>
</div>
<div class="row"><div class='col-sm-11'></div>

<div class='col-sm-1'><?php if($mb_gcode=="G1"){?>
<a href="javascript:set_write();" class="btn btn-success">쓰기</a><?php }?></div></div>
</article>