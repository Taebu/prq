<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2><span class="mb_gname">가맹점</span> 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a><span class="mb_gname">가맹점</span>관리</a>
</li>
<li class="active">
<strong><span class="mb_gname">가맹점</span> 등록</strong>
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
echo form_open('/franchise/write/prq_member', $attributes);
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
<h5><span class="mb_gname">가맹점</span> 등록 정보 입니다. <small>총판의 정보 및 계약서를 작성해 주세요.</small></h5>
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
<?php 
if($mb_code=="PT"){?>
<div class="form-group"><label class="col-sm-2 control-label">총판 협력사
</label>
<div class="col-sm-10"><select name="mb_pcode" id="">
	<option value="A0002">파알큐(문성준_총판)(A0002)</option>
	<option value="A0003">파알큐(문성준_총판)(A0003)</option>
	<option value="A0004">파알큐(문성준_총판)(A0004)</option>
	<option value="A0005">파알큐(문성준_총판)(A0005)</option>

</select> <span class="help-block m-b-none">총판협력사를 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<?php }?>

<div class="form-group">
	<label for="fr_code" class="col-sm-2 control-label">PRQ 코드</label>
	<div class="col-sm-10"><select name="prq_fcode"  class="form-control" id="prq_fcode" size='10'></select>
	<span class="help-block m-b-none">PRQ 코드를 선택 합니다.</span></div><!-- .col-sm-10 -->
</div><!-- .form-inline-->


<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">가맹점</span> 아이디</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id"> <span class="help-block m-b-none" id="mb_id_assist"><span class="mb_gname">가맹점</span>아이디를 등록 합니다. 중복 된 아이디를 등록할 수 없습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">비밀번호</label>
<div class="col-sm-10"><input type="password" class="form-control" name="mb_password">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비밀번호 확인</label>
<div class="col-sm-10"><input type="password" class="form-control" name="mb_password_2">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">가맹점</span> 명</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_name" name="mb_name"> <span class="help-block m-b-none"><span class="mb_gname">가맹점</span>명 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_email" name="mb_email"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">주소1</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_addr1" name="mb_addr1"> <span class="help-block m-b-none">시군구를 등록해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">주소2</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_addr2" name="mb_addr2"> <span class="help-block m-b-none">동읍면리.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">주소3</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_addr3" name="mb_addr3"> <span class="help-block m-b-none">상세주소</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">대표자 명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_ceoname"> <span class="help-block m-b-none">대표자명을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">대표 연락처</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">대표 연락처를 기입해 주세요..</span>
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

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">가맹점</span> 정산비율</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_exactcaculation_ratio"> <span class="help-block m-b-none">정산 비율</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">

<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
<div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"사업자등록증"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">가맹점</span> 계약서</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <div id="my-awesome-dropzone2">my-awesome-dropzone2</div> -->
<!-- <div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div> --><!-- #my-awesome-dropzone2 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"<span class="mb_gname">가맹점</span> 계약서"를 드래그 하거나 선택해 주세요.</span>
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

<div class="form-group"><label class="col-sm-2 control-label">생년월일</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_birth"  data-mask="999999"> <span class="help-block m-b-none">생년월일 기입해 주세요.예) 80년 4월 5일인 경우 800405</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비고</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

</div><!-- .col-md-6 Right Menu-->


<div class="row">
<div class="col-md-12">
<div class="ibox-title"><h5>CID, KT 정보</h5>&nbsp;&nbsp;<small>CID 정보를 기입 합니다.</small></div><!-- .ibox-title -->
<div class="ibox-content">
<!-- <h3>Switcher</h3>
<p>Is iOS 7 style switches for your checkboxes.</p> -->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">전화번호 1</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">전화번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">매장코드 1</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">매장코드를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">

<div class="form-group"><label class="col-sm-2 control-label">전화번호 2</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">전화번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">매장코드 2</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">매장코드를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .ibox-content -->
</div><!-- .col-md-12 -->
</div><!-- .row -->


<div class="row">
<div class="col-md-12">
<div class="ibox-title"><h5>가맹점주 핸드폰 정보</h5>&nbsp;&nbsp;<small>가맹점 핸드폰 정보를 기입 합니다.</small></div><!-- .ibox-title -->
<div class="ibox-content">
<!-- <h3>Switcher</h3>
<p>Is iOS 7 style switches for your checkboxes.</p> -->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">발송번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">발송될 핸드폰번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<div class="form-group"><label class="col-sm-2 control-label">안드로이드버전</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder" value="0.4"> <span class="help-block m-b-none">전화번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<div class="form-group"><label class="col-sm-2 control-label">문자발송</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder" value="190"> <span class="help-block m-b-none">월간,수신처 중복 제외.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">문자구분</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">MMS.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<div class="form-group"><label class="col-sm-2 control-label">단말기</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder" value="SHV-E160S"> <span class="help-block m-b-none">단말기 모델명을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<div class="form-group"><label class="col-sm-2 control-label">중복발송제한</label>
<div class="col-sm-10"><select name="" id="">
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
	<option value=""></option>
</select>일 <span class="help-block m-b-none">매장코드를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .ibox-content -->
</div><!-- .col-md-12 -->
</div><!-- .row -->
<div class="col-md-12">
<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div></div>
</div><!-- .row -->

<div class="row">
<div class="col-md-12">
<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button></div><!-- .col-sm-4 .col-sm-offset-2 -->
</div><!-- .form-group -->
</div></div><!-- .row -->

</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div>
<div class="ibox float-e-margins">

</div><!-- .row -->

</div><!-- .wrapper .wrapper-content .animated .fadeInRight -->
<script type="text/javascript">
/*
server에 <span class="mb_gname">가맹점</span>을 등록 합니다.

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


/*가맹점 코드를 불러 옵니다.*/
var fr_code="";
function get_frcode()
{
	
	$.ajax({
	url:"/prq/ajax/get_frcode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		fr_code=data.posts;
		console.log(fr_code);
//		$("#is_member").val(data.success);	
//		chk_vali_id();
		search_frcode("DS0001PT0001");
		}
	});
}


/*pt_code로 fr 코드를 탐색 합니다.
*/
function search_frcode(spt_code)
{
	var object = [];
	var chk_max_frcode=[];
	var arr =["DS0001PT0001FR0002","DS0001PT0001FR0003"];
	$.each(fr_code,function(key,val){
//	if(val.fr_code.indexOf(spt_code)>-1)
//	{
		if(spt_code+"FR0001"==val.fr_code){
			object.push('<option value='+val.fr_code+' selected>');
		}else{
			if($.inArray(val.fr_code,arr)>-1){
			object.push('<option value='+val.fr_code+' disabled>');
			}else{
			object.push('<option value='+val.fr_code+'>');
			}
		}
		chk_max_frcode.push(val.fr_code);
		if($.inArray(val.fr_code,arr)>-1){
		object.push('['+val.fr_code+']');
		object.push(val.fr_name+" 이미 사용 중입니다.");
		
		}else{
		object.push('['+val.fr_code+']');
		object.push(val.fr_name);
		}
		object.push('</option>');
//	}
	});
	if(chk_max_frcode.length>0)
	{
	var max_fr_code=chk_max_frcode[chk_max_frcode.length-1];
	console.log(max_fr_code);
	console.log(max_fr_code.substr(14,18));
	var next_code_index=Number(max_fr_code.substr(14,18));
	console.log("is array next code index -> "+next_code_index);
	}else{
	var next_code_index=0;
	console.log("is not array next code index -> "+next_code_index);
	}
	next_code_index=10001+next_code_index;
	var next_code_string=next_code_index.toString();
	var fr_code_new="FR"+next_code_string.substr(1,5);
	var result=object.join("");
	$("#prq_fcode").html(result);
//	chg_frcode(spt_code+""+fr_code_new);
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

	/*가맹점 코드 가져 오기*/
	get_frcode();
};/*window.onload = function() {..}*/
</script>