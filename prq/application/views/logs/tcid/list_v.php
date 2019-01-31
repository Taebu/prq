<?php
 /***********************************
 *
 * /prq/application/views/logs/cid/list_v.php
 * 
 ***********************************
  * string_format
 ***********************************/
 function string_format($format, $string, $placeHolder = "#")
 {
 	$numMatches = preg_match_all("/($placeHolder+)/", $format, $matches);
 	foreach ($matches[0] as $match)
 	{
 		$matchLen = strlen($match);
 		$format = preg_replace("/$placeHolder+/", substr($string, 0, $matchLen), $format, 1);
 		$string = substr($string, $matchLen);
 	}
 	return $format;
 }
 
 
 //phone regex http://blog.acronym.co.kr/243
 function phone_format($num){
 	return preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$1-$2-$3",$num);

 }
 ?>

	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/logs/lists/cid/q/'+$("#gc_receiver").val()+'/page/1';
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
		
		/*cid를 검색합니다.*/
		function search_form(p,type){
			$("#page").val(p);
			if(type=="search"){
			var act = '/prq/logs/lists/cid/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/logs/lists/cid/page/'+p;
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
                            <h5>CID LOG 현황 입니다. <small>콜 정보를 조회해 주세요.</small></h5>
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
						<?php 
						$my_search = array_filter($search);$count_search= count($my_search);
						/*  */
						if($count_search>0){?>
						<div class="row">
						검색한 값 "<?php echo join("\",\"",$my_search);?>" 결과 입니다.</div>
						<?php }?>
	<div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title">이메일</label>
                <input class="form-control" id="cd_id" name="cd_id" size="30" type="text" value="<?php echo $search['cd_id'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="cd_name">상점명</label>
                <input class="form-control" id="cd_name" name="cd_name" required="true" size="30" type="text" value="<?php echo $search['cd_name'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="cd_callerid">수신인</label>
                <input class="form-control" id="cd_callerid" name="cd_callerid" size="30" type="text"  value="<?php echo $search['cd_callerid'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname"><span class="mb_gname">총판</span>ID</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" OnKeyDown="javascript:board_search_enter();" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for="user_email"><span class="mb_gname">총판</span> 목록</label>
                <input class="form-control required email" id="user_email" name="user[email]" required="true" size="30" type="text"  OnKeyDown="javascript:board_search_enter();"/>
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
			function get_state($v)
			{
				$str[0]="미발신";
				$str[1]="발신";
				$str[2]="일반번호";
				$str[3]="수신거부";
				$str[4]="150건초과";
				$str[5]="업소누락";
				$str[6]="정보부족";
				$str[7]="중복전송제한";
				return $str[$v];
			}
			
			$attributes = array(
				'class' => 'form-horizontal', 
				'id' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);


		?>
	<div class='col-sm-12'>
	<pre>
1: 미처리, 
2: 배달대행 요청(웹서버), 
3: 배달대행 동기화 완료 <의미 없을 듯>
4: 배달대행 요청중(PC에서 최강배달에 배달대행 요청중), 
5: 배송접수완료, 
6: 보류, 
7: 자동보류, 
8: 보류(웹서버), 
11: 접수요청중 오류, 

22: 삭제요청(웹서버) <이미 배달접수/취소/배달취소중오류 가 완료된 것은 삭제 불가능>
23: 삭제동기화 완료 <의미 없을 듯>
24: 삭제요청(PC에서 삭제된 경우) (22값을 수신받은 경우 처리이기도 함)

32: 삭제된 항목 복원 ()

87: 배송취소요청(웹서버), 
88: 배송취소동기화 완료 <의미 없을 듯>
89: 배송취소요청접수(PC에서 최강배달에 취소 요청중), 

90: 배송취소완료
91: 배송취소중 오류

	</pre>
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
<th>bt_no</th>
<th>전문유효성검사. 년도-월. 허용치 +-1, +-12</th>
<th>요청구분.</th>
<th>외부시스템 연계 키</th>
<th>mac address (kwjang. 9월21일추가)</th>
<th>가맹점Id</th>
<th>판매금액</th>
<th>결제방법코드</th>
<th>고객전화번호</th>
<th>배달 상품종류코드</th>
<th>가맹점 전달사항</th>
<th>지연시간. 분단위</th>
<th>라이더 배정후 조리시작 지연시간. 분단위</th>
<th>시/도</th>
<th>시/군/구</th>
<th>도로명 주소인지 여부</th>
<th>- </th>
<th>지번</th>
<th>도로명</th>
<th>건물번호</th>
<th>건물명</th>
<th>상세주소</th>
<th>위도</th>
<th>경도</th>
<th>배달번호</th>
<th>배달상태</th>
<th>입력일시</th>
<th>변경일시</th>
<th>취소일시</th>
</tr>
<tr>
<th>bt_no</th>
<th>bt_check</th>
<th>bt_method</th>
<th>bt_outersystemkey</th>
<th>bt_mac</th>
<th>bt_agencyid</th>
<th>bt_price</th>
<th>bt_approvaltype</th>
<th>bt_customerphone</th>
<th>bt_goodscode</th>
<th>bt_memo</th>
<th>bt_delay</th>
<th>bt_afterassigndelay</th>
<th>bt_city</th>
<th>bt_county</th>
<th>bt_roadaddressyn</th>
<th>bt_town</th>
<th>bt_jibun</th>
<th>bt_road</th>
<th>bt_buildingno</th>
<th>bt_buildingname</th>
<th>bt_detailaddr</th>
<th>bt_lat</th>
<th>bt_long</th>
<th>bt_bnum</th>
<th>bt_state</th>
<th>bt_print</th>
<th>bt_datetime</th>
<th>bt_modifydate</th>
<th>bt_canceldate</th>
</tr>
</thead>
<tbody>
<?php
/*리스트가 없으면 없는 값 출력*/
if(count($list)==0){
?>
<tr><td scope="row" colspan='11' class='text-center'> 조회한 TCID Log가 없습니다.</td></tr>
<?php
}
foreach ($list as $lt)
{
?>
<tr>
<td scope="row"><?php echo $lt->bt_no;?></td>
<td scope="row"><?php echo $lt->bt_check;?></td>
<td scope="row"><?php echo $lt->bt_method;?></td>
<td scope="row"><?php echo $lt->bt_outersystemkey;?></td>
<td scope="row"><?php echo $lt->bt_mac;?></td>
<td scope="row"><?php echo $lt->bt_agencyid;?></td>
<td scope="row"><?php echo $lt->bt_price;?></td>
<td scope="row"><?php echo $lt->bt_approvaltype;?></td>
<td scope="row"><?php echo $lt->bt_customerphone;?></td>
<td scope="row"><?php echo $lt->bt_goodscode;?></td>
<td scope="row"><?php echo $lt->bt_memo;?></td>
<td scope="row"><?php echo $lt->bt_delay;?></td>
<td scope="row"><?php echo $lt->bt_afterassigndelay;?></td>
<td scope="row"><?php echo $lt->bt_city;?></td>
<td scope="row"><?php echo $lt->bt_county;?></td>
<td scope="row"><?php echo $lt->bt_roadaddressyn;?></td>
<td scope="row"><?php echo $lt->bt_town;?></td>
<td scope="row"><?php echo $lt->bt_jibun;?></td>
<td scope="row"><?php echo $lt->bt_road;?></td>
<td scope="row"><?php echo $lt->bt_buildingno;?></td>
<td scope="row"><?php echo $lt->bt_buildingname;?></td>
<td scope="row"><?php echo $lt->bt_detailaddr;?></td>
<td scope="row"><?php echo $lt->bt_lat;?></td>
<td scope="row"><?php echo $lt->bt_long;?></td>
<td scope="row"><?php echo $lt->bt_bnum;?></td>
<td scope="row"><?php echo $lt->bt_state;?></td>
<td scope="row"><?php echo $lt->bt_print;?></td>
<td scope="row"><?php echo $lt->bt_datetime;?></td>
<td scope="row"><?php echo $lt->bt_modifydate;?></td>
<td scope="row"><?php echo $lt->bt_canceldate;?></td>
</tr>
<?php
}
?>

</tbody>
<tfoot>
<tr>
<th colspan="12" style="text-align:left">

<?php
if($mb_gcode=="G1")
{
?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button></div><!-- .btn_area -->
<?php 
}
?></th>
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