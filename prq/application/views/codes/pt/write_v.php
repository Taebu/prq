<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2><span class="mb_gname">대리점 코드</span> 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a>코드 관리</a>
</li>
<li class="active">
<strong><span class="mb_gname">대리점 코드</span> 등록</strong>
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
echo form_open('/codes/write/prq_ptcode', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$ds_code=$this->input->post('ds_code',TRUE);

?>

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5><span class="mb_gname">대리점 코드</span> 등록 정보 입니다. <small>대리점코드를 작성해 주세요.</small></h5>
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
<div class="col-md-4"><label>총판 코드</label>
	<div class="form-inline">
	<select name="ds_code"  class="form-control" id="ds_code" size='10' style='width:100%'>
		<option value="DS0001" selected>[DS0001] 캐시큐1</option>
		<option value="DS0002">[DS0002] 캐시큐2</option>
		<option value="DS0003">[DS0003] 캐시큐3</option>
		<option value="DS0004">[DS0004] 캐시큐4</option>
		<option value="DS0005">[DS0005] 캐시큐5</option>
		<option value="DS0006">[DS0006] 캐시큐6</option>
		<option value="DS0007">[DS0007] 캐시큐7</option>
		<option value="DS0008">[DS0008] 캐시큐8</option>
		<option value="DS0009">[DS0009] 캐시큐9</option>
		<option value="DS0010">[DS0010] 캐시큐10</option>
		<option value="DS0011">[DS0011] 캐시큐11</option>
	</select>
	<span class="help-block m-b-none" id="mb_id_assist">총판코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-4 -->
<div class="col-md-4">
	<div class="form-group">
	<label for="pt_code">대리점 코드</label>
	<select name="pt_code"  class="form-control" id="pt_code" size='10'   style='width:100%' onchange="javascript:chg_ptcode(this.value)"
	 onclick="javascript:chg_ptcode(this.value)">
		<option value="PT0001">[PT0001] 캐시큐1</option>
		<option value="PT0002">[PT0002] 캐시큐2</option>
		<option value="PT0003">[PT0003] 캐시큐3</option>
		<option value="PT0004">[PT0004] 캐시큐4</option>
		<option value="PT0005">[PT0005] 캐시큐5</option>
		<option value="PT0006">[PT0006] 캐시큐6</option>
		<option value="PT0007">[PT0007] 캐시큐7</option>
		<option value="PT0008">[PT0008] 캐시큐8</option>
		<option value="PT0009">[PT0009] 캐시큐9</option>
		<option value="PT0010">[PT0010] 캐시큐10</option>
		<option value="PT0011">[PT0011] 캐시큐11</option>
	</select>
	<span class="help-block m-b-none" id="mb_id_assist">대리점코드를 선택 합니다.</span>
	</div><!-- .form-inline-->
</div><!-- col-md-4 -->
<div class="col-md-4"><label>대리점 수정</label>
<span id="span_pt_code">..</span>
<input type="text"  class="form-control" name="edit_pt_name" id="edit_pt_name"><input type="button" value="수정" class="btn btn-primary" ><input type="button" value="삭제" class="btn btn-danger" >
</div><!-- col-md-4 -->

</div><!-- row-->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="row">
<div class="col-md-4"><label>대리점 코드</label>
<div id="display_dscode">DS0001</div>
<div id="display_ptcode">PT0001</div>
</div>
<div class="col-md-6"><label>대리점 분류명</label>
<input type="text"  class="form-control" name="" id=""></div>
<div class="col-md-2"><label>처리</label>
<div><input type="button" value="추가" class="btn btn-primary" ></div>
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
</div><!-- .col-lg-12 -->
</div><!-- .row -->

</div><!-- .wrapper .wrapper-content .animated .fadeInRight -->

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
	var object = [];
	object.push({"code":"DS0001","name":"캐시큐"});
	object.push({"code":"DS0002","name":"우동배"});

	var sel_obj=[];
	for(var i in object)
	{
		if("DS0001"==object[i]['code']){

			sel_obj.push('<option value='+object[i]['code']+' selected>');
		}else{
			sel_obj.push('<option value='+object[i]['code']+'>');
		}
		sel_obj.push('['+object[i]['code']+']');

		sel_obj.push(object[i]['name']);
		sel_obj.push('</option>');
	}

	var result=sel_obj.join("");
	$("#ds_code").html(result);
}

/*

*/
function chg_ptcode(v)
{
	var ds_code=$("#ds_code").val();

	$("#display_dscode").html(ds_code);
	$("#display_ptcode").html(v);
	$("#span_pt_code").html(ds_code+""+v);
	$("#edit_pt_name").val(ds_code+"_"+v);
}
window.onload = function() {

$( "#mb_id" ).focusout(function() {
	//chk_vali_id();
	chk_duplicate_id();
})
.blur(function() {
	blur++;
	//	chk_vali_id();
	chk_duplicate_id();
});

	/*mb_code로 등록 정보 변경*/
	//chg_gname();
	get_dscode();
};/*window.onload = function() {..}*/
</script>