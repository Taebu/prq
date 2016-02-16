var nDelay = jindo.m.getDeviceInfo().android ? 100: 0;
var oAccordion = null;

var storeNo = null;

window.onload = function() {
	setTimeout(function() {
		oAccordion = new jindo.m.Accordion( jindo.$('mypagelist_notice_area'), {
			bActivateOnload: true,
			bUseToggle: true,
			nDuration: 0
		});
		oAccordion.attach({
			beforeExpand: function(e) {
			},
			expand: function(e) {
				if ( !$( e.elBlock ).find( 'dt' ).hasClass('select') ) {
					$( e.elBlock ).find( 'dt' ).addClass( 'select' );
				}
				oSlideFlickingRefresh();
			},
			beforeCollapse: function(e) {
			},
			collapse: function(e) {
				if ( $( e.elBlock ).find( 'dt' ).hasClass('select') ) {
					$( e.elBlock ).find( 'dt' ).removeClass( 'select' );
				}
				oSlideFlickingRefresh();
			}
		});
		
		oSlideFlickingRefresh();
	}, nDelay);
}

function oSlideFlickingRefresh() {
	var contentsHeight = 0;
	
	if ( $('div#mypagelist_notice_area').length ) {
		contentsHeight   = $('div#mypagelist_notice_area').outerHeight();
	}
    else if ( $('div#servicecompany_area').length ) {
		contentsHeight   = $('div#servicecompany_area').outerHeight();
	}
	else if ( $('div#mycoupon_area').length ) {
		contentsHeight   = $('div#mycoupon_area').outerHeight();
	}
    else if ( $('div.contents').length ) {
	    contentsHeight   = $('div.contents').outerHeight();
    }
    
    var minContentHeight = $(window).height() - ( $('div.header').outerHeight() + $('div.footer').outerHeight() );
    
    if ( contentsHeight < minContentHeight ) {
        $('div.contents').height(minContentHeight);
    }
	else {
		$('div.contents').height( contentsHeight );
	}
}

function goHome() {
	// window.location.replace( '/' + storeNo.toLowerCase() );
	window.location.replace( '/?s=' + storeNo.toLowerCase() + '&v=HOME' );
}

function goBack() {
	window.location.replace( document.referrer );
}

function goto( path ) {
	window.location.replace( path );
}