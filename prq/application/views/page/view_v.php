<?php //print_r($views);?>
<body class="display_none">
<!-- rs-body 시작 -->
<div class="reveal2-wrap">

<!-- rs-left 시작 -->
<div id="celeblist" class="celeb_vw reveal2-nav">
<div class="celeb_wrap" id="celeblist_scroll">
<div style="width:100%;">
<nav class="celeb_lst">
<div class="left_navtitle">
<a href="/member/login.php">
<span class="left_nav_photo">메뉴포토</span>
<p>로그인하세요</p>
</a>
<a href="javascript:;" id="leftNavClose" class="left_nav_close">닫기</a> 
</div>

<ul>
<li><a href="/member/join.php"><span class="icon_menu imenu01">회원가입아이콘</span>회원가입</a></li>
</ul>
<ul>
<li>
<a href="/member/myCoupon.php"><span class="icon_menu imenu03">쿠폰함아이콘</span>쿠폰함</a>
</li>
<li>
<a href="/order/basket/"><span class="icon_menu imenu04">장바구니아이콘</span>장바구니</a>
</li>
<li>
<a href="/order/history/"><span class="icon_menu imenu05">주문내역아이콘</span>주문내역</a>
<!--<span class="msg_num">99</span>-->
</li>
</ul>
<ul>
<li>
<a href="/notice/"><span class="icon_menu imenu06">공지사항아이콘</span>공지사항</a>
<!--span class="msg_num">3</span>-->
</li>
<li>
<a href="/help/"><span class="icon_menu imenu07">도움말아이콘</span>도움말</a>
<!--<span class="msg_num">1</span>-->
</li>
<li><a href="/board/inquiry/write.php"><span class="icon_menu imenu08">오류신고/기타문의아이콘</span>오류신고/기타문의</a></li>
</ul>
<ul>
<li><a href="./introduction/"><span class="icon_menu imenu09">배달홈피 소개 아이콘</span>배달홈피 소개</a></li>
<li><a href="./company/"><span class="icon_menu imenu10">배달홈피 제공사 아이콘</span>배달홈피 제공사</a></li>
</ul>
<div id="shortcutWrapper" class="display_none">
<a href="javascript:;" class="add_favorite" onclick="addFavorite();"><span>즐겨찾기아이콘</span>바탕화면 바로가기 추가</a>
</div>
<div style="width:100%; height:50px;"></div>
</nav>
</div>
</div>

</div>
<!-- rs-left 끝 -->

<!-- rs-body 시작 -->
<div id="ct" role="main" class="reveal-contents reveal2-contents">
<div class="ct_wrp">
<div class="header">
<div class="gnb_wrp">
<h1><a href="javascript:;"><span class="gnb_tl"><?php echo $views->st_name;?></span></a></h1>
<!-- top_btn -->
<a href="javascript:;" class="btn_top_openleft _leftMenu gnb list">
<span class="btn_top openleft">확장영역 열기</span>
<!--
<span class="btn_top_openleft_num">N</span>
-->
</a>
<a href="javascript:;" class="btn_top_home" id="btnTopHome" data-id="HOME" data-idx=0>
<span class="btn_top home">홈 바로가기</span>
</a>
<!-- //top_btn -->
</div>


<div class="grd_prev"></div>
<div class="grd_next"></div>

<div id="nav" class="nav">
<div class="nav_wrap">
<ul class="nav_u" id="nav_u">
<!-- 메뉴 -->
<li class="nav_l"><a href="javascript:;" class="nav_a" data-id="HOME" data-idx=0>&nbsp;홈&nbsp;</a></li>
						<li class="nav_l"><a href="javascript:;" class="nav_a" data-id="INFO" data-idx=1>정보/후기</a></li>
						<li class="nav_l"><a href="javascript:;" class="nav_a" data-id="MENU" data-idx=2>메뉴</a></li>
						<li class="nav_l"><a href="javascript:;" class="nav_a" data-id="ONLINEORDER" data-idx=3>온라인주문</a></li>
						<li class="nav_l"><a href="javascript:;" class="nav_a" data-id="COUPON" data-idx=4>쿠폰</a></li>
						<li class="nav_l"><a href="javascript:;" class="nav_a" data-id="EVENT" data-idx=5>이벤트</a></li>
</ul>
</div>
</div>
</div>

<div id="ct" style="position:relative;">
<!-- Demo 영역 -->
<div id="mflick">
<div class="flick-container">
<div class="flick-ct"></div>
<div class="flick-ct"></div>
<div class="flick-ct"></div>
</div>
</div>
<!--// Demo 영역 -->
</div>
</div>

<div id="footer" class="footer footer01">
<p><?php echo $views->st_name;?> 587-09-00247</p>
<p>경기도 부천시 원미구 부천로53번길 52 1층(심곡동) 김은정</p>
<p>copyright(c) 2014 prq</p>
</div>

<div id="menuBg" class="menu_bg display_none" style="">메뉴bg</div>
</div>
<!-- rs-body 끝 -->

</div>
<!-- rs-body 끝 -->

<div class="bottombtn_wrp">
<!-- bottom_btn -->
<a href="tel:<?php echo $views->st_tel_1;?>" class="btn_bottom_call">
<span class="btn_bottom call">전화걸기</span>
</a>
<!-- //bottom_btn -->
</div>


<script type="text/javascript">
storeNo = 'b0o9';
storeNo = storeNo.toLowerCase();

memberNo = '856710';
memberId = '';
msgType  = '';

var cookie  = jindo.$Cookie();

if ( storeNo == cookie.get ("MM_S") ) {
var nIdx  = parseInt( cookie.get ("MM_I") );
var nLeft = parseFloat( cookie.get ("MM_L") );
var nView = cookie.get ("MM_V");
}
else {
var nLeft = 0;
}

// 에러 제거용
Card = {
nclk: function() {}
};

function nclk() {}

var uri = window.location.toString();
var clean_uri = uri.substring( 0, uri.indexOf("?") );
if ( uri.indexOf("?") > 0 ) {

window.history.replaceState({}, document.title, clean_uri + storeNo);
}
else {
//			alert("?");
//			window.history.replaceState({}, document.title, clean_uri + storeNo);
}

var nDelay = jindo.m.getDeviceInfo().android ? 300 : 0;
var oSlideFlicking = null;
var aScroll = [];
var oAccordion = null;

var htSize = jindo.$Document().clientSize();
var htOtherFlick = {
header: jindo.$Element(jindo.$$.getSingle(".header")).height()
};
jindo.$Element("mflick").height(htSize.height - htOtherFlick.header);

var aCelebScroll, oTab = null;

var oMenu, oLeftNav = null;

var oReveal = null;
var oScroll = null;

var aAjaxData = [];
aAjaxData.length = 6;

var parameters = {};
parameters['store_no'] = storeNo;
parameters['member_no'] = memberNo;
parameters['st_thumb_paper'] = "<?php echo $views->st_thumb_paper;?>";
$.ajax({
url : '/prq/include/view/home.php',
type : 'POST',
async : false,
data : parameters,
beforeSend: function(jqXHR) {
//
},
success : function(data, textStatus, jqXHR) {
aAjaxData[0] = data;
},
error : function(jqXHR, textStatus, errorThrown) {
},
complete : function() {

}
});
var parameters = {};
parameters['store_no'] = storeNo;
parameters['member_no'] = memberNo;
parameters['st_thumb_paper'] = "<?php echo $views->st_thumb_paper;?>";
parameters['st_intro'] = "<?php echo $views->st_intro;?>";
parameters['st_alltime'] = "<?php echo $views->st_alltime;?>";
parameters['st_open'] = "<?php echo $views->st_open;?>";
parameters['st_closed'] = "<?php echo $views->st_closed;?>";
parameters['st_destination'] = "<?php echo $views->st_destination;?>";
parameters['st_tel'] = "<?php echo $views->st_tel_1;?>";

$.ajax({
url : '/prq/include/view/info.php',
type : 'POST',
async : false,
data : parameters,
beforeSend: function(jqXHR) {

},
success : function(data, textStatus, jqXHR) {
aAjaxData[1] = data;
},
error : function(jqXHR, textStatus, errorThrown) {
},
complete : function() {

}
});

var parameters = {};
parameters['store_no'] = storeNo;
parameters['member_no'] = memberNo;
parameters['st_menu_paper'] = "<?php echo $views->st_menu_paper;?>";
parameters['st_thumb_paper'] = "<?php echo $views->st_thumb_paper;?>";

$.ajax({
url : '/prq/include/view/menu.php',
type : 'POST',
async : false,
data : parameters,
beforeSend: function(jqXHR) {
//
},
success : function(data, textStatus, jqXHR) {
aAjaxData[2] = data;
},
error : function(jqXHR, textStatus, errorThrown) {
},
complete : function() {

}
});
var parameters = {};
parameters['store_no'] = storeNo;
parameters['member_no'] = memberNo;

$.ajax({
url : '/prq/include/view/onlineorder.php',
type : 'POST',
async : false,
data : parameters,
beforeSend: function(jqXHR) {
//
},
success : function(data, textStatus, jqXHR) {
aAjaxData[3] = data;
},
error : function(jqXHR, textStatus, errorThrown) {
},
complete : function() {

}
});
var parameters = {};
parameters['store_no'] = storeNo;
parameters['member_no'] = memberNo;

$.ajax({
url : '/prq/include/view/coupon.php',
type : 'POST',
async : false,
data : parameters,
beforeSend: function(jqXHR) {
//
},
success : function(data, textStatus, jqXHR) {
aAjaxData[4] = data;
},
error : function(jqXHR, textStatus, errorThrown) {
},
complete : function() {

}
});
var parameters = {};
parameters['store_no'] = storeNo;
parameters['member_no'] = memberNo;

$.ajax({
url : '/prq/include/view/event.php',
type : 'POST',
async : false,
data : parameters,
beforeSend: function(jqXHR) {
//
},
success : function(data, textStatus, jqXHR) {
aAjaxData[5] = data;
},
error : function(jqXHR, textStatus, errorThrown) {
},
complete : function() {

}
});
</script>
<script type="text/javascript" src="/prq/include/js/app.min.js?1447751507"></script>
<script type="text/javascript">
storeNm     = '멕시카나치킨부천북부점';
thumbnail   = 'http://img.delipartner.kr/store/thumbnail/B0o9_thumbnail_20151104170141.png';
shortcutURL = 'http://dlpg.kr';
linkSource  = 'none';
</script>

</body>

</html>