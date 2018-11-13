<?php
/**
* 가맹점 상태 리스트 뷰 페이지
* prq#110
* file : /prq/application/views/franchise/status/list_v.php
* 작성 : 2018-11-07 (수) 17:47:01 
* 수정 : 
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/
?>
<script type="text/javascript" src="http://prq.co.kr/prq/include/js/jquery-2.1.1.js"></script>
<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
//					var act = '/prq/board/lists/ci_board/q/'+$("#q").val()+'/page/1';
					var act = '/prq/franchise/lists/prq_member_status/page/1';
					

					$("#bd_search").attr('action', act).submit();
				}
			});
			/*버튼 비활성화.*/
			chk_btn_status();

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


		/*franchise를 검색합니다.*/
		function search_form(p,type){
			$("#page").val(p);
			if(type=="search"){
				//prq/franchise/lists/prq_member/page/1
			var act = '/prq/franchise/lists/prq_member_status/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/franchise/lists/prq_member_status/page/'+p;
			}
			$("#bd_search").attr('action', act).submit();
		}

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/franchise/write/prq_member_status/page/1");
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
		

		function swal_status(code){

			
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
						if(!data.success){
							//alert("변경에 실패하였습니다.");
							swal("변경!", "변경에 실패하였습니다. 변경 사유 : "+inputValue, "warning");
						}
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
			object['wa']='대기';
			object['pr']='처리중';
			object['ac']='승인';
			object['ad']='승인거부';
			object['ec']='연계완료';
			object['ca']='해지';
			return object[code];
		}

function check_status()
{
	var alert_message=[];
	$.ajax({
	url:"/prq/crontab/set_talktalk_status",
	data:"",
	dataType:"json",
	type:"POST",
	success:function(data){
		alert_message.push("PC 정상 상태 : ");
		alert_message.push(data.pc_normal_status);
		alert_message.push(", PC 점검 상태 : ");
		alert_message.push(data.pc_warning_status);
		alert_message.push(", PC 경고 상태 : ");
		alert_message.push(data.pc_danger_status);
		alert_message.push("\nAndroid 정상 상태 : ");
		alert_message.push(data.android_normal_status);
		alert_message.push(", Android 점검 상태 : ");
		alert_message.push(data.android_warning_status);
		alert_message.push(", Android 경고 상태 : ");
		alert_message.push(data.android_danger_status);
		alert_message.push("\n");
		alert_message.push("정상적으로 갱신 되었습니다. 페이지를 새로 고쳐 주세요.");
		alert_message.push("\n");
		alert(alert_message.join(""));
	}
	});

}
	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">

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
                            <h5><span class="mb_gname">가맹점</span> 등록 정보 입니다. <small>
													<?php 
						$my_search = array_filter($search);$count_search= count($my_search);
						/*  */
						if($count_search>0){
						echo "검색한 값 ".join("\",\"",$my_search)." 결과 입니다.";
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
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title">아이디</label>
                <input class="form-control" id="mb_id" name="mb_id" size="30" type="text" value="<?php echo $search['mb_id'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="mb_name">상호</label>
                <input class="form-control" id="mb_name" name="mb_name" required="true" size="30" type="text"  value="<?php echo $search['mb_name'];?>" OnKeyDown="javascript:board_search_enter();"/>


								
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="mb_email">이메일</label>
                <input class="form-control" id="mb_email" name="mb_email" size="30" type="text"  value="<?php echo $search['mb_email'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="mb_hp">휴대폰</label>
                <input class="form-control" id="mb_hp" name="mb_hp" required="true" size="30" type="text"  value="<?php echo $search['mb_hp'];?>" OnKeyDown="javascript:board_search_enter(this);"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
	<div class='col-sm-12 right'>
            <div class='form-group'>
						<input type="button" value="검색" id="search_btn" class="btn btn-primary" />
						<input type="button" value="가맹점 상태 갱신"  class="btn btn-info" onclick="javascript:check_status();"/>
						</div>

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
				'name' => 'write_action', 
				'id' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>
	<?php $mb_gcode=$this->input->cookie('mb_gcode', TRUE);

if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"||$mb_gcode=="G4"){?>
<div class="btn_area">
<button type="button" class="btn btn-default btn-sm">알수 없음</button></td>
<button type="button" class="btn btn-primary btn-sm">정상</button></td>
<button type="button" class="btn btn-warning btn-sm">경고</button></td>
<button type="button" class="btn btn-danger btn-sm">점검</button></td>
</div><!-- .btn_area -->
<?php }?>
<div class="table-responsive">
<table cellspacing="0" cellpadding="0" class="table table-striped">
<thead>
<tr>
	<th scope="col"><input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status()"></th>
	<th scope="col">No</th>
	<th scope="col">코드</th>
	<th scope="col">아이디 / 이메일</th>
	<th scope="col">상호</th>
<!-- 	<th scope="col">가맹점 ID</th>
	<th scope="col">구분</th> -->
<!-- 	<th scope="col">휴대폰</th>
	<th scope="col">상점수</th> -->
	<th scope="col">상태</th>
	<th scope="col">PC</th>
	<th scope="col">날짜시간</th>
	<th scope="col">APP</th>
	<th scope="col">날짜시간</th>
	<th scope="col">PROGRAM</th>
	<th scope="col">VERSION</th>
</tr>
</thead>
<tbody>
<?php
//print_r($st_count);


if(count($list)==0){
echo "<tr><td colspan='12' style='text-align:center'>등록된 `가맹점`이 없습니다. </td>";
}

//$count=json_decode(json_encode($count), True);
$array_fr = array_column($st_count, 'prq_fcode');
$fr_cnt = array_column($st_count, 'cnt');


/* 총판 코드명 불러 오기 */
$ds_code = array_column($ds_names, 'ds_code');
$ds_name = array_column($ds_names, 'ds_name');

/* 대리점 코드명 불러 오기 */
$pt_code = array_column($pt_names, 'pt_code');
$pt_name = array_column($pt_names, 'pt_name');


foreach ($list as $lt)
{
/*총판 코드 */
$sub_dscode=substr($lt->prq_fcode,0,6);
$index=array_search($sub_dscode, $ds_code);
$sub_ds_name=$index>-1?$ds_name[$index]:"미등록코드";

/*대리점 코드 */
$sub_ptcode=substr($lt->prq_fcode,0,12);
$index=array_search($sub_ptcode, $pt_code);
$sub_pt_name=$index>-1?$pt_name[$index]:"미등록코드";

$is_fr=array_search($lt->prq_fcode, $array_fr);
$fr_count=$is_fr>-1?$fr_cnt[$is_fr]."개":"0개";
	$is_unknown=$lt->mb_talktalkmessage_pc_unixtime=="0";
	
	if($is_unknown){
		$min="알수 없음";
	}else{
		$interval_time=(int)((time()-$lt->mb_talktalkmessage_pc_unixtime)/60);
		$min=change_recentTime($interval_time);
	}

	$is_unknown=$lt->mb_talktalkmessage_android_unixtime=="0";
	if($is_unknown){
		$min2="알수 없음";
	}else{
		$interval_time=(int)((time()-$lt->mb_talktalkmessage_android_unixtime)/60);
		$min2=change_recentTime($interval_time);
	}

?>
<tr>
	<td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->mb_no;?>" onclick="chk_btn_status()"></td>
	<td scope="row"><?php echo $lt->mb_no;?></td>
	<td><?php echo $sub_ds_name;?> &gt; <?php echo $sub_pt_name;	?></td>
	<td scope="row"><a rel="external" href="/prq/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $lt->mb_no;?>/page/<?php echo $page;?>"><?php echo $lt->mb_id;?>(<?php echo $lt->mb_email;?>)</a></td>
	<td scope="row"><?php echo $lt->mb_name;?></td>
	<td><span id="status_<?php echo $lt->mb_no;?>"><?php echo $controllers->get_status($lt->mb_status);?></span></td>
	<td><?php echo get_talktalk_status($lt->mb_talktalkmessage_pc_status);?></td>
	<td><?php echo $min;?></td>
	<td><?php echo get_talktalk_status($lt->mb_talktalkmessage_android_status)?></td>
	<td><?php echo $min2;?></td>
	<td><?php echo $lt->mb_programname;?></td>
	<td><?php echo $lt->mb_programversion;?></td>

</tr>
<?php
}
	
	function get_talktalk_status($key)
	{
		$array['unknown']='<button type="button" class="btn btn-default btn-xs">알수 없음</button>';
		$array['normal']='<button type="button" class="btn btn-primary btn-xs">정상</button>';
		$array['warning']='<button type="button" class="btn btn-warning btn-xs">경고</button>';
		$array['danger']='<button type="button" class="btn btn-danger btn-xs">점검</button>';
		if (array_key_exists($key, $array)) {
			$result=$array[$key];
		}else{
			$result='<button type="button" class="btn btn-default btn-xs">알수 없음</button>';
		}
		return $result;
	}

	
/*  시간변환 
$on1 = floor($time / 86400);
$rest_hours = $time % 86400;
$diff_in_hours = floor($rest_hours / 3600);

echo $time."<BR>".$on1.'일'.$diff_in_hours.'시간 남음'
*/
function change_recentTime($recentTime) 
{  
  if($recentTime > 10080){
    $recentTime = (int)($recentTime/10080)."주 전";
  }else if($recentTime > 1440){
    $recentTime = (int)($recentTime/1440)."일전";
  }else if($recentTime > 60){
    $recentTime = (int)($recentTime/60)."시간 전";
  }else if($recentTime < 3){
    $recentTime = "방금";
  }else{
    $recentTime = ceil($recentTime)."분 전";
  }
  return $recentTime;
}
?>
</tbody>
<tfoot>
	<tr>
		<th colspan="5" style="text-align:center">
		<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
	</tr>
</tfoot>
</table>
</div><!-- .table-responsive -->
<?php 
if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"||$mb_gcode=="G4"){?>
<div class="btn_area">
<button type="button" class="btn btn-default btn-xs">알수 없음</button></td>
<button type="button" class="btn btn-primary btn-xs">정상</button></td>
<button type="button" class="btn btn-warning btn-xs">경고</button></td>
<button type="button" class="btn btn-danger btn-xs">점검</button></td>

</div><!-- .btn_area -->
<?php }?>
</div>
</div>
</div>
<div class="row"><div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">쓰기</a></div></div>
</article>