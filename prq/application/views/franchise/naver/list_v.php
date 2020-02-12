<?php
/**
* 가맹점 리스트 뷰 페이지
* file : /prq/application/views/franchise/list_v.php
* 작성 : 2015-03-05 (목)
* 수정 : 2016-04-27 (수)
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/
?>
<script type="text/javascript" src="/prq/include/js/jquery-2.1.1.js"></script>
<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
//					var act = '/prq/board/lists/ci_board/q/'+$("#q").val()+'/page/1';
					var act = '/prq/franchise/lists/prq_member/page/1';
					

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
			var act = '/prq/franchise/lists/prq_member/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/franchise/lists/prq_member/page/'+p;
			}
			$("#bd_search").attr('action', act).submit();
		}

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/franchise/write/prq_member_naver/page/1");
          $("#bd_search").submit();		
		
		}
		function chg_list(code){
			var param=$("#write_action").serialize();
			if(param=="")
			{
				alert("하나 이상 선택 하셔야 합니다.");
				$("#seconde_process").val("");
				return;
			}
			
			/* sweet alert */
			swal_status(code);

			//alert(code+" : "+param);
		}
		

		function swal_status(code){
			var first_process = $("#first_process").val();
			var first_name = $("#first_process option:selected").text();

			swal({
				title: "정말 변경 하시겠습니까?",
				text: "해당 리스트를 \""+first_name+" - "+get_status(code)+"\"(으)로 변경 됩니다.<br> 진행 하시겠습니까?<br>변경 사유를 작성해 주세요.",
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
				param=param+"&first_process="+first_process;
				param=param+"&seconde_process="+code
				param=param+"&mb_no="+code
				console.log(param);
				
				$.ajax({
				url:"/prq/ajax/chg_status/prq_member_naver",
					data:param,
					dataType:"json",
					type:"POST",
					success:function(data){
						console.log(data);
						if(data.success){
							//alert("변경에 성공하였습니다.");
							swal("변경!", "변경에 성공하였습니다.. 변경 사유 : "+inputValue, "success");
							$.each(data.posts,function(key,val){
								$("#"+val.first_process+"_"+val.mb_no).html(val.mb_status);
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
			var object={'wait':'대기','order':'접수','installing':'설치중','withhold':'보류','complete':'완료','in_progress':'진행중','decision_in_process':'심사중'};
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
                            <h5><span class="mb_gname">네이버 테이블 주문 가맹점</span> 등록 정보 입니다. <small>
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
				'name' => 'write_action', 
				'id' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>
	<?php $mb_gcode=$this->input->cookie('mb_gcode', TRUE);

if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"||$mb_gcode=="G4"){?>
<div class="btn_area">
<!-- <button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button> -->
<div class="row">
<div class="col-sm-3">
<select name="" id="first_process" onchange="javascript:chg_sencond_list(this.value);" class="form-control m-b">
<option value="">첫 번째 진행 단계를 선택해 주세요.</option>
<option value="fr_submit">서류접수</option>
<option value="fr_install">설치</option>
<option value="fr_1st_payment">1차지급</option>
<option value="fr_2nd_payment">2차지급</option>
</select>
</div>
<div class="col-sm-3">
<select name="" id="seconde_process" onchange="javascript:chg_list(this.value);" class="form-control m-b" disabled>
<option value="">첫 번째 먼저 선택해 주세요.</option>
<option value="wait">대기</option>
<option value="order">접수</option>
<option value="installing">설치중</option>
<option value="decision_in_process">심사중</option>
<option value="withhold">보류</option>
<option value="complete">완료</option>
</select>
</div>
</div>
<script>
function chg_sencond_list(v)
{
//	alert(v);
var obj = {};
obj['fr_submit'] = {'wait':'대기','order':'접수','decision_in_process':'심사중','withhold':'보류','complete':'완료'};
obj['fr_install'] = {'wait':'대기','in_progress':'진행중','withhold':'보류','complete':'완료'};
obj['fr_1st_payment'] = {'wait':'대기','decision_in_process':'심사중','withhold':'보류','complete':'완료'};
obj['fr_2nd_payment'] = {'wait':'대기','decision_in_process':'심사중','withhold':'보류','complete':'완료'};

var object = [];
var is_option = v=="";

object.push('<option value="">두 번째 진행 단계를 선택해 주세요.</option>');


if(!is_option)
	{
for (const [key, value] of Object.entries(obj[v])) {
  object.push('<option value="'+key+'">'+value+'</option>');
}
$("#seconde_process").html(object.join(""));
$("#seconde_process").attr('disabled', false);	
	}else{

$("#seconde_process").html('<option value="">첫 번째 먼저 선택해 주세요.</option>');
$("#seconde_process").attr('disabled', true);	

	}

}

            $(document).ready(function () {
                $('.i-checks').iCheck({
                    checkboxClass: 'icheckbox_square-green',
                    radioClass: 'iradio_square-green',
                });
            });
</script>

</div><!-- .btn_area -->
<?php }?>
<div class="table-responsive">
<table cellspacing="0" cellpadding="0" class="table table-striped">
<thead>
<tr>
	<th scope="col">
					<div class="checkbox checkbox-primary">
	<input type="checkbox" name="chk_all" id="chk_all"  onclick="checkAll('write_action');chk_btn_status()"><label for="chk_all"></label></div></th>
	<th scope="col">No</th>
	<th scope="col">코드</th>
	<th scope="col">상호</th>
	<th scope="col">아이디 / 이메일 / POS</th>
	<th scope="col">서류접수</th>
	<th scope="col">설치</th>
	<th scope="col">1차지급</th>
	<th scope="col">2차지급</th>
	<th scope="col">등록일자</th>
	<th scope="col">비고</th>
</tr>
</thead>
<?php
//print_r($st_count);


if(count($list)==0){
echo "<tr><td colspan='12' style='text-align:center'>등록된 `네이버 테이블 가맹점`이 없습니다. </td>";
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
//$pv_no = array_column($codes, 'pv_no');
function get_code_status($codes,$pv_code,$mb_no)
{
	$return_value ='<button type="button" class="btn btn-default btn-xs">대기</button>';

	$status = array();
	$status['wait'] = '<button type="button" class="btn btn-default btn-xs">대기</button>';
	$status['order'] = '<button type="button" class="btn btn-danger btn-xs">접수</button>';
	$status['installing'] = '<button type="button" class="btn btn-danger btn-xs">설치중</button>';
	$status['withhold'] = '<button type="button" class="btn btn-warning btn-xs">보류</button>';
	$status['complete'] = '<button type="button" class="btn btn-primary btn-xs">완료</button>';
	$status['in_progress'] ='<button type="button" class="btn btn-danger btn-xs">진행중</button>';
	$status['decision_in_process'] = '<button type="button" class="btn btn-danger btn-xs">심사중</button>';

	foreach ($codes as $cd)
	{
		if($pv_code=="4005"&&$cd['pv_no']==$mb_no&&$cd['pv_code']==$pv_code){
			$return_value=$cd['pv_value'];
		}else if($cd['pv_no']==$mb_no&&$cd['pv_code']==$pv_code){
			//echo $cd['pv_value'];
			$return_value=$status[$cd['pv_value']];
		}
	}


	return $return_value;
}


foreach ($list as $lt)
{
	$mb_no = $lt->mb_no;
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
$external_link=sprintf("/prq/%s/view/%s/mb_no/%s/page/%s",$this->uri->segment(1),$this->uri->segment(3),$mb_no,$page);

?>
<tr>
	<td scope="col">
				<div class="checkbox checkbox-primary"> 
	<input type="checkbox" name="chk_seq[]" value="<?php echo $mb_no;?>" onclick="chk_btn_status(this)"
	id="chk_<?php echo $mb_no;?>"><label for="chk_<?php echo $mb_no;?>"></label></div>
	</td>
	<td scope="row"><?php echo $lt->mb_no;?></td>
	<td><?php echo $sub_ds_name;?> &gt; <?php echo $sub_pt_name;?></td>
	<td scope="row"><?php echo $lt->mb_name;?></td>
	<td scope="row"><a rel="external" href="<?php echo $external_link;?>"><?php echo $lt->mb_id;?> / <?php echo $lt->mb_email;?> / 
	<?php echo get_code_status($codes,"4005",$mb_no);?>
	</a></td>
<td>
<span id="fr_submit_<?php echo $mb_no;?>"><?php echo get_code_status($codes,"4001",$mb_no);?></span>
</td>
<td>
<span id="fr_install_<?php echo $mb_no;?>"><?php echo get_code_status($codes,"4002",$mb_no);?></span>
</td>
<td>
<span id="fr_1st_payment_<?php echo $mb_no;?>"><?php echo get_code_status($codes,"4003",$mb_no);?></span>
	</td>
	<!-- <td><span id="status_<?php echo $lt->mb_no;?>"><?php echo $controllers->get_status($lt->mb_status);?></span></td> -->
<td>
<span id="fr_2nd_payment_<?php echo $mb_no;?>"><?php echo get_code_status($codes,"4004",$mb_no);?></span>
	</td>
	<td><?php echo date("Y-m-d",strtotime($lt->mb_datetime));?></td>
	<td>-</td>
</tr>
<?php
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
<!-- <button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button> -->

</div><!-- .btn_area -->
<?php }?>
</div>
</div>
</div>
<div class="row"><div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">쓰기</a></div></div>
</article>