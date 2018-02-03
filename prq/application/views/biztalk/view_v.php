
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>플러스 친구 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a>플러스 친구</a>
</li>
<li class="active">
<strong>플러스 친구 등록</strong>
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
echo form_open('/codes/write/prq_dscode', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$ds_code=$this->input->post('ds_code',TRUE);
$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
?>

<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>플러스 친구 등록 정보 입니다. <small>플러스아이디, 앱아디, 센더키를 기재해주세요.</small></h5>
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
<div class="col-md-12">
<!-- <form method="get" class="form-horizontal"> -->
<div class="form-group"><label class="col-sm-2 control-label">appid</label>
<div class="col-sm-10"><?php echo $views->bp_appid;?> <span class="help-block m-b-none" id="mb_id_assist">앱아이디를 등록 합니다. 중복 된 앱아이디를 등록할 수 없습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">플러스친구</label>
<div class="col-sm-10"><?php echo $views->bp_plusid;?> <span class="help-block m-b-none" id="mb_name_assist">플러스친구를 등록 합니다. 예) `배달톡톡` 이면 `@배달톡톡`</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">센더키</label>
<div class="col-sm-10"><?php echo $views->bp_senderid;?> <span class="help-block m-b-none text-danger" id="mb_name_assist">*주의 선택 기재사항이지만 센더키가 없으면 알림톡이 발송되지 않습니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<?php 

function chg_code_status($key)
{
	$array['access']="정상";
	$array['stop']="정지";
	$array['terminate']="해지";
	$array['0']='<span class="btn btn_secondary">미적립</span>';
	$array['1']='<span class="btn btn_access">사용가능</span>';
	$array['2']='<span class="btn btn_info">신청중</span>';
	$array['3']='<span class="btn btn_success">현금지급</span>';
	$array['4']='<span class="btn btn_black">삭제</span>';
	if (array_key_exists($key, $array)) {
		$result=$array[$key];
	}else{
		$result="정상";
	}
	return $result;
}
?>

<div class="form-group"><label class="col-sm-2 control-label">상태</label>
<div class="col-sm-10">
<span class="btn btn-xs btn-success"><?php echo chg_code_status($views->bp_status);?></span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<a href="/prq/biztalk/modify/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a> 
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
};/*window.onload = function() {..}*/
</script>