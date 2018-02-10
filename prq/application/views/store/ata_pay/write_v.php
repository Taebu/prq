<!-- D:\Share\04.Paid_PG\products-WB0R5L90S\Static_Full_Version\form_advanced.html -->
<script src="/prq/include/js/mysql/prq_store.js" type="text/javascript"></script>
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>알림톡 결재 등록</h2>
<ol class="breadcrumb">
<li><a href="/prq/">Home</a></li>
<li><a>상점 관리</a></li>
<li class="active"><strong>알림톡 입금 등록</strong></li></ol>
</div><!-- .col-lg-10 -->
<div class="col-lg-2"></div><!-- .col-lg-2 -->
</div><!-- .row wrapper border-bottom white-bg page-heading -->
<div class="wrapper wrapper-content animated fadeInRight">
<?php 
$attributes = array(
'class' => 'form-horizontal', 
'id' => 'write_action',
'onsubmit'=>'return set_atapay();'
);
echo form_open('/store/write/prq_ata_pay', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
$prq_fcode=$this->input->cookie('prq_fcode',TRUE);
$mb_gcode=$this->input->cookie('mb_gcode',TRUE);

echo $prq_fcode;
?>
<div class="form-group">
<div class="col-sm-10 ">
<input type="text" name="st_name" id="st_name">
</div></div>
<input type="hidden" name="mb_gcode" id="mb_gcode" value="<?php echo $mb_gcode;?>">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="mb_pcode" id="mb_pcode" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="ds_code" id="ds_code" value="<?php echo @$this->input->cookie('prq_fcode',TRUE);?>">


<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>알림톡 입금등록 <small>알림톡 전송시 입금할 상품을 작성해 주세요.</small></h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li>
	</ul>
	<a class="close-link"><i class="fa fa-times"></i></a>
	</div></div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">가맹점선택 </label>
<div class="col-sm-10"><select name="prq_fcode" id="prq_fcode" class="select2_demo_1 form-control" onchange="get_store_info(this.value)"></select> 
<span class="help-block m-b-none">상점을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">매장명 </label>
<div class="col-sm-10">
<select name="st_no" id="st_no" class="select2_demo_1 form-control" onchange="javascript:set_name()"><option value="">가맹점 먼저 선택 해주세요.</option></select><!-- #st_name -->
<span class="help-block m-b-none">가맹점을 선택 후 매장명을 선택해 주세요. <br>
<a href="javascript:make_js()" class="btn btn-primary">매장정보 갱신</a>
<a class="btn btn-danger">주의 !!!</a> 목록에 없을 경우만 사용하세요.
</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">충전금액</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="ap_price" id="ap_price_1" value='10000' checked><label for="ap_price_1">10,000원</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="ap_price" id="ap_price_2"  value='20000'><label for="ap_price_2">20,000원</label>
</div><!-- .radio .radio-info .radio-inline -->
 <span class="help-block m-b-none">- 10,000원 충전은 월10,000건 발송 </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">결제구분</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="ap_autobill_yn" id="ap_autobill_yn_1" value='Y' checked><label for="ap_autobill_yn_1">정기결제(충전)</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="ap_autobill_yn" id="ap_autobill_yn_2"  value='N' ><label for="ap_autobill_yn_2">일시결제</label>
</div><!-- .radio .radio-info .radio-inline -->
 <span class="help-block m-b-none">- 정기 결제시 매월 출금일로 부터 자동 출금(CMS) 합니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">출금일</label>
<div class="col-sm-10">
<div class="form-group" id="data_1">
<div class="input-group date">
<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="ap_autobill_date" id="ap_autobill_date" value="<?php echo date("Y-m-d");?>">
</div>
</div>
<span class="help-block m-b-none">1. 17일을 선택 시 매월 17일 날 출금(충전) 됩니다.<br>
2. 충전 이후 잔여 개수는 초기화 됩니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">상태</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="ap_status" id="ap_status_1" value='join' checked><label for="ap_status_1">정상</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="ap_status" id="ap_status_2"  value='stop'><label for="ap_status_2">중지</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="ap_status" id="ap_status_3"  value='terminate'><label for="ap_status_3">해지</label>
</div><!-- .radio .radio-info .radio-inline -->

 <span class="help-block m-b-none">- 정기 결제시 매월 입금로 부터 자동 출금(CMS) 합니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="form-group"><label class="col-sm-2 control-label">예약발송</label>
<div class="col-sm-10 ">
<div class="radio radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_1" value='0' checked><label for="ap_reserve_1">즉시발송</label>
</div><!-- .radio .radio-success .radio-inline -->
<div class="radio radio-primary radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_2" value='10'><label for="ap_reserve_2">10분</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-success radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_3" value='20'><label for="ap_reserve_3">20분</label>
</div><!-- .radio .radio-danger .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_4" value='30'><label for="ap_reserve_4">30분</label>
</div><!-- .radio .radio-warning .radio-inline -->

<div class="radio radio-warning radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_5" value='40'><label for="ap_reserve_5">40분</label>
</div><!-- .radio .radio-success .radio-inline -->

<div class="radio radio-danger radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_6" value='50'><label for="ap_reserve_6">50분</label>
</div><!-- .radio .radio-success .radio-inline -->

<div class="radio radio-primary radio-inline">
<input type="radio" name="ap_reserve" id="ap_reserve_7" value='60'><label for="ap_reserve_7">60분</label>
</div><!-- .radio .radio-success .radio-inline -->
<span class="help-block m-b-none">- CID로그 기준으로 알림톡 발송 시간을 설정합니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="col-md-12">
<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div><!-- .controls -->

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button class="btn btn-primary" type="submit">저장</button>
<!-- <button type="submit" class="btn btn-primary" id="write_btn">작성</button> -->
<!-- <button type="submit" class="btn btn-primary" id="write_btn">작성 실제 적용</button> -->
<button class="btn btn-white" type="reset">취소</button>

<!-- <button class="btn btn-primary" type="button" onclick="set_ds()">파람...</button> -->
<!-- <textarea id="form_data"  class="form-control" rows="4" cols="50">#form_data</textarea> --><!-- #form_data -->
</div></div>
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->






</div><!-- .wrapper .wrapper-content .animated .fadeInRight -->
<script type="text/javascript">
/*
server에 <span class="mb_gname">총판</span>을 등록 합니다.
*/

var vali_names= [
        { "name":"prq_fcode", "hname":"가맹점코드" },
        { "name":"st_no", "hname":"매장명" },
        { "name":"st_name", "hname":"매장명" },
    ];

function set_atapay(){


var param=$("#write_action").serialize();
//param=param.replace(/&/gi, "\n&");

/* 배열 갯수 만큼 validate 처리 */
for(var i in vali_names){
	console.log(vali_names[i].name);
if($("[name="+vali_names[i].name+"]").val()=="")
{

	$("[name="+vali_names[i].name+"]").focus();
	$("[name="+vali_names[i].name+"]").parent().parent().addClass("has-error");
	toastr.error("\""+vali_names[i].hname+"\"이(가) 없습니다.");
	return false;
}
else if($("[name="+vali_names[i].name+"]").val().length>=2)
{
	$("[name="+vali_names[i].name+"]").parent().parent().removeClass("has-error");
	$("[name="+vali_names[i].name+"]").parent().parent().addClass("has-success");
}

}/* for(var i in vali_names){...} */
return true;
}

/********************************************************************************
*
*
*
*
*
*
********************************************************************************/
function set_ds(){
var param=$("#write_action").serialize();
param=param.replace(/&/gi, "\n&");
$("#form_data").html(param);
if($("#is_join").val()=="TRUE"){
$("#form_data").html(param);
//	$("#write_action").submit();
//set_member();
}
if($("#is_join").val()=="FALSE"){
$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
}
}
function chk_duplicate_id(mb_id)
{
var result=false;
$.ajax({
url:"/prq/auth/chk_id",
type: "POST",
data:"mb_id="+mb_id,
dataType:"json",
success: function(data) {
	$("#is_member").val(data.success);	
	}
});
}
/*End Dropzone*/	
var focus=0,blur=0;
function chk_vali_id(){
focus++; 
var object=[];
var mb_id=$("#mb_id").val();
chk_duplicate_id(mb_id);
if (mb_id.length<4)
{
object.push("<span  class=\"text-danger\">");
object.push("아이디 길이가 너무 적습니다. 4자 이상");
$("#is_join").val("FALSE");
//}else if ($( "#mb_id" ).val()!="erm00")	{
}else if ($("#is_member").val()){
object.push("<span  class=\"text-success\">");
object.push("\""+$( "#mb_id" ).val()+"\" 멋진 아이디네요.");
$("#is_join").val("TRUE");
}else{
object.push("<span  class=\"text-danger\">");
object.push("이미 사용중이거나 탈퇴한 아이디입니다.");	
$("#is_join").val("FALSE");
}
object.push("</span>");
$( "#mb_id_assist" ).html(object.join(""));
}


function set_member(){
var param=$("#write_action").serialize();
$.ajax({
url:"/prq/board/write/prq_member",
type: "POST",
data:param,
cache: false,
async: false,
success: function(data) {
console.log(data);
}
});		
}
function chk_btn_status()
{
	var param=$("#write_action").serialize();
//			$(".btn_area [lass*='btn-']").toggleClass("disabled",param.indexOf("chk_seq")<0).prop('disabled', param.indexOf("chk_seq")<0);
	
	if(param.indexOf("st_alltime")>0)
	{
		$("#st_open").val('00:00');
		$("#st_closed").val('24:00');
		$("#st_open").addClass("disabled").prop('disabled', true); 
		$("#st_closed").addClass("disabled").prop('disabled', true); 
	}else{
		$("#st_open").removeClass("disabled").prop('disabled', false); 
		$("#st_closed").removeClass("disabled").prop('disabled', false); 
	}
	
}
/*가맴점 코드를 불러 옵니다.*/
var pt_code="";
function get_frcode()
{
	$.ajax({
	url:"/prq/ajax/get_frcode/"+$("#ds_code").val(),
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		pt_code=data.posts;
		search_frcode();
		}
	});
}
function search_frcode()
{
	var object = [];
	var chk_max_ptcode=[];
if(pt_code===undefined){
	$("#prq_fcode").html("<option selected>사용 가능한 가맹점코드가 하나도 없습니다. 코드와 가맹점을 등록 해주세요.</option>");
}else{
	$.each(pt_code,function(key,val){
		if("DS0001"==val.pt_code){
			object.push('<option value='+val.fr_code+' selected>');
		}else{
			object.push('<option value='+val.fr_code+'>');
		}
		chk_max_ptcode.push(val.fr_code);
		object.push('['+val.fr_code+']');
		object.push(val.fr_name);
		object.push('</option>');
	});
	var result=object.join("");
	var chk_gcode=$("#mb_gcode").val();
	if(chk_gcode=="G5"){
	$("#fr_code").html(result);
	}else{
	$("#prq_fcode").html(result);
	}
}
}
var fr_mail=[];
function get_frmail()
{
	$.ajax({
	url:"/prq/ajax/get_frmail/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
			$.each(data.posts,function(key,val){
				
				fr_mail[val.prq_fcode]=val.mb_email;
			});
		}
	});
}
function get_mb_id(v){
$("#mb_id").val(fr_mail[v]);
}

/* 개선된 FOR문으로 문자열 BYTE 계산 */
function getstrbyte(string)
{
	var stringByteLength=0;
	stringByteLength = (function(s,b,i,c){
		for(b=i=0;c=s.charCodeAt(i++);b+=c>>11?2:c>>7?2:1);
		return b
	})(string);
	return stringByteLength;
}


/* 메세지 길이 */
function chk_byte(){
var str=document.getElementById("st_middle_msg").value;
console.log(str);
var bytesize=getstrbyte(str);
console.log(bytesize);
document.getElementById("bytesize").innerHTML=bytesize;
}

/* Textarea to resize based on content length */
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}



window.onload = function() {
	
	
	$( "#mb_id" ).focusout(function() {
	chk_vali_id();

	})	.blur(function() {
	blur++;
	chk_vali_id();
	});
	
	/*mb_code로 등록 정보 변경*/
	//chg_gname();
	/*24시간인지 체크*/
	chk_btn_status();
	
	/*멀티 셀렉트 구현 chosen-select */
	$(".chosen-select").chosen();
	
	var code=$("#prq_fcode").val();
	
	get_frcode(code);
	
	get_frmail();

	//chk_byte();
	/* datepicker */
	$('#data_1 .input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			language: 'kr',
			format:'yyyy-mm-dd'
	});
	/*select chosen */
	$(".select2_demo_1").select2();
	
	/* 매장 정보 검색 하여 가져오기 */
	//get_store_info("");
};/*window.onload = function() {..}*/


function set_top_msg(v){
$("#st_top_msg").val("(광고) [ "+v+" ] 에서");
}

function get_store_info(key)
{
	var is_key=false;

	if(key.length>0){
	is_key=true;
	}
	
	let object=[];
	var key_index=0;
	$("#st_no").val(null).trigger('change.select2');
	for(var i in store.store)
	{
		var n = store.store[i].prq_fcode.indexOf(key)>-1;
		if(n)
		{
			if(key_index==0&&is_key)
			{
			 object.push("<option value='"+store.store[i].st_no+ "' selected>");
			 
				
			 key_index++;
			}else{
			 object.push("<option value='"+store.store[i].st_no+ "'>");
			}
			 object.push(store.store[i].st_name);
			 object.push("</option>");
		}
	}

	
	if(key_index==0){
		/* 등록된 매장이 하나도 없습니다.*/
		$("#st_no").html("<option value='' selected>등록된 매장이 하나도 없습니다.</option>");
	//	$("#st_name").val(null).select2('change.select2');
		$(".select2_demo_1").select2();

	}else{
		$("#st_no").html(object.join(""));
//		$("#st_name").val(null).select2('change.select2');
		$(".select2_demo_1").select2();
		set_name();
	}
	
}

function make_js()
{
	var result=false;
	$.ajax({
	url:"/prq/ajax/make_js",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		if(data.success){
			swal("성공!", "매장 리스트 생성에 성공하였습니다.", "success");
		}else{
			swal("실패!!!", "만들기에 실패하였습니다.", "error");
		}
		}
	});
}

function set_name()
{
	$("[name=st_name]").val($("#st_no option:selected").text());

}
</script>