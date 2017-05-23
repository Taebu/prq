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
$attributes = array(
'class' => 'form-horizontal', 
'id' => 'write_action'
);
echo form_open('/appjoin/write/', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
$prq_fcode=$this->input->cookie('prq_fcode',TRUE);
$mb_gcode=$this->input->cookie('mb_gcode',TRUE);

echo $prq_fcode;
?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="is_member" id="is_member">
<?php if($mb_gcode=="G5"){?>
<input type="hidden" name="prq_fcode" id="prq_fcode" value="<?php echo $prq_fcode;?>">
<?php }?>
<input type="hidden" name="mb_gcode" id="mb_gcode" value="<?php echo $mb_gcode;?>">
<input type="hidden" name="mb_code" id="mb_code" value="<?php echo $this->input->post('mb_code',TRUE);?>">
<input type="hidden" name="mb_pcode" id="mb_pcode" value="<?php echo $this->input->post('mb_code',TRUE);?>">

<input type="hidden" name="st_business_paper" id="st_business_paper">
<input type="hidden" name="st_thumb_paper" id="st_thumb_paper">
<input type="hidden" name="st_menu_paper" id="st_menu_paper">
<input type="hidden" name="st_main_paper" id="st_main_paper">

<input type="hidden" name="st_business_paper_size" id="st_business_paper_size">
<input type="hidden" name="st_thumb_paper_size" id="st_thumb_paper_size">
<input type="hidden" name="st_menu_paper_size" id="st_menu_paper_size">
<input type="hidden" name="st_main_paper_size" id="st_main_paper_size">

<input type="hidden" name="st_imgprefix" id="st_imgprefix" value="<?php echo date("Ym");?>">

<input type="hidden" name="ds_code" id="ds_code" value="<?php echo @$this->input->cookie('prq_fcode',TRUE);?>">




<div class="form-group">
<div class="col-sm-12 ">



<div class="col-sm-3 text-center">
<label for="is_bdtt" style="cursor:pointer"><img src="/prq/img/agreement/btn_bdtt.png" alt="" /></label>
<div class="checkbox checkbox-info">
<input id="is_bdtt"  name="is_bdtt" type="checkbox" checked="" onclick="javascript:chk_btn_status();"><label for="is_bdtt">배달톡톡</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="is_ttmsg" style="cursor:pointer"><img src="/prq/img/agreement/btn_msg.png" alt="" /></label>
<div class="checkbox checkbox-danger">
<input id="is_ttmsg"  name="is_ttmsg" type="checkbox" checked="" onclick="javascript:chk_btn_status();"><label for="is_ttmsg">톡톡메시지</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="is_navermap" style="cursor:pointer"><img src="/prq/img/agreement/btn_map.png" alt="" /></label>
<div class="checkbox checkbox-primary">
<input id="is_navermap"  name="is_navermap" type="checkbox" checked="" onclick="javascript:chk_btn_status();"><label for="is_navermap">지도등록/관리</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="is_blog" style="cursor:pointer"><img src="/prq/img/agreement/btn_blog.png" alt="" /></label>
<div class="checkbox checkbox-success">
<input id="is_blog"  name="is_blog" type="checkbox" checked="" onclick="javascript:chk_btn_status();"><label for="is_blog">블로그 리뷰</label></div><!-- checkbox-primary -->
</div>


</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
.has-warning .has-error .has-success
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

<label class="col-sm-2 control-label">가맹점명 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="ag_name" name="ag_name" > <span class="help-block m-b-none">가맹점명을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">최소주문금액 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="ag_minpay" name="ag_minpay" > <span class="help-block m-b-none">예) 15,000원 이상</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

</div><!-- .col-md-6 -->


<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">휴무일 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="ag_holiday" name="ag_holiday">
<span class="help-block m-b-none">휴무일을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">영업시간 *</label>
<div class="col-sm-4">
<input type="text" class="form-control" id="ag_open" name="ag_open" data-mask="99:99" disabled value="12:00">
<span class="help-block m-b-none">시작 09:00</span>
</div><!-- .col-sm-5 -->
<div class="col-sm-4"><input type="text" class="form-control" id="ag_closed" name="ag_closed" data-mask="99:99" disabled value="01:00"> <span class="help-block m-b-none">종료 19:00</span>
</div><!-- .col-sm-5 -->

<div class="checkbox checkbox-primary col-sm-2">
<input id="st_alltime"  name="st_alltime" type="checkbox" checked="" onclick="javascript:chk_btn_status();">
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->

</div><!-- .form-group -->
</div>
</div><!-- .row -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">배달 가능지역 *</label>
<div class="col-sm-10"><input type="text" class="form-control" id="ag_delivery" name="ag_delivery" onkeyup="set_top_msg(this.value)"> <span class="help-block m-b-none">배달가능 지역을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">매장 주소 *</label>
<div class="col-sm-10"><input type="text" class="form-control" name="ag_address" id="ag_address"> <span class="help-block m-b-none">상세 주소까지 모두 기입해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">업종 카테고리 *</label>
<div class="col-sm-10">
<select name="ag_category" id="ag_category" class="form-control" >
<option value="" >업종을 선택하세요.</option>
<option value="치킨">치킨</option>
<option value="중식">중식</option>
<option value="피자/햄버거">피자/햄버거</option>
<option value="족발/보쌈">족발/보쌈</option>
<option value="찜/탕">찜/탕</option>
<option value="한식">한식</option>
<option value="분식/도시락">분식/도시락</option>
<option value="야식">야식</option>
<option value="일식/돈가스">일식/돈가스</option>
</select><span class="help-block m-b-none">카테고리를을 선택해 주세요.</span>

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">원산지 </label>
<div class="col-sm-10"><input type="text" class="form-control" name="pv_value" id="pv_value" value="" placeholder="예) 닭고기 (국내산)">
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
<input type="text" class="form-control"  data-mask="999-99-99999" name="bizno" id="bizno"	>
<span class="help-block">999-99-99999</span>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">사업자 상호</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="mb_id" name="mb_id"> 
<span class="help-block m-b-none">사업자 상호</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 성명
</label>
<div class="col-sm-10">
<input type="text" class="form-control" id="mb_id" name="mb_id"> 
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 주소</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_name" name="st_name" onkeyup="set_top_msg(this.value)"> <span class="help-block m-b-none">사업자 등록본호 상에 주소를 기입해야 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">세금계산서 이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" name="email" id="email"> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">핸드폰</label>
<div class="col-sm-10"><input type="text" class="form-control"  data-mask="019-9999-9999"  name="st_vtel" id="st_vtel"> <span class="help-block m-b-none">050번호를 기입해 주세요..</span>
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
<label class="col-sm-2 control-label">핸드폰 번호</label>
<div class="col-sm-10">
<input type="text" class="form-control" data-mask="019-9999-9999" placeholder="">
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
<input type="radio" name="st_mno" id="st_mno_2"  value='LGU+'><label for="st_mno_2">LGU+</label>
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


<div class="form-group"><label class="col-sm-2 control-label">상점명 1<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_pay1"  name="st_pay1" type="checkbox">
<label for="st_pay1">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" placeholder="업체명" class="form-control"></div>
<div class="col-md-5"><input type="text" placeholder="전화번호" class="form-control"></div>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="form-group"><label class="col-sm-2 control-label">상점명 2<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_pay2"  name="st_pay2" type="checkbox">
<label for="st_pay2">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" placeholder="업체명" class="form-control"></div>
<div class="col-md-5"><input type="text" placeholder="전화번호" class="form-control"></div>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">상점명 3<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2"><div class="checkbox checkbox-primary">
<input id="st_pay3"  name="st_pay3" type="checkbox">
<label for="st_pay3">과금</label></div><!-- checkbox-primary --></div>
<div class="col-md-5"><input type="text" placeholder="업체명" class="form-control"></div>
<div class="col-md-5"><input type="text" placeholder="전화번호" class="form-control"></div>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="form-group"><label class="col-sm-2 control-label">상점명 4<span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2"><div class="checkbox checkbox-primary">
<input id="st_pay4"  name="st_pay4" type="checkbox">
<label for="st_pay4">과금</label></div><!-- checkbox-primary --></div>
<div class="col-md-5"><input type="text" placeholder="업체명" class="form-control"></div>
<div class="col-md-5"><input type="text" placeholder="전화번호" class="form-control"></div>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->




<div class="form-group"><label class="col-sm-2 control-label">KT 통화매니저<br>
(월 4,400원)
</label>
<div class="col-sm-10">
<div class="col-md-6"><input type="text" placeholder="명의자" class="form-control"></div>
<div class="col-md-6"><input type="text" placeholder="생년월일" class="form-control"></div>

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
월)<input type="text" class="form-control" id="mb_id" name="mb_id">원(vat 별도)
<span class="help-block m-b-none">사업자 상호</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">예금주
</label>
<div class="col-sm-10">
개인
법인
<input type="text" class="form-control" id="mb_id" name="mb_id"> 
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">생년월일(또는 사업자번호)</label>
<div class="col-sm-10"><input type="text" class="form-control" id="st_name" name="st_name" onkeyup="set_top_msg(this.value)"> <span class="help-block m-b-none">사업자 등록본호 상에 주소를 기입해야 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="email" id="email"> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
<div class="col-sm-10"><input type="text" class="form-control"  data-mask="019-9999-9999"  name="st_vtel" id="st_vtel"> <span class="help-block m-b-none">050번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">출금일</label>
<div class="col-sm-10 ">
<div class="radio radio-danger radio-inline">
<input type="radio" name="paid_day" id="paid_day_1" value='5' checked><label for="paid_day_1">5일</label>
</div><!-- .radio .radio-info .radio-inline -->


<div class="radio radio-warning radio-inline">
<input type="radio" name="paid_day" id="paid_day_2"  value='15'><label for="paid_day_2">15일</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="paid_day" id="paid_day_3"  value='25'><label for="paid_day_3">25일</label>
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
월)<input type="text" class="form-control" id="mb_id" name="mb_id">원(vat 별도)
<span class="help-block m-b-none">사업자 상호</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->



<div class="form-group"><label class="col-sm-2 control-label">블로그 포스팅 선택</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary col-sm-3">
<input id="location_blog"  name="location_blog" type="checkbox">
<label for="location_blog">지역블로그</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">리뷰 혜택 포인트 적립</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary">
<input id="bdmt_point"  name="bdmt_point" type="checkbox">
<label for="bdmt_point">배달톡톡 블로그 포인트 2,000원</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">네이버 아이디<br>>비밀번호</label>
<div class="col-sm-10">
<input type="text" placeholder="비밀번호" class="form-control">


</div><!-- .col-sm-10 -->

</div><!-- .form-group -->

</div><!-- .col-md-12 11-->
</div><!-- .row 12-->
</div><!-- .ibox-content 13-->
</div><!-- .ibox float-e-margins-->
<!-- </div> --><!-- .col-lg-6 15-->

<div class="row">
<div class="form-group">
<table id="table-3"><colgroup><col /></colgroup>
<tbody><tr><td><p>자동이체 서비스 이용 약관</p>
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
<p>개인정보 수집 및 이용동의</p>
<p>1. 수집 및 이용목적 : 나이스정보통신㈜ 자동이체서비스를 통한 요금 수납, 민원처리 및 상담요청 응답</p>
<p>2. 수집항목 : 성명, 전화번호, 휴대폰번호, 은행명, 계좌번호, 예금주명, 예금주주민번호앞6자리, 카드번호, 카드사, 카드주, 카드유효기간,이메일</p>
<p>3. 보유 및 이용기간 : 수집 이용 동의일부터 자동이체서비스 종료일(해지일)까지며, 보유는 해지일로부터 5년간 보존 후 파기(관계 법령에 의거)</p>
<p>4. 신청자는 개인정보 수집 및 이용을 거부할 수 있습니다. 단, 거부 시 자동이체서비스 신청이 처리되지 않습니다.</p>
<p>개인정보 취급 위탁</p>
<p>1. 결제(자동이체)서비스를 통한 요금 수납, 관련 민원처리 및 상담요청 응답을 위하여 개인정보 취급 업무를 나이스정보통신㈜에 </p>
<p>위탁 운영하고 있습니다.</p>
<p>2. 위탁 계약 시 개인정보보호를 위해 위탁업무 수행 목적 외 개인정보 처리 금지, 기술적 관리적 보호조치, 위탁업무의 목적 및 범위, 재위탁 </p>
<p>제한, 개인정보에 대한 접근 제한 등 안전성 확보 조치, 위탁업무와 관련하여 보유하고 있는 개인정보의 관리 현황 점검 등 감독에 관한 사항 등을 명확히 규정한 계약을 서면 보관하고 있습니다.</p>
<p>3. 위탁 업체가 변경될 경우, 변경된 업체 명을 인터넷홈페이지, SMS, 전자우편, 서면, 모사전송 등의 방법으로 공개하겠습니다.</p>
<p>문자(SMS)발송 동의</p>
<p>1. 자동이체 동의 및 처리결과 안내(휴대폰 문자전송)송부에 동의합니다.</p>
</td></tr>
</tbody></table>
<p></p>
</div>

<div>
<table id="table-4"><colgroup><col /><col /></colgroup>
<tbody><tr><td><p>□ 네이버지도 관리서비스  </p></td><td><p> 네이버 지도 관련 정보 수집, 네이버지도 관리 대행, 업체정보 수정 등 에이엔피알 에게 관리 권한 위임합니다.</p></td></tr></tbody></table><p></p></div><div><table id="table-5"><colgroup><col /></colgroup><tbody><tr><td><p>     신청자 본인은 톡톡메세지_배달톡톡 서비스 신청서 내용과 이용 약관 (內) 신용카드 및 금융거래정보의 제공 동의 내용을 충분히 숙지함에 따라 </p><p>위와 같이 서비스를 신청합니다.</p></td></tr></tbody></table><p></p></div><div><img src="톡톡_가입신청서_170207-web-resources/image/logo_fmt.jpeg" alt="logo.jpg" /></div><div><p>          에이엔 피알</p><p>대표이사 : 김옥란  /  사업자번호 : 476-11-00222 </p><p>사무실 : 경기도 고양시 일산동구 백석동 1176-1</p><p>고객센터 : 1599 - 7571  /  팩스 : 0505-300-9495</p></div><div><table id="table-6"><colgroup><col /><col /></colgroup><tbody><tr><td colspan="2"><p>□자동 이체 신청 (CMS)                         (출금자 : 에이엔피알)</p></td></tr>
<tr><td>금액</td><td><p>&#160;</p><p>월)                            원(vat별도)</p></td></tr>
<tr><td><p>예금주  □개인  □법인</p></td><td>&#160;</td></tr>
<tr><td><p>생년월일(또는 사업자번호)</p></td><td>&#160;</td></tr>
<tr><td>은행명</td><td>&#160;</td></tr>
<tr><td>계좌번호</td><td>&#160;</td></tr>
<tr><td>출금일</td><td><p>□5일 , □15일 , □25일</p></td></tr></tbody></table>

<p></p></div>
<div><img src="톡톡_가입신청서_170207-web-resources/image/1_fmt.png" alt="1.jpg" /></div>
<div><p>모두톡톡 메세지 어플 가입 신청서</p></div>
<div><img src="톡톡_가입신청서_170207-web-resources/image/2_fmt.jpeg" alt="2.jpg" /></div>
<div><img src="톡톡_가입신청서_170207-web-resources/image/%eb%ac%b8%ec%84%b1%ec%a4%80%eb%8b%98%ec%9d%98-%ec%84%9c%eb%aa%85_fmt.jpeg" alt="%eb%ac%b8%ec%84%b1%ec%a4%80%eb%8b%98%ec%9d%98-%ec%84%9c%eb%aa%85.jpg" /></div>

<div>
<table id="table-7">
<colgroup><col /><col /><col /><col /></colgroup>
<tbody>
<tr><td colspan="4">□톡톡 문자서비스 가입정보 (Play스토어 &quot;톡톡메시지&quot; 검색)</td></tr>
<tr><td colspan="2">대표자 핸드폰번호★</td><td colspan="2"><p>-              -</p></td></tr>
<tr><td colspan="2">통신사</td><td colspan="2">□ SK □ KT □LGU+ □알뜰폰</td></tr>
<tr><td colspan="2">요금제★</td><td colspan="2"> 무제한 문자요금제 확인 [문의 114]</td></tr>
<tr><td>상점명 1</td><td><p>과금 □</p></td><td>업체명</td><td>전화번호</td></tr>
<tr><td>상점명 2</td><td><p>과금 □</p></td><td><p>업체명</p></td><td><p>전화번호</p></td></tr>
<tr><td>상점명 3</td><td><p>과금 □</p></td><td><p>업체명</p></td><td><p>전화번호</p></td></tr>
<tr><td>상점명 4</td><td><p>과금 □</p></td><td><p>업체명</p></td><td><p>전화번호</p></td></tr>
<tr><td colspan="2">KT 통화매니저</td><td colspan="2">명의자 :                 생년월일:                          </td></tr></tbody></table><p></p></div>

<div>
<table id="table-8"><colgroup><col /><col /></colgroup>
<tbody><tr><td colspan="2">□네이버 블로그 포스팅 관리 서비스</td></tr>
<tr><td>※초기세팅비</td><td> 90,000원</td></tr>
<tr><td><p>금액</p></td><td><p>월)                            원(vat별도)</p></td></tr>
<tr><td>블로그 포스팅 선택</td><td><p> ○지역블로그</p></td></tr>
<tr><td>리뷰 혜택 포인트 적립1</td><td><p> ○일반2,000원   ○프리미엄5,000원</p></td></tr>
<tr><td>리뷰 혜택 상품권 지급2</td><td><p> ○일반2,000원   ○프리미엄5,000원</p></td></tr>
<tr><td>네이버 아이디/비밀번호</td><td>&#160;</td></tr></tbody></table>

<p></p>

</div><!-- .form-group -->
<div class="col-md-12">
<textarea id="form_data"  class="form-control" rows="4" cols="50">#form_data</textarea><!-- #form_data -->
</div>

<button class="btn btn-primary" type="button" onclick="set_ds()">저장</button>


</div><!-- .row .blog-layout 16-->




<!-- </div> --><!-- .row -->


<!-- </div> --><!-- .wrapper .wrapper-content .animated .fadeInRight -->
<script type="text/javascript">
/*
server에 <span class="mb_gname">총판</span>을 등록 합니다.
*/
var vali_names=["ag_name","ag_minpay","ag_minpay","ag_holiday","ag_delivery","ag_address","ag_category","ag_delivery"];
function set_ds(){
var param=$("#write_action").serialize();
param=param.replace(/&/gi, "\n&");




for(var i in vali_names){
if($("#"+vali_names[i]).val()=="")
{
	$("#"+vali_names[i]).focus();
	$("#"+vali_names[i]).parent().parent().addClass("has-error");
	return;
}else if($("#"+vali_names[i]).val().length>3)
{
	$("#"+vali_names[i]).parent().parent().removeClass("has-error");
	$("#"+vali_names[i]).parent().parent().addClass("has-success");
}

}/* for(var i in vali_names){...} */



$("#form_data").html(param);
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
		$("#ag_open").val('00:00');
		$("#ag_closed").val('24:00');
		$("#ag_open").addClass("disabled").prop('disabled', true); 
		$("#ag_closed").addClass("disabled").prop('disabled', true); 
	}else{
		$("#ag_open").removeClass("disabled").prop('disabled', false); 
		$("#ag_closed").removeClass("disabled").prop('disabled', false); 
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
textAreaAdjust(document.getElementById("st_middle_msg"));
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

chk_byte();
};/*window.onload = function() {..}*/


function set_top_msg(v){
$("#st_top_msg").val("(광고) [ "+v+" ] 에서");
}



  $(document).ready(function() {
    $('#write_action').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            ag_name: {
                validators: {
                        stringLength: {
                        min: 2,
                    },
                        notEmpty: {
                        message: 'Please supply your first name'
                    }
                }
            },
             last_name: {
                validators: {
                     stringLength: {
                        min: 2,
                    },
                    notEmpty: {
                        message: 'Please supply your last name'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your email address'
                    },
                    emailAddress: {
                        message: 'Please supply a valid email address'
                    }
                }
            },
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your phone number'
                    },
                    phone: {
                        country: 'US',
                        message: 'Please supply a vaild phone number with area code'
                    }
                }
            },
            address: {
                validators: {
                     stringLength: {
                        min: 8,
                    },
                    notEmpty: {
                        message: 'Please supply your street address'
                    }
                }
            },
            city: {
                validators: {
                     stringLength: {
                        min: 4,
                    },
                    notEmpty: {
                        message: 'Please supply your city'
                    }
                }
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Please select your state'
                    }
                }
            },
            zip: {
                validators: {
                    notEmpty: {
                        message: 'Please supply your zip code'
                    },
                    zipCode: {
                        country: 'US',
                        message: 'Please supply a vaild zip code'
                    }
                }
            },
            comment: {
                validators: {
                      stringLength: {
                        min: 10,
                        max: 200,
                        message:'Please enter at least 10 characters and no more than 200'
                    },
                    notEmpty: {
                        message: 'Please supply a description of your project'
                    }
                    }
                }
            }
        })
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
                $('#contact_form').data('bootstrapValidator').resetForm();

            // Prevent form submission
            e.preventDefault();

            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');

            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
            }, 'json');
        });
});


</script>
</div>