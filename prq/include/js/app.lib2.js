var thumbnail=null,
storeNm=null,
shortcutURL=null,
linkSource=null,
oDialog=null,
aTemplate=[];

window.onload=function()
{

$("body").removeClass("display_none");

setTimeout(function(){
	oMenu=(new jindo.m.Scroll("nav",{
		bActivateOnload:!0,
		bUseHScroll:!0,
		bUseVScroll:!1,
		bUseScrollbar:!1,
		buseMomentum:!1,
		bUseBounce:!1,
		nHeight:40,
		bAutoResize:!0})).attach({afterScroll:function(a){}});

	oMenu.scrollTo(nLeft,0);

	oReveal=(new jindo.m.SlideReveal({
		sClassPrefix:"reveal2-",
		nDuration:600,
		nMargin:$(window).width()+230,
		sDirection:"left"
		})).attach(
	{
		beforeShow:function(a){
			$("div#menuBg").removeClass("display_none");
			$("a.btn_bottom_basket").addClass("display_none");
			$("a.btn_bottom_call").addClass("display_none");
			jindo.$Element("celeblist").show();
			oScroll||(oScroll=new jindo.m.Scroll("celeblist_scroll",{
				bUseHScroll:!1,
				bUseVScroll:!0,
				bUseScrollbar:!1,
				nHeight:this._htSize.height})
			)
		},
		show:function(a){
			oScroll&&oScroll.height(this._htSize.height)
		},
		hide:function(a){
			$("div#menuBg").addClass("display_none");
			$("a.btn_bottom_basket").removeClass("display_none");
			$("a.btn_bottom_call").removeClass("display_none");
		},
		rotate:function(){
			oScroll&&oScroll.height(this._htSize.height)
		}
	});

	oSlideFlicking=(new jindo.m.SlideFlicking(jindo.$("mflick"),
	{
		bActivateOnload:!0,
		nTotalContents:aAjaxData.length,
		nDuration:200,
		bUseCircular:!0,
		bUseBounce:!0,
		bUseDiagonalTouch:!1
	})).attach({
		beforeFlicking:function(a){},
		flicking:function(a)
		{
			a.bCorrupt?(this.getElement().html(aAjaxData[this.getContentIndex()]),
			this.getContentIndex()==this.getTotalContents()-1?this.getNextElement().html(aAjaxData[0]):this.getNextElement().html(aAjaxData[this.getNextIndex()]),
			0==this.getContentIndex()?this.getPrevElement().html(aAjaxData[this.getTotalContents()-
		1]):this.getPrevElement().html(aAjaxData[this.getPrevIndex()])):a.bNext?this.getNextElement().html(aAjaxData[this.getNextIndex()]):this.getPrevElement().html(aAjaxData[this.getPrevIndex()])},
		beforeRestore:function(a){},
		restore:function(a){},
		afterFlicking:function(a){
		
		$("div.header li.nav_l").each(function(b)
		{
			var c=$(this);
			b==a.nContentsIndex?(
			c.addClass("nav_lon"),
			b=jindo.$Cookie(),
			b.set("MM_S",storeNo,0),
			b.set("MM_V",c.find("a").attr("data-id"),0),
			b.set("MM_I",c.find("a").attr("data-idx"),0),
			b.set("MM_L",c.offset().left,0),
			c.prev().length
			&&c.prev().offset().left>c.parent().find($("li")).first().offset().left?oMenu.scrollTo(c.prev().offset().left,0):oMenu.scrollTo(0,0)):c.removeClass("nav_lon")
		});
		
		$("div#box_reviews").find($("span.comment")).each(function(b){
			$(this).html($(this).html().replace(/\r?\n/g,"<br/>"))
		});
		
		$("div#orderinfo_area").find($(".htmlArea")).each(function(b){
			$(this).html($(this).html().replace(/\r?\n/g,"<br/>"))
		});
		
		$("div#delilink_area").find($(".htmlArea")).each(function(b){
			$(this).html($(this).html().replace(/\r?\n/g,"<br/>"))
		});
		
		oAccordion=new jindo.m.Accordion(jindo.$("orderlist_area"),{
			nDefaultIndex:0,
			bActivateOnload:!0,
			bUseToggle:!0,
			nDuration:0
		});

		oAccordion.attach({
			beforeExpand:function(b){},
			expand:function(b){
				$(b.elBlock).find("dt").hasClass("select")||$(b.elBlock).find("dt").addClass("select");
				oSlideFlickingRefresh()
			},
			beforeCollapse:function(b){},
			collapse:function(b){
				$(b.elBlock).find("dt").hasClass("select")&&$(b.elBlock).find("dt").removeClass("select");
				oSlideFlickingRefresh()
			}
		});

		$("#orderlist_area").find($("dt.hx")).first().trigger("click");

		jindo.$Fn(function(b)
		{
			b.stop();
			window.location.href="/order/product/?i="+$(b.currentElement).attr("idx")},this).attach(jindo.$$("li.product"),"click");
			var d=1*a.nContentsIndex;
			0==d&&$("div#floatBtn").hasClass("display_none")?$("div#floatBtn").removeClass("display_none"):0===d||$("div#floatBtn").hasClass("display_none")||$("div#floatBtn").addClass("display_none");
			
			$("div.contents").find($("img.menu_img")).load(function(){refreshLayout()});

		setTimeout(function(){refreshLayout()},100);
		window.scrollTo(0,0)},rotate:function(){}});

	setTimeout(function(){
		oSlideFlicking.refresh(nIdx);
		controlToast(msgType);
		1==jindo.m.getDeviceInfo().android&&$("div#shortcutWrapper").removeClass("display_none");
		if(1==jindo.m.getDeviceInfo().android
			&&0==nLeft
			&&"home"!=linkSource
			&&"link"!=linkSource
			&&!$.cookie("MM_POP_"+storeNo))
		{
		aTemplate.push('<div id="popup_area" class="popup_center">');
		aTemplate.push('<div class="pop_title">');
		aTemplate.push('<h3 class="title">\ubc14\ub85c\uac00\uae30 \uc124\uce58</h3>');

		aTemplate.push("</div>");
		aTemplate.push('<div class="shoutcut_area">');
		aTemplate.push('<span class="thumb" style="background:url('+thumbnail+') center center no-repeat;background-size:100% 100%;">\ub9e4\uc7a5\uc378\ub124\uc77c</span>');
		aTemplate.push('<div class="shoutcut_btn_area">');
		aTemplate.push("<p>\ud648\ud654\uba74\uc5d0 \ubc14\ub85c\uac00\uae30\ub97c \ucd94\uac00\ud558\uc2dc\uaca0\uc2b5\ub2c8\uae4c?</p>");
		aTemplate.push('<a href="javascript:;" class="btn_b_yes" onclick="addFavorite();"> \uc608 </a>');
		aTemplate.push('<a href="javascript:;" class="btn_b_no" onclick="oDialog.hide();"> \uc544\ub2c8\uc624 </a>');
		aTemplate.push("</div>");
		aTemplate.push('<p class="shoutcut_info"><i class="fa fa-info"></i><em>\ub124\uc774\ubc84 \uc5b4\ud50c\uc774 \uc5c6\uc73c\uba74<br/> \ud50c\ub808\uc774\uc2a4\ud1a0\uc5b4\ub85c \uc774\ub3d9\ud569\ub2c8\ub2e4.</em></p>');
		aTemplate.push('<p class="shoutcut_form">');
		aTemplate.push('<a id="fa_check_wrapper" class="icon_check" href="javascript:;" onclick="chk7days();"><i class="fa fa-check"></i></a>');
		aTemplate.push('<a href="javascript:;" onclick="chk7days();">\uc77c\uc8fc\uc77c\uac04 \ubcf4\uc9c0 \uc54a\uae30</a>');
		aTemplate.push("</p>");
		aTemplate.push("</div>");
		aTemplate.push("</div>");
		
		var a=aTemplate.join("");
		oDialog=new jindo.m.Dialog({bUseEffect:!1});
		oDialog.setTemplate(a);

		oDialog.attach({
			beforeShow:function(a){
				$("body").addClass("overflow_hidden")},
				show:function(a){},
				hide:function(a){
					$("div#view").addClass("display_none");
					$("body").removeClass("overflow_hidden");
					if($("a#fa_check_wrapper").hasClass("select")){
						var b=new Date;
						b.setDate(b.getDate()+7);
						b.setHours(0,0,0,0);
						var c=new Date
					}else 
						b=new Date,b.setDate(b.getDate()+1),b.setHours(0,0,0,0),c=new Date;
					a=new Date;
					a.setTime(c.getTime()+(b.getTime()-c.getTime()));
					b={path:"/",domain:"."+location.hostname,expires:a};
					$.cookie("MM_POP_"+storeNo,a,b)
				}
		});

		oDialog.show()}},300);

jindo.$Fn(function(a){
	a=parseInt(jindo.$Element(a.currentElement).child()[0].attr("data-idx"),10);
	oSlideFlicking.moveTo(a,0)},this).attach(jindo.$Element("nav_u").child(),"click");

jindo.$Fn(function(a){
	a=parseInt(jindo.$Element(a.currentElement).attr("data-idx"),10);
	oSlideFlicking.moveTo(a,0)},this).attach(jindo.$Element("btnTopHome"),"click");

jindo.$Fn(function(a){a.stop();oReveal.hide()},this).attach(jindo.$Element("leftNavClose"),"click");

jindo.$Fn(function(a){a.stop();oReveal.hide()},this).attach(jindo.$Element("menuBg"),"click");

jindo.$Fn(function(a){a.stop();oReveal.show()},this).attach(jindo.$$.getSingle("._leftMenu"),"click");

jindo.$Fn(function(a){a.stop();oReveal.show()},this).attach(jindo.$$.getSingle("._rightMenu"),"click");	




},nDelay);

}; /* window.onload=function(){...} */


function refreshLayout()
{
	var a=oSlideFlicking.getElement().child()[0].height(),d=$(window).height()-($("div.header").outerHeight()+$("div.footer").outerHeight());
	a<d?jindo.$Element("mflick").height(d):jindo.$Element("mflick").height(oSlideFlicking.getElement().child()[0].height())
}

function chk7days()
{
	$("a#fa_check_wrapper").hasClass("select")?$("a#fa_check_wrapper").removeClass("select"):$("a#fa_check_wrapper").addClass("select")
}

function addFavorite()
{
	try{
		var a=encodeURIComponent(thumbnail),d=encodeURIComponent(storeNm),b="intent://addshortcut?url="+encodeURIComponent(shortcutURL)+"&icon="+a+"&title="+d+"&serviceCode=sports&version=7#Intent;scheme=naversearchapp;action=android.intent.action.VIEW;category=android.intent.category.BROWSABLE;package=com.nhn.android.search;end";
		location.href=b;
	}catch(c){
		console.log(c);
	}finally{
		"undefined"!==typeof oDialog&&"null"!==oDialog&&oDialog.isShown()&&oDialog.hide(),	"undefined"!==typeof oReveal&&"null"!==oReveal&&oReveal.hide();
	}
};