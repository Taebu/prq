<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>GCM Send</h2>
<ol class="breadcrumb">
<li><a href="/prq/">Home</a></li>
<li><a>GCM</a></li>
<li class="active"><strong>GCM Send</strong></li></ol></div>
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
	<h5>GCM Send <small>GCM을 MMS 형태로 전송처리 합니다.</small></h5>
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
<textarea name="message" id="message" cols="30" rows="10" class="form-control"  onkeyup='chk_byte()'></textarea>
<span id='bytesize'>0</span> byte
<!-- <input type="text" class="form-control" name="message" id="message"> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">MNO TYPE</label>
<div class="col-sm-10 ">

<div class="radio radio-info radio-inline">
<input type="radio" name="mno_type" id="is_mno_1" value='SK' checked><label for="is_mno_1">SK</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="mno_type" id="is_mno_2" value='LG'><label for="is_mno_2">LG</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="mno_type" id="is_mno_3"  value='KT'><label for="is_mno_3">KT</label>
</div><!-- .radio .radio-info .radio-inline -->

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

<div class="form-group"><label class="col-sm-2 control-label">Happycall</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="happycall" id="happycall_1" value='false' checked><label for="happycall_1">happycall이 아닙니다.</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="happycall" id="happycall_2"  value='true'><label for="happycall_2">happycall로 전송 합니다.</label>
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
<button class="btn btn-primary" type="button" onclick="set_img_url()">기본 이미지</button>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">상점 번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_no" id="st_no">
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
/* server에 <span class="mb_gname">총판</span>을 등록 합니다. */

/*-------------------------------------------------------------------
기능:  쿠키값을 셋팅한다.
사용예: 
setCookie('isEnter','OK');//브라우저쿠키로 사용
setCookie('isEnter','OK',1);//하루동안 설정
*-------------------------------------------------------------------*/
function setCookie(name, value, expiredays) {
 var expire_date = new Date(); 
 var strDomain = document.domain;
 var posDot = strDomain.indexOf(".");
 if(posDot>-1){
  strDomain = strDomain.substring(posDot);
 }
 if(undefined==expiredays){
  //if(false && posDot>-1){
  // document.cookie = name + "=" + escape( value ) + "; path=/; domain="+strDomain+"";//
  //}
  //else{
   document.cookie = name + "=" + escape( value ) + "; path=/;";
  //}
 }
 else{
  expire_date.setDate(expire_date.getDate() + expiredays );
  document.cookie = name + "=" + escape( value ) + "; expires=" + expire_date.toGMTString() + "; path=/";
 }
} 

/*-------------------------------------------------------------------
기능: 쿠키값을 얻어온다.  
사용예: var val=getCookie('cookiename');
*-------------------------------------------------------------------*/
function getCookie(name){
    var nameOfCookie = name + "=";
    var x = 0;
    while ( x <= document.cookie.length ){
        var y = (x+nameOfCookie.length);
        if ( document.cookie.substring( x, y ) == nameOfCookie ) {
            if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 ) {
                endOfCookie = document.cookie.length;
            }
            return unescape( document.cookie.substring( y, endOfCookie ) );
        }
        x = document.cookie.indexOf(" ", x ) + 1;
        if ( x == 0 )
        break;
    }
    return "";
}


/*-------------------------------------------------------------------
기능: 2014-06-24 날짜를 가져온다. YYYY-MM-DD  
사용예: 
	오늘 var val=getDateISO();
	한달전 var val=getDateISO(-1);
	한달후 var val=getDateISO(1);
*-------------------------------------------------------------------*/

function getDateISO(editmonth)
{
	var myDate, day, month, year, date;
	myDate = new Date();

	if(editmonth){
	month=myDate.getMonth()+1;
	myDate.setMonth(month+editmonth);
	}

	year = myDate.getFullYear();
	month = myDate.getMonth()+1;
	day = myDate.getDate();

	month=month<10?"0"+month:month;
	day=day<10?"0"+day:day;

	date = year + "-" + month + "-" + day;
	return date;
}



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
	/* 세팅된 값 쿠키에 저장*/
	setCookie("phone", $("#phone").val(), 365);
	setCookie("title", $("#title").val(), 365);
	setCookie("message", $("#message").val(), 365);
	setCookie("img_url", $("#img_url").val(), 365);
	setCookie("st_no", $("#st_no").val(), 365);
	setCookie("receiver_num", $("#receiver_num").val(), 365);
	setCookie("mno_type", $(':radio[name="mno_type"]:checked').val(), 365);
	setCookie("is_mms", $(':radio[name="is_mms"]:checked').val(), 365);

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
	if(data.success){

	var string="전송 성공  \n";

	alert (string);	
	}else{
	alert("전송실패");
	}

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

function set_img_url(){
$("#img_url").val("http://prq.co.kr/prq/uploads/201601/DS_1453950682.jpg");

}
window.onload = function() {

$( "#mb_id" ).focusout(function() {
chk_vali_id();
})
.blur(function() {
blur++;
chk_vali_id();
});




$("#phone").val(getCookie("phone"));
$("#title").val(getCookie("title"));
$("#message").html(getCookie("message"));
$("#img_url").val(getCookie("img_url"));
$("#st_no").val(getCookie("st_no"));
$("#receiver_num").val(getCookie("receiver_num"));


$("input:radio[name='mno_type']:radio[value='"+getCookie("mno_type")+"']").attr("checked",true);
$("input:radio[name='is_mms']:radio[value='"+getCookie("is_mms")+"']").attr("checked",true);

/* 메세지 길이 */
chk_byte();


};/*window.onload = function() {..}*/




</script>