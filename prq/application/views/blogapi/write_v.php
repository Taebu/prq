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

.help-error{
	color:red;
	font-weight:900;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>블로그 API 등록</h2>
<ol class="breadcrumb">
	<li><a href="index.html">Home</a></li>
	<li><a>블로그</a></li>
	<li class="active"><strong>블로그 API 등록</strong></li></ol>
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
echo form_open('/blogapi/write', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
$pb_app_name=$this->input->post('pb_app_name', TRUE);
if($pb_app_name=="")
{
$pb_app_name="모두톡톡리뷰";
}
?>
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>블로그API 등록 정보 입니다. <small>블로그 API 정보를 작성해 주세요.</small></h5>

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
<div class="col-xs-12">
<div class="form-group"><label class="col-sm-2 control-label">회사명</label>
<div class="col-sm-10"><input type="text" class="form-control" id="pb_company_name" name="pb_company_name" value="<?php echo $this->input->post('pb_company_name', TRUE);?>">
<span class="help-block m-b-none" id="pb_company_name">회사명을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">앱이름</label>
<div class="col-sm-10"><input type="text" class="form-control" id="pb_app_name" name="pb_app_name" value="<?php echo $pb_app_name;?>"> 
<span class="help-block m-b-none" id="mb_name_assist">앱 이름을 등록 해주세요. 기본값은 "모두톡톡리뷰"입니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">네이버아이디</label>
<div class="col-sm-10"><input type="text" class="form-control" id="pb_naver_id" name="pb_naver_id" value="<?php echo $this->input->post('pb_naver_id', TRUE);?>">
<span class="help-block m-b-none" id="mb_name_assist">블로그로 등록할 네이버 아이디를 기재해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">네이버비밀번호</label>
<div class="col-sm-10"><input type="text" class="form-control" id="pb_naver_pw" name="pb_naver_pw" value="<?php echo $this->input->post('pb_naver_pw', TRUE);?>">
<span class="help-block m-b-none" id="mb_name_assist">블로그로 등록할 네이버 비밀번호를 기재해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">access_token</label>
<div class="col-sm-10"><div id="access_token_area"><a href="/blog/">access_token이 없습니다. 로그인을 시도해주세요.</a>
<br>시크릿 모드 추천 !!! 네이버 로그아웃 된 상태여야 합니다.
</div><!-- #access_token_area -->
<span class="help-block m-b-none">access_token을 선택해주세요. 금일 시도한 access 토큰 목록입니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">refresh_token</label>
<div class="col-sm-10"><div id="refresh_token_area"><a href="/blog/">refresh_token 없습니다. 로그인을 시도해주세요.</a>
<br>시크릿 모드 네이버 로그아웃 된 상태여야 합니다.
</div><!-- #refresh_token_area -->
<span class="help-block m-b-none">refresh_token을  선택해주세요. 금일 시도한 refresh 토큰 목록입니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">핸드폰번호</label>
<div class="col-sm-10"><input type="text" class="form-control" id="pb_hp" name="pb_hp" placeholder="예) 010-0000-0000" value="<?php echo $this->input->post('pb_hp', TRUE);?>">
<span class="help-block m-b-none">"-(대시)"기호 포함 예)010-0000-0000으로 기재</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="controls help-error">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div><!-- .controls -->

<div class="form-group">
<div class="col-xs-4 col-xs-offset-5">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button>
</div><!-- .col-xs-4 .col-xs-offset-5 -->
</div><!-- .form-group -->

</div><!-- .col-xs-12 -->
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->
</div><!-- .wrapper wrapper-content animated fadeInRight -->

<script type="text/javascript">
/**
* server에 총판을 등록 합니다.
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



/* 최근 인증한 access_code를 불러 옵니다.*/
var ds_code="";
function get_auth()
{
	
	$.ajax({
	url:"/prq/ajax/get_auth/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
			var object_1=[];
			var object_2=[];
			object_1.push('<select name="access_token" id="access_token" class="form-control">');
			object_2.push('<select name="refresh_token" id="refresh_token" class="form-control">');
			$.each(data.posts,function(key,val){
				/* option 1*/
				object_1.push('<option value="');
				object_1.push(val.access_token);
				object_1.push('">');
				object_1.push(val.access_token);
				object_1.push('</option>');
				/* option 2*/
				object_2.push('<option value="');
				object_2.push(val.refresh_token);
				object_2.push('">');				
				object_2.push(val.refresh_token);
				object_2.push('</option>');
			});

			object_1.push('</select>');
			object_2.push('</select>');
			$("#access_token_area").html(object_1.join(""));
			$("#refresh_token_area").html(object_2.join(""));
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

	/* 
	2017-04-04 (화) 11:28:23 
	*/
	get_auth();

};
/*window.onload = function() {..}*/
</script>