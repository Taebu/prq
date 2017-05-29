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
//echo $prq_fcode;
?>
<!-- id="my-awesome-dropzone" class="" -->
<div class="form-group">
<div class="col-sm-12 ">



<div class="col-sm-3 text-center">
<label for="is_bdtt" style="cursor:pointer"><img src="/prq/img/agreement/btn_bdtt.png" alt="" /></label>
<div class="checkbox checkbox-info">
<input id="ma_isbdtt"  name="ma_isbdtt" type="checkbox"  <?php echo $views->ma_isbdtt=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isbdtt">배달톡톡</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="is_ttmsg" style="cursor:pointer"><img src="/prq/img/agreement/btn_msg.png" alt="" /></label>
<div class="checkbox checkbox-danger">
<input id="ma_isttmsg"  name="ma_isttmsg" type="checkbox"  <?php echo $views->ma_isttmsg=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isttmsg">톡톡메시지</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="is_navermap" style="cursor:pointer"><img src="/prq/img/agreement/btn_map.png" alt="" /></label>
<div class="checkbox checkbox-primary">
<input id="ma_isnavermap"  name="ma_isnavermap" type="checkbox"  <?php echo $views->ma_isnavermap=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isnavermap">지도등록/관리</label></div><!-- checkbox-primary -->
</div>


<div class="col-sm-3 text-center">
<label for="is_blogreview" style="cursor:pointer"><img src="/prq/img/agreement/btn_blog.png" alt="" /></label>
<div class="checkbox checkbox-success">
<input id="ma_isblogreview"  name="ma_isblogreview" type="checkbox"  <?php echo $views->ma_isblogreview=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isblogreview">블로그 리뷰</label></div><!-- checkbox-primary -->
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

<label class="col-sm-2 control-label">가맹점명 *</label>
<div class="col-sm-10"><?php echo $views->st_name;?> <span class="help-block m-b-none">가맹점명을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">최소주문금액 *</label>
<div class="col-sm-10"><?php echo $views->st_minpay;?> <span class="help-block m-b-none">예) 15,000원 이상</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

</div><!-- .col-md-6 -->


<div class="col-md-6">
<div class="form-group"><label class="col-sm-2 control-label">휴무일 *</label>
<div class="col-sm-10"><?php echo $views->st_closingdate;?>
<span class="help-block m-b-none">휴무일을 기재해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->


<div class="form-group"><label class="col-sm-2 control-label">영업시간 *</label>
<div class="col-sm-4"> <?php echo $views->st_open;?>
<span class="help-block m-b-none">시작 09:00</span>
</div><!-- .col-sm-5 -->
<div class="col-sm-4"> <?php echo $views->st_closed;?>
<span class="help-block m-b-none">종료 19:00</span>
</div><!-- .col-sm-5 -->


<div class="checkbox checkbox-primary col-sm-2">
<input id="st_alltime"  name="st_alltime" type="checkbox" <?php echo $views->st_alltime=="on"?"checked":"";?>>
<label for="st_alltime">24시간</label></div><!-- checkbox-primary -->

</div><!-- .form-group -->
</div>
</div><!-- .row -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="row">
<div class="col-md-12">
<div class="form-group"><label class="col-sm-2 control-label">배달 가능지역 *</label>
<div class="col-sm-10"> <?php echo $views->st_delivery;?> <span class="help-block m-b-none">배달가능 지역을 등록 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">매장 주소 *</label>
<div class="col-sm-10"> <?php echo $views->st_address;?> <span class="help-block m-b-none">상세 주소까지 모두 기입해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">업종 카테고리 *</label>
<div class="col-sm-10">
<?php 
$cate_arre['P01']="치킨";
$cate_arre['P02']="중식";
$cate_arre['P03']="피자/햄버거";
$cate_arre['P04']="족발/보쌈";
$cate_arre['P05']="찜/탕";
$cate_arre['P06']="한식";
$cate_arre['P07']="분식/도시락";
$cate_arre['P08']="야식";
$cate_arre['P09']="일식/돈가스";
?>
<?php
$st_category=$views->st_category;
foreach($cate_arre as $key => $value){
if($key==$st_category){
echo $value;
}
}
?>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">원산지 </label>

<div class="col-sm-10"> <?php echo $views->st_origin;?>
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
<div class="col-sm-10"> <?php echo $views->st_bizno;?>
<span class="help-block">999-99-99999</span>
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">사업자 상호</label>
<div class="col-sm-10"> <?php echo $views->st_bizname;?>
<span class="help-block m-b-none">사업자 상호</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 성명
</label>
<div class="col-sm-10"> <?php echo $views->st_ceoname;?>
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 주소</label>
<div class="col-sm-10"> <?php echo $views->st_bizaddress;?> <span class="help-block m-b-none">사업자 등록본호 상에 주소를 기입해야 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">세금계산서 이메일</label>
<div class="col-sm-10"> <?php echo $views->st_taxemail;?> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">사업자 핸드폰</label>
<div class="col-sm-10"> <?php echo $views->st_bizhp;?> <span class="help-block m-b-none">사업자 핸드폰을 기재해 주세요.</span>
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
<div class="col-sm-10"> <?php echo $views->st_bdtthp;?>
<span class="help-block">019-9999-9999</span>
</div>
</div>


<div class="form-group"><label class="col-sm-2 control-label">통신사(MNO)</label>
<div class="col-sm-10 "> <?php echo $views->st_mno;?>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="form-group"><label class="col-sm-2 control-label">요금제<span style="color:#">★</span> </label>
<div class="col-sm-10">
<span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->




 <?php $st_info=explode("&",$views->st_info);
$st_info=array_filter($st_info);
$i=0;
foreach($st_info as $k){
	$i++;
$store=explode("|",$k);
$st_ispay=explode("=",$store[0]);
$st_names=explode("=",$store[1]);
$st_tel=explode("=",$store[2]);
?>
 <div class="form-group"><label class="col-sm-2 control-label">상점명 <?php echo $i;?><span style="color:#">★</span> </label>
<div class="col-sm-10">
<div class="row">
<div class="col-md-2">
<div class="checkbox checkbox-primary">
<input id="st_ispay1"  name="st_ispay1" type="checkbox" <?php echo $st_ispay[1]=="on"?"checked":"";?>>
<label for="st_ispay1">과금</label></div><!-- checkbox-primary -->
</div>
<div class="col-md-5"><input type="text" name="st_names1" id="st_names1" placeholder="업체명" class="form-control" onkeyup="javascript:set_storeinfo(1)" 
value="<?php echo $st_names[1]?>"></div>
<div class="col-md-5"><input type="text" name="st_tel1" id="st_tel1" placeholder="전화번호" class="form-control" onkeyup="javascript:set_storeinfo(1)" 
value="<?php echo $st_tel[1]?>"></div>
</div>

<!-- <span class="help-block m-b-none">무제한 문자요금제 확인 [문의 114]</span> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<?php
 
 }
?>

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->




<div class="form-group"><label class="col-sm-2 control-label">KT 통화매니저<br>
(월 4,400원)
</label>
<div class="col-sm-10">
<div class="col-md-6"><input type="text" placeholder="명의자" class="form-control" value="<?php echo $views->ma_ktuser;?>"></div>
<div class="col-md-6"><input type="text" placeholder="생년월일" class="form-control" value="<?php echo $views->ma_ktbirth;?>"></div>

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
<div class="col-sm-10"><?php echo number_format($views->ma_cmsprice);?>원
<span class="help-block m-b-none">금액 매월 0,000원(vat 별도)</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="form-group"><label class="col-sm-2 control-label">예금주
</label>
<div class="col-sm-10"> <?php echo $views->mb_bankholder;?>
<!-- <select name="type" style="width: 228px; height: 38px; "> -->
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">생년월일(또는 사업자번호)</label>
<div class="col-sm-10">
<?php echo $views->mb_birth;?> <span class="help-block m-b-none">사업자 등록본호 상에 주소를 기입해야 합니다. </span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
<div class="col-sm-10">
<?php echo $views->mb_bankname;?> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
<div class="col-sm-10">
<?php echo $views->mb_banknum;?> <span class="help-block m-b-none">계좌번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="form-group"><label class="col-sm-2 control-label">출금일</label>
<div class="col-sm-10 ">
<?php echo $views->ma_dateofpayment;?>
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
<?php echo number_format($views->ma_blogprice);?>원
<span class="help-block m-b-none">금액 매월 0,000원(vat 별도)</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->



<div class="form-group"><label class="col-sm-2 control-label">블로그 포스팅 선택</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary col-sm-3">
<input id="ma_ispost"  name="ma_ispost" type="checkbox">
<label for="ma_ispost">지역블로그</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="form-group"><label class="col-sm-2 control-label">리뷰 혜택 포인트 적립</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary">
 
<input id="ma_ispoint"  name="ma_ispoint" type="checkbox" <?php echo $views->ma_ispoint=="on"?"checked":"";?>>
<label for="ma_ispoint">배달톡톡 블로그 포인트 2,000원</label></div><!-- checkbox-primary -->

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->



<div class="form-group"><label class="col-sm-2 control-label">네이버 아이디</label>
<div class="col-sm-10"> <?php echo $views->ma_naverid;?>
</div><!-- .col-sm-10 -->
</div><!-- .form-group-->

<div class="form-group"><label class="col-sm-2 control-label">네이버 비밀번호</label>
<div class="col-sm-10"> <?php echo $views->ma_naverpwd;?>
</div><!-- .col-sm-10 -->
</div><!-- .form-group-->


<div class="form-group"><label class="col-sm-2 control-label">네이버지도 관리서비스</label>
<div class="col-sm-10">
<div class="checkbox checkbox-primary">
<input id="ma_isnaver"  name="ma_isnaver" type="checkbox">
<label for="ma_isnaver"> 네이버 상점 지도 관리위임에 동입니다.  </label></div><!-- checkbox-primary -->
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
<div class="col-md-4 col-sm-4 col-xs-8">
<img src="/prq/img/agreement/anpr_logo.jpeg" alt="anpr_logo.jpeg" />
<p>대표이사 : 김옥란  /  사업자번호 : 476-11-00222 </p>
<p>사무실 : 경기도 고양시 일산동구 백석동 1176-1</p>
<p>고객센터 : 1599 - 7571  /  팩스 : 0505-300-9495</p>
</div><!-- .col-md-4 -->

<div class="col-md-1  col-sm-2  col-xs-12">
<img src="/prq/img/agreement/anpr_sign.jpeg" alt="anpr_sign.jpeg" />
</div><!-- .col-md-4 -->

<div class="col-md-7  col-sm-6  col-xs-4">
<div class="form-group"><label class="col-sm-2 control-label">관리자 성명</label>
<div class="col-sm-10"><?php echo $views->ma_adminname;?> <span class="help-block m-b-none">세금계산서를 발행할 이메일을 기입해  주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">관리자 핸드폰</label>
<div class="col-sm-10"><?php echo $views->ma_adminhp;?> <span class="help-block m-b-none">관리자 핸드폰을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<img src="<?php echo $views->ma_signaturepad;?>" alt="" width="50px" height="30px"/ >

</div><!-- .col-md-4 -->

</div><!-- .row -->


<div class="row">


<div class="col-md-12">
<textarea id="form_data"  class="form-control" rows="4" cols="50">#form_data</textarea><!-- #form_data -->
</div>
<button class="btn btn-primary" type="button" onclick="set_appjoin()">저장</button>
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

$("#form_data").html(param);
$.ajax({
url:"/prq/appjoin/write",
type: "POST",
data:param,
dataType:"json",
success: function(data) {
	console.log(data);

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

//chk_byte();
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
}

function clear_signature()
{
	$("#signature_content").html("");
	$("#signature_area").html("");
	signaturePad.clear();
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

$(".help-block").remove();
</script>
<style type="text/css">
.signature-pad {
  border:1px solid #000;
}
</style>
