var oDialog   = null;
var aTemplate = [];
var oAddrList = null;

function findAddress() {
	oDialog.show();
}

function initAddress() {
	aTemplate.push('<div id="popup_area" class="popup_address">');
	
    aTemplate.push('<div class="pop_title">');
    aTemplate.push('<h3 class="title">주소검색</h3>');
    aTemplate.push('<a class="close dialog-close guioHeaderClose"><i class="fa fa-angle-right"></i><i class="fa fa-angle-left"></i></a>');
    aTemplate.push('</div>');
    aTemplate.push('<dl class="adress_cont clearfix">');
    aTemplate.push('<dt class="a_adress">주소</dt>');
    aTemplate.push('<dd> <input style="width:100%" type="text" name="typed_address" placeholder="주소를 입력하세요."></dd>');
    aTemplate.push('<a href="javascript:;" class="btn gray_btn_b" id="getAddress"><span>주소검색</span></a>');
    aTemplate.push('</dl>');
    aTemplate.push('<div class="adress_info">');
    aTemplate.push('<i class="fa fa-info"></i>');
    aTemplate.push('<p class="t_color_red"> 주소명(동/읍/면/리/가) 또는 도로명(로/길)</p>');
    aTemplate.push('<p>예)가산동,디지털로9길</p>');
    aTemplate.push('</div>');
    
    aTemplate.push('<div id="view" class="display_none">');
    aTemplate.push('<div style="width:100%;">');
    aTemplate.push('<div class="adress_scroll">');
	aTemplate.push('</div>');
	aTemplate.push('</div>');
	aTemplate.push('</div>');
    
    aTemplate.push('</div>');
    
    var sTemplate = aTemplate.join("");
	
	oDialog = new jindo.m.Dialog({ bUseEffect : false });
	oDialog.setTemplate(sTemplate);
	oDialog.attach({
		beforeShow : function(e) {
			$('body').addClass('overflow_hidden');
		},
		show : function(e) {
			oAddrList = new jindo.m.Scroll("view", {
				bUseHScroll: false,
				bUseVScroll: true,
				bUseMomentum: true,
				nHeight: 180
			});
			
			setTimeout(function() {
				$('a#getAddress').bind('click', function() {
					getAddress();
				});
			}, 100);
		},
		hide : function(e) {
			$('div#view').addClass( 'display_none' );
			$('body').removeClass('overflow_hidden');
		}
	});
}


// 주소검색 팝업의 주소검색 버튼 클릭시 호출되는 함수
function getAddress() {
	$('div.adress_scroll').html();
	
	var $inputAddress = $.trim( $('input[name="typed_address"]').val() );
	
	if ( $inputAddress < 2 ) {
		alert( '주소를 입력하세요.' );
		$('input[name="typed_address"]').focus();
		return;
	}
	else {
		var parameters = {};
	    parameters['typed_address'] = $inputAddress;
	       	
	    $.ajax({
			url : '/api/address/get.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);

				if ( obj.res.state == "success" ) {
					if ( obj.res.address_list.length > 0 ) {
						var html = '';
						for ( var i = 0; i < obj.res.address_list.length; i++ ) {
							var addressInfo = obj.res.address_list[i];
							html += "<div class='adress_select'>";
							html += 	"<span>" + $.trim( addressInfo['addr3'] ) + "</span>";
							html += 	"<p>" + $.trim( addressInfo['addr'] ) + "</p>";
							html += 	"<a class='btn gray_btn_s' data-addr1='" + $.trim( addressInfo['addr1'] ) + "' data-addr2='" + $.trim( addressInfo['addr2'] ) + "' data-addr3='" + $.trim( addressInfo['addr3'] ) + "' data-addr='" + $.trim( addressInfo['addr'] ) + "'><span>선택</span></a>";
							html += "</div>";
						}
						$('div.adress_scroll').html( html ).promise().done( function() {
							$('div#view').removeClass( 'display_none' );
							
							oAddrList.refresh();
							
							$('div.adress_select > a').bind('click', function() {
								oDialog.hide();
								setAddress( $(this).attr('data-addr1'), $(this).attr('data-addr2'), $(this).attr('data-addr3'), $(this).attr('data-addr') );
							});
						});
					}
					else {
						alert( '주소를 다시 확인해주세요.' );
						$('input[name="typed_address"]').focus();
						return;
					}
					
				}
				else {
					alert( '오류가 발생하였습니다.' );
					return;
				}
			},
			error : function(jqXHR, textStatus, errorThrown) {
			},
			complete : function() {
				//
			}
		});
	}
}


// 주소검색 팝업의 선택 버튼 클릭시 호출되는 함수
function setAddress( addr1, addr2, addr3, addr ) {
	$('input[name="member_addr1"]').val( addr1 );
	$('input[name="member_addr2"]').val( addr2 );
	$('input[name="member_addr3"]').val( addr3 );
	$('input[name="member_addr"]').val( addr );
	
	$('input[name="member_addr_detail"]').focus();
}