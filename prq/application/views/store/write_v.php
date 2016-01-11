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
echo form_open('/store/write/prq_member', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="is_member" id="is_member">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="mb_pcode" id="mb_pcode" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="mb_business_paper" id="mb_business_paper">
<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper">
<input type="hidden" name="mb_bank_paper" id="mb_bank_paper">
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
<div class="form-group"><label class="col-sm-2 control-label">가맹점선택
</label>
<div class="col-sm-10"><select name="prq_fcode" id="prq_fcode" class="form-control" >
	<option value="FR0001">네네치킨(FR0001)</option>
	<option value="FR0002">네네치킨(FR0002)</option>
	<option value="FR0003">네네치킨(FR0003)</option>
	<option value="FR0004">네네치킨(FR0004)</option>
	<option value="FR0005">네네치킨(FR0005)</option>
</select> <span class="help-block m-b-none">가맹점을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">카테고리 선택
</label>
<div class="col-sm-10"><select name="st_category" id="st_category" class="form-control" >
	<option value="W01">치킨(W01)</option>
	<option value="W02">치킨(W02)</option>
	<option value="W03">치킨(W03)</option>
	<option value="W04">치킨(W04)</option>
	<option value="W05">치킨(W05)</option>
	<option value="W06">치킨(W06)</option>
	<option value="W07">치킨(W07)</option>
	<option value="W08">치킨(W08)</option>
	<option value="W09">치킨(W09)</option>
	<option value="W10">치킨(W10)</option>
	<option value="W11">치킨(W11)</option>
</select> <span class="help-block m-b-none">카테고리를을 선택해 주세요.</span>
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
<div class="col-sm-10"><input type="text" class="form-control" id="mb_email" name="mb_email"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">영업시간
</label>
<div class="col-sm-5"><span class="help-block m-b-none">시작 09:00</span><input type="text" class="form-control" id="st_open" name="st_open" data-mask="99:99" disabled>
<div class="checkbox checkbox-primary">
<input id="st_alltime"  name="st_alltime" type="checkbox" checked="" onclick="javascript:chk_btn_status();">
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-5 -->
<div class="col-sm-5"><span class="help-block m-b-none">종료 19:00</span><input type="text" class="form-control" id="st_closed" name="st_closed" data-mask="99:99" disabled> 
</div><!-- .col-sm-5 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">휴무일</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_closingdate" name="st_closingdate"> <span class="help-block m-b-none">카테고리를을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">배달지역</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_name" name="st_name"> <span class="help-block m-b-none">매장명을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">매장소개</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_intro" id="st_intro"> <span class="help-block m-b-none">매장 소개를 간단하게 적어주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_email" name="st_email"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 RightMenu-->


<div class="col-md-12">
<h3>매장 서류</h3>

<div class="form-group"><label class="col-sm-2 control-label">대표자 명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_ceoname"> <span class="help-block m-b-none">대표자명을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">휴대폰 번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">사업자등록번호</label>
<div class="col-sm-10">
<input type="text" class="form-control" data-mask="999-99-99999" placeholder="" name="mb_business_num" id="mb_business_num">
<span class="help-block">999-99-99999</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">총판</span> 정산비율</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_exactcaculation_ratio"> <span class="help-block m-b-none">정산 비율</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
</div><!-- .col-md-12 Left Menu-->


<div class="col-md-12">

<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
<div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message">사업자 등록증</div></div><!-- #my-awesome-dropzone1 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"사업자등록증"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">총판</span> 계약서</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <div id="my-awesome-dropzone2">my-awesome-dropzone2</div> -->
<!-- <div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div> --><!-- #my-awesome-dropzone2 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"<span class="mb_gname">총판</span> 계약서"를 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">통장 사본</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone3" class="dropzone">

<div class="dz-default dz-message"></div>
</div><!-- #my-awesome-dropzone3 -->

<!-- <div id="my-awesome-dropzone3">my-awesome-dropzone3</div> --><!-- #my-awesome-dropzone3 -->

<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"통장 사본"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankname"> <span class="help-block m-b-none">"거래은행"을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_banknum"> <span class="help-block m-b-none">계좌번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">예금주</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">예금주를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비고</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">상단문구(고정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo"> <span class="help-block m-b-none">상단 문구 변하지 않습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">중단문구(수정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo"> <span class="help-block m-b-none">중단 문구 수정 원하시는 형태로 수정이 가능합니다..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">하단문구(고정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">모두홈피 URL 주소 (수정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo" value="http://sjhero18.moodu.at"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button>
</div><!-- .col-md-12 -->
<!-- .row -->

<!-- 						      <div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->

<div class="row"><div class="col-md-12">
<textarea id="form_data">#form_data</textarea><!-- #form_data -->
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
if($("#is_join").val()=="TRUE"){
$("#form_data").html(param);
//	$("#write_action").submit();
set_member();
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
	
	if(param.indexOf("st_alltime")<0)
	{
		$("#st_open").addClass("disabled").prop('disabled', true); 
		$("#st_closed").addClass("disabled").prop('disabled', true); 
	}else{
		$("#st_open").removeClass("disabled").prop('disabled', false); 
		$("#st_closed").removeClass("disabled").prop('disabled', false); 
	}
	
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
};/*window.onload = function() {..}*/


</script>