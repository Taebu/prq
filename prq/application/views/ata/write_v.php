<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>ATA Send</h2>
<ol class="breadcrumb">
<li><a href="/prq/">Home</a></li>
<li><a>ATA</a></li>
<li class="active"><strong>ATA Send</strong></li></ol></div>
<div class="col-lg-2"></div>
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
<input type="hidden" name="mode" value="manual">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>ATA Send <small>ATA를 카카오톡 형태로 전송처리 합니다.</small></h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a>
	</div>
</div><!-- .ibox-title -->
<div class="ibox-content">
<div class="row">
<div class="col-md-12">
<!-- <form method="get" class="form-horizontal"> -->
<div class="form-group"><label class="col-sm-2 control-label">받는 사람 <br> [핸드폰]</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="mb_hp" name="mb_hp" value="01030372004"> 
<span class="help-block m-b-none" id="mb_hp">[비즈톡 @배달맛톡]받는사람</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">내용</label>
<div class="col-sm-10">
<textarea name="message" id="message" cols="30" rows="10" class="form-control"  onkeyup='chk_byte()' style='height:500px'>[PRQ 테스트] 에서 주문 해주셔서 감사합니다
전화번호 : 050-8515-0001
적립금액 : 2,000원 적립
5회 주문시 현금 최대 5,000원
10회 주문시 현금 최대 10,000원
20회 주문시 현금 최대 20,000원
적립기간 : 적립 후 부터 60일 후 소멸

"배달맛톡" 어플로 주문 시 마다 적립을 해드립니다.

적립금은 "배달맛톡" 에서 제공하며 어플에서 미션달성 시 현금으로 교환하여 사용하실 수 있습니다.

12,000원 이하 주문 시 적립금액은 무효 처리됩니다.

적립금 관련 궁금한 점은 1599-9495 으로 문의해 주세요

앱 다운로드 링크
http://prq.co.kr/prq/page/7"</textarea>
<span id='bytesize'>0</span> byte
<!-- <input type="text" class="form-control" name="message" id="message"> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->

<!-- <div class="form-group"><label class="col-sm-2 control-label">보내는 사람</label>
<div class="col-sm-10"><input type="text" class="form-control" name="receiver_num" id="receiver_num"  value="01077430009">
</div>.col-sm-10
</div>.form-group
<div class="hr-line-dashed"></div>.hr-line-dashed -->

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">

<button class="btn btn-primary" type="button" onclick="set_ata()">ATA 보내기</button>
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

/*ata 연동 테스트*/
function set_ata(){
var param=$("#write_action").serialize();
//alert(param);
if($("#mb_hp").val().length<4){
	alert("너무 짧다. 다시");
	$("#mb_hp").focus();
	return;
}


if($("#message").val().length<4){
	alert("너무 짧다. 다시");
	$("#message").focus();
	return;
}
	
$.ajax({
url:"/prq/ajax/set_ata",
type: "POST",
data:param,
dataType:"json",
success: function(data) {
	console.log(data);
/*
	if(data.success){

	var string="전송 성공  \n";

	alert (string);	
	}else{
	alert("전송실패");
	}
*/
	}
});

}

/* 개선된 FOR문으로 문자열 BYTE 계산 */
function getstrbyte(string)
{
	var stringByteLength=0;
	stringByteLength = (function(s,b,i,c){
		for(b=i=0;c=s.charCodeAt(i++);b+=c>>11?2:c>>7?2:1);
		return b
	})(string);
	return stringByteLength;
}


/* 메세지 길이 */
function chk_byte(){
var str=document.getElementById("message").value;
console.log(str);
var bytesize=getstrbyte(str);
console.log(bytesize);
document.getElementById("bytesize").innerHTML=bytesize;
}

window.onload = function() {

$( "#mb_id" ).focusout(function() {
chk_vali_id();
})
.blur(function() {
blur++;
chk_vali_id();
});
/* 메세지 길이 */
chk_byte();
};/*window.onload = function() {..}*/




</script>