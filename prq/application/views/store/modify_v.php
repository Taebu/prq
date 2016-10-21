<script type="text/javascript">

function modify_ds(){
var param=$("#write_action").serialize();

$.ajax({
url:"/prq/board/modify/prq_member/board_id/5",
type: "POST",
data:param,
cache: false,
async: false,
success: function(data) {
console.log(data);
}
});		
}
function showDropzone (){
//	$("#my-awesome-dropzone1").html("...");
}
</script>
	<article id="board_area">
	<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>상점 수정</h2>
<ol class="breadcrumb">
<li><a href="/">Home</a></li>
<li><a href="/prq/stoer/lists/prq_member/">상점관리</a></li>
<li class="active"><strong>상점 수정</strong></li>
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
//echo form_open('/board/modify/prq_member', $attributes);

echo form_open('/store/modify/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5), array('id'=>'write_action', 'class'=>'form-horizontal'));

//echo form_open_multipart('/dropzone/upload', $attributes);

$mb_code=$this->input->post('mb_code',TRUE);
$prq_fcode=$this->input->cookie('prq_fcode',TRUE);
$mb_gcode=$this->input->cookie('mb_gcode',TRUE);

?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_member" id="is_member">
<?php if($mb_gcode=="G5"){?>
<input type="hidden" name="prq_fcode" id="prq_fcode" value="<?php echo $views->prq_fcode;?>">
<?php }?>
<input type="hidden" name="sel_prq_fcode" id="sel_prq_fcode" value="<?php echo $views->prq_fcode;?>">
<input type="hidden" name="mb_gcode" id="mb_gcode" value="<?php echo $mb_gcode;?>">
<input type="hidden" name="is_join" id="is_join">
<input type="hidden" id="mode" value="modify">
<input type="hidden" id="st_no" name="st_no" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" id="st_business_paper" name="st_business_paper" value="<?php echo $views->st_business_paper;?>">
<input type="hidden" id="st_business_paper_size" name="st_business_paper_size" value="<?php echo $views->st_business_paper_size;?>">

<input type="hidden" id="st_thumb_paper" name="st_thumb_paper" value="<?php echo $views->st_thumb_paper;?>">
<input type="hidden" id="st_thumb_paper_size" name="st_thumb_paper_size" value="<?php echo $views->st_thumb_paper_size;?>">

<input type="hidden" id="st_menu_paper" name="st_menu_paper" value="<?php echo $views->st_menu_paper;?>">
<input type="hidden" id="st_menu_paper_size" name="st_menu_paper_size" value="<?php echo $views->st_menu_paper_size;?>">

<input type="hidden" id="st_main_paper" name="st_main_paper" value="<?php echo $views->st_main_paper;?>">
<input type="hidden" id="st_main_paper_size" name="st_main_paper_size" value="<?php echo $views->st_main_paper_size;?>">



<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5>상점 수정 정보 입니다. <small>상점 수정의 정보 및 계약서를 작성해 주세요.</small></h5>
<div class="ibox-tools">
<a class="collapse-link">
<i class="fa fa-chevron-up"></i>
</a>
<a class="dropdown-toggle" data-toggle="dropdown" href="#">
<i class="fa fa-wrench"></i>
</a>
<ul class="dropdown-menu dropdown-user">
<li><a href="#">Config option 1</a></li>
<li><a href="#">Config option 2</a></li>
</ul>
<a class="close-link"><i class="fa fa-times"></i></a>
</div>
</div><!-- .ibox-title -->
<div class="ibox-content">
<div class="row">
<div class="col-md-6">
<!--
stdClass Object
(
    [st_no] => 2
    [prq_fcode] => DS0003PT0001FR0003
    [st_category] => W01
    [st_name] => 성준치킨
    [st_tel] => 031-909-5242
    [st_open] => 
    [st_closed] => 
    [st_alltime] => on
    [st_closingdate] => 
    [st_destination] => 
    [st_intro] => 소개
    [st_password] => 
    [st_nick] => 
    [st_nick_date] => 0000-00-00
    [st_email] => 
    [st_homepage] => 
    [st_business_name] => 
    [st_business_paper] => 
    [st_business_paper_size] => 0
    [st_thumb_paper] => store_1453960198.jpg
    [st_thumb_paper_size] => 5326
    [st_menu_paper] => 
    [st_menu_paper_size] => 0
    [st_main_paper] => 
    [st_main_paper_size] => 0
    [st_business_num] => 
    [st_datetime] => 2016-01-28 14:53:14
    [st_status] => wa
)
-->
<div class="form-group"><label class="col-sm-2 control-label">가맹점선택 </label>
<div class="col-sm-10">

<?php if($mb_gcode=="G5"){?>
<select name="fr_code" id="fr_code" class="form-control" >
	<option value="FR0001">네네치킨(FR0001)</option>
	<option value="FR0002">네네치킨(FR0002)</option>
	<option value="FR0003">네네치킨(FR0003)</option>
	<option value="FR0004">네네치킨(FR0004)</option>
	<option value="FR0005">네네치킨(FR0005)</option>
</select>
<?php }else if($mb_gcode!="G5"){?>
<select name="prq_fcode" id="prq_fcode" class="form-control" onchange="get_mb_id(this.value)" onclick="get_mb_id(this.value)"></select> 
<?php }?>

<span class="help-block m-b-none">가맹점을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">가맹점 아이디 </label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id" value="<?php echo $views->mb_id;?>" > <span class="help-block m-b-none">가맹점 아이디 입니다.. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">카테고리 선택
</label>
<div class="col-sm-10">
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
<select name="st_category" id="st_category" class="form-control" >
<option value="W01" selected>치킨</option>
<option value="W02">피자</option>
<option value="W03">중국집</option>
<option value="W04">한식/분식</option>
<option value="W05">닭발/오리/기타</option>
<option value="W06">야식/찜/탕 </option>
<option value="W07">족발/보쌈</option>
<option value="W08">일식/회/기타</option>
<option value="W09">오락/레저</option>
<option value="W10">건강/뷰티</option>
<option value="W11">꽃배달</option>
<option value="W12">병원/약국</option>
<option value="W13">집수리</option>
<option value="W14">학원</option>
<option value="W15">이사/용달/퀵</option>
<option value="W16">부동산</option>
<option value="W17">청소/파출부</option>
<option value="W18">자동차</option>
<option value="W19">컴퓨터/인터넷</option>
<option value="W20">기타</option>
<option value="W21">소셜</option>
<option value="W00">할인</option>
</select><span class="help-block m-b-none">카테고리를을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">매장 명</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_name" name="st_name" value="<?php echo $views->st_name;?>" > <span class="help-block m-b-none">매장명을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="form-group"><label class="col-sm-2 control-label">전화 번호 Type</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_teltype" id="st_teltype_1" value='prq' <?php echo $views->st_teltype=="prq"?"checked":"";?>><label for="st_teltype_1">prq</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_teltype" id="st_teltype_2"  value='cashq' <?php echo $views->st_teltype=="cashq"?"checked":"";?>><label for="st_teltype_2">cashq</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">전화번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_tel" id="st_tel" value="<?php echo $views->st_tel;?>"> <span class="help-block m-b-none">연락처를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">050 번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_vtel" id="st_vtel" value="<?php echo $views->st_vtel;?>"> <span class="help-block m-b-none">가상번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_email" name="st_email" value="<?php echo $views->st_email;?>"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">영업시간
</label>
<div class="col-sm-5"><span class="help-block m-b-none">시작 09:00</span><input type="text" class="form-control" id="st_open" name="st_open" data-mask="99:99" disabled value="<?php echo $views->st_open;?>">
<div class="checkbox checkbox-primary">
<input id="st_alltime"  name="st_alltime" type="checkbox" <?php echo $views->st_alltime=="on"?"checked":"";?> onclick="javascript:chk_btn_status();">
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-5 -->
<div class="col-sm-5"><span class="help-block m-b-none">종료 19:00</span><input type="text" class="form-control" id="st_closed" name="st_closed" data-mask="99:99" disabled  value="<?php echo $views->st_closed;?>"> 
</div><!-- .col-sm-5 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">휴무일</label>
<div class="col-sm-5">
<?php $arr_closingdate= explode(",",$views->st_closingdate);
//print_r($arr_closingdate);
$arr_week=array("일요일","월요일","화요일","수요일","목요일","금요일","토요일");
?>
 <select data-placeholder="Choose a Country..." class="chosen-select" multiple style="width:350px;" tabindex="4"  id="st_closingdate" name="st_closingdate[]">
<?php
foreach($arr_week as $aw){
$sel_aw=in_array($aw, $arr_closingdate)?" selected":"";
echo "<option value='".$aw."'".$sel_aw.">".$aw."</option>";
}?>
</select>
<span class="help-block m-b-none">휴무일을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">배달지역</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_destination" name="st_destination" value="<?php echo $views->st_destination;?>"> <span class="help-block m-b-none">배달 가능 구역을 작성 합니다.. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">매장소개</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_intro" id="st_intro" value="<?php echo $views->st_intro;?>"> <span class="help-block m-b-none">매장 소개를 간단하게 적어주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->


<div class="col-md-12">
<h3>매장 서류</h3>

<div class="form-group"><label class="col-sm-2 control-label">계약서</label>
<div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<span class="help-block m-b-none">"계약서"를 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">썸네일 이미지</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<span class="help-block m-b-none">"썸네일 이미지"를 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">메뉴 이미지</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone3" class="dropzone">
<div class="dz-default dz-message"></div>
</div><!-- #my-awesome-dropzone3 -->
<span class="help-block m-b-none">"메뉴 이미지"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">대표 이미지</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone4" class="dropzone">

<div class="dz-default dz-message"></div>
</div><!-- #my-awesome-dropzone4 -->

<span class="help-block m-b-none">"대표 이미지"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

</div>
</div>

<div class="row">
<div class="form-group"><label class="col-sm-2 control-label">CID Type</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_cidtype" id="st_cidtype_1" value='ktcid' <?php echo $views->st_cidtype=="ktcid"?"checked":"";?>><label for="st_cidtype_1">ktcid</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_cidtype" id="st_cidtype_2"  value='callcid' <?php echo $views->st_cidtype=="callcid"?"checked":"";?>><label for="st_cidtype_2">callcid</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .row -->

<div class="row">
<div class="form-group"><label class="col-sm-2 control-label">Theme Type</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_1" value='red' <?php echo $views->st_theme=="red"?"checked":"";?>><label for="st_theme_1">Red</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_2" value='blue' <?php echo $views->st_theme=="blue"?"checked":"";?>><label for="st_theme_2">Blue</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_3" value='orange' <?php echo $views->st_theme=="orange"?"checked":"";?>><label for="st_theme_3">orange</label>
</div><!-- .radio .radio-info .radio-inline -->


<div class="radio radio-info radio-inline">
<input type="radio" name="st_theme" id="st_theme_4" value='green' <?php echo $views->st_theme=="green"?"checked":"";?>><label for="st_theme_4">Green</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .row -->

<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">포트번호</label>
<div class="col-sm-10"><?php echo $views->st_port;?> <span class="help-block m-b-none">해당 포트는 가맹점이 수정 가능합니다. 기본값 1 * 다중 업소인 경우 최대 4개의 포트를 가집니다.</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
</div><!-- .row -->


<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">매장 번호 1</label>
<div class="col-sm-8"><input type="text" class="form-control" id="st_tel_1" name="st_tel_1" value="<?php echo $views->st_tel_1;?>"> <span class="help-block m-b-none">상점 번호를 등록 합니다. 예) 031-706-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">핸드폰 번호 1</label>
<div class="col-sm-8"><input type="text" class="form-control" id="st_hp_1" name="st_hp_1" value="<?php echo $views->st_hp_1;?>"> <span class="help-block m-b-none">연동할 핸드폰 번호를 등록 합니다. 예) 010-####-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->

<div class="form-group"><label class="col-sm-2 control-label">통신사(MNO)</label>
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_1" value='SK' <?php echo $views->st_mno=="SK"?"checked":"";?>><label for="st_mno_1">SK</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_2"  value='LG' <?php echo $views->st_mno=="LG"?"checked":"";?>><label for="st_mno_2">LG</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_3"  value='KT' <?php echo $views->st_mno=="KT"?"checked":"";?>><label for="st_mno_3">KT</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">상단문구(고정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_top_msg" value="<?php echo $views->st_top_msg;?>">
<span class="help-block m-b-none">상단 문구 변하지 않습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">중단문구(수정)</label>
<div class="col-sm-10">
<textarea  class="form-control" name="st_middle_msg"  id="st_middle_msg" rows="4" cols="50" onkeyup='chk_byte();textAreaAdjust(this)'><?php echo $views->st_middle_msg;?></textarea><!-- #form_data -->
<span class="help-block m-b-none"><span id='bytesize'>0</span> byte <br>#{homepage}<br>
 - 기본제공하는 URL을 표시합니다. http://prq.co.kr/prq/page/상점번호<br>
<br>
#{st_tel}<br>
 - "매장 번호1"의 값을 불러와 031####### 을 031-###-#### 상태로 수정하여 발송 합니다.<br>
 <br>중단 문구 수정 원하시는 형태로 수정이 가능합니다..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">하단문구(고정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_bottom_msg" value="<?php echo $views->st_bottom_msg;?>"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">모두홈피 URL 주소 (수정)</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_modoo_url" value="<?php echo $views->st_modoo_url;?>"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button type="submit" class="btn btn-primary" id="write_btn">수정</button>
<button class="btn btn-white" type="reset">취소</button>

</div><!-- .col-md-6 Left Menu-->
</div><!-- .row-->
<!-- 						      <div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->

<!-- <div class="row"><div class="col-md-12">
<textarea id="form_data">#form_data</textarea>#form_data
</div></div> -->
</div><!-- .col-md-6 Right Menu-->
<!-- <button class="btn btn-primary" type="button" onclick="modify_ds()">수정</button> -->
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->

<!-- </div> --><!-- .wrapper .wrapper-content .animated .fadeInRight -->
</article>
<script type="text/javascript">
function chk_btn_status()
{
	var param=$("#write_action").serialize();
//			$(".btn_area [lass*='btn-']").toggleClass("disabled",param.indexOf("chk_seq")<0).prop('disabled', param.indexOf("chk_seq")<0);
	
	if(param.indexOf("st_alltime")>0)
	{
		$("#st_open").addClass("disabled").prop('disabled', true); 
		$("#st_closed").addClass("disabled").prop('disabled', true); 
	}else{
		$("#st_open").removeClass("disabled").prop('disabled', false); 
		$("#st_closed").removeClass("disabled").prop('disabled', false); 
	}
	
}

/*가맴점 코드를 불러 옵니다.*/
var pt_code="";
function get_frcode(code)
{
	$.ajax({
	url:"/prq/ajax/get_frcode/"+code,
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		pt_code=data.posts;
		var ds_code=$("#sel_prq_fcode").val().substring(0, 12);
		search_frcode(ds_code);
		}
	});
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
				if(val.prq_fcode==$("#sel_prq_fcode").val())
				{
//					fr_mail[val.prq_fcode]=val.mb_email;
					$("#mb_id").val(val.mb_email);
				}
				fr_mail[val.prq_fcode]=val.mb_email;
			});
		}
	});
}

function search_frcode(ds_code)
{
	var object = [];
	var chk_max_ptcode=[];
	var prq_fcode=$("#sel_prq_fcode").val();
	$.each(pt_code,function(key,val){
		
		//console.log(val);
		if(prq_fcode==val.fr_code){
			object.push('<option value='+val.fr_code+' selected>');
			$("#mb_id").val(fr_mail[val.fr_code]);
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
function chk_byte(){
var str=document.getElementById("st_middle_msg").value;
console.log(str);
var bytesize=getstrbyte(str);
console.log(bytesize);
document.getElementById("bytesize").innerHTML=bytesize;
}

/* Textarea to resize based on content length */
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}

/* Textarea to resize based on content length */
function textAreaAdjustOn() {
    document.getElementById("st_middle_msg").style.height = "1px";
    document.getElementById("st_middle_msg").style.height = (25+document.getElementById("st_middle_msg").scrollHeight)+"px";
}

window.onload = function() {
/*24시간인지 체크*/
chk_btn_status();

/*멀티 셀렉트 구현 chosen-select */
$(".chosen-select").chosen();
var code=$("#sel_prq_fcode").val().substring(0, 12);
get_frcode(code);

get_frmail();

chk_byte();

textAreaAdjustOn();
};/*window.onload = function() {..}*/


</script>