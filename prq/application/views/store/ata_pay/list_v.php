<?php
/**
* 상점 리스트 뷰 페이지
* file : /prq/application/views/store/list_v.php
* 작성 : 2015-03-05 (목)
* 수정 : 2016-04-27 (수)
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/

/* 싱크 상점 불러 오기 */
$tt_no = array_column($sync_store, 'tt_no');
$tt_no=array_unique($tt_no);

?>
<style type="text/css">
table tr.green:nth-child(2n+1){
	background-color: #aed994;
}
table tr.green:nth-child(2n){
	background-color: #4ad994;
}
</style>

<script type="text/javascript">
var tt_nos=[<?php echo join(",",$tt_no);?>];
//console.log(tt_nos);

		/* onload */
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
//					var act = '/prq/store/lists/ci_board/q/'+$("#q").val()+'/page/1';
					var act = '/prq/store/lists/prq_store/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});

			/*버튼 비활성화.*/
			chk_btn_status();
			for(var i in tt_nos){
				//console.log(tt_nos[i]);
				$("#ttno_"+tt_nos[i]).html('<i class="fa fa-refresh  text-success"></i>');
			}
		});


		function get_status(s)
		{
			var result="";

			if(s=="join"){
				result="정상";
			}else if(s=="stop"){
				result="중지";
			}else if(s=="terminate"){
				result="해지";
			}
			return result;
		}

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/store/write/prq_ata_pay/page/1");
    $("#bd_search").submit();		
		
		}

		/* 리스트 상태를 변경, 로그를 기록 합니다. */
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
		

		String.prototype.toKorChars = function() {
    var cCho  = [ 'ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ' ],
        cJung = [ 'ㅏ', 'ㅐ', 'ㅑ', 'ㅒ', 'ㅓ', 'ㅔ', 'ㅕ', 'ㅖ', 'ㅗ', 'ㅘ', 'ㅙ', 'ㅚ', 'ㅛ', 'ㅜ', 'ㅝ', 'ㅞ', 'ㅟ', 'ㅠ', 'ㅡ', 'ㅢ', 'ㅣ' ],
        cJong = [ '', 'ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ' ],
        cho, jung, jong;

    var str = this,
        cnt = str.length,
        chars = [],
        cCode;

    for (var i = 0; i < cnt; i++) {
        cCode = str.charCodeAt(i);
        
        if (cCode == 32) { continue; }

        // 한글이 아닌 경우
        if (cCode < 0xAC00 || cCode > 0xD7A3) {
            chars.push(str.charAt(i));
            continue;
        }

        cCode  = str.charCodeAt(i) - 0xAC00;

        jong = cCode % 28; // 종성
        jung = ((cCode - jong) / 28 ) % 21 // 중성
        cho  = (((cCode - jong) / 28 ) - jung ) / 21 // 초성

        chars.push(cCho[cho], cJung[jung]);
        if (cJong[jong] !== '') { chars.push(cJong[jong]); }
    }

    return chars;
}

function is_jong(str)
{
	var chk_jong=str.toKorChars();
	var index=chk_jong.length-1;
	var cJong = ['ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ','1','3','6','7','8' ];
	var a = cJong.indexOf(chk_jong[index]);
	var result=a>-1;
	return result;
}

		/* 리스트 상태를 변경, 로그를 기록 합니다. */
		function swal_status(code)
		{
			var status=get_status(code);
			var key="";
			key=is_jong(status)?status+"\"으로":status+"\"로";
			swal({
				title: "사유를 기입해 주세요.",
				text: "해당 리스트를 \""+key+" 변경 됩니다.<br> 진행 하시겠습니까?<br>변경 사유를 작성해 주세요.",
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
				//if (inputValue === false) return false;
				if(!inputValue){
					swal("취소!", "취소 하였습니다.", "error");
					return false;
				}

				if ( $.trim(inputValue).length<3) {
				  swal.showInputError("3자이상 사유를 적어 주세요. 공백은 인정하지 않습니다.");
				  return false
				}

				var param=$("#write_action").serialize();
				param=param+"&mb_status="+code;
				/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
				param=param+"&mb_reason="+inputValue;
				console.log(param);
				$.ajax({
				url:"/prq/ajax/chg_status/prq_ata_pay",
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
					}
				});

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

/*
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">완료</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">1,2개 미흡</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">설치실패</button>
*/

		

	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">

    <div class='row'>
<?php echo form_open('/prq/store/lists/prq_store/', array('id'=>'bd_search', 'class'=>'well form-search'));?>
<!--form id="bd_search" method="post" class="well form-search" -->

<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="ST">
		<!-- id="my-awesome-dropzone" class="" -->
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>알림톡 결재 리스트 정보 입니다. <small>검색 정보를 작성해 주세요.</small></h5>
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
                <label for="st_name">상점명</label>
                <input class="form-control" id="st_name" name="st_name" size="30" type="text" value="<?php echo $search['st_name'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="mb_id">아이디</label>
                <input class="form-control" id="mb_id" name="mb_id" required="true" size="30" type="text" value="<?php echo $search['mb_id'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="prq_fcode">풀코드</label>
                <input class="form-control" id="prq_fcode" name="prq_fcode" size="30" type="text" value="<?php echo $search['prq_fcode'];?>" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <!--<div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname"><span class="mb_gname">총판</span>ID</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" OnKeyDown="javascript:board_search_enter();"/>
            </div><!-- .form-group -->
        <!--</div><!-- .col-sm-6 -->
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
				'id' => 'write_action',
				'name' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>

<?php 



function get_status3($s)
{
	$result="";
	$status=array();
	$status[]=array('status'=>'success','name'=>"정상");
	$status[]=array('status'=>'warning','name'=>"중지");
	$status[]=array('status'=>'danger','name'=>"해지");

	if($s=="join"){
		$result=$status[0];
	}else if($s=="stop"){
		$result=$status[1];
	}else if($s=="terminate"){
		$result=$status[2];
	}
	return $result;
}

	
	 
	



/* cookie에서 멤버 gcode 불러 오기 */
foreach($group_cnt as $gc)
{
	${$gc['st_status']."_cnt"}=$gc['cnt'];

}

$mb_gcode=$this->input->cookie('mb_gcode', TRUE);

if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"||$mb_gcode=="G4"){?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('join');">정상 <?php echo $wa_cnt;?></button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('stop');">중지 <?php echo $pr_cnt;?></button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('terminate');">해지 <?php echo $ac_cnt;?></button></div><!-- .btn_area -->
<?php }?>
<div class="table-responsive">
<?php 
		$mb_pcode=$this->input->cookie('mb_pcode', TRUE);
		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		$mb_gcode=$this->input->cookie('mb_gcode', TRUE);
//echo $mb_pcode;echo $prq_fcode;echo $mb_gcode;
		?>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col">
					<div class="checkbox checkbox-primary">
						<input type="checkbox" name="chk_all" id="chk_all" onclick="checkAll('write_action');chk_btn_status()">
						<label for="chk_all"></label>
					</div>
					</th>
					<th scope="col">시작일</th>
					<th scope="col">자동출금일</th>
					<th scope="col">상점명</th>
					<th scope="col">충전금액</th>
					<th scope="col">결재구분</th>
					<th scope="col">월발송건</th>
					<th scope="col">상태</th>
				</tr>
			</thead>
			<tbody>
<?php
//print_r($fr_names);
//print_r($pt_names);

/* 총팡 코드명 불러 오기 */
$ds_code = array_column($ds_names, 'ds_code');
$ds_name = array_column($ds_names, 'ds_name');

/* 대리점 코드명 불러 오기 */
$pt_code = array_column($pt_names, 'pt_code');
$pt_name = array_column($pt_names, 'pt_name');


//print_r($pt_code);
//print_r($pt_name);


$st_origin = json_decode(json_encode($st_origin), True);
$pv_no = array_column($st_origin, 'pv_no');


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
$index=array_search($lt->st_no, $pv_no);
$billtm=strtotime($lt->ap_autobill_date);
$st_dt=date("y-m-d",$billtm);
$autobill_date=date("d",$billtm);
$ap_autobill_YN=$lt->ap_autobill_YN=="Y"?"정기결재":"1회 출금";
$ap_status=get_status3($lt->ap_status);
$ap_status=sprintf('<button type="button" id="status_%s" class="btn btn-%s btn-xs">%s</button>',$lt->ap_no,$ap_status['status'],$ap_status['name']);

?>
	<tr>
		<td scope="col">
		<div class="checkbox checkbox-primary"><input type="checkbox" name="chk_seq[]" onclick="chk_btn_status()" id="<?php printf("chk_%s",$lt->ap_no);?>" value="<?php echo $lt->ap_no;?>"><label for="<?php printf("chk_%s",$lt->ap_no);?>"></label></div>
		</td>
 		<td><?php echo $st_dt;?></td>
 		<td><?php printf("매월 %s일 ",$autobill_date);?></td>
		<td><?php echo $lt->st_name;?> </td>
		<td><?php echo number_format($lt->ap_price)."원";?></td>
<!-- 		<td><?php echo $lt->prq_fcode;?></td> -->
		<td><?php echo $ap_autobill_YN;?></td>
		<td><?php echo number_format($lt->ap_price/10)."건";?></td>
		<td><?php echo $ap_status;?></td>
	</tr>
<?php
}

if(!$list){
echo "<tr><td colspan=9 style='text-align:center'>알림톡 입금 리스트가 존재 하지 않습니다.</td></tr>";
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
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('join');">정상 <?php echo $wa_cnt;?></button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('stop');">중지 <?php echo $pr_cnt;?></button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('terminate');">해지 <?php echo $ac_cnt;?></button>
</div><!-- .btn_area -->
<?php }?>
</div>
</div>
</div>
<div class="row"><div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">쓰기</a></div></div>
</article>