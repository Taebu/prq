<?php
GLOBAL $regex_index;
$regex_index=1;
/*템플릿 정규식을 문자열로 변환*/
function chg_template_rule($point_items,$option="")
{
	GLOBAL $regex_index;

	$array=array();
	if(strlen($point_items)>1)
	{
		$setmenu_a=explode("&",$point_items);
		$count_setmenu=count($setmenu_a)+1;

		for($i=0;$i<count($setmenu_a);$i++)
		{
			$setm= explode("=",$setmenu_a[$i]);
			$array[]='<div class="row" id="regex_'.$i.'">';
			if($option=="view"){
			$array[]=sprintf(' %s %s <br>',$setm[0],$setm[1]);
			}else{
			$array[]='<div class="col-xs-5">';
			$array[]='<label for="ex2">key name</label>';
			$array[]=sprintf('<input type="text" name="reg_name[]" value="%s" class="form-control"> ',$setm[0]);
			$array[]='</div>';
			
			$array[]='<div class="col-xs-5">';
			$array[]='<label for="ex2">key value</label>';
			$array[]=sprintf('<input type="text" name="reg_value[]" value="%s" class="form-control">',$setm[1]);
			$array[]='</div>';
			}
			
			if($option=="add")
			{
				$array[]='<div class="col-xs-2">';
				$array[]='<input type="button" value="+" onclick="javascript:add_regex()"  class="btn btn-primary">';
				if($i>0)
				{
					$array[]=sprintf('<input type="button" value="-" onclick="javascript:remove_regex(%s)"  class="btn btn-danger">',$i);
				}
				$array[]='</div>';
			}
			$array[]=sprintf('</div><!-- .row #regex_%s -->',$i);
			$regex_index++;
		}
	}
	return join($array,"");
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>템플릿관리 친구 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a>biztalk</a>
</li>
<li class="active">
<strong>템플릿관리</strong>
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
$method=$this->uri->segment(3);
$bt_no=$this->uri->segment(5);
echo form_open(sprintf('/template/write/%s/bp_no/%s',$method,$bt_no), $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$ds_code=$this->input->post('ds_code',TRUE);
$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
?>

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>템플릿관리 등록 정보 입니다. <small>플러스아이디, 앱아디, 센더키를 기재해주세요.</small></h5>
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

<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<input type="text" name="table" id="table" value="bt_template">
<div class="row">
<div class="col-md-12">
<!-- <form method="get" class="form-horizontal"> -->
<div class="form-group"><label class="col-sm-2 control-label">appid</label>
<div class="col-sm-10">
<select name="appid" id="appid" class="form-control" onchange="javascript:chg_plusid()">
<option>선택해주세요.</option>
<?php
foreach($appids as $app)
{
	printf("<option value='%s'>%s</option>",$app->bp_appid,$app->bp_plusid);
}?></select>
<span class="help-block m-b-none" id="mb_id_assist">앱아이디를 등록 합니다. 중복 된 앱아이디를 등록할 수 없습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">플러스아이디</label>
<div class="col-sm-10">
<input type="hidden" name="bt_plusid" id="bt_plusid" class="form-control" value="">
<span class="bt_plusid form-control"></span>

<span class="help-block m-b-none" id="mb_name_assist">플러스친구를 등록 합니다. 예) `배달톡톡` 이면 `@배달톡톡`</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">템플릿코드</label>
<div class="col-sm-10"><input type="text" class="form-control" id="bt_code" name="bt_code" value=""> <span class="help-block m-b-none text-danger" id="mb_name_assist">*주의 선택 기재사항이지만 센더키가 없으면 알림톡이 발송되지 않습니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">템플릿타입</label>
<div class="col-sm-10">
<div class="radio radio-primary radio-inline">
<input type="radio" name="bt_type" id="bt_type_access" value='gcm' checked><label for="bt_type_access"><span class="btn btn-xs btn-success">gcm</span></label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-warning radio-inline">
<input type="radio" name="bt_type" id="bt_type_stop" value='ata'><label for="bt_type_stop"><span class="btn btn-xs btn-warning">ata</span></label>
</div><!-- .radio .radio-info .radio-inline -->
<span class="help-block m-b-none" id="mb_name_assist">`정상`이외에 다른 `중지`, `해지`는 알림톡을 발송하지 않습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<td>
<!-- <input type="radio" name="po_status" id="po_status_0" value="0"><label for="po_status_0"><span class="btn btn_secondary">미적립</span></label>
<input type="radio" name="po_status" id="po_status_1" value="1" checked="checked"><label for="po_status_1"><span class="btn btn_access">사용가능</span></label>
<input type="radio" name="po_status" id="po_status_2" value="2"><label for="po_status_2"><span class="btn btn_info">신청중</span></label>
<input type="radio" name="po_status" id="po_status_3" value="3"><label for="po_status_3"><span class="btn btn_success">현금지급</span></label>
<input type="radio" name="po_status" id="po_status_4" value="4"><label for="po_status_4"><span class="btn btn_black">삭제</span></label> -->
</td>
<div class="form-group"><label class="col-sm-2 control-label">적립타입</label>
<div class="col-sm-10">
<div class="radio radio-primary radio-inline">
<input type="radio" name="po_status" id="po_status_0" value='0' checked><label for="po_status_0"><span class="btn btn-xs btn-white">미적립</span></label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-warning radio-inline">
<input type="radio" name="po_status" id="po_status_1" value='1'><label for="po_status_1"><span class="btn btn-xs btn-success">사용가능</span></label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-danger radio-inline">
<input type="radio" name="po_status" id="po_status_2" value='2'><label for="po_status_2"><span class="btn btn-xs btn-info">신청중</span></label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-danger radio-inline">
<input type="radio" name="po_status" id="po_status_3" value='3'><label for="po_status_3"><span class="btn btn-xs btn-primary">현금지급</span></label>
</div><!-- .radio .radio-info .radio-inline --><div class="radio radio-danger radio-inline">

<input type="radio" name="po_status" id="po_status_terminate" value='terminate'><label for="po_status_terminate"><span class="btn btn-xs btn-free">삭제</span></label>
</div><!-- .radio .radio-info .radio-inline -->

<span class="help-block m-b-none" id="mb_name_assist">- 0:미적립,1:사용가능,2:신청중,3:현금지급,4:삭제</span>


</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">템플릿내용 </label>
<div class="col-sm-10">
<textarea name="bt_content" id="bt_content" cols="30" rows="10"  class="form-control"></textarea>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">정규식 코드</label>
<div class="col-sm-10" id="regex_area">
	<div class="row" id="regex_2">
		<div class="col-xs-5"><label for="ex2">key name</label>
			<input type="text" name="reg_name[]" value="" class="form-control"> 
		</div>
		<div class="col-xs-5"><label for="ex2">key value</label>
			<input type="text" name="reg_value[]" value="" class="form-control">
		</div>
		<div class="col-xs-2">
			<input type="button" value="+" class="btn btn-primary" onclick="javascript:add_regex()">
		</div>
	</div><!-- .row #regex_2 -->
</div><!-- .col-sm-10 #regex_area-->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">템플릿 상세내용 </label>
<div class="col-sm-10">
<input type="text" class="form-control" id="bt_comment" name="bt_comment" value="">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group">
<div class="col-sm-12" style="text-align:center">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button>

</div>
</div>
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

function chg_plusid()
{
	var bt_appid=$("#appid option:selected").text();
	var appid=$("#appid option:selected").val();
	$("#bt_plusid").val(bt_appid);
	$(".bt_plusid").html(bt_appid+"("+appid+")");
}


var regex_index=<?php echo $regex_index;?>;
var max_regex=[<?php echo $regex_index;?>];
/*
add_regex()
2017-12-28 (목) 15:21:03 
정규식 패턴을 추가 합니다.
예제 1) #{매장명} store.name
으로 저장시 상점의 매장으로 불러옵니다.
{table}.{column_name} 의 형태로 불러오는 값을 패턴으로 하며

가운데 . 이 없는 패턴은 모두 Static 한 값으로 인식하여 불러 들입니다.

예제 2) #{전화번호} 010-1234-1234 
전화

*/
function add_regex()
{
	regex_index=Math.max.apply(null,max_regex)+1;

	var object=[];
	object.push('<div class="row" id="regex_'+regex_index+'">');
	object.push('<div class="col-xs-5">');
	object.push('<label for="ex2">key name</label>');
	object.push('<input type="text" name="reg_name[]" value="" class="form-control"> ');
	object.push('</div>');
	object.push('<div class="col-xs-5">');
	object.push('<label for="ex2">key value</label>');
	object.push('<input type="text" name="reg_value[]" value="" class="form-control">');
	object.push('</div>');
	object.push('<div class="col-xs-2">');
	object.push('<input type="button" value="+" class="btn btn-primary" onclick="javascript:add_regex()">');
	object.push('<input type="button" value="-" class="btn btn-danger" onclick="javascript:remove_regex('+regex_index+')">');
	object.push('</div>');
	object.push('</div><!-- .row #regex_'+regex_index+' -->');
/*
	
	object.push('<p id="regex_'+regex_index+'">');
	object.push('<input type="text" name="reg_name[]"   value="'+regex_index+'">');
	object.push('<input type="text" name="reg_value[]"  value="'+regex_index+'">');
	object.push('<input type="button" value="+" onclick="javascript:add_regex()">');
	object.push('<input type="button" value="-" onclick="javascript:remove_regex('+regex_index+')">');
	object.push('</p>');
	*/
	max_regex.push(regex_index);
	console.log(regex_index);
	$("#regex_area").append(object.join(""));
}

function remove_regex(id)
{
	$("#regex_"+id).remove();
}

window.onload = function() {

$( "#mb_id" ).focusout(function() {
	//chk_vali_id();
	chk_duplicate_id();
}).blur(function() {
	blur++;
	//	chk_vali_id();
	chk_duplicate_id();
});
	
//
	/*mb_code로 등록 정보 변경*/
	//chg_gname();
};/*window.onload = function() {..}*/
</script>