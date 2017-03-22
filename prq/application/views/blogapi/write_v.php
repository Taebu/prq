<?php
/**
* BLOG API 쓰기 페이지
* file : /prq/application/views/blogapi/write_v.php
* 작성 : 2017-03-09 (목) 9:28:36 
* 수정 : 
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/
?>
<style type="text/css">
option:disabled {
    background: rgb(51, 122, 183);
    color:white;
	font-weight: 900 !important;
	padding:5px;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2><span class="mb_gname">총판</span> 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a><span class="mb_gname">총판</span>관리</a>
</li>
<li class="active">
<strong><span class="mb_gname">총판</span> 등록</strong>
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
echo form_open('/blogapi/write/prq_member/page/1', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);

?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="is_member" id="is_member">
<input type="hidden" name="mb_gtype" id="mb_gtype" value="DS">
<input type="hidden" name="mb_gcode" id="mb_gcode" value="G3">
<input type="hidden" name="mb_gname_eng" id="mb_gname_eng" value="Distributors">
<input type="hidden" name="mb_gname_kor" id="mb_gname_kor" value="총판">
<!-- mb_code는 자동으로 생성 되도록 설계 -->
<input type="hidden" name="mb_pcode" id="mb_pcode" value="AD0001">
<input type="hidden" name="mb_business_paper" id="mb_business_paper">
<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper">
<input type="hidden" name="mb_bank_paper" id="mb_bank_paper">
<input type="hidden" name="mb_business_paper_size" id="mb_business_paper_size">
<input type="hidden" name="mb_distributors_paper_size" id="mb_distributors_paper_size">
<input type="hidden" name="mb_bank_paper_size" id="mb_bank_paper_size">

<input type="hidden" name="mb_imgprefix" id="mb_imgprefix" value="<?php echo date("Ym");?>">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5><span class="mb_gname">총판</span> 등록 정보 입니다. <small>총판의 정보 및 계약서를 작성해 주세요.</small></h5>
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
<div class="form-group"><label class="col-sm-2 control-label">PRQ CODE</label>
<div class="col-sm-10"> <select name="prq_fcode" id="prq_fcode" class="form-control"></select><span class="help-block m-b-none" >총판  CODE를 선택합니다. 총판 코드를 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">총판</span> 아이디</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id"> <span class="help-block m-b-none" id="mb_id_assist"><span class="mb_gname">총판</span>아이디를 등록 합니다. 중복 된 아이디를 등록할 수 없습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_name">총판</span> 상호</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_name" name="mb_name"> <span class="help-block m-b-none" id="mb_name_assist"><span class="mb_gname">총판</span>상호를 등록 합니다. 중복 된 상호를 등록할 수 없습니다.</span>
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

</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">

<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
<div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
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


<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button>

</div>
</div>
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
/**
* server에 <span class="mb_gname">총판</span>을 등록 합니다.
**/
function set_ds()
{
	var param=$("#write_action").serialize();
	if($("#is_join").val()=="TRUE")
	{
		$("#form_data").html(param);
		//	$("#write_action").submit();
		set_member();
	}

	if($("#is_join").val()=="FALSE")
	{
		$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
	}
}
/*End Dropzone*/	

/**
* fn chk_duplicate_id()
 아이디 길이 체크 후 중복 체크
*/
var focus=0,blur=0;
function chk_duplicate_id()
{
	focus++; 
	var object=[];
	var mb_id=$("#mb_id").val();
	
	if (mb_id.length<4)
	{
		object.push("<span  class=\"text-danger\">");
		object.push("아이디 길이가 너무 적습니다. 4자 이상");
		object.push("</span>");
		$("#is_join").val("FALSE");
		//}else if ($( "#mb_id" ).val()!="erm00")	{
		$( "#mb_id_assist" ).html(object.join(""));
		return;
	}

	var result=false;
	$.ajax({
	url:"/prq/auth/chk_id",
	type: "POST",
	data:"mb_id="+mb_id,
	dataType:"json",
	success: function(data) {
		console.log(data.success);
		console.log(data);
		$("#is_member").val(data.success);	
		chk_vali_id();
		}
	});
}

/*
chk_vali_id();
아이디 유효성 여부 검사
*/
function chk_vali_id()
{
	var object=[];
	console.log("&gt;"+$("#is_member").val());
	var is_dupid=eval($("#is_member").val());
	if (is_dupid){
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
url:"/prq/distributors/write/prq_member",
type: "POST",
data:param,
cache: false,
async: false,
success: function(data) {
console.log(data);
}
});		

}



/*총판 코드를 불러 옵니다.*/
var ds_code="";
function get_dscode()
{
	
	$.ajax({
	url:"/prq/ajax/get_dscode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		ds_code=data.posts;
		console.log(ds_code);
//		$("#is_member").val(data.success);	
//		chk_vali_id();
			get_used_dscode();
		}
	});
}

/*사용 중인 총판 코드를 불러 옵니다.*/
var used_ds_code=[];
function get_used_dscode()
{
	
	$.ajax({
	url:"/prq/ajax/get_used_dscode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {

			$.each(data.posts,function(key,val){
				used_ds_code.push(val.prq_fcode);
			});
	
		//search_dscode("DS0003");
		search_dscode("DS0003");
		}
	});
}


/*
총판코드로 사용중인 코드를  비활성화 합니다.
*/
function search_dscode(spt_code)
{
	spt_code="";
	var object = [];
	var chk_max_dscode=[];
	/*서버에서 실제 사용중인 코드를 불러 온다. */
	var arr =used_ds_code;
	console.log("사용 중인 코드 갯수 : "+used_ds_code.length);
	console.log("등록한 코드 갯수 : "+ds_code.length);

	if(ds_code.length==used_ds_code.length){
		alert("총판 코드를 모두 소진하여 \n 더 이상 총판 등록이 불가능 합니다.\n 리스트로 돌아갑니다.");
		$(location).attr('href','/prq/distributors/lists/prq_member/page/1');
	}
	/* ds_code는 이미 get_dscode인 부모 코드에서 불러 온다.*/
	$.each(ds_code,function(key,val){
//	if(val.fr_code.indexOf(spt_code)>-1)
//	{
		if(spt_code==val.ds_code){
			object.push('<option value='+val.ds_code+' selected>');
		}else{
			if($.inArray(val.ds_code,arr)>-1){
			object.push('<option value='+val.ds_code+' disabled>');
			}else{
			object.push('<option value='+val.ds_code+'>');
			}
		}
		chk_max_dscode.push(val.ds_code);
		if($.inArray(val.ds_code,arr)>-1){
		object.push('['+val.ds_code+'] ');
		object.push(val.ds_name+" [사용 중] ");
		
		}else{
		object.push('['+val.ds_code+'] ');
		object.push(val.ds_name);
		}
		object.push('</option>');
//	}
	});

	if(chk_max_dscode.length>0)
	{
	var max_ds_code=chk_max_dscode[chk_max_dscode.length-1];
	console.log(max_ds_code);
	console.log(max_ds_code.substr(0,6));
	var next_code_index=Number(max_ds_code.substr(0,6));
	console.log("is array next code index -> "+next_code_index);
	}else{
	var next_code_index=0;
	console.log("is not array next code index -> "+next_code_index);
	}
	next_code_index=10001+next_code_index;
	var next_code_string=next_code_index.toString();
	var ds_code_new="DS"+next_code_string.substr(1,5);
	var result=object.join("");
	$("#prq_fcode").html(result);
//	chg_frcode(spt_code+""+fr_code_new);
}


/* 모든 정보를 불러 오면 아래 코드를 실행합니다.*/
window.onload = function() {

$( "#mb_id" ).focusout(function() {
	//chk_vali_id();
	chk_duplicate_id();
}).blur(function() {
	blur++;
	//	chk_vali_id();
	chk_duplicate_id();
});

	/*mb_code로 등록 정보 변경*/
	//chg_gname();

	/* 
	2016-01-25 (월)
	fn get_dscode();
	총판 코드   prq_fcode 불러오기
	아래 함수는 get_used_dscode를 불러서 이미 사용 중인 코드를 호출 합니다.
	그 후 search_dscode 를 호출 하여 이미 사용중인 코드가 모두 소진 되면 
	입력을 할 수 없도록 총판 리스트로 돌아 갑니다.
	*/
	get_dscode();

};
/*window.onload = function() {..}*/
</script>