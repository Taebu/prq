<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2><span class="mb_gname">상점</span> 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a><span class="mb_gname">상점</span>관리</a>
</li>
<li class="active">
<strong><span class="mb_gname">상점</span> 등록</strong>
</li>
</ol>
</div>
<div class="col-lg-2">

</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<?php 
$attributes = array(
'class' => 'form-horizontal', 
'id' => 'write_action'
);
echo form_open('/store/write/prq_store/board_id/', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
$prq_fcode=$this->input->cookie('prq_fcode',TRUE);
$mb_gcode=$this->input->cookie('mb_gcode',TRUE);
?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="is_member" id="is_member">
<?php if($mb_gcode=="G5"){?>
<input type="hidden" name="prq_fcode" id="prq_fcode" value="<?php echo $prq_fcode;?>">
<?php }?>
<input type="hidden" name="mb_gcode" id="mb_gcode" value="<?php echo $mb_gcode;?>">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="mb_pcode" id="mb_pcode" value="<?php echo $this->input->post('mb_code',TRUE);?>">

<input type="hidden" name="st_store_paper" id="st_store_paper">
<input type="hidden" name="st_thumb_paper" id="st_thumb_paper">
<input type="hidden" name="st_menu_paper" id="st_menu_paper">
<input type="hidden" name="st_main_paper" id="st_main_paper">

<input type="hidden" name="st_store_paper_size" id="st_store_paper_size">
<input type="hidden" name="st_thumb_paper_size" id="st_thumb_paper_size">
<input type="hidden" name="st_menu_paper_size" id="st_menu_paper_size">
<input type="hidden" name="st_main_paper_size" id="st_main_paper_size">

<input type="hidden" name="st_imgprefix" id="st_imgprefix" value="<?php echo date("Ym");?>">

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5><span class="mb_gname">상점</span> 등록 정보 입니다. <small>상점의 정보 및 계약서를 작성해 주세요.</small></h5>
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
<div class="row">

<div class="col-md-6">
<!-- <form method="get" class="form-horizontal"> -->
<div class="form-group"><label class="col-sm-2 control-label">가맹점선택 </label>
<div class="col-sm-10">
<?php if($mb_gcode=="G5"){?>
<select name="fr_code" id="fr_code" class="form-control" >
	<option value="FR0001">네네치킨(FR0001)</option>
	<option value="FR0002">네네치킨(FR0002)</option>
	<option value="FR0003">네네치킨(FR0003)</option>
	<option value="FR0004">네네치킨(FR0004)</option>
	<option value="FR0005">네네치킨(FR0005)</option>
</select>
<?php }else if($mb_gcode!="G5"){?>
<select name="prq_fcode" id="prq_fcode" class="form-control" onchange="get_mb_id(this.value)" onclick="get_mb_id(this.value)" ></select> 
<?php }?>
<span class="help-block m-b-none">가맹점을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">가맹점 아이디 </label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id" > <span class="help-block m-b-none">가맹점 아이디 입니다.. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">카테고리 선택
</label>
<div class="col-sm-10">
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
<select name="st_category" id="st_category" class="form-control" >
<option value="W01" selected>치킨</option>
<option value="W02">피자</option>
<option value="W03">중국집</option>
<option value="W04">한식/분식</option>
<option value="W05">닭발/오리/기타</option>
<option value="W06">야식/찜/탕 </option>
<option value="W07">족발/보쌈</option>
<option value="W08">일식/회/기타</option>
<option value="W09">오락/레저</option>
<option value="W10">건강/뷰티</option>
<option value="W11">꽃배달</option>
<option value="W12">병원/약국</option>
<option value="W13">집수리</option>
<option value="W14">학원</option>
<option value="W15">이사/용달/퀵</option>
<option value="W16">부동산</option>
<option value="W17">청소/파출부</option>
<option value="W18">자동차</option>
<option value="W19">컴퓨터/인터넷</option>
<option value="W20">기타</option>
<option value="W21">소셜</option>
<option value="W00">할인</option>
</select><span class="help-block m-b-none">카테고리를을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">매장 명</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_name" name="st_name"> <span class="help-block m-b-none">매장명을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">전화번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_tel" id="st_tel"> <span class="help-block m-b-none">연락처를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_email" name="st_email"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">영업시간
</label>
<div class="col-sm-5"><span class="help-block m-b-none">시작 09:00</span><input type="text" class="form-control" id="st_open" name="st_open" data-mask="99:99" disabled value="12:00">
<div class="checkbox checkbox-primary">
<input id="st_alltime"  name="st_alltime" type="checkbox" checked="" onclick="javascript:chk_btn_status();">
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-5 -->
<div class="col-sm-5"><span class="help-block m-b-none">종료 19:00</span><input type="text" class="form-control" id="st_closed" name="st_closed" data-mask="99:99" disabled value="01:00"> 
</div><!-- .col-sm-5 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">휴무일</label>
<div class="col-sm-5">
 <select data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4"  id="st_closingdate" name="st_closingdate[]">
                <option value="">Select</option>
                <option value="일요일">일요일</option>
                <option value="월요일">월요일</option>
                <option value="화요일">화요일</option>
                <option value="수요일">수요일</option>
                <option value="목요일">목요일</option>
                <option value="금요일">금요일</option>
                <option value="토요일">토요일</option>
				</select>
<span class="help-block m-b-none">휴무일을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">배달지역</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_destination" name="st_destination"> <span class="help-block m-b-none">배달 가능 구역을 작성 합니다.. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">매장소개</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_intro" id="st_intro"> <span class="help-block m-b-none">매장 소개를 간단하게 적어주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

</div><!-- .col-md-6 RightMenu-->




<div class="col-md-12">
<h3>매장 서류</h3>

<div class="form-group"><label class="col-sm-2 control-label">계약서</label>
<div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"계약서"를 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">썸네일 이미지</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"썸네일 이미지"를 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">메뉴 이미지</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone3" class="dropzone">

<div class="dz-default dz-message"></div>
</div><!-- #my-awesome-dropzone3 -->

<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"메뉴 이미지"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">대표 이미지</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone4" class="dropzone">

<div class="dz-default dz-message"></div>
</div><!-- #my-awesome-dropzone4 -->

<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"대표 이미지"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

</div>
</div><!-- .row -->

<div class="row">
<div class="form-group"><label class="col-sm-2 control-label">CID Type</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_cidtype" id="st_cidtype_1" value='ktcid' checked><label for="st_cidtype_1">ktcid</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_cidtype" id="st_cidtype_2"  value='callcid'><label for="st_cidtype_2">callcid</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .row -->

<div class="row">
<div class="form-group"><label class="col-sm-2 control-label">Theme Type</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_1" value='red' checked><label for="st_theme_1">Red</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_2" value='blue'><label for="st_theme_2">Blue</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_3" value='orange'><label for="st_theme_3">orange</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .row -->

<div class="form-group"><label class="col-sm-2 control-label">통신사(MNO)</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_1" value='SK' checked><label for="st_mno_1">SK</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_2"  value='LG'><label for="st_mno_2">LG</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_3"  value='KT'><label for="st_mno_3">KT</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">매장 번호 1</label>
<div class="col-sm-8"><input type="text" class="form-control" id="st_tel_1" name="st_tel_1"> <span class="help-block m-b-none">상점 번호를 등록 합니다. 예) 031-706-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">핸드폰 번호 1</label>
<div class="col-sm-8"><input type="text" class="form-control" id="st_hp_1" name="st_hp_1"> <span class="help-block m-b-none">연동할 핸드폰 번호를 등록 합니다. 예) 010-####-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->



<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">상단문구(고정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_top_msg">
<span class="help-block m-b-none">상단 문구 변하지 않습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">중단문구(수정)</label>
<div class="col-sm-10">
<textarea  class="form-control" name="st_middle_msg"  id="st_middle_msg" rows="4" cols="50">#form_data</textarea><!-- #form_data -->
<span class="help-block m-b-none">중단 문구 수정 원하시는 형태로 수정이 가능합니다..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">하단문구(고정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_bottom_msg"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">모두홈피 URL 주소 (수정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_modoo_url" value="http://sjhero18.moodu.at"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<!-- <button type="submit" class="btn btn-primary" id="write_btn">작성</button> -->
<button type="submit" class="btn btn-primary" id="write_btn">작성 실제 적용</button>
<button class="btn btn-white" type="reset">취소</button>

<button class="btn btn-primary" type="button" onclick="set_ds()">파람...</button>

</div><!-- .col-md-12 -->
<!-- .row -->

<!--
<div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->

<div class="row"><div class="col-md-12">
<textarea id="form_data"  class="form-control" rows="4" cols="50">#form_data</textarea><!-- #form_data -->
</div></div>
</div><!-- .col-md-6 Right Menu-->
<button class="btn btn-primary" type="button" onclick="set_ds()">저장</button>
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
/*mb_code로 등록 정보 변경*/
function chg_gname(){
	var chk_code=$("#mb_code").val();
	switch (chk_code)
	{
	case "DS":
	$(".mb_gname").html("총판");
	break;
	case "PT":
	$(".mb_gname").html("대리점");
	break;
	case "FR":
	$(".mb_gname").html("가맹점");
	break;
	}
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
		$("#st_open").addClass("disabled").prop('disabled', true); 
		$("#st_closed").addClass("disabled").prop('disabled', true); 
	}else{
		$("#st_open").removeClass("disabled").prop('disabled', false); 
		$("#st_closed").removeClass("disabled").prop('disabled', false); 
	}
	
}
/*가맴점 코드를 불러 옵니다.*/
var pt_code="";
function get_frcode(code)
{
	$.ajax({
	url:"/prq/ajax/get_frcode/"+code,
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		pt_code=data.posts;
		search_frcode("DS0003PT0001");
		}
	});
}
function search_frcode(ds_code)
{
	var object = [];
	var chk_max_ptcode=[];
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
window.onload = function() {
$( "#mb_id" ).focusout(function() {
chk_vali_id();
})
.blur(function() {
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
};/*window.onload = function() {..}*/
</script>