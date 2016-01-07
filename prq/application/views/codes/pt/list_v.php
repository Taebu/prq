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

		function set_write()
		{
			$('#write_action').attr('action', "/prq/codes/write/prq_ptcode/page/1");
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
				animation: "slide-from-top",
				showLoaderOnConfirm: true,
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
				url:"/prq/ajax/chg_status/prq_dscode",
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
			object['delete']='삭제';
			object['modify']='수정';
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
//	echo form_open('prq/board/distributors/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));
?><!--form id="bd_search" method="post" class="well form-search" -->

<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->cookie('mb_code', TRUE);?>">

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

if($mb_gcode=="G1"){?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('modify');">수정</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('delete');">삭제</button>
</div><!-- .btn_area -->
<?php }?>
<table cellspacing="0" cellpadding="0" class="table table-striped">
<thead>
<tr>
<th scope="col"><input type="checkbox"></th>
<th scope="col">총판코드</th>
<th scope="col">코드이름</th>
</tr>
</thead>
<tbody>
<?php
if(!$list){
echo "<tr><td colspan='3' style='text-align:center'>등록된 코드가 없습니다.</td></tr>";
$next_code="DS0001";
}

foreach ($list as $lt)
{
$code = substr($lt->pt_code,2,6);
?>
<tr>
<td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->pt_code;?>" onclick="chk_btn_status()"></td>
<td scope="row"><?php echo $lt->pt_code;?></td>
<td><input type='text' id='name_<?php echo $code;?>' name="pt_name[<?php echo $lt->pt_code;?>]" value='<?php echo $lt->pt_name;?>' class='ed'></td></td>
</tr>
<?php
if($code != 9999) $next_code = $code + 1;
}
?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="12" style="text-align:left">
					<?php if($mb_gcode=="G1"){?>
					<div class="btn_area">
					<?php
					if($next_code!="pt0001")
					{
//						$next_code=substr($get_max_ptcode[0]->max_pt_code,2,6);
						$next_code=10001+$next_code;
						$pt_code="PT".substr($next_code,1,5);
					}else{
					$ds_code="PT0001";
					}
					?>
				<button type="button" class="btn btn-sm btn-default" onclick="chg_list('modify');">수정</button>
				<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('delete');">삭제</button></div><!-- .btn_area --><?php }?></th>
				</tr>
				<tr>
					<th colspan="12" style="text-align:center;border-top:0">
					<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
				</tr>
			</tfoot>
		</table>
<input type="hidden" name="pt_code"  id="pt_code" value="<?php echo $pt_code;?>">
</div>
</div>
</div>
<div class="row">        <div class='col-sm-11'></div><div class='col-sm-1'> 
<?php if($mb_gcode=="G1"){?>
<a href="javascript:set_write();" class="btn btn-success">쓰기</a><?php }?></div></div>
</article>