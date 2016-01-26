<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2><span class="mb_gname">가맹점 코드</span> 등록</h2>
<ol class="breadcrumb">
<li>
<a href="/prq/">Home</a>
</li>
<li>
<a>코드 관리</a>
</li>
<li class="active">
<strong><span class="mb_gname">가맹점 코드</span> 등록</strong>
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
echo form_open('/codes/write/prq_frcode', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$ds_code=$this->input->post('ds_code',TRUE);
$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
$prq_fcode=@$this->session->userdata['prq_fcode'];
?>

<input type="hidden" name="mode" id="mode">
<input type="hidden" name="pt_code_new" id="pt_code_new">
<input type="hidden" name="fr_code_new" id="fr_code_new">
<input type="hidden" name="mb_gcode" id="mb_gcode" value="<?php echo $mb_gcode;?>">
<input type="hidden" name="prq_fcode" id="prq_fcode" value="<?php echo $prq_fcode;?>">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5><span class="mb_gname">가맹점 코드</span> 등록 정보 입니다. <small>가맹점코드를 작성해 주세요.</small></h5>
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
if($mb_gcode=="G1"||$mb_gcode=="G2"){?>
<div class="row">
<div class="col-md-3"><label>총판 코드</label>
	<div class="form-inline">
	<select name="ds_code"  class="form-control" id="ds_code" size='10' style='width:100%' onchange="javascript:search_ptcode(this.value)"></select>
	<span class="help-block m-b-none" id="mb_id_assist">총판코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-3 -->
<div class="col-md-3">
	<div class="form-inline">
	<label for="pt_code">대리점 코드</label>
	<select name="pt_code"  class="form-control" id="pt_code" size='10'   style='width:100%' onchange="javascript:chg_ptcode(this.value);search_frcode(this.value);"
	 onclick="javascript:chg_ptcode(this.value)"></select>
	<span class="help-block m-b-none" id="mb_id_assist">대리점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-3 -->
<div class="col-md-3">
	<div class="form-inline">
	<label for="fr_code">가맹점 코드</label>
	<select name="fr_code"  class="form-control" id="fr_code" size='10'   style='width:100%' disabled onchange="javascript:changed_frcode(this.value);chg_frcode(this.value)"
	 onclick="javascript:changed_frcode(this.value);chg_frcode(this.value)"
	></select>

	<span class="help-block m-b-none" id="mb_id_assist">가맹점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-3 -->
<div class="col-md-3"><label>가맹점 수정</label>
<span id="span_fr_code">..</span>
<input type="text"  class="form-control" name="edit_fr_name" id="edit_fr_name" disabled>
<input type="button" value="수정" class="btn btn-primary"  onclick="javascript:set_frcode('modify')">
<input type="button" value="삭제" class="btn btn-danger"  onclick="javascript:set_frcode('delete')">
</div><!-- col-md-4 -->
</div><!-- row-->
<?php 
}?>

<?php 
/* 총판인 경우 */
if($mb_gcode=="G3")
{?>
<div class="row">
<div class="col-md-4">
	<div class="form-inline">
	<label for="pt_code">대리점 코드</label>
	<input type="hidden" name="ds_code"  class="form-control" id="ds_code" value="<?php echo $prq_fcode;?>">
	<select name="pt_code"  class="form-control" id="pt_code" size='10'   style='width:100%' onchange="javascript:chg_ptcode(this.value);search_frcode(this.value);"
	 onclick="javascript:chg_ptcode(this.value)"></select>
	<span class="help-block m-b-none" id="mb_id_assist">대리점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-4 -->
<div class="col-md-4">
	<div class="form-inline">
	<label for="fr_code">가맹점 코드</label>
	<select name="fr_code"  class="form-control" id="fr_code" size='10'   style='width:100%' disabled onchange="javascript:changed_frcode(this.value);chg_frcode(this.value)"
	 onclick="javascript:changed_frcode(this.value);chg_frcode(this.value)"
	></select>
	<span class="help-block m-b-none" id="mb_id_assist">가맹점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-4 -->
<div class="col-md-4"><label>가맹점 수정</label>
<span id="span_fr_code">..</span>
<input type="text"  class="form-control" name="edit_fr_name" id="edit_fr_name">
<input type="button" value="수정" class="btn btn-primary"  onclick="javascript:set_frcode('modify')">
<input type="button" value="삭제" class="btn btn-danger"  onclick="javascript:set_frcode('delete')">
</div><!-- col-md-4 -->
</div><!-- row-->
<?php 
}?>

<?php 
/* 대리점인 경우 */
if($mb_gcode=="G4")
{?>
<div class="row">
<div class="col-md-4">
	<div class="form-inline">
	<label for="pt_code">대리점 코드</label>
	<input type="hidden" name="ds_code"  class="form-control" id="ds_code" value="<?php echo $prq_fcode;?>">
	<select name="pt_code"  class="form-control" id="pt_code" size='10'   style='width:100%' onchange="javascript:chg_ptcode(this.value);search_frcode(this.value);"
	 onclick="javascript:chg_ptcode(this.value)"></select>
	<span class="help-block m-b-none" id="mb_id_assist">대리점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-4 -->
<div class="col-md-4">
	<div class="form-inline">
	<label for="fr_code">가맹점 코드</label>
	<select name="fr_code"  class="form-control" id="fr_code" size='10'   style='width:100%' disabled onchange="javascript:changed_frcode(this.value);chg_frcode(this.value)"
	 onclick="javascript:changed_frcode(this.value);chg_frcode(this.value)"
	></select>
	<span class="help-block m-b-none" id="mb_id_assist">가맹점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-4 -->
<div class="col-md-4"><label>가맹점 수정</label>
<span id="span_fr_code">..</span>
<input type="text"  class="form-control" name="edit_fr_name" id="edit_fr_name">
<input type="button" value="수정" class="btn btn-primary"  onclick="javascript:set_frcode('modify')">
<input type="button" value="삭제" class="btn btn-danger"  onclick="javascript:set_frcode('delete')">
</div><!-- col-md-4 -->
</div><!-- row-->
<?php 
}?>
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="row">
<div class="col-md-4"><label>가맹점 코드</label>
<div id="display_dscode">DS0001</div>
<div id="display_ptcode">PT0001</div>
<div id="display_frcode">FR0001</div>
<div id="fr_code_new"></div>
</div>
<div class="col-md-6"><label>가맹점 분류명</label>
<input type="text"  class="form-control" name="fr_name" id="fr_name" onclick="javascript:search_frcode($('#pt_code').val());"></div>
<div class="col-md-2"><label>처리</label>
<div><input type="button" value="추가" class="btn btn-primary" onclick="javascript:set_frcode('add')"></div>
</div>

</div><!-- col-md-12 -->

</div><!-- row-->
<!-- <form method="get" class="form-horizontal"> -->
<!-- <div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">총판</span> 코드</label>
<div class="col-sm-10"><input type="text" class="form-control" id="ds_code" name="ds_code" value="<?php echo $ds_code;?>"> <span class="help-block m-b-none" id="mb_id_assist"><span class="mb_gname">총판</span>코드를 등록 합니다. 중복 된 코드를 등록할 수 없습니다.</span>
</div>.col-sm-10
</div>.form-group
<div class="hr-line-dashed"></div>.hr-line-dashed

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_name">총판</span> 이름</label>
<div class="col-sm-10"><input type="text" class="form-control" id="ds_name" name="ds_name"> <span class="help-block m-b-none" id="mb_name_assist"><span class="mb_gname">총판</span>상호를 등록 합니다. 중복 된 상호를 등록할 수 없습니다.</span>
</div>.col-sm-10
</div>.form-group
<div class="hr-line-dashed"></div>.hr-line-dashed

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button> -->
<!-- 						      <div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->


</div><!-- .col-md-6 Right Menu-->

</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
<!-- </div> --><!-- .col-lg-12 -->

<script type="text/javascript">
/**
* server에 <span class="mb_gname">총판</span>을 등록 합니다.
**/
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


function get_dscode()
{
	
	$.ajax({
	url:"/prq/ajax/get_dscode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		console.log(data.success);
		console.log(data.posts);
		var object = [];
		$.each(data.posts,function(key,val){
		if("DS0001"==val.ds_code){
			object.push('<option value='+val.ds_code+' selected>');
		}else{
			object.push('<option value='+val.ds_code+'>');
		}
		object.push('['+val.ds_code+']');
		object.push(val.ds_name);
		object.push('</option>');
		});
//		$("#is_member").val(data.success);	
//		chk_vali_id();
		var result=object.join("");
		$("#ds_code").html(result);
		}
	});
}

/*대리점 코드를 불러 옵니다.*/
var pt_code="";
function get_ptcode(code)
{
	var ds_code=code==""?"DS0001":code;
	
	$.ajax({
	url:"/prq/ajax/get_ptcode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		pt_code=data.posts;
//		$("#is_member").val(data.success);	
//		chk_vali_id();
		search_ptcode(ds_code);
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
//		search_ptcode("DS0001");
		}
	});
}

function search_ptcode(ds_code)
{
	var object = [];
	var chk_max_ptcode=[];
	var is_pt=$("#pt_code").val()===null;
	if(is_pt){
		$("#edit_fr_name").prop('disabled', true); 
		$("#fr_code").prop('disabled', true); 
		$("#fr_name").prop('disabled', true); 
		
	}else{
		$("#edit_fr_name").prop('disabled', false); 
		$("#fr_code").prop('disabled', false); 	
		$("#fr_name").prop('disabled', false); 	
	}	
	$.each(pt_code,function(key,val){
	if(val.pt_code.indexOf(ds_code)>-1)
	{
		if("DS0001"==val.pt_code){
			object.push('<option value='+val.pt_code+' selected>');
		}else{
			object.push('<option value='+val.pt_code+'>');
		}
		chk_max_ptcode.push(val.pt_code);
		object.push('['+val.pt_code+']');
		object.push(val.pt_name);
		object.push('</option>');
	}
	});
	if(chk_max_ptcode.length>0)
	{
	var max_pt_code=chk_max_ptcode[chk_max_ptcode.length-1];

	var next_code_index=Number(max_pt_code.substr(8,12));
	console.log("is array next code index -> "+next_code_index);
	}else{
	var next_code_index=0;
	console.log("is not array next code index -> "+next_code_index);
	}
	next_code_index=10001+next_code_index;
	var next_code_string=next_code_index.toString();
	var pt_code_new="PT"+next_code_string.substr(1,5);
	var result=object.join("");
	$("#pt_code").html(result);
	chg_ptcode(ds_code+""+pt_code_new);
}

/*pt_code로 fr 코드를 탐색 합니다.
*/
function search_frcode(spt_code)
{
	var object = [];
	var chk_max_frcode=[];
	var is_pt=$("#pt_code").val()===null;
	if(is_pt){
		$("#edit_fr_name").prop('disabled', true); 
		$("#fr_code").prop('disabled', true); 
		$("#fr_name").prop('disabled', true); 
	}else{
		$("#edit_fr_name").prop('disabled', false); 
		$("#fr_code").prop('disabled', false); 	
		$("#fr_name").prop('disabled', false); 	
	}
	$.each(fr_code,function(key,val){
	if(val.fr_code.indexOf(spt_code)>-1)
	{
		if(spt_code+"FR0001"==val.fr_code){
			object.push('<option value='+val.fr_code+' selected>');
		}else{
			object.push('<option value='+val.fr_code+'>');
		}
		chk_max_frcode.push(val.fr_code);
		object.push('['+val.fr_code+']');
		object.push(val.fr_name);
		object.push('</option>');
	}
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
	$("#fr_code").html(result);
	chg_frcode(spt_code+""+fr_code_new);
}

function changed_frcode(fcode)
{
	$.each(fr_code,function(key,val){
		if(val.fr_code==fcode)
		{
			
			$("#edit_fr_name").val(val.fr_name);
		}

//	$("#edit_pt_name").val(ds_code+"_"+v);
	});
	$("#span_fr_code").html(fcode);

}
/*

*/
function chg_ptcode(v)
{
	var ds_code=$("#ds_code").val();
	$("#pt_code_new").val(v);
	$("#display_ptcode").html(ds_code);
	$("#display_frcode").html(v);
	$("#span_fr_code").html(ds_code+""+v);
	var search_code=v;
	console.log(search_code);
	var i=0;
	$.each(fr_code,function(key,val){
		if(val.fr_code.indexOf(search_code)>-1)
		{
			if(val.fr_code==$("#fr_code").val())
			{
				$("#edit_fr_name").val(val.fr_name);
			}
		}
		i++;
//	$("#edit_pt_name").val(ds_code+"_"+v);
	});
	if(i==0){
		$("#edit_fr_name").val("");
	}
}
/*

*/
function chg_frcode(v)
{
	var fr_code=$("#fr_code").val();
	$("#fr_code_new").val(v);
	//$("#display_dscode").html(ds_code);
	$("#display_ptcode").html(v);
	$("#span_pt_code").html(ds_code+""+v);
	var search_code=v;
		var i=0;
	console.log(search_code);
	$.each(pt_code,function(key,val){
		if(val.pt_code.indexOf(search_code)>-1)
		$("#edit_fr_name").val(val.pt_name);
//	$("#edit_pt_name").val(ds_code+"_"+v);
		i++;
	});
	if(i==0){
		$("#edit_fr_name").val("");
	}
}

function set_frcode(mode)
{
	/* 코드 추가 */
	if(mode=="add")
	{
		if($("#fr_name").val()==""||$("#fr_name").val().length<2){
			alert("길이가 너무 적거나 공백입니다.");
			$("#fr_name").focus();
			return;
		}
		$("#mode").val("add");
		var param =$("#write_action").serialize();
		alert(param);
		
		$.ajax({
		url:"/prq/ajax/set_frcode/",
		type: "POST",
		data:param,
		dataType:"json",
		success: function(data) {
			console.log(data);
			if(data.success){
				alert('입력 성공');
				$(location).attr('href',document.URL);
			}else{
				alert(data.result);
			}
		}
		});
	}

	/* 코드 수정 */
	if(mode=="modify")
	{
		if($("#edit_fr_name").val()==""||$("#edit_fr_name").val().length<2){
			alert("길이가 너무 적거나 공백입니다.");
			$("#edit_fr_name").focus();
			return;
		}
		$("#mode").val("modify");
		var param =$("#write_action").serialize();
		alert(param);
		
		$.ajax({
		url:"/prq/ajax/set_frcode/",
		type: "POST",
		data:param,
		dataType:"json",
		success: function(data) {
			console.log(data);
			if(data.success){
				alert('수정 성공');
				$(location).attr('href',document.URL);
			}else{
				alert(data.result);
			}
		}
		});
	}

	/* 코드 추가 */
	if(mode=="delete")
	{
		if($("#edit_fr_name").val()==""||$("#edit_fr_name").val().length<2){
			alert("길이가 너무 적거나 공백입니다.");
			$("#fr_name").focus();
			return;
		}
		$("#mode").val("delete");
		var param =$("#write_action").serialize();
		alert(param);
		
		$.ajax({
		url:"/prq/ajax/set_frcode/",
		type: "POST",
		data:param,
		dataType:"json",
		success: function(data) {
			console.log(data);
			if(data.success){
				alert('삭제 성공');
				$(location).attr('href',document.URL);
			}else{
				alert(data.result);
			}
		}
		});
	}

}

window.onload = function() {


	/*mb_code로 등록 정보 변경*/
	//chg_gname();

	var mb_gcode=$("#mb_gcode").val();
	/* 관리자인 경우 */
	if(mb_gcode=="G2"||mb_gcode=="G1")
	{
	/*총판 코드 가져 오기*/
	get_dscode();

	/*대리점 코드 가져 오기*/
	var ds_code="";
	get_ptcode(ds_code);
	
	/*가맹점 코드 가져 오기*/
	get_frcode();
	}
	/* 총판인 경우 */
	if(mb_gcode=="G3")
	{
	/*대리점 코드 가져 오기*/
	var ds_code=$("#prq_fcode").val();
	get_ptcode(ds_code);
	
	/*가맹점 코드 가져 오기*/
	get_frcode();
	}
	/*초기 대리점 코드 설정*/
	
};/*window.onload = function() {..}*/
</script> 

