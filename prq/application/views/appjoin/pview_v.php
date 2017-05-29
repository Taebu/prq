<?php
/**
 * 모두톡톡 메세지 어플 가입 신청서 프린트 할 수 있는 페이지
 * 작성 : 2017-05-29 (월) 10:53:37 
 * 수정 : 
 * 
 * 1.1 모두톡톡 메세지 어플 가입 신청서
 * @author Taebu, Moon <mtaebu@gmail.com>
 * @version 1.1
 */
//print_r($views);
?>
<style>
@page a4sheet { size: 21.0cm 29.7cm } 
.a4 { page: a4sheet; page-break-after: always } 
</style>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ko" xml:lang="ko">
<HEAD>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<TITLE>모두톡톡 메세지 어플 가입 신청서</TITLE>
<link rel="stylesheet" type="text/css" href="/prq/include/css/ext/stdtheme.css" media="all" />
<link rel="stylesheet" type="text/css" href="/prq/include/css/ext/main.css" media="all" />
<link rel="stylesheet" type="text/css" href="/prq/include/css/ext/nuli_btn.css" media="all" />
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
function myFunction() {
	$("#btn_print").hide();
	$("#navigater").hide();
	$(".option").hide();
//chg_size('dn');
//chg_size('dn');
	window.print();
//	chg_size('up');
//	chg_size('up');
	$("#btn_print").show();
	$("#navigater").show();
	$(".option").show();
}

var memcount=0;
var gp_seq=1;
//load_list();
$(function(){
$("#stdt").val(getDateWeek(memcount));
$("#eddt").val(getDateWeek(memcount-1));
$("#gp_seq").val("<?echo $_GET[gp_seq];?>");
gp_seq=$("#gp_seq").val();
$("#swipecount").html(getDateWeek(memcount)+" : "+weekNumber+"주차");
$(document).attr("title","청년1조_"+getDateWeek(memcount)+"_"+weekNumber+"주차");  

//load_wklst();
});

var basic_size=12;
function chg_size(mode){
if(mode=="up"){
basic_size++;
}else{
basic_size--;
}
$('td,th').css('font-size', basic_size+'pt');
}
// Callback function references the event target and adds the 'swipe' class to it
function swipeHandler( event ){
//$( event.target ).addClass( "swipe" );
memcount++;
$("#stdt").val(getDateWeek(memcount));
$("#eddt").val(getDateWeek(memcount-1));
$("#swipecount").html(getDateWeek(memcount)+" : "+weekNumber+"주차");

$(document).attr("title","청년1조_"+getDateWeek(memcount)+"_"+weekNumber+"주차");  

//load_wklst();

}  

function swipeHandler2( event ){
//$( event.target ).addClass( "swipe" );
memcount--;
$("#stdt").val(getDateWeek(memcount));
$("#eddt").val(getDateWeek(memcount-1));
$("#swipecount").html(getDateWeek(memcount)+" : "+weekNumber+"주차");
$(document).attr("title",getDateWeek(memcount)+" : "+weekNumber+"주차");  
load_wklst();
$('td,th').css('font-size', basic_size+'pt');
}

var json;
function load_wklst(){
var param=$("#listform").serialize();
$.ajax({
url:"./ajax/get_wklview.php",
method:"POST",
data:param,
dataType:"json",
success:function(data){
	json=data;

	load_report();
	load_abreport();
}
});
}
/*-------------------------------------------------------------------
기능: 2014-06-24 날짜를 가져온다. YYYY-MM-DD  
사용예: 
    오늘 var val=getDateISO();
    한달전 var val=getDateISO(-1);
    한달후 var val=getDateISO(1);
*-------------------------------------------------------------------*/

function getDateWeek(editweek){
Date.prototype.getWeek = function() {
    var onejan = new Date(this.getFullYear(), 0, 1);
    return Math.ceil((((this - onejan) / 86400000) + onejan.getDay() + 1) / 7);
}


var myDate, day, month, year, date,tmpDate;
myDate = new Date();
day = myDate.getDate();
myDate.setDate(day-7*editweek-myDate.getDay());
day = myDate.getDate();
month = myDate.getMonth() + 1;
year = myDate.getFullYear();
weekNumber = (myDate).getWeek()-1;

if (day <10)day = "0" + day;
if (month <10)month = "0" + month;
date = year + "-" + month + "-" + day;
return date;
}

function load_report(){
var object=[];

object.push('<table class="ibk_info" id="ibk_info1">');
object.push('<tr>');
object.push('<td>부서</td>');
object.push('<td>청년1그룹</td>');
object.push('<td>담당</td>');
object.push('<td>문태부</td></tr>');
object.push('<tr>');
object.push('<td>일자</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_date")+'</td>');
object.push('<td>주간</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_week")+'</td></tr>');
object.push('<tr>');
object.push('<td>재적</td>');
object.push('<td>'+json.re_count+'</td>');
object.push('<td>출석</td>');
object.push('<td>'+json.chk_count+'</td></tr>');
object.push('<tr>');
object.push('<td>진도</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_tprogress")+'</td>');
object.push('<td>계획</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_nprogress")+'</td></tr>');
object.push('</table><!-- table#ibk_info1 -->');

$("#wkl_report").html(object.join(""));

object=[];
object.push('<table class="ibk_info" id="ibk_info1">');
object.push('<thead>');
object.push('<tr>');
object.push('<th colspan="2">금주 진도</th>');
object.push('<th colspan="2">차주 계획</th></tr>');
object.push('</thead>');
object.push('<tbody>');
object.push('<tr>');
object.push('<td>주제</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_tsub")+'</td>');
object.push('<td>주제</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_nsub")+'</td></tr>');
object.push('<tr>');
object.push('<td>준비</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_tready")+'</td>');
object.push('<td>준비</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_nready")+'</td></tr>');
object.push('<tr>');
object.push('<td>순서</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_tseq")+'</td>');
object.push('<td>순서</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_nseq")+'</td></tr>');
object.push('</tbody>');
object.push('</table><!-- table#ibk_info1 -->');

$("#seq_report").html(object.join(""));
object=[];
object.push('<table class="ibk_info" id="ibk_info4">');
object.push('<tbody>');
object.push('<tr>');
object.push('<td>내용</td>');
object.push('<td>'+eval("json.gp_"+gp_seq+"_content")+'</td></tr>');
$("#special_report").html(object.join(""));
$('td,th').css('font-size', basic_size+'pt');
}

function load_abreport(){
var object=[];

object.push('<table class="ibk_lst" id="ibk_info1">');
object.push('<colgroup>');
object.push('<col width="2%">');
object.push('<col width="20%">');
//object.push('<col width="20%">');
object.push('<col width="5%">');
object.push('<col width="5%">');
object.push('<col width="78%">');
object.push('</colgroup>');
object.push('<thead>');
object.push('<tr>');
object.push('<th>#</th>');
object.push('<th>성명</th>');
//object.push('<th>부모</th>');
object.push('<th>출결</th>');
object.push('<th>심방</th>');
object.push('<th>결석/기도</th></tr>');
object.push('</thead>');
object.push('<tbody>');
var i=1;
$.each(json.posts,function(key,val){
object.push('<tr>');
object.push('<td>'+i+++'</td>');
object.push('<td>'+val.wr_name+' ('+val.wr_birth.substring(2,4)+')<a href="javascript:del_report('+val.seq+');" class="option">del</a></td>');
console.log(val);
//console.log(val);
//object.push('<td>'+val.wr_name+' ('+val.wr_birth+')</td>');
//object.push('<td>'+val.wr_pare+'</td>');
object.push('<td>'+val.wr_chk+'</td>');
object.push('<td>'+val.wr_status+'</td>');

object.push('<td>');
if(val.wr_absent.length>3){
object.push("결석 : "+val.wr_absent+"<br>");
}

if(val.wr_prayer.length>3){
object.push("기도 : "+val.wr_prayer+"<br>");
}
object.push('</td></tr>');
});

object.push('</tbody>');
object.push('</table><!-- table#ibk_info1 -->');

$("#absent_report").html(object.join(""));
$('td,th').css('font-size', basic_size+'pt');
}


function del_report(v) {
	// body...
	$.ajax({
url:"./ajax/set_report_del.php",
method:"POST",
data:"seq="+v,
dataType:"json",
success:function(data){
if(data.success){
	alert(data.sql)
}
}
});
}
</script>
<style type="text/css">
body{max-width:840px;margin:0 auto;}
</style>
</HEAD>
<body class="a4">
<form name="listform" id="listform">
<input type="hidden" name="stdt" id="stdt">
<input type="hidden" name="eddt" id="eddt">
<input type="hidden" name="gp_seq" id="gp_seq">
<input type="hidden" name="wkl_seq" id="wkl_seq">
</form>
</div>


<div class="icon_area">
<center><h1>모두톡톡 메세지 어플 가입 신청서</h1></center>
<table style="margin:0 auto">
<tr>
<td style="width:120px">
<label for="is_bdtt" style="cursor:pointer"><img src="/prq/img/agreement/btn_bdtt.png" alt="" style="width:30%"/></label>
<div class="checkbox checkbox-info">
<input id="ma_isbdtt"  name="ma_isbdtt" type="checkbox"  <?php echo $views->ma_isbdtt=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isbdtt">배달톡톡</label></div><!-- checkbox-primary -->
</td>


<td style="width:120px;">
<label for="is_ttmsg" style="cursor:pointer"><img src="/prq/img/agreement/btn_msg.png" alt=""  style="width:30%"/></label>
<div class="checkbox checkbox-danger">
<input id="ma_isttmsg"  name="ma_isttmsg" type="checkbox"  <?php echo $views->ma_isttmsg=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isttmsg">톡톡메시지</label></div><!-- checkbox-primary -->
</td>


<td style="width:120px;">
<label for="is_navermap" style="cursor:pointer"><img src="/prq/img/agreement/btn_map.png" alt=""  style="width:30%"/></label>
<div class="checkbox checkbox-primary">
<input id="ma_isnavermap"  name="ma_isnavermap" type="checkbox"  <?php echo $views->ma_isnavermap=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isnavermap">지도등록/관리</label></div><!-- checkbox-primary -->
</td>


<td style="width:120px;">
<label for="is_blogreview" style="cursor:pointer"><img src="/prq/img/agreement/btn_blog.png" alt=""  style="width:30%"/></label>
<div class="checkbox checkbox-success">
<input id="ma_isblogreview"  name="ma_isblogreview" type="checkbox"  <?php echo $views->ma_isblogreview=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"><label for="ma_isblogreview">블로그 리뷰</label></div><!-- checkbox-primary -->
</td>
</tr></table>
<div style="clear:both"></div>
</div>
<b><span class="ibk_h3"></span>광고정보 배달톡톡 앱광고 (신규매장)</b>
</div><!-- #navigater -->

<div id="wkl_report">
<table class="ibk_info" id="ibk_info1">
<tr>
<td>가맹점명</td>
<td><?php echo $views->st_name;?></td>
<td>휴무일</td>
<td><?php echo $views->st_closingdate;?></td></tr>
<tr>
<td>최소주문금액</td>
<td><?php echo number_format($views->st_minpay);?>원</td>
<td>영업시간</td>
<td><?php echo $views->st_open;?> ~ <?php echo $views->st_closed;?></td></tr>
<tr>
<td>배달 가능지역</td>
<td colspan=3><?php echo $views->st_delivery;?></td>
<tr>
<td>매장주소</td>
<td colspan=3><?php echo $views->st_address;?></td>
<tr>
<td>업종카테고리</td>
<td colspan=3>
<?php
$array["P01"]="치킨";
$array["P02"]="중식";
$array["P03"]="피자/햄버거";
$array["P04"]="족발/보쌈";
$array["P05"]="찜/탕";
$array["P06"]="한식";
$array["P07"]="분식/도시락";
$array["P08"]="야식";
$array["P09"]="일식/돈가스";
foreach($array as $k=>$v){
if($k==$views->st_category){
echo "<input type=\"checkbox\" checked>";
}else{
echo "<input type=\"checkbox\">";
}
echo $v;

}?></td>
<tr>
<td>원산지표기</td>
<td colspan=3><?php echo $views->st_origin;?></td></tr>
</table><!-- table#ibk_info1 -->
</div><!-- #wkl_report -->

<div style="clear:both">
<div style="width:50%;float:left;">
<b><span class="ibk_h4"></span>사업자 업주 정보</b>

<div id="absent_report">
<table class="ibk_info" id="ibk_info1">
<tr>
<td>사업자등록번호</td>
<td><?php echo $views->st_bizno;?></td></tr>
<tr>
<td>사업자 상호</td>
<td><?php echo $views->st_bizname;?></td></tr>
<tr>
<td>사업자 성명</td>
<td><?php echo $views->st_ceoname;?></td></tr>
<tr>
<td>사업자 주소</td>
<td><?php echo $views->st_bizaddress;?></td></tr>
<tr>
<td>세금계산서 이메일</td>
<td><?php echo $views->st_taxemail;?></td></tr>
<tr>
<td>핸드폰 번호</td>
<td><?php echo $views->st_bdtthp;?></td></tr>
</table><!-- table#ibk_info1 -->

</div><!-- #absent_report -->
</div><!-- <div style="width:50%"> -->

<div style="width:50%;float:left">
<b><span class="ibk_h3"></span>톡톡 문자서비스 가입정보 (Play스토어 "톡톡메시지" 검색)</b>
<div id="seq_report">
<table class="ibk_info2" id="ibk_info1">
<tr>
<td colspan="2">대표자 핸드폰번호★</td>
<td><?php echo $views->st_bdtthp;?></td></tr>
<tr>
<td colspan="2">통신사</td>
<td>
<?php 

$array=array();
$array["SK"]="SK";
$array["KT"]="KT";
$array["LGU+"]="LGU+";
$array["알뜰폰"]="알뜰폰";

foreach($array as $k=>$v){
if($k==$views->st_mno){
echo "<input type=\"checkbox\" checked>";
}else{
echo "<input type=\"checkbox\">";
}
echo $v;
}	
?></td></tr>
<tr>
<td colspan="2">요금제★</td>
<td class="text-center">무제한 문자요금제 확인 [문의 114]</td></tr>
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
<tr>
<td>상점명 <?php echo $i;?><span style="color:red">★</span></td>
<td>과금<input id="ma_isbdtt"  name="ma_isbdtt" type="checkbox" <?php echo $st_ispay[1]=="on"?"checked":"";?>></td>
<td><?php echo $st_names[1]?> <?php echo $st_tel[1]?></td></tr>
<?php
 
 }
?>
<tr>
<td colspan="2">KT 통화매니저<br> (월 4,400원)</td>
<td><?php echo $views->ma_ktuser;?> / <?php echo $views->ma_ktbirth;?></td></tr>
</table><!-- table#ibk_info1 -->

</div><!-- #seq_report -->
</div><!-- <div style="width:50%"> -->
</div><!--  사업자,톡톡 -->
<div style="clear:both"></div>
<div style="width:50%;float:left">
<b><span class="ibk_h3"></span>자동 이체 신청(CMS) <span class="text-right">(출금자 : 에이엔피알)</span></b>

<div id="absent_report">
<table class="ibk_info" id="ibk_info1">
<tr>
<td>금액</td>
<td>월) <u><?php echo number_format($views->ma_cmsprice);?>원 (vat별도)</u></td></tr>
<tr>
<td>예금주</td>
<td><?php echo $views->mb_bankholder;?></td></tr>
<tr>
<td>생년월일<small>(또는 사업자번호)</small></td>
<td><?php echo $views->mb_birth;?></td></tr>
<tr>
<td>은행명</td>
<td><?php echo $views->mb_bankname;?></td></tr>
<tr>
<td>계좌번호</td>
<td><?php echo $views->mb_banknum;?></td></tr>
<tr>
<td>출금일</td>
<td><?php 
$array=array();
$array["5"]="5일";
$array["15"]="15일";
$array["25"]="25일";

foreach($array as $k=>$v){
if($k==$views->ma_dateofpayment){
echo "<input type=\"checkbox\" checked>";
}else{
echo "<input type=\"checkbox\">";
}
echo $v;
}	
?></td></tr>
</table><!-- table#ibk_info1 -->

</div><!-- #absent_report -->
</div><!-- <div style="width:50%"> -->

<div style="width:50%;float:left">
<b><span class="ibk_h3"></span>네이버 블로그 포스팅 관리 서비스</b>
<div id="seq_report">
<table class="ibk_info" id="ibk_info1">
<tr>
<td>※초기세팅비</td>
<td>90,000원</td></tr>
<tr>
<td>금액</td>
<td>월) <u><?php echo number_format($views->ma_blogprice);?>원 (vat별도)</u></td></tr>
<tr>
<td>블로그 포스팅 선택</td>
<td><input id="ma_isbdtt"  name="ma_isbdtt" type="checkbox"  <?php echo $views->ma_isbdtt=="on"?"checked":"";?> onclick="javascript:chk_btn_status();">지역블로그</td></tr>
<tr>
<td>리뷰 혜택 포인트 적립</td>
<td><input id="ma_isbdtt"  name="ma_isbdtt" type="checkbox"  <?php echo $views->ma_isbdtt=="on"?"checked":"";?> onclick="javascript:chk_btn_status();">배달톡톡 블로그 포인트 2,000원</td></tr>
<tr>
<td>네이버 아이디/비밀번호</td>
<td><?php echo $views->ma_naverid;?> / <?php echo $views->ma_naverpwd;?></td></tr>
</table><!-- table#ibk_info1 -->

</div><!-- #seq_report -->
</div><!-- <div style="width:50%"> -->


<div style="clear:both"></div>
<div class="raw_area">
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

<table class="ibk_info" id="ibk_info1">
<tr>
<td style="width:5%;font-size:9pt"><input id="ma_isnaver"  name="ma_isnaver" type="checkbox"  <?php echo $views->ma_isnaver=="on"?"checked":"";?> onclick="javascript:chk_btn_status();"> 네이버지도 관리서비스</td>
<td style="font-size:9pt">네이버 지도 관련 정보 수집, 네이버지도  관리 대행, 업체정보 수정 등 "에이엔피알"에게 관리 권한 위임합니다.</td></tr>
</table><!-- table#ibk_info1 -->
신청자 본인은 톡톡메시지_배달톡톡 서비스 신청서 내용과 이용약관(內) 신용카드 및 금육거래 정보의 제공 동의 내용을 충분히 숙지 참여함에 따라 위와 같이 서비스를 신청합니다.

<div id="special_report"></div><!-- #special_report -->
<div style="width:38%;float:left">
<img src="/prq/img/agreement/anpr_logo.jpeg" alt="anpr_logo.jpeg">
<p>대표이사 : 김옥란  /  사업자번호 : 476-11-00222 </p>
<p>사무실 : 경기도 고양시 일산동구 백석동 1176-1</p>
<p>고객센터 : 1599 - 7571  /  팩스 : 0505-300-9495</p>

</div>
<div style="width:17%;float:left">
<img src="/prq/img/agreement/anpr_sign.jpeg" alt="anpr_sign.jpeg"></div>
<div style="width:45%;float:left">
<h3><?php echo date("Y년 m월 d일",strtotime($views->ma_datetime));?></h3>
<h3>가맹점주 성명 : <u><?php echo $views->st_ceoname;?></u> 서명 : <img src="<?php echo $views->ma_signaturepad;?>" alt=""  width="40px" height="30px"/></h3>
<div>관리담당자 성명 : <u><?php echo $views->ma_adminname;?></u> 연락처 : <u><?php echo $views->ma_adminhp;?></u></div>

</div><!-- .<div style="width:45%;float:left"> -->
</tbody>
</table><!-- table#ibk_info4 -->
<div style="clear:both"></div>
<div id="btn_print">
<button onclick="myFunction()" >Print this page</button>
<?php
$param=$_SERVER['QUERY_STRING'];
echo '<button onclick="javascript:location.href=\'./wkl_report.php?'.$param.'\'" >Go to Report</button>';
?>
<button onclick="javascript:location.href='./list.php';" >Go to LIst</button>

</div><!-- #btn_print -->
</body>
</html>
