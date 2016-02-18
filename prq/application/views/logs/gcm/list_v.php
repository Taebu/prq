	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#gc_receiver").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/logs/lists/gcm/q/'+$("#gc_receiver").val()+'/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});
			/*버튼 비활성화.*/
			chk_btn_status();

			/*페이지에 검색어가 있을 경우 예외 처리 후 검색어 submit 처리*/
			$("ul.pagination a").click(function() {
				var search_key=$(this).attr('href').split("/");

				if(search_key.length == 7){
				search_form(search_key[6],'page');
				}else{
				search_form(search_key[8],'search');
				}
				
				return false;
			  });  
		});
		
		/*cid를 검색합니다.*/
		function search_form(p,type){
			$("#page").val(p);
			if(type=="search"){
			var act = '/prq/logs/lists/gcm/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/logs/lists/gcm/page/'+p;
			}
			$("#bd_search").attr('action', act).submit();
		}


		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/distributors/write/prq_member/page/1");
          $("#bd_search").submit();		
		
		}
		
		/* chg_store(seq)
		@seq
		*/
		function chg_store(seq){
		$('#write_action').attr('action', "/prq/store/view/prq_store/board_id/"+seq+"/page/1");
          $("#write_action").submit();		
		
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
				/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
				param=param+"&mb_reason="+inputValue;
				$.ajax({
				url:"/prq/ajax/chg_status/prq_member",
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
	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">

    <div class='row'>
	<?php
			echo form_open('prq/board/distributors/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));
?>
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
                            <h5>GCM LOG 현황 입니다. <small>콜 정보를 조회해 주세요.</small></h5>
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
                <label for="gc_receiver">수신인</label>
                <input class="form-control" id="gc_receiver" name="gc_receiver" size="30" type="text" value="<?php echo $search['gc_receiver'];?>"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="gc_sender">발신인</label>
                <input class="form-control" id="gc_sender" name="gc_sender" required="true" size="30" type="text" value="<?php echo $search['gc_sender'];?>" />
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
			$attributes = array(
				'class' => 'form-horizontal', 
				'id' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>
<?php $mb_gcode=$this->input->cookie('mb_gcode', TRUE);

if($mb_gcode=="G1"||$mb_gcode=="G2")
{
?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button>
</div><!-- .btn_area -->
<?php }?>
<div class="table-responsive">
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">번호</th>
					<th scope="col">내용</th>
					<th scope="col">이미지</th>
					<th scope="col">isMMS </th>
					<th scope="col">수신인</th>
					<th scope="col">발신인(GCM은수신)</th>
					<th scope="col">상태</th>
					<th scope="col">전송일</th>
					<th scope="col">gc_stno</th>
				</tr>
			</thead>
			<tbody>
<?php
/*리스트가 없으면 없는 값 출력*/
if(count($list)==0){
?>
				<tr>
					<td scope="row" colspan='11' class='text-center'> 조회한 GCM Log가 없습니다.</td>
				</tr>
<?php
}
foreach ($list as $lt)
{
?>
				<tr>
					<td scope="row"><?php echo $lt->gc_no;?></td>
					<td scope="row"><?php echo $lt->gc_subject;?><br><?php echo nl2br($lt->gc_content);?></td>
					<td scope="row"><img src="<?php echo $lt->gc_imgurl;?>" width="200" height="*"></td>
					<td scope="row"><?php echo $lt->gc_ismms;?></td>
					<td scope="row"><?php echo $lt->gc_receiver;?></td>
					<td scope="row"><?php echo $lt->gc_sender;?></td>
					<td scope="row"><?php echo $lt->gc_result;?></td>
					<td scope="row"><?php echo $lt->gc_datetime;?></td>
					<td scope="row"><a href="javascript:chg_store(<?php echo $lt->gc_stno;?>);"><?php echo $lt->gc_stno;?></a></td>
<!-- 					<td scope="row"><?php echo $lt->gc_status;?></td>
					<td scope="row"><?php echo $lt->gc_ipaddr;?></td> -->
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
					<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button></div><!-- .btn_area --><?php }?></th>
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
<div class="row">        <div class='col-sm-11'></div><div class='col-sm-1'> 
<?php if($mb_gcode=="G1"){?>
<a href="javascript:set_write();" class="btn btn-success">쓰기</a><?php }?></div></div>
</article>
<script type="text/javascript">
/*
2016-01-28 (목)
fn get_cid();
*/
function get_cid()
{
$.ajax({
url:"/prq/set_gcm.php",
type: "POST",
data:param,
dataType:"json",
success: function(data) {
	console.log(data.posts);
	}
});
}

$(document).ready(function(){

});
</script>