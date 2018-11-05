
<div class="row wrapper border-bottom white-bg page-heading">
	<div style="border:0px solid red;text-align:center;">
		<img src="/prq/img/new/view_top.png" width="100%">
	</div>
	<div class="col-lg-10" style="text-align:center;">
		<ul style="margin:0;padding:10px 0 10px 0;list-style:none;">
			<!-- <li><?php echo $friends->pt_name." (".$friends->pt_code.")";?></li> -->
			<li> <input type="text" style="text-align:center;width:100%;border:0px;" name="" id="" value="<?php echo $friends->pt_name;?> "/></li>
			<li style="font-weight:bold;font-size:27px;"><input type="text" style="text-align:center;width:100%;border:0px;" name="" id="" value="<?php echo $store->st_name;?>"/></li>
			<li>BLOG Review</li>
			<li style="border:1px solid #bbb;width:210px;margin:0 auto;"></li>
			<li style="margin:15px 0 2px 0;">일반번호 : <input type="text" style="border:0px;" name="" id="" value="<?php echo $store->st_tel;?>"/></li>
			<li>050 번호 : <input type="text" style="border:0px;" name="" id="" value="<?php echo $store->st_vtel;?>"/>
			</li>
			
			<li style="margin:2px 0 2px 0;"><input type="text" style="margin-left:-20px;text-align:center;width:100%;border:0px;font-size:15px;" name="" id="" value="http://prq.co.kr/prq/page/<?php echo $store->st_no;?>"/></li>
		</ul>
		<!-- <ol class="breadcrumb">
			<li>
				<a href="/">Home</a>
			</li>
			<li>
				<a>블로그 관리</a>
			</li>
			<li class="active">
				<strong>블로그 리뷰 보기</strong>
			</li>
		</ol> -->
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
echo form_open('/blog/modify/', $attributes);

$bf_file=$views->bl_file;
IF($bf_file!=0){

$arr_file=explode("_",$bf_file);
$d1x=$arr_file[0];
$d2x=$d1x+$arr_file[1];
$d3x=$d2x+$arr_file[2];
}
?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="is_member" id="is_member">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="mb_pcode" id="mb_pcode" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="chk_seq[]" id="chk_seq" value='<?php echo $views->bl_no;?>' checked>
<!-- <input type="text" name="bl_file" id="bl_file" value="<?php echo $views->bl_file;?>">
<input type="text" name="bl_naverid" id="bl_naverid" value="testid">-->
<input type="hidden" name="bl_no" id="bl_no" value="<?php echo $this->uri->segment(3);?>"> 

<input type="hidden" name="bl_imgprefix" id="bl_imgprefix" value="<?php echo $views->bl_imgprefix;?>">

<input type="hidden" name="ds_code" id="ds_code" value="<?php echo @$this->input->cookie('prq_fcode',TRUE);?>">

<div class="row">
<div class="col-lg-12">
<!-- <div id="image_area">#image_area</div> -->

<?php
$arrays=array();

//print_r($store);

foreach($files as $fi){
	$arrays[]="http://".$_SERVER['SERVER_NAME'].'/prq/uploads/'.$fi->bf_content."/".$fi->bf_source;
}


?>
</div><!--.col-lg-12-->
</div><!--.row-->






<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<!-- <div class="ibox-title">
<h5>"<?php echo $store->st_name;?>"에 사용자가 올린 리뷰 보기 <small>이용후기의 사진 광고 목적으로 사용 할 수 있습니다.</small></h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li>
	</ul>
	<a class="close-link"><i class="fa fa-times"></i></a>
	</div> 
</div> --><!-- .ibox-title -->

<div class="ibox-content" style="padding-top:20px;">

<div class="col-md-12" style="padding:0px;">


            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <!-- <div class="ibox-title">
                            <h5>배달음식 사진</h5>
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
                        </div> --><!-- .ibox-title -->
                        <div class="ibox-content" style="padding:0px;">
                            <div class="carousel slide" id="carousel1">
                                <div class="carousel-inner">
                                    <div class="item gallery active">
                                        <div class="row">
										<?php
										IF(isset($d1x)){
											for($i=0;$i<$d1x;$i++){
												echo "<div class=\"col-sm-12\" style=\"margin-bottom:0px\">";

												echo "<img src='".$arrays[$i]."' class=\"img-responsive\">";
												echo "</div>";
											}
											
												}

												if(!isset($d1x))
											{
												echo "<div class=\"col-sm-12\" style=\"margin-bottom:0px\">";
												echo "첫번째 등록된 리뷰 사진이 없습니다.";
												echo "</div>";
											}
										?>

										</div>
                                    </div>
                                </div>
                                <!-- <a data-slide="prev" href="#carousel1" class="left carousel-control">
                                    <span class="icon-prev"></span>
                                </a>
                                <a data-slide="next" href="#carousel1" class="right carousel-control">
                                    <span class="icon-next"></span>
                                </a> -->
                            </div>
                        </div><!-- .ibox-content -->
                    </div><!-- .ibox float-e-margins -->
                </div><!-- .col-lg-12 -->
            </div><!-- .row -->


<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->

<div class="form-group"><!-- <label class="col-sm-2 control-label">첫 번째 글</label> -->
<div class="col-sm-10" style="word-break:break-all;word-wrap:break-word;">
<?php 
$bl_content1=nl2br($views->bl_content1);
echo $bl_content1;?><!-- #form_data -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->


            <div class="row" style="margin-top:25px;">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <!-- <div class="ibox-title">
                            <h5>먹방 사진</h5>
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
                        </div> --><!-- .ibox-title -->
                        <div class="ibox-content" style="padding:0px;">
                            <div class="carousel slide" id="carousel2">
                                <div class="carousel-inner">
                                    <div class="item gallery active">
                                        <div class="row">
										<?php
										IF(isset($d2x)){
											for($i=$d1x;$i<$d2x;$i++){
												echo "<div class=\"col-sm-12\" style=\"margin-bottom:0px\">";
												echo "<img src='".$arrays[$i]."' class=\"img-responsive\">";
												echo "</div>";
											}                                  }

											if(!isset($d2x))
											{
												echo "<div class=\"col-sm-12\" style=\"margin-bottom:0px\">";
												echo "두번째, 등록된 리뷰 사진이 없습니다.";
												echo "</div>";
											}
										?>
										</div>
                                    </div>
                                </div>
                                <!-- <a data-slide="prev" href="#carousel2" class="left carousel-control">
                                    <span class="icon-prev"></span>
                                </a>
                                <a data-slide="next" href="#carousel2" class="right carousel-control">
                                    <span class="icon-next"></span>
                                </a> -->
                            </div>
                        </div><!-- .ibox-content -->
                    </div><!-- .ibox float-e-margins -->
                </div><!-- .col-lg-12 -->
            </div><!-- .row -->
<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->

<div class="form-group"><!-- <label class="col-sm-2 control-label">두 번째 글</label> -->
<div class="col-sm-10" style="word-break:break-all;word-wrap:break-word;">
<?php 
$bl_content2=nl2br($views->bl_content2);
echo $bl_content2;?><!-- #form_data -->
<!-- <span class="help-block m-b-none"><span id='bytesize_2'>0</span> byte <br>
100 byte 이상 작성하셔야 합니다.~ !!! <br>
무성의한 글은 신청시 포인트 지급이 거절 될 수 있습니다. -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->



            <div class="row" style="margin-top:25px;">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <!-- <div class="ibox-title">
                            <h5>잘찍은 사진</h5>
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
                        </div> --><!-- .ibox-title -->
                        <div class="ibox-content" style="padding:0px;">
                            <div class="carousel slide" id="carousel3">
                                <div class="carousel-inner">
                                    <div class="item gallery active">
                                        <div class="row">
										<?php
										IF(isset($d3x)){
											for($i=$d2x;$i<$d3x;$i++){
												echo "<div class=\"col-sm-12\" style=\"margin-bottom:0px\">";
												echo "<img src='".$arrays[$i]."' class=\"img-responsive\">";
												echo "</div>";
											}
											}

											if(!isset($d3x))
											{
												echo "<div class=\"col-sm-12\" style=\"margin-bottom:0px\">";
												echo "세번째, 등록된 리뷰 사진이 없습니다.";
												echo "</div>";
											}
										?>
										</div>
                                    </div>
                                </div>
                                <!-- <a data-slide="prev" href="#carousel3" class="left carousel-control">
                                    <span class="icon-prev"></span>
                                </a>
                                <a data-slide="next" href="#carousel3" class="right carousel-control">
                                    <span class="icon-next"></span>
                                </a> -->
                            </div>
                        </div><!-- .ibox-content -->
                    </div><!-- .ibox float-e-margins -->
                </div><!-- .col-lg-12 -->
            </div><!-- .row -->

<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->

<div class="form-group"><!-- <label class="col-sm-2 control-label">세 번째 글</label> -->
<div class="col-sm-10" style="word-break:break-all;word-wrap:break-word;"><?php $bl_content3=nl2br($views->bl_content3);
echo $bl_content3;?><!-- #form_data -->


<!-- <span class="help-block m-b-none"><span id='bytesize_3'>0</span> byte <br>
여기까지 작성하시면 특별한 혜택을 더해 드려요. ☆♥♡♥♡☆ -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->
</div><!-- .col-md-12 -->


<!-- <div class="form-group">
	<label class="col-sm-2 control-label">이름</label> <div class="col-sm-10"><?php echo $views->bl_name;?></div> 
</div> --><!-- .form-group -->
<!-- <div class="hr-line-dashed"></div> --><!-- .hr-line-dashed -->
<div class="form-group" style="text-align:center;font-size:17px;">
	<label class="col-sm-2 control-label">이벤트 혜택 선택</label>
	<div class="col-sm-10" style="">
	<?php echo $views->bl_gifticon_type=="cu_2000"?"CU 상품권 2,000원":"";?>
	<?php echo $views->bl_gifticon_type=="cash_2000"?"현금 2,000원":"";?>
	
	</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<div class="form-group" style="text-align:center;font-size:17px;">
	<label class="col-sm-2 control-label">핸드폰</label>
	<div class="col-sm-10" style=""><?php echo $views->bl_hp;?></div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<div style="text-align:center;margin-top:30px;">
	<ul style="margin:0;padding:0;list-style:none;color:#fff;font-weight:100;font-size:15px;">
		<li class="col-lg-4" style="padding:5px;">
			<div style="background:#0a285a;border-radius:5px;padding:10px;cursor:pointer" onclick="javascript:set_point('ceo_deny');">
				사 장 거 절
			</div>
		</li>
		<li class="col-lg-4" style="padding:5px">
			<div style="background:#2d5baa;border-radius:5px;padding:10px;cursor:pointer" onclick="javascript:set_point('ceo_allow');">
			사 장 승 인
			</div>
		</li>
		<li class="col-lg-4" style="padding:5px">
			<div style="background:#89bbe4;border-radius:5px;cursor:pointer;padding:10px;" onclick="javascript:location.href='/prq/blog/modify/<?php echo $this->uri->segment(3);?>';">
			수 정 하 기
			</div>
		</li>
		<li style="clear:both;"></li>
	</ul>
</div>

<div class="controls">

<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<div class="form-group">
<div class="col-sm-10 col-sm-offset-2" style="width:100%;">
<!-- <button type="button" class="btn btn-primary btn-block" onclick="javascript:modify_blog()" id="write_btn" style="background:#10cdf4;border:1px solid #05c2e9;font-size:16px;font-weight:bold;">리뷰 수정하기</button> -->
<!-- <button type="submit" class="btn btn-primary" id="write_btn">작성 실제 적용</button> -->
<!-- <button class="btn btn-white" type="reset">취소</button> -->
<!-- <button class="btn btn-primary" type="button" onclick="set_ds()">파람...</button> -->
<!--
<div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->

<div class="row"><div class="col-md-12">
<!-- <textarea id="form_data"  class="form-control" rows="4" cols="50">#form_data</textarea> --><!-- #form_data -->
</div></div>
</div><!-- .col-md-6 Right Menu-->
<!-- <button class="btn btn-primary" type="button" onclick="set_ds()">저장</button> -->
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->

<!-- </div> --><!-- .wrapper .wrapper-content .animated .fadeInRight -->
<script type="text/javascript">
var image_file_count=0;


/*
server에 <span class="mb_gname">총판</span>을 등록 합니다.
*/
function set_ds(){
var param=$("#write_action").serialize();
param=param.replace(/&/gi, "\n&");
$("#form_data").html(param);
if($("#is_join").val()=="TRUE"){
$("#form_data").html(param);
//	$("#write_action").submit();
//set_member();
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


function set_member(){
var param=$("#write_action").serialize();
$("#write_action").submit();
}
function chk_btn_status()
{
	var param=$("#write_action").serialize();
//			$(".btn_area [lass*='btn-']").toggleClass("disabled",param.indexOf("chk_seq")<0).prop('disabled', param.indexOf("chk_seq")<0);
	
	if(param.indexOf("st_alltime")>0)
	{
		$("#st_open").val('00:00');
		$("#st_closed").val('24:00');
		$("#st_open").addClass("disabled").prop('disabled', true); 
		$("#st_closed").addClass("disabled").prop('disabled', true); 
	}else{
		$("#st_open").removeClass("disabled").prop('disabled', false); 
		$("#st_closed").removeClass("disabled").prop('disabled', false); 
	}
	
}
/*가맴점 코드를 불러 옵니다.*/
var pt_code="";
function get_frcode()
{
	$.ajax({
	url:"/prq/ajax/get_frcode/"+$("#ds_code").val(),
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		pt_code=data.posts;
		search_frcode();
		}
	});
}
function search_frcode()
{
	var object = [];
	var chk_max_ptcode=[];
if(pt_code===undefined){
	$("#prq_fcode").html("<option selected>사용 가능한 가맹점코드가 하나도 없습니다. 코드와 가맹점을 등록 해주세요.</option>");
}else{
	$.each(pt_code,function(key,val){
		if("DS0001"==val.pt_code){
			object.push('<option value='+val.fr_code+' selected>');
		}else{
			object.push('<option value='+val.fr_code+'>');
		}
		chk_max_ptcode.push(val.fr_code);
		object.push('['+val.fr_code+']');
		object.push(val.fr_name);
		object.push('</option>');
	});
	var result=object.join("");
	var chk_gcode=$("#mb_gcode").val();
	if(chk_gcode=="G5"){
	$("#fr_code").html(result);
	}else{
	$("#prq_fcode").html(result);
	}
}
}
var fr_mail=[];
function get_frmail()
{
	$.ajax({
	url:"/prq/ajax/get_frmail/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
			$.each(data.posts,function(key,val){
				
				fr_mail[val.prq_fcode]=val.mb_email;
			});
		}
	});
}
function get_mb_id(v){
$("#mb_id").val(fr_mail[v]);
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
function chk_byte(id){
var str=document.getElementById("content"+id).value;
//console.log(str);
var bytesize=getstrbyte(str);
//console.log(bytesize);
document.getElementById("bytesize_"+id).innerHTML=bytesize;
}

/* Textarea to resize based on content length */
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}



window.onload = function() {
/*	chk_byte(1);
	chk_byte(2);
	chk_byte(3);
    var checkload = true;

    $("#write_btn").click(function () {
        checkload = false;
    });
 
    $(window).on("beforeunload", function () {
        if (checkload == true) return "레알 나감????????????";
    });
  //출처 ㅡ 「페이지 벗어날때 확인창 띄우기 - 따블류 랩」 https://lab.hv-l.net/?document_srl=172498
 */
};/*window.onload = function() {..}*/


function set_top_msg(v){
$("#st_top_msg").val("(광고) [ "+v+" ] 에서");
}

function get_store()
{
	$.ajax({
	url:"/prq/ajax/get_frmail/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
			$.each(data.posts,function(key,val){
				
				fr_mail[val.prq_fcode]=val.mb_email;
			});
		}
	});
}

function modify_blog(){
location.href='/prq/blog/modify/'+$("#bl_no").val();
}

/* swal 로 적용 */
function set_point(k)
{
	
	swal({
		title: "정말 변경 하시겠습니까?",
		text: "해당 블로그 리뷰를 \""+get_status(k)+"\"(으)로 변경 됩니다.<br> 진행 하시겠습니까?<br>변경 사유를 작성해 주세요.",
		html:true,
		type: "input",
		showCancelButton: true,
		closeOnConfirm: false,
		cancelOnConfirm: false,
		confirmButtonText: "네, 변경할래요!",
		cancelButtonText: "아니요, 취소할래요!",
		animation: "slide-from-top",
		showLoaderOnConfirm: true,
		allowEscapeKey:true,
		inputPlaceholder: "변경 사유는 로그에 기록 됩니다." 
		}, 
		function(v){
			set_ajax_status(k,v);
		});
}

/* 비동기 통신 적용 */
function set_ajax_status(k,v){
		if (v === false) return false;
		if(!v){
			swal("취소!", "취소 하였습니다.", "error");
		}
		if (v.length<3) {
		  swal.showInputError("3자이상 사유를 적어 주세요.");
		  return false
		}

		var param=$("#write_action").serialize();
		param=param+"&mb_status="+k;
		console.log(param);
		/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
		param=param+"&mb_reason="+v;
		$.ajax({
		url:"/prq/ajax/chg_status/prq_blog",
			data:param,
			dataType:"json",
			method:"POST",
			success:function(data){
				if(data.success){
					//alert("변경에 성공하였습니다.");
					swal("변경!", "변경에 성공하였습니다.. 변경 사유 : "+v, "success");
					/*
					$.each(data.posts,function(key,val){
						$("#status_"+val.mb_no).html(val.mb_status);
					});
					*/
				}
				console.log(data);
				console.log(data=="9000");
				if(data=="9000"){
					//swal("로그인!", "로그인 되지 않았습니다. 로그인 하시겠습니까?", "error");
					swal({   
						title: "로그인!",
						text: "변경하려면 로그인 되어야 합니다. 로그인 하시겠습니까?",
						type: "warning",
						showCancelButton: true,
						closeOnConfirm: false,
						animation: "slide-from-top"
					}, 
					function(v)
					{
						/*취소를 눌렀을 때*/
						if (v === false) return false;

						swal("Nice!", "2초 뒤 로그인 페이지로 이동 합니다. ", "success");
						
						setTimeout(function(){console.log('setTimeout');$(location).attr('href', "/prq/auth/");}, 2000);
						;
					});	
				}

			}
		});

}


function get_status(code)
{
	var object=[];
	object['view']='사용자 포스팅 등록';
	object['ceo_allow']='사장승인';
	object['ceo_deny']='사장거절';
	object['co_blog_allow']='일반 승인';
	object['co_blog_deny']='일반 거절';
	object['po_blog_allow']='포인트 승인';
	object['po_blog_deny']='포인트 거절';
	return object[code];
}
</script>
<style type="text/css">
#image_area{display:none}
</style>
