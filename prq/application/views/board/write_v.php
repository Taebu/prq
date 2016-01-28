<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>GCM TEST</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a>GCM</a>
</li>
<li class="active">
<strong>GCM TEST</strong>
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
echo form_open('/board/write/prq_member', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
?>
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>GCM 정보 입니다. <small>....</small></h5>
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
<?php 
if($mb_code=="PT"){?>
<div class="form-group"><label class="col-sm-2 control-label">총판 협력사
</label>
<div class="col-sm-10"><select name="mb_pcode" id="">
	<option value="A0002">파알큐(문성준_총판)(A0002)</option>
	<option value="A0003">파알큐(문성준_총판)(A0003)</option>
	<option value="A0004">파알큐(문성준_총판)(A0004)</option>
	<option value="A0005">파알큐(문성준_총판)(A0005)</option>

</select> <span class="help-block m-b-none" id="mb_id_assist">총판협력사를 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<?php }?>
<div class="form-group"><label class="col-sm-2 control-label">핸드폰</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="phone" name="phone"> 
<span class="help-block m-b-none" id="mb_id_assist">핸드폰 번호</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">제목</label>
<div class="col-sm-10"><input type="text" class="form-control" name="title" id="title">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">내용</label>
<div class="col-sm-10">
<textarea name="message" id="message" cols="30" rows="10" class="form-control" ></textarea>
<!-- <input type="text" class="form-control" name="message" id="message"> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">MMS</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="is_mms" id="is_mms_1" value='false' checked><label for="is_mms_1">아닙니다.</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="is_mms" id="is_mms_2"  value='true'><label for="is_mms_2">MMS로 전송 합니다.</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">받는 사람</label>
<div class="col-sm-10"><input type="text" class="form-control" name="receiver_num" id="receiver_num">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">img_url</label>
<div class="col-sm-10"><input type="text" class="form-control" name="img_url" id="img_url" value='http://prq.co.kr/prq/uploads/201601/DS_1453950682.jpg'>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">

<button class="btn btn-primary" type="button" onclick="set_gcm()">GCM 보내기</button>
</div>
</div>


<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

</div>
<!-- 						      <div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->


</div><!-- .col-md-12 Right Menu-->
<!-- <button class="btn btn-primary" type="button" onclick="set_ds()">저장</button> -->
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->

<!-- </div> --><!-- .wrapper .wrapper-content .animated .fadeInRight -->
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

/*gcm 연동 테스트*/
function set_gcm(){
var param=$("#write_action").serialize();
//alert(param);
if($("#phone").val().length<4){
	alert("너무 짧다. 다시");
	$("#phone").focus();
	return;
}


if($("#title").val().length<4){
//	alert("너무 짧다. 다시");
//	$("#title").focus();
//	return;
}

if($("#message").val().length<4){
	alert("너무 짧다. 다시");
	$("#message").focus();
	return;
}
	
$.ajax({
url:"/prq/set_gcm.php",
type: "POST",
data:param,
dataType:"json",
success: function(data) {
	
	var string="성공 : "+data.success+"\n";
	string+="실패 : "+data.failure+"\n";
	alert (string);
	}
});

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
chg_gname();
};/*window.onload = function() {..}*/




</script>