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

		/* onload */
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
//					var act = '/prq/store/lists/ci_board/q/'+$("#q").val()+'/page/1';
					var act = '/prq/store/lists/prq_ata_pay/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});

			/*버튼 비활성화.*/
			chk_btn_status();
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
			}else if(s=="expire"){
				result="만료";
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
<?php echo form_open('/store/lists/prq_ata_pay/', array('id'=>'bd_search', 'class'=>'well form-search'));?>
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
            <div class='form-group'>
                <label for="prq_fcode">풀코드</label>
                <input class="form-control" id="prq_fcode" name="prq_fcode" size="30" type="text" value="<?php echo $search['prq_fcode'];?>" OnKeyDown="javascript:board_search_enter();"/>
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
<pre>
[ 2018-04-13 (금) 17:02:15  ]
신규 상점 등록 시 반드시 실행해 줄것!!! 
http://prq.co.kr/prq/ajax/make_store

미실행시 전송 되지 않을 수 있다.
</pre>
    <?php 
			$attributes = array(
				'class' => 'form-horizontal', 
				'id' => 'write_action',
				'name' => 'write_action'
			);

			echo form_open('//write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>

<?php 



function get_status_ata_pay($s)
{
	$result="";
	$status=array();
	$status[]=array('status'=>'success','name'=>"정상");
	$status[]=array('status'=>'warning','name'=>"중지");
	$status[]=array('status'=>'danger','name'=>"해지");
	$status[]=array('status'=>'info','name'=>"만료");

	if($s=="join"){
		$result=$status[0];
	}else if($s=="stop"){
		$result=$status[1];
	}else if($s=="terminate"){
		$result=$status[2];
	}else if($s=="expire"){
		$result=$status[3];
	}
	return $result;
}

	
	 
	


$join_cnt=$expire_cnt=$stop_cnt=$terminate_cnt=0;

/* cookie에서 멤버 gcode 불러 오기 */
foreach($group_cnt as $gc)
{
	${$gc['ap_status']."_cnt"}=$gc['cnt'];

}

$mb_gcode=$this->input->cookie('mb_gcode', TRUE);

if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"||$mb_gcode=="G4"){?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('join');">정상 <?php echo $join_cnt;?></button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('stop');">중지 <?php echo $stop_cnt;?></button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('terminate');">해지 <?php echo $terminate_cnt;?></button>
<button type="button" class="btn btn-sm btn-info">만료 <?php echo $expire_cnt;?></button></div><!-- .btn_area -->
<?php }?>
<div class="row"><div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">등록</a></div></div>
<div class="table-responsive">
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
<th scope="col">입력일</th>
<th scope="col">코드</th>
<th scope="col">자동출금일</th>
<th scope="col">상점명</th>
<th scope="col">충전금액</th>
<th scope="col">결재구분</th>
<th scope="col">월발송건</th>
<th scope="col">예약발송</th>
<th scope="col">상태</th>
</tr>
</thead>
<tbody>
<?php
//print_r($pt_code);

foreach ($list as $lt)
{


//$list['location']=$json['agency'][array_search($list['biz_code'],$keys)]['location'];

$billtm=strtotime($lt->ap_autobill_date);
$st_dt=date("y-m-d",$billtm);
$autobill_date=date("d",$billtm);
$ap_autobill_YN=$lt->ap_autobill_YN=="Y"?"정기결재":"일시결재";
$ap_status=get_status_ata_pay($lt->ap_status);
$ap_status=sprintf('<button type="button" id="status_%s" class="btn btn-%s btn-xs">%s</button>',$lt->ap_no,$ap_status['status'],$ap_status['name']);
$ap_reserve=$lt->ap_reserve=="0"?"즉시발송":$lt->ap_reserve."분";
$view_url=sprintf("/prq/atapay/view/%s/ap_no/%s/page/%s",$this->uri->segment(3),$lt->ap_no,$page);
$prq_fcode=substr($lt->prq_fcode,0,12);
$code_name=$pt_code[$prq_fcode];

$ata_yn=$store[$lt->st_no];
$is_ata=$ata_yn=="Y";
$ata_status=$is_ata?"success":"danger";
$store_url=sprintf("/prq/store/modify/prq_store/st_no/%s/page/1",$lt->st_no);

?>
	<tr>
		<td scope="col">
		<div class="checkbox checkbox-primary"><input type="checkbox" name="chk_seq[]" onclick="chk_btn_status()" id="<?php printf("chk_%s",$lt->ap_no);?>" value="<?php echo $lt->ap_no;?>"><label for="<?php printf("chk_%s",$lt->ap_no);?>"></label></div>
		</td>
 		<td><?php echo $st_dt;?></td>
 		<td><?php echo $lt->ap_datetime;?></td>
 		<td><?php echo $code_name;?></td>
 		<td><?php printf("매월 %s일 ",$autobill_date);?></td>
		<td><a rel="external" href="<?php echo $view_url;?>"><?php echo $lt->st_name;?></a>
		<a rel="external" href="<?php echo $store_url;?>"><?php printf('<button type="button" class="btn btn-%s btn-xs">%s</button>',$ata_status,$store[$lt->st_no]);?></a>
		</td>
		<td><?php echo number_format($lt->ap_price)."원";?></td>
<!-- 		<td><?php echo $lt->prq_fcode;?></td> -->
		<td><?php echo $ap_autobill_YN;?></td>
		<td><?php printf("%s / %s건",$lt->ap_limit_cnt,number_format($lt->ap_limit));?></td>
		<td><?php echo $ap_reserve;?> </td>
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
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('join');">정상 <?php echo $join_cnt;?></button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('stop');">중지 <?php echo $stop_cnt;?></button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('terminate');">해지 <?php echo $terminate_cnt;?></button>
<button type="button" class="btn btn-sm btn-info">만료 <?php echo $expire_cnt;?></button>
</div><!-- .btn_area -->
<?php }?>
</div>
</div>
</div>
<div class="row"><div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">등록</a></div></div>
</article>