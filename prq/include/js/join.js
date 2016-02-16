window.onload = function() {
	// 프로필 업로드
	$('#myProfile').bind('change', function() {
		$('input[name="member_image_state"]').val('new');
		
		var file = $('#myProfile')[0].files[0];

		var reader = new FileReader();
		reader.onload = function(e){
			image_base64 = e.target.result;
			$('.user_photo_s').css("background", "url('"+image_base64+"') center center no-repeat");
			$('.user_photo_s').css("background-size", "103% 103%");
		};
		reader.readAsDataURL(file);
	});
	$('.user_photo_s').bind('click', function(e) {
		e.stopPropagation();

		$('#myProfile').last().simulate( "click" );
	});
	
	// 약관보기
	$('div.terms_chk_all a.btn_terms_view').bind('click', function() {
		if ( $('div.box_join03 > div.bdp_terms').css('display') == 'none' ) {
			$('div.terms_chk_all').find('a.btn_terms_view > i').removeClass('fa-angle-down').addClass('fa-angle-up');
			$('div.box_join03 > div.bdp_terms').show();
		}
		else {
			$('div.terms_chk_all').find('a.btn_terms_view > i').removeClass('fa-angle-up').addClass('fa-angle-down');
			$('div.box_join03 > div.bdp_terms').hide();
		}
	});
	
	// 약관동의
	$('div.box_join03 .icon_check').bind('click', function() {
		if ($(this).hasClass('select')) {
			$(this).removeClass('select');
		}
		else {
			$(this).addClass('select');
		}
	});
	
	initAddress();
}


function requestMember() {
	// 정규표현식 - 아이디
	var reId = /^([a-z0-9_-]{4,20})$/;
	// 정규표현식 - 이메일
	var reEmail = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	// 정규표현식 - 비밀번호
	var rePswd  = /^(.{4,16})$/;
	// 정규표현식 - 휴대전화번호
	var rePhone = /^(01[016789]{1})-?[0-9]{3,4}-?[0-9]{4}$/;
	
	var $inputedMode        = $.trim( $('input[name="mode"]').val() );
	var $inputedAuthedMobno = $.trim( $('input[name="authed_mobno"]').val() );
	
	// 기본정보(필수)
	var $inputedId     = $.trim( $('input[name="member_id"]').val() );
	var $inputedName   = $.trim( $('input[name="member_name"]').val() );
	var $inputedEmail  = $.trim( $('input[name="member_email"]').val() );
	var $inputedPswd1  = $.trim( $('input[name="member_pswd1"]').val() );
	var $inputedPswd2  = $.trim( $('input[name="member_pswd2"]').val() );
	var $inputedMobno  = $.trim( $('input[name="mobno"]').val() );
	var $inputedAuthno = $.trim( $('input[name="authno"]').val() );
	
	// 아이디
	if ( $inputedId.length < 4 || $inputedId.length > 20 ) {
		alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
		$('input[name="member_id"]').focus();
		return;
	}
	// 아이디 - 정규표현식
	else if ( !reId.test($inputedId) ) {
		alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
		$('input[name="member_id"]').focus();
		return;
	}
	// 이름 - 입력확인
	else if ( $inputedName.length == 0 ) {
		alert( '이름을 입력하세요.' );
		$('input[name="member_id"]').focus();
		return;
	}
	// 이메일 - 입력확인
	else if ( $inputedEmail.length == 0 ) {
    	alert( '이메일주소를 입력하세요.' );
		$('input[name="member_email"]').focus();
		return false; 
    }
    // 이메일 - 정규표현식
    else if ( !reEmail.test($inputedEmail) ) {
        alert( '이메일주소가 올바르지 않습니다.' );
		$('input[name="member_email"]').focus();
		return false;
    }
    // 비밀번호 - 정규표현식
	else if ( !rePswd.test( $inputedPswd1 ) ) {
    	alert( '4~16자 영문 대 소문자, 숫자, 특수문자를 사용하여\n비밀번호를 입력해주세요.\n' );
		$('input[name="member_pswd1"]').focus();
		return false; 
    }
    // 비밀번호 확인
    else if ( $inputedPswd1 != $inputedPswd2 ) {
    	alert( '비밀번호가 일치하지 않습니다.' );
		$('input[name="member_pswd2"]').focus();
		return false; 
    }
    // 휴대전화번호 확인
    else if ( !rePhone.test($inputedMobno) ) {
		alert( '휴대전화번호를 다시 확인해주세요.' );
		$('input[name="mobno"]').focus();
		return;
	}
	// 수정시 휴대폰번호 변경여부 확인
	else if ( ($inputedMode=='update') && (authIdx=='done') && ($inputedAuthedMobno!=$inputedMobno) ) {
		alert( '휴대전화번호를 변경하시려면 인증이 필요합니다.' );
		$('input[name="mobno"]').focus();
		return;
	}
	// 인증 확인
	else if ( authIdx == null ) {
		alert( '인증이 필요합니다.' );
		$('input[name="mobno"]').focus();
		return;
	}
    // 인증번호 확인
    else if ( authIdx !== 'done' && $inputedAuthno.length == 0 ) {
		alert( '인증번호를 입력하세요.' );
		$('input[name="authno"]').focus();
		return;
	}
	// 약관동의 여부
	else if ( !$('.box_join03 .icon_check').hasClass('select') ) {
		alert('이용약관과 개인정보 수집 및 이용에 모두 동의해주세요.');
		return false;
	}
	else {
		checkId( 'submit' );
	}
}