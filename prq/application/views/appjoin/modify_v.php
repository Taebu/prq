<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>모두톡톡 메세지 어플 가입 신청서</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a>모두톡톡 메세지 어플 </a>
</li>
<li class="active">
<strong>가입 신청서</strong>
</li>
</ol>
</div>
<div class="col-lg-2">

</div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
<?php 

function isdata($v)
{
	$retVal="";
	if(isset($v)){
	$retVal=$v;
	}

	return $retVal;
}
$attributes = array(
'class' => 'form-horizontal', 
'id' => 'write_action'
);

echo form_open('/appjoin/modify/', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
$prq_fcode=$this->input->cookie('prq_fcode',TRUE);
$mb_gcode=$this->input->cookie('mb_gcode',TRUE);
//echo $prq_fcode;
?>
<!-- id="my-awesome-dropzone" class="" -->
<div class="form-group">
<div class="col-sm-12 ">



<div class="col-sm-3 text-center">
<label for="ma_isbdtt" style="cursor:pointer"><img src="/prq/img/agreement/btn_bdtt.png" alt="" id="img_ma_isbdtt"  <?php echo $views->ma_isbdtt=="on"?"":"class=\"img_gray\"";?>/></label>
<div class="checkbox checkbox-info">
<input id="ma_isbdtt"  name="ma_isbdtt" type="checkbox" <?php echo $views->ma_isbdtt=="on"?"checked":"";?> onclick="javascript:switch_img(this.id);"><label for="ma_isbdtt">배달톡톡</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="ma_isttmsg" style="cursor:pointer"><img src="/prq/img/agreement/btn_msg.png" alt="" id="img_ma_isttmsg"  <?php echo $views->ma_isttmsg=="on"?"":"class=\"img_gray\"";?>/></label>
<div class="checkbox checkbox-danger">
<input id="ma_isttmsg"  name="ma_isttmsg" type="checkbox"  <?php echo $views->ma_isttmsg=="on"?"checked":"";?> onclick="javascript:switch_img(this.id);"><label for="ma_isttmsg">톡톡메시지</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="ma_isnavermap" style="cursor:pointer"><img src="/prq/img/agreement/btn_map.png" alt="" id="img_ma_isnavermap"  <?php echo $views->ma_isnavermap=="on"?"":"class=\"img_gray\"";?>/></label>
<div class="checkbox checkbox-primary">
<input id="ma_isnavermap"  name="ma_isnavermap" type="checkbox"  <?php echo $views->ma_isbdtt=="on"?"checked":"";?> onclick="javascript:switch_img(this.id);"><label for="ma_isnavermap">지도등록/관리</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="ma_isblogreview" style="cursor:pointer"><img src="/prq/img/agreement/btn_blog.png" alt="" id="img_ma_isblogreview"  <?php echo $views->ma_isblogreview=="on"?"":"class=\"img_gray\"";?>/></label>
<div class="checkbox checkbox-success">
<input id="ma_isblogreview"  name="ma_isblogreview" type="checkbox"  <?php echo $views->ma_isblogreview=="on"?"checked":"";?> onclick="javascript:switch_img(this.id);"><label for="ma_isblogreview">블로그 리뷰</label></div><!-- checkbox-primary -->
</div>


</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="row">
<div class="col-lg-12 bdtalkad-layout">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>광고정보 배달톡톡 앱광고 <small>(신규매장) *은 필수 표기 입니다.</small></h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->


<div class="ibox-content">
<div class="row">
<div class="col-md-6">

<div class="form-group ">
<input type="hidden" name="ma_no" id="ma_no" value="<?php echo $views->ma_no;?>" />
<label class="col-sm-2 control-label">가맹점명 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_name" name="st_name" value="<?php echo $views->st_name;?>"> <span class="help-block m-b-none">가맹점명을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">최소주문금액 *</label>
<div class="col-sm-10"><input type="number" class="form-control" id="st_minpay" name="st_minpay" step="1000" min="12000"  value="<?php echo $views->st_minpay;?>"> <span class="help-block m-b-none">예) 15,000원 이상</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

</div><!-- .col-md-6 -->


<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">휴무일 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_closingdate" name="st_closingdate" value="<?php echo $views->st_closingdate;?>">
<span class="help-block m-b-none">휴무일을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">영업시간 *</label>
<div class="col-sm-4">
<?php if($views->st_alltime=="off"){?>
<input type="text" class="form-control" id="st_open" name="st_open" data-mask="99:99" value="<?php echo $views->st_open;?>">
<span class="help-block m-b-none">시작 09:00</span>
</div><!-- .col-sm-5 -->
<div class="col-sm-4">
<input type="text" class="form-control" id="st_closed" name="st_closed" data-mask="99:99" value="<?php echo $views->st_closed;?>">
<span class="help-block m-b-none">종료 19:00</span>
</div><!-- .col-sm-5 -->

<div class="checkbox checkbox-primary col-sm-2">
<input id="st_alltime"  name="st_alltime" type="checkbox" onclick="javascript:chk_btn_status();">
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->
<?php }else{?>
<input type="text" class="form-control" id="st_open" name="st_open" data-mask="99:99" disabled value="00:00">
<span class="help-block m-b-none">시작 09:00</span>
</div><!-- .col-sm-5 -->
<div class="col-sm-4">
<input type="text" class="form-control" id="st_closed" name="st_closed" data-mask="99:99" disabled value="24:00"> 
<span class="help-block m-b-none">종료 19:00</span>
</div><!-- .col-sm-5 -->

<div class="checkbox checkbox-primary col-sm-2">
<input id="st_alltime"  name="st_alltime" type="checkbox" checked="" onclick="javascript:chk_btn_status();">
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->

<?php }?>
</div><!-- .form-group -->
</div>
</div><!-- .row -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">배달 가능지역 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_delivery" name="st_delivery"  value="<?php echo $views->st_delivery;?>"> <span class="help-block m-b-none">배달가능 지역을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">매장 주소 *</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_address" id="st_address" value="<?php echo $views->st_address;?>"> <span class="help-block m-b-none">상세 주소까지 모두 기입해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">업종 카테고리 *</label>
<div class="col-sm-10">
<select name="st_category" id="st_category" class="form-control" >
<option value="" >업종을 선택하세요.</option>
<option value="P01">치킨</option>
<option value="P02">중식</option>
<option value="P03">피자/햄버거</option>
<option value="P04">족발/보쌈</option>
<option value="P05">찜/탕</option>
<option value="P06">한식</option>
<option value="P07">분식/도시락</option>
<option value="P08">야식</option>
<option value="P09">일식/돈가스</option>
</select><span class="help-block m-b-none">카테고리를을 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">원산지 </label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_origin" id="st_origin" id="st_origin" value="<?php echo $views->st_origin;?>" placeholder="예) 닭고기 (국내산)">
<span class="help-block m-b-none text-danger font-bold"> 최초  등록시 자동 저장 됩니다.</span>
</div><!-- .col-sm-10 1-->
</div><!-- .form-group 2-->
</div><!-- .ibox-content 3-->
</div><!-- .row 4-->
</div><!-- .ibox-content 5-->
</div><!-- .ibox float-e-margins 6-->
</div><!-- .bdtalkad-layout-->

<div class="row biz-layout col-lg-6">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>사업자 업주정보</h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label class="col-sm-2 control-label">사업자등록번호</label>
<div class="col-sm-10">
<input type="text" class="form-control"  data-mask="999-99-99999" name="st_bizno" id="st_bizno" value="<?php echo $views->st_bizno;?>"> 
<span class="help-block">999-99-99999</span>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">사업자 상호</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="st_bizname" name="st_bizname" value="<?php echo $views->st_bizname;?>"> 
<span class="help-block m-b-none">사업자 상호</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 성명
</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="st_ceoname" name="st_ceoname" value="<?php echo $views->st_ceoname;?>"> 
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 주소</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_bizaddress" name="st_bizaddress" value="<?php echo $views->st_bizaddress;?>"> <span class="help-block m-b-none">사업자 등록본호 상에 주소를 기입해야 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">세금계산서 이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" name="st_taxemail" id="st_taxemail" value="<?php echo $views->st_taxemail;?>"> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 핸드폰</label>
<div class="col-sm-10"><input type="text" class="form-control"  data-mask="019-9999-9999"  name="st_bizhp" id="st_bizhp" value="<?php echo $views->st_bizhp;?>"><span class="help-block m-b-none">사업자 핸드폰을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


</div><!-- .ibox float-e-margins   1-->
</div><!-- .ibox float-e-margins 2-->
</div><!-- .ibox-content 3-->
</div><!-- .ibox float-e-margins 4-->
</div><!-- .col-lg-12 5-->
</div><!-- .row biz-layout 6-->

<div class="row ttmsg-layout col-lg-6">
<!-- <div class="col-lg-12"> -->
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>톡톡문자서비스 가입정보 <small>(Play스토어 "톡톡메세지"검색)</small></h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<div class="col-md-12">
<!-- <form method="get" class="form-horizontal"> -->

<div class="form-group">
<label class="col-sm-2 control-label">배달톡톡핸드폰 번호</label>
<div class="col-sm-10">
<input type="text" class="form-control" data-mask="019-9999-9999" name="st_bdtthp" id="st_bdtthp" value="<?php echo $views->st_bdtthp;?>">
<span class="help-block">019-9999-9999</span>
</div>
</div>


<div class="form-group"><label class="col-sm-2 control-label">통신사(MNO)</label>
<div class="col-sm-10 ">
<div class="radio radio-danger radio-inline">
<input type="radio" name="st_mno" id="st_mno_1" value='SK' checked><label for="st_mno_1">SK</label>
</div><!-- .radio .radio-info .radio-inline -->
<div class="radio radio-info radio-inline">
<input type="radio" name="st_mno" id="st_mno_3"  value='KT'><label for="st_mno_3">KT</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-warning radio-inline">
<input type="radio" name="st_mno" id="st_mno_2"  value='LG'><label for="st_mno_2">LG</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-primary radio-inline">
<input type="radio" name="st_mno" id="st_mno_4"  value='알뜰폰'><label for="st_mno_4">알뜰폰</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="form-group"><label class="col-sm-2 control-label">요금제<span style="color:#">★</span> </label>
<div class="col-sm-10">
<span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
<?php 
$st_info=explode("&",$views->st_info);
//$st_info=array_filter($st_info);
$i=0;

$array['posts']=array();
foreach($st_info as $k)
{
	$product=array();
	$i++;
	$store=explode("|",$k);
	if(count($store)==3)
	{
	$st_ispay=explode("=",$store[0]);
	$st_names=explode("=",$store[1]);
	$st_tel=explode("=",$store[2]);

	$product['st_info']=$k;
	$product['st_ispay']=$st_ispay[1];
	$product['st_names']=$st_names[1];
	$product['st_tel']=$st_tel[1];

	array_push($array['posts'],$product);
	}else{
	$product['st_info']="";
	$product['st_ispay']="";
	$product['st_names']="";
	$product['st_tel']="";

	array_push($array['posts'],$product);
	}
}
?>

<div class="form-group"><label class="col-sm-2 control-label">상점명 1<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_ispay1"  name="st_ispay1" type="checkbox" value="" onclick="javascript:set_storeinfo(1)"  <?php echo isdata($array['posts'][0]['st_ispay'])=="on"?"checked":"";?>>
<label for="st_ispay1">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" name="st_names1" id="st_names1" placeholder="업체명" class="form-control" onkeyup="javascript:set_storeinfo(1)" value="<?php echo isdata($array['posts'][0]['st_names']);?>"></div>
<div class="col-md-5"><input type="text" name="st_tel1" id="st_tel1" placeholder="전화번호" class="form-control" onkeyup="javascript:set_storeinfo(1)"  value="<?php echo isdata($array['posts'][0]['st_tel']);?>"></div>
<input type="text" name="st_info[]" id="st_info1" class="form-control" value="<?php echo $array['posts'][0]['st_info'];?>"/>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="form-group"><label class="col-sm-2 control-label">상점명 2<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_ispay2"  name="st_ispay2" type="checkbox" value="" onclick="javascript:set_storeinfo(2)"  <?php echo isdata($array['posts'][1]['st_ispay'])=="on"?"checked":"";?>>
<label for="st_ispay2">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" name="st_names2" id="st_names2" placeholder="업체명" class="form-control" onkeyup="javascript:set_storeinfo(2)" value="<?php echo isdata($array['posts'][1]['st_names']);?>"></div>
<div class="col-md-5"><input type="text" name="st_tel2" id="st_tel2" placeholder="전화번호" class="form-control" onkeyup="javascript:set_storeinfo(2)" value="<?php echo isdata($array['posts'][1]['st_tel']);?>"></div>
<input type="text" name="st_info[]" id="st_info2" class="form-control" value="<?php echo $array['posts'][1]['st_info'];?>"/>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="form-group"><label class="col-sm-2 control-label">상점명 3<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_ispay3"  name="st_ispay3" type="checkbox" onclick="javascript:set_storeinfo(3)"  <?php echo isdata($array['posts'][2]['st_ispay'])=="on"?"checked":"";?>>
<label for="st_ispay3">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" name="st_names3" id="st_names3" placeholder="업체명" class="form-control" onkeyup="javascript:set_storeinfo(3)" value="<?php echo isdata($array['posts'][2]['st_names']);?>"></div>
<div class="col-md-5"><input type="text" name="st_tel3" id="st_tel3" placeholder="전화번호" class="form-control" onkeyup="javascript:set_storeinfo(3)" value="<?php echo isdata($array['posts'][2]['st_tel']);?>"></div>
<input type="text" name="st_info[]" id="st_info3" class="form-control" value="<?php echo $array['posts'][2]['st_info'];?>"/>
</div>
<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="form-group"><label class="col-sm-2 control-label">상점명 4<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_ispay4"  name="st_ispay4" type="checkbox" value="" onclick="javascript:set_storeinfo(4)"  <?php echo isdata($array['posts'][3]['st_ispay'])=="on"?"checked":"";?>>
<label for="st_ispay4">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" name="st_names4" id="st_names4" placeholder="업체명" class="form-control" onkeyup="javascript:set_storeinfo(4)" value="<?php echo isdata($array['posts'][3]['st_names']);?>"></div>
<div class="col-md-5"><input type="text" name="st_tel4" id="st_tel4" placeholder="전화번호" class="form-control" onkeyup="javascript:set_storeinfo(4)" value="<?php echo isdata($array['posts'][3]['st_tel']);?>"></div>
<input type="text" name="st_info[]" id="st_info4" class="form-control" value="<?php echo $array['posts'][3]['st_info'];?>"/>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->




<div class="form-group"><label class="col-sm-2 control-label">KT 통화매니저<br>
(월 4,400원)
</label>
<div class="col-sm-10">
<div class="col-md-6"><input type="text" placeholder="명의자" class="form-control" name="ma_ktuser" value="<?php echo $views->ma_ktuser;?>"></div>
<div class="col-md-6"><input type="text" placeholder="생년월일" class="form-control" name="ma_ktbirth" value="<?php echo $views->ma_ktbirth;?>"></div>

</div><!-- .col-sm-10 -->
<span class="help-block m-b-none">CID 없는 경우 KT 통화매니저 가입 필요</span>
</div><!-- .form-group -->

</div><!-- .col-md-12 11-->
</div><!-- .row 12-->
</div><!-- .blog-layout col-lg- 6 -->
</div><!-- .ibox float-e-margins-->
<!-- </div> --><!-- .col-lg-6 15-->
</div><!-- .row .ttmsg-layout 16-->

<div class="row cms-layout col-lg-6">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>자동이체 신청 (CMS) <small class="align-right">(출금자 : 에이엔피알)</small></h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<div class="col-md-12">

<div class="form-group">
<label class="col-sm-2 control-label">금액</label>
<div class="col-sm-10">
<input type="number" class="form-control" id="ma_cmsprice" name="ma_cmsprice" step="1000" value="<?php echo $views->ma_cmsprice;?>">
<span class="help-block m-b-none">금액 매월 0,000원(vat 별도)</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">예금주
</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="mb_bankholder" name="mb_bankholder" value="<?php echo $views->mb_bankholder;?>">
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">생년월일(또는 사업자번호)</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_birth" name="mb_birth" value="<?php echo $views->mb_birth;?>"> <span class="help-block m-b-none">사업자 등록본호 상에 주소를 기입해야 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankname" id="mb_bankname" value="<?php echo $views->mb_bankname;?>"> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
<div class="col-sm-10"><input type="text" class="form-control"  name="mb_banknum" id="mb_banknum" value="<?php echo $views->mb_banknum;?>"><span class="help-block m-b-none">계좌번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">출금일</label>
<div class="col-sm-10 ">
<div class="radio radio-danger radio-inline">
<input type="radio" name="ma_dateofpayment" id="ma_dateofpayment_1" value='5' checked><label for="ma_dateofpayment_1">5일</label>
</div><!-- .radio .radio-info .radio-inline -->


<div class="radio radio-warning radio-inline">
<input type="radio" name="ma_dateofpayment" id="ma_dateofpayment_2"  value='15'><label for="ma_dateofpayment_2">15일</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="ma_dateofpayment" id="ma_dateofpayment_3"  value='25'><label for="ma_dateofpayment_3">25일</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


</div><!-- .ibox float-e-margins   1-->
</div><!-- .ibox float-e-margins 2-->
</div><!-- .col-lg-12 3-->
</div><!-- .row 4-->
</div><!-- .col-lg-12 5-->
</div><!-- .row cms-layout 6-->

<div class="row blog-layout col-lg-6">
<!-- <div class="col-lg-12"> -->
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>네이버 블로그 포스팅 관리 서비스 </h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<div class="col-md-12">
<!-- <form method="get" class="form-horizontal"> -->

<div class="form-group">
<label class="col-sm-2 control-label">※초기세팅비</label>
<div class="col-sm-10">
<h1 class="text-center font-size-large">90,000원</h1>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">금액</label>
<div class="col-sm-10">
<input type="number" class="form-control" id="ma_blogprice" name="ma_blogprice" value="<?php echo $views->ma_blogprice;?>">
<span class="help-block m-b-none">금액 매월 0,000원(vat 별도)</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->



<div class="form-group"><label class="col-sm-2 control-label">블로그 포스팅 선택</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary col-sm-3">
<input id="ma_ispost"  name="ma_ispost" type="checkbox"  <?php echo $views->ma_ispost=="on"?"checked":"";?>>
<label for="ma_ispost">지역블로그</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">리뷰 혜택 포인트 적립</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary">
<input id="ma_ispoint"  name="ma_ispoint" type="checkbox"  <?php echo $views->ma_ispoint=="on"?"checked":"";?>>
<label for="ma_ispoint">배달톡톡 블로그 포인트 2,000원</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="form-group"><label class="col-sm-2 control-label">네이버 아이디</label>
<div class="col-sm-10">
<input type="text" placeholder="아이디" class="form-control" name="ma_naverid" id="ma_naverid" value="<?php echo $views->ma_naverid;?>">
</div><!-- .col-sm-10 -->
</div><!-- .form-group-->

<div class="form-group"><label class="col-sm-2 control-label">네이버 비밀번호</label>
<div class="col-sm-10">
<input type="text" placeholder="비밀번호" class="form-control" name="ma_naverpwd" id="ma_naverpwd" value="<?php echo $views->ma_naverpwd;?>">
</div><!-- .col-sm-10 -->
</div><!-- .form-group-->


<div class="form-group"><label class="col-sm-2 control-label">네이버지도 관리서비스</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary">
<input id="ma_isnaver"  name="ma_isnaver" type="checkbox" 
 <?php echo isdata($views->ma_isnaver)=="on"?"checked":"";?>>
<label for="ma_isnaver"> 네이버 상점 지도 관리위임에 동의 합니다.  </label></div><!-- checkbox-primary -->
<span>네이버 지도 관련 정보 수집, 네이버지도 관리 대행, 업체정보 수정 등 에이엔피알 에게 관리 권한 위임합니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group-->

</div><!-- .md-12-->
</div><!-- .row-->
</div><!-- .ibox-content-->

</div><!-- .ibox float-e-margins-->
</div><!-- .row 12-->
</div><!-- .ibox-content 13-->

<!-- </div> --><!-- .col-lg-6 15-->

<div class="row raw-layout">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>이용약관</h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<u><p class="text-center under-line">자동이체 서비스 이용 약관</p></u>
<p>1. 이용자는 본 신청서에 서명하거나 공인인증 및 그에 준하는 전자 인증절차를 통함으로써 본 서비스를 이용할 수 있습니다.</p>
<p>2. 회사는 서비스 제공을 위하여 이용자가 제출한 지급결제수단 정보를 해당 금융기관(통신사 포함)에 제공할 수 있습니다.</p>
<p>3. 자동이체 개시일을 이용자가 지정하지 않은 경우 재화 등을 공급하는 자로부터 사전 통지 받은 납기일을 최초 개시일로 하며, 출금은 이용업체와 협의한 날짜에 계좌출금이 이루어 집니다.</p>
<p>4. 출금이체 금액은 해당 지정 출금일 영업 시간 내에 입금된 예금(지정출금일에 입금된 타점권은 제외)에 한하여 출금 처리 되며, 출금이체 금액의 이의가 있는 경우에는 이용업체에 협의하여 조정키로 합니다.</p>
<p>5. 납기일에 동일한 수종의 자동이체 청구가 있는 경우 이체 우선 순위는 이용자의 거래 금융기관이 정하는 바에 따릅니다.</p>
<p>6. 자동이체 납부일이 영업일이 아닌 경우에는 다음 영업일을 납부일로 합니다.</p>
<p>7. 이용자가 자동이체 신청(신규, 해지, 변경)을 원하는 경우 해당 납기일 30일 전까지 회사에 통지해야 합니다.</p>
<p>8. 이용자가 제출한 지급결제수단의 잔액(예금한도, 신용한도 등)이 예정 결제금액보다 부족하거나 지급제한, 연체 등 납부자의 과실에 의해 발생하는 손해의 책임은 이용자에게 있습니다. </p>
<p>9. 이용자가 금융기관 및 회사가 정하는 기간 동안 자동이체 이용 실적이 없는 경우 사전 통지 후 자동이체를 해지할 수 있습니다.</p>
<p>10. 회사는 이용자와의 자동이체서비스 이용과 관련된 구체적인 권리, 의무를 정하기 위하여 본 약관과는 별도로 자동이체서비스이용약관을 제정할 수 있습니다</p>
<p></p>
<u><p class="text-center under-line">개인정보 수집 및 이용동의</p></u>
<p>1. 수집 및 이용목적 : 나이스정보통신㈜ 자동이체서비스를 통한 요금 수납, 민원처리 및 상담요청 응답</p>
<p>2. 수집항목 : 성명, 전화번호, 휴대폰번호, 은행명, 계좌번호, 예금주명, 예금주주민번호앞6자리, 카드번호, 카드사, 카드주, 카드유효기간,이메일</p>
<p>3. 보유 및 이용기간 : 수집 이용 동의일부터 자동이체서비스 종료일(해지일)까지며, 보유는 해지일로부터 5년간 보존 후 파기(관계 법령에 의거)</p>
<p>4. 신청자는 개인정보 수집 및 이용을 거부할 수 있습니다. 단, 거부 시 자동이체서비스 신청이 처리되지 않습니다.</p>
<p></p>
<u><p class="text-center under-line">개인정보 취급 위탁</p></u>
<p>1. 결제(자동이체)서비스를 통한 요금 수납, 관련 민원처리 및 상담요청 응답을 위하여 개인정보 취급 업무를 나이스정보통신㈜에 위탁 운영하고 있습니다.</p>
<p>2. 위탁 계약 시 개인정보보호를 위해 위탁업무 수행 목적 외 개인정보 처리 금지, 기술적 관리적 보호조치, 위탁업무의 목적 및 범위, 재위탁 제한, 개인정보에 대한 접근 제한 등 안전성 확보 조치, 위탁업무와 관련하여 보유하고 있는 개인정보의 관리 현황 점검 등 감독에 관한 사항 등을 명확히 규정한 계약을 서면 보관하고 있습니다.</p>
<p>3. 위탁 업체가 변경될 경우, 변경된 업체 명을 인터넷홈페이지, SMS, 전자우편, 서면, 모사전송 등의 방법으로 공개하겠습니다.</p>
<p></p>
<u><p class="text-center under-line">문자(SMS)발송 동의</p></u>
<p>1. 자동이체 동의 및 처리결과 안내(휴대폰 문자전송)송부에 동의합니다.</p>

</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .row raw-layout col-lg-12 -->


<div class="row info-layout">
<div class="ibox float-e-margins">
<div class="ibox-title">
	<h5>..</h5>
	<div class="ibox-tools">
	<a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
	<a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-wrench"></i></a>
	<ul class="dropdown-menu dropdown-user">
	<li><a href="#">Config option 1</a></li>
	<li><a href="#">Config option 2</a></li></ul>
	<a class="close-link"><i class="fa fa-times"></i></a></div>
</div><!-- .ibox-title -->

<div class="ibox-content">
<div class="row">
<p>신청자 본인은 톡톡메세지_배달톡톡 서비스 신청서 내용과 이용 약관 (內) 신용카드 및 금융거래정보의 제공 동의 내용을 충분히 숙지함에 따라 위와 같이 서비스를 신청합니다.</p>
<div class="col-md-4 col-sm-4 col-xs-12">
<img src="/prq/img/agreement/anpr_logo.jpeg" alt="anpr_logo.jpeg" />
<p>대표이사 : 김옥란  /  사업자번호 : 476-11-00222 </p>
<p>사무실 : 경기도 고양시 일산동구 백석동 1176-1</p>
<p>고객센터 : 1599 - 7571  /  팩스 : 0505-300-9495</p>
</div><!-- .col-md-4 -->

<div class="col-md-1  col-sm-2  col-xs-12">
<img src="/prq/img/agreement/anpr_sign.jpeg" alt="anpr_sign.jpeg" />
</div><!-- .col-md-4 -->

<div class="col-md-7  col-sm-6  col-xs-12">
<div class="form-group"><label class="col-sm-2 control-label">관리자 성명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="ma_adminname" id="ma_adminname" value="<?php echo $views->ma_adminname;?>"> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">관리자 핸드폰</label>
<div class="col-sm-10"><input type="text" class="form-control"  name="ma_adminhp" id="ma_adminhp" value="<?php echo $views->ma_adminhp;?>"> <span class="help-block m-b-none">관리자 핸드폰을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<canvas id="signature-pad" class="signature-pad responsive" width=400 height=200 style="display:none"></canvas>
<div id="signature_area"><img src="<?php echo $views->ma_signaturepad;?>" alt="" class="image-responsive"/></div><!-- #signature_area -->
<div id="btn_signpad">
  <button class="btn btn-primary" id="btn_save" type="button" onclick="javascript:set_signature()" style="display:none">사인저장</button>
  <button class="btn btn-warning" id="btn_clear" type="button" onclick="javascript:clear_signature()">사인다시하기</button>
</div><!-- #btn_signpad -->


<textarea name="signature_content" id="signature_content" cols="30" rows="10" style="display:none"><?php echo $views->ma_signaturepad;?></textarea>


</div><!-- .col-md-4 -->

</div><!-- .row -->


<div class="row">


<div class="col-md-12">
<textarea id="form_data"  class="form-control" rows="4" cols="50"  style="display:none">#form_data</textarea><!-- #form_data -->
</div>
<button class="btn btn-primary" type="button" onclick="set_appjoin()">수정</button>
</div><!-- .row raw-layout-->

</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .row info-layout -->
</div>

<script type="text/javascript">
/*

server에 <span class="mb_gname">총판</span>을 등록 합니다.

  `ma_isbdtt` enum('off','on') DEFAULT 'off' COMMENT '배달톡톡 사용여부',
  `ma_isttmsg` enum('off','on') DEFAULT 'off' COMMENT '톡톡메시지 사용여부',
  `ma_isnavermap` enum('off','on') DEFAULT 'off' COMMENT '지도등록/관리 사용여부',
  `ma_isblogreview` enum('off','on') DEFAULT 'off' COMMENT '블로그리뷰 사용여부',
  `st_open` char(5) NOT NULL DEFAULT '09:00' COMMENT '영업시작시간',
  `st_closed` char(5) NOT NULL DEFAULT '19:00' COMMENT '영업종료시간',
  `st_alltime` enum('off','on') NOT NULL DEFAULT 'off' COMMENT '24시간여부',
*/
var vali_names= [
        { "name":"st_name", "hname":"가맹점명" },
        { "name":"st_minpay", "hname":"최소주문금액" },
        { "name":"st_closingdate", "hname":"휴무일" },
        { "name":"st_delivery", "hname":"배달가능지역" },
        { "name":"st_address", "hname":"매장주소" },
        { "name":"st_category", "hname":"업종 카테고리" },
        { "name":"st_origin", "hname":"원산지" },
        { "name":"st_open", "hname":"영업시작시간" },
        { "name":"st_closed", "hname":"영업종료시간" },
        { "name":"st_bizno", "hname":"사업자등록번호" },
        { "name":"st_bizname", "hname":"사업자상호" },
        { "name":"st_ceoname", "hname":"사업자성명" },
        { "name":"st_bizaddress", "hname":"사업자주소" },
        { "name":"st_taxemail", "hname":"세금계산서 email" },
        { "name":"st_bizhp", "hname":"사업자핸드폰" },
        { "name":"st_bdtthp", "hname":"톡톡연동핸드폰" },
        { "name":"st_names1", "hname":"상점이름" },
        { "name":"st_tel1", "hname":"상점전화" },
        { "name":"ma_blogprice", "hname":"블로그 금액" },
        { "name":"ma_ispost", "hname":"블로그 포스팅 선택" },
        { "name":"ma_ispoint", "hname":"리뷰혜택 포인트 적립" },
        { "name":"ma_naverid", "hname":"네이버 아이디" },
        { "name":"ma_naverpwd", "hname":"네이버 비밀번호" },
        { "name":"ma_isnaver", "hname":"네이버 관리 서비스" },
        { "name":"ma_adminname", "hname":"관리자 성명" },
        { "name":"ma_adminhp", "hname":"관리자 핸드폰" },
        { "name":"mb_birth", "hname":"생년월일" },
        { "name":"mb_bankname", "hname":"은행명" },
        { "name":"mb_banknum", "hname":"계좌번호" },
        { "name":"ma_dateofpayment", "hname":"출금일" },
        { "name":"mb_bankholder", "hname":"예금주" }
    ];

function set_appjoin(){
var param=$("#write_action").serialize();
//param=param.replace(/&/gi, "\n&");




/* 배열 갯수 만큼 validate 처리 */
for(var i in vali_names){
	console.log(vali_names[i].name);
if($("[name="+vali_names[i].name+"]").val()=="")
{

	$("[name="+vali_names[i].name+"]").focus();
	$("[name="+vali_names[i].name+"]").parent().parent().addClass("has-error");
	toastr.error("\""+vali_names[i].hname+"\"이(가) 없습니다.");
	return;
}
else if($("[name="+vali_names[i].name+"]").val().length>=2)
{
	$("[name="+vali_names[i].name+"]").parent().parent().removeClass("has-error");
	$("[name="+vali_names[i].name+"]").parent().parent().addClass("has-success");
}

}/* for(var i in vali_names){...} */


/* 사인만 특별 처리 가장 중요!!!*/
if($("#signature_content").val()=="")
{
	swal("사인은 필수","미등록시 계약이 성사되지 않습니다!!! 사인후 \"사인저장\" 해 주세요.","error");
	return;
}

if(!$("#ma_isnaver").is(":checked"))
{
	swal("지도권한","지도권한 미동의 시 계약이 성사되지 않습니다!!! 지도권한을 체크해주세요.","error");
	$("#ma_isnaver").focus();
	console.log("not pass");
	return;
}
console.log("pass");
$("#form_data").html(param);
$.ajax({
url:"/prq/appjoin/modify",
type: "POST",
data:param,
dataType:"json",
success: function(data) {
	if(data.success){
		swal("수정완료","수정완료 되었습니다.","success");
	}else{
		swal("수정실패","통신이 원할하지 않거나 알수 없는 문제로 실패하였습니다.","error");
	}

	}
});

/*
if($("#is_join").val()=="TRUE"){
$("#form_data").html(param);
//	$("#write_action").submit();
//set_member();
}
if($("#is_join").val()=="FALSE"){
$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
}
*/

}

/**
	chk_duplicate_id(mb_id)
*/
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
$.ajax({
url:"/prq/board/write/prq_member",
type: "POST",
data:param,
cache: false,
async: false,
success: function(data) {
console.log(data);
}
});		
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

/* 이미지를 클릭시 스위치 처럼 온/오프 효과를 냅니다. */
function switch_img(id)
{
	var is_btn=$("#"+id).is(":checked");
	if(is_btn){
		$("#img_"+id).removeClass('img_gray');
	}else{
		$("#img_"+id).addClass('img_gray');
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



window.onload = function() {

$( "#mb_id" ).focusout(function() {
chk_vali_id();

})
.blur(function() {
blur++;
chk_vali_id();

});
/*mb_code로 등록 정보 변경*/
//chg_gname();
/*24시간인지 체크*/
chk_btn_status();
/*멀티 셀렉트 구현 chosen-select */
$(".chosen-select").chosen();
var code=$("#prq_fcode").val();
get_frcode(code);
get_frmail();

$(".ibox-tools").hide();
//chk_byte();

/* 초기값 세팅 */
/* 통신사 */
$('input:radio[name=st_mno]:input[value=<?php echo $views->st_mno;?>]').attr("checked", true);
/* 출금일 */
$('input:radio[name=ma_dateofpayment]:input[value=<?php echo $views->ma_dateofpayment;?>]').attr("checked", true);

/* 매장 카테고리 */
$('#st_category option[value=<?php echo $views->st_category;?>]').attr('selected', 'selected');
};/*window.onload = function() {..}*/


function set_top_msg(v){
$("#st_top_msg").val("(광고) [ "+v+" ] 에서");
}

function set_sign(id){
	
    var con = document.getElementById(id);
    con.style.display = con.style.display=='none'?'block':'none';
}


function set_signature()
{
	let sign_data=signaturePad.toDataURL();
	$("#signature_content").html(sign_data);
	sign_data="<img src='"+sign_data+"'>";
	$("#signature_area").html(sign_data);
	//set
	$("#signature_area").show();  //img
	$("#signature-pad").hide();   //canvas
	$("#btn_save").hide();
}

function clear_signature()
{
	$("#signature_content").html("");
	$("#signature_area").html("");
	signaturePad.clear();
	//clear
	$("#signature_area").hide();  //img
	$("#signature-pad").show();   //canvas
	$("#btn_save").show();   //canvas
}

function set_storeinfo(v)
{
	let param="";
	let st_ispay=$("#st_ispay"+v).prop("checked")?"on":"off";
	param="st_ispay="+st_ispay;
	param+="|st_names="+$("#st_names"+v).val();
	param+="|st_tel="+$("#st_tel"+v).val();
	console.log(param);
	$("#st_info"+v).val(param);
}
</script>
<style type="text/css">
.signature-pad {
  border:1px solid #000;
}
.img_gray{filter:grayscale(100%);}
</style>
