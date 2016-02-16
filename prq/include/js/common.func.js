// 휴대폰번호 이쁘게 바꾸기
function beautifulPhoneNumber( phoneNo ) {
	var beautifulPhoneNo = phoneNo
	if ( phoneNo.length == 10 ) {
		beautifulPhoneNo = beautifulPhoneNo.replace(/(\d{3})(\d{3})(\d{4})/, '$1-$2-$3');
	}
	else if ( phoneNo.length == 11 ) {
		beautifulPhoneNo = beautifulPhoneNo.replace(/(\d{3})(\d{4})(\d{4})/, '$1-$2-$3');
	}

	return beautifulPhoneNo;
}

// 쿠폰등록
function registerCoupon() {
	if ( memberNo.length == 0 ) {
		alert( '쿠폰을 등록하시려면 먼저 로그인을 해주세요.' );
		return;
	}
	else {
		var couponId = $.trim( $('input[name="coupon_id"]').val() );
		
		if ( couponId.length > 0 ) {
			var parameters = {};
			parameters['member_no'] = memberNo;
			parameters['coupon_id'] = couponId;
			
			var fileNm = '/api/coupon/register.php';
				
			$.ajax({
				url : fileNm,
				type : 'POST',
				async : false,
				data : parameters,
				beforeSend: function(jqXHR) {
					//
				},
				success : function(data, textStatus, jqXHR) {
					var obj = JSON.parse(data);
					
					if ( obj.res.code == 'S001' ) {
						//
					}
					else if ( obj.res.code == 'E009' ) {
						alert( '쿠폰번호가 유효하지 않습니다.' );
						$('input[name="coupon_id"]').focus();
						return;
					}
					else {
						alert( '쿠폰등록중 오류가 발생하였습니다.' );
						$('input[name="coupon_id"]').focus();
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
		else {
			alert( '쿠폰번호를 입력하세요.' );
			$('input[name="coupon_id"]').focus();
			return;
		}
	}	
}

// 쿠폰 다운로드
function downloadCoupon( issueType, couponNo ) {
	if ( memberId.length > 0 ) {
		if ( issueType == '재주문쿠폰' ) {
			alert( '재주문쿠폰은 주문시 받을 수 있습니다.' );
		}
		else {
			var parameters = {};
			parameters['member_no'] = memberNo;
			parameters['coupon_no'] = couponNo;
			
			console.log( parameters );
			
			var fileNm = '/api/coupon/download.php';
				
			$.ajax({
				url : fileNm,
				type : 'POST',
				async : false,
				data : parameters,
				beforeSend: function(jqXHR) {
					//
				},
				success : function(data, textStatus, jqXHR) {
					var obj = JSON.parse(data);
					
					if ( obj.res.code == 'S001' ) {
						if ( confirm( '쿠폰받기가 완료되었습니다.\n쿠폰함으로 이동하시겠습니까?' ) ) {
							window.location.replace("/member/myCoupon.php");
						}
						else {
							location.reload();
						}
					}
					else if ( obj.res.code == 'E901' ) {
						alert( '재주문쿠폰은 주문시 받을 수 있습니다.' );
					}
					else if ( obj.res.code == 'E902' ) {
						alert( '이미 받은 쿠폰입니다.\n쿠폰함을 확인하세요.' );
					}
					else {
						alert( '오류가 발생하였습니다.' );
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
	else {
		alert( '쿠폰을 받으시려면 먼저 로그인을 해주세요.' );
		return;
	}
}