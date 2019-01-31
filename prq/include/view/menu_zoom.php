    <style>
	    * {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		
		html {
			-ms-touch-action: none;
		}
		
		body,ul,li {
			padding: 0;
			margin: 0;
			border: 0;
		}
		
		body {
			font-size: 12px;
			font-family: ubuntu, helvetica, arial;
			overflow: hidden; /* this is important to prevent the whole page to bounce */
		}
		
		#wrapper {
			position: absolute;
			z-index: 1;
			top: 0px;
			bottom: 0px;
			left: 0px;
			right: 0px;
			background: #ccc;
			overflow: hidden;
		}
		
		#scroller {
			position: absolute;
			z-index: 1;
			-webkit-tap-highlight-color: rgba(0,0,0,0);
			width: 100%;
			-webkit-transform: translateZ(0);
			-moz-transform: translateZ(0);
			-ms-transform: translateZ(0);
			-o-transform: translateZ(0);
			transform: translateZ(0);
			-webkit-touch-callout: none;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			-webkit-text-size-adjust: none;
			-moz-text-size-adjust: none;
			-ms-text-size-adjust: none;
			-o-text-size-adjust: none;
			text-size-adjust: none;
		}
		
		#scroller ul {
			list-style: none;
			padding: 0;
			margin: 0;
			width: 100%;
			text-align: left;
		}
		
		#scroller li {
			padding: 0 10px;
			height: 40px;
			line-height: 40px;
			border-bottom: 1px solid #ccc;
			border-top: 1px solid #fff;
			background-color: #fafafa;
			font-size: 14px;
		}
		.btn_top_close { position: absolute; top: 20px; right: 10px; width: 50px; height: 50px; padding: 0; border: 0; background-color: transparent; }
		.btn_top.close { width: 50px; height: 50px; top: 0px; z-index: 9999; background: url(/prq/img/btn_menu_zoom_02.png) center center; background-size: 50px 50px; right: 0px; }
	
.btn_bottom, .btn_intro, .btn_top {
    display: block;
    text-indent: -9999px;
}
</style>
	<div class="header">
        <div class="gnb_wrp">
	        <a href="javascript:;" class="btn_top_close" onclick="closePopup();">
	            <span class="btn_top close">닫기</span>
	        </a>
     
        </div>
    </div> 

<div id="imgScroll" style="overflow: scroll;
    width: 100%;
    height: 500px;">
<img class="menu_img imageCache" src="http://prq.co.kr/prq/uploads/ME/<?php echo $_GET['me_src'];?>" style="width: 100%;
 z-index: -1;" alt="메뉴이미지" /> 
 </div>
    <script type="text/javascript">
	function closePopup() {
		if ( history.length == 1 ) {
			self.opener = self;
			window.close();
		}
		else {
			history.go(-1);
		}
	}
var h = window.innerHeight;
	document.getElementById("imgScroll").style.height =h;
	</script>
	