var loginMode = 'index';
var authIdx   = null;

// 로그인
function login() {
	var id   = $.trim( $('input[name="login_id"]').val() );
	var pw   = $.trim( $('input[name="login_pw"]').val() );
	var auto = $.trim( $('input[name="login_auto"]:checked').val() );
	
	if ( id.length == 0 ) {
		alert( '아이디를 입력하세요.' );
		$('input[name="login_id"]').focus();
		return;
	}
	else if ( pw.length == 0 ) {
		alert( '비밀번호를 입력하세요.' );
		$('input[name="login_pw"]').focus();
		return;
	}
	else {
		var parameters = {};
    	parameters['t']  = 'T01';
		parameters['login_id']   = id;
		parameters['login_pw']   = pw;
		parameters['login_auto'] = auto;
		
		requestLogin( parameters );
	}     	
}

// 카카오톡으로 로그인
function loginWithKakao() { 
  	// 로그인 창을 띄웁니다.
    Kakao.Auth.login({
    	success: function(authObj) {
		  	// 로그인 성공시 API를 호출합니다.
		    Kakao.API.request({
		    	url: '/v1/user/me',
		        success: function(res) {
		        	var kakao_id      = res.id;
		        	
		        	if ( typeof res.properties.nickname != 'undefined' ) { 
			        	var kakao_nick    = res.properties.nickname;
			        	var kakao_thumb   = res.properties.thumbnail_image;
			        	var kakao_profile = res.properties.profile_image;
			        	var access_token  = Kakao.Auth.getAccessToken();
			        	var refresh_token = Kakao.Auth.getRefreshToken();
			        	
			        	// 회원가입
			        	var parameters = {};
			        	parameters['t']             = 'T02';
						parameters['kakao_id']      = kakao_id;
						parameters['kakao_nick']    = kakao_nick;
						parameters['kakao_thumb']   = kakao_thumb;
						parameters['kakao_profile'] = kakao_profile;
						
						requestLogin( parameters );	
					}
					else {
						alert( '카카오톡 아이디가 잘못되었습니다.' );
					}  	
		        },
		        fail: function(error) {
		          	console.log(JSON.stringify(error))
		        }
		    });
        },
        fail: function(err) {
          	console.log( JSON.stringify(err) );
        },
        always : function(authObj, errorObj) {
	    	Kakao.API.cleanup();
        }, 
        persistAccessToken: true,
        persistRefreshToken: true
    });
}


// 네이버로 로그인
function generateState() {
	var oDate = new Date();
	return oDate.getTime();
}
function saveState(state) {
	$.removeCookie('state_token');
	$.cookie('state_token', state);
}
function loginWithNaver() {
	var state = generateState();
	saveState( state );
	naver.login( state );
}


// google+로 로그인
function loginWithGooglePlus() {
	var parameters = {};
	parameters['callback'] 				= $('span.btn_google').data( 'callback' );
	parameters['clientid'] 				= $('span.btn_google').data( 'clientid' );
	parameters['cookiepolicy'] 			= $('span.btn_google').data( 'cookiepolicy' );
	parameters['requestvisibleactions'] = $('span.btn_google').data( 'requestvisibleactions' );
	parameters['scope'] 			    = $('span.btn_google').data( 'scope' );
	
	gapi.auth.signIn( parameters );
}

function signinCallback( authResult ) {
	if ( authResult['access_token'] ) {
		getEmail();
	}
	else if ( authResult['error'] ) {
		
	}
}
function getEmail() {
	gapi.client.load('oauth2', 'v2', function() {
		var request = gapi.client.oauth2.userinfo.get();
		request.execute(getEmailCallback);
	});
}
function getEmailCallback(obj) {
	// 회원가입
	var parameters = {};
	parameters['t']              = 'T04';
	parameters['social_id']      = obj.id;
	parameters['social_name']    = obj.name;
	obj.gender == 'male' ? parameters['social_gender'] = 'M' : parameters['social_gender'] = 'W';
	parameters['social_profile'] = obj.picture;
	
	var token = gapi.auth.getToken();
	
	disconnectUser( token.access_token, parameters );
}
function disconnectUser(access_token, parameters ) {
  var revokeUrl = 'https://accounts.google.com/o/oauth2/revoke?token=' + access_token;

  // 비동기 GET 요청을 수행합니다.
  $.ajax({
    type: 'GET',
    url: revokeUrl,
    async: false,
    contentType: "application/json",
    dataType: 'jsonp',
    success: function(nullResponse) {
      // 사용자가 연결 해제되었으므로 작업을 수행합니다.
      // 응답은 항상 정의되지 않음입니다.
      requestLogin( parameters );
    },
    error: function(e) {
      // 오류 처리
      // console.log(e);
      // 실패한 경우 사용자가 수동으로 연결 해제하게 할 수 있습니다.
      // https://plus.google.com/apps
    }
  });
}


// facebook으로 로그인
function loginWithFacebook() {
	FB.login(function(response) {
		// Logged into your app and Facebook.
		if ( response.status == 'connected' ) {
			var accessToken = response.authResponse.accessToken;
			FB.api('/me', function(response) {
				// 회원가입
	        	var parameters = {};
	        	parameters['t']              = 'T05';
				parameters['social_id']      = response.id;
				parameters['social_name']    = response.name;
				parameters['social_profile'] = 'https://graph.facebook.com/'+response.id+'/picture?type=square';
				parameters['access_token']   = accessToken;
				
				requestLogin( parameters );
			});
		}
		// The person is logged into Facebook, but not your app.
		else if ( response.status == 'not_authorized' ) {
			
		}
		// The person is not logged into Facebook, so we're not sure if they are logged into this app or not.
		else {
			
		}
	});
}


function requestLogin( parameters ) {
	var fileNm = '/member/login_ok.php';
	
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
			
			if ( obj.res.state == "success") {
				window.location.replace("/"+storeNo);
			}
			else {
				alert("아이디 또는 비밀번호가 잘못되었습니다.");
			}
		},
		error : function(jqXHR, textStatus, errorThrown) {
		},
		complete : function() {
			//
		}
	});	
}


// 아이디 찾기
function findId() {
	if ( !$('div.memeber_form_result').hasClass( 'display_none' ) ) {
    	$('div.memeber_form_result').addClass( 'display_none' );
    }

	var reEmail      = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	var guessedEmail = $.trim( $('input[name="email"]').val() );
	
	if ( guessedEmail.length == 0 ) {
    	alert( '이메일주소를 입력하세요.' );
		$('input[name="email"]').focus();
		return false; 
    }
    else if ( !reEmail.test(guessedEmail) ) {
        alert( '이메일주소가 올바르지 않습니다.' );
		$('input[name="email"]').focus();
		return false;
    }
    else {	    
	    var parameters = {};
	    parameters['guessed_email'] = guessedEmail;
	        	
	    $.ajax({
			url : '/member/findId_ok.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);
				
				if ( obj.res.state == "success") {
					if ( obj.res.state_detail == "found" ) {
						$('div.memeber_form_result').find( $('p span') ).html( $.trim(obj.res.member_id) + "<em>XXXX</em>" );
						if ( $('div.memeber_form_result').hasClass( 'display_none' ) ) {
					    	$('div.memeber_form_result').removeClass( 'display_none' );
					    }
					}
					else {
						alert( "이메일을 다시 확인하세요.\n등록되지 않은 이메일이거나, 이메일을 잘못 입력하셨습니다." );
						$('input[name="email"]').focus();
					}
				}
				else {
					alert( "오류가 발생하였습니다." );
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


// 비밀번호 찾기
function findPw() {
	if ( !$('div.memeber_form_result').hasClass( 'display_none' ) ) {
    	$('div.memeber_form_result').addClass( 'display_none' );
    }
	    
	var reEmail      = /^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/;
	var guessedId    = $.trim( $('input[name="id"]').val() );
	var guessedEmail = $.trim( $('input[name="email"]').val() );
	
	if ( guessedId.length == 0 ) {
		alert( '아이디를 입력하세요.' );
		$('input[name="id"]').focus();
		return false; 
	}
	else if ( guessedEmail.length == 0 ) {
    	alert( '이메일주소를 입력하세요.' );
		$('input[name="email"]').focus();
		return false; 
    }
    else if ( !reEmail.test(guessedEmail) ) {
        alert( '이메일주소가 올바르지 않습니다.' );
		$('input[name="email"]').focus();
		return false;
    }
    else {
	    var parameters = {};
	    parameters['guessed_id']    = guessedId;
	    parameters['guessed_email'] = guessedEmail;
	        	
	    $.ajax({
			url : '/member/findPw_ok.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);

				if ( obj.res.state == "success") {
					if ( obj.res.state_detail == "found" ) {
						$('div.memeber_form_result').find( $('p span') ).html( $.trim(obj.res.member_pw) + "<em>XXX</em>" );
						if ( $('div.memeber_form_result').hasClass( 'display_none' ) ) {
					    	$('div.memeber_form_result').removeClass( 'display_none' );
					    }
					}
					else {
						alert( "아이디 또는 이메일을 다시 확인하세요.\n등록되지 않은 아이디이거나, 아이디 또는 이메일을 잘못 입력하셨습니다." );
						$('input[name="email"]').focus();
					}
				}
				else {
					alert( "오류가 발생하였습니다." );
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


// 아이디 중복 확인
function checkId( authMode ) {
	var reId = /^([a-z0-9_-]{4,20})$/;
	
	var $chkMode   = $.trim( $('input[name="mode"]').val() );
	var $inputedId = $.trim( $('input[name="member_id"]').val() );
	
	if ( $inputedId.length < 4 || $inputedId.length > 20 ) {
		alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
		$('input[name="member_id"]').focus();
		return;
	}
	else if ( !reId.test($inputedId) ) {
		alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
		$('input[name="member_id"]').focus();
		return;
	}
	else {
		var parameters = {};
	    parameters['member_id'] = $inputedId;
	    if ( $chkMode == 'update' ) {
		    parameters['member_no'] = $.trim( $('input[name="member_no"]').val() );
	    }
	     	
	    $.ajax({
			url : '/api/member/chk_id_duplication.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);

				if ( obj.res.state == "success") {
					if ( authMode == 'chk' ) {
						alert( '사용 가능한 아이디입니다.' );
						$('input[name="member_name"]').focus();
						return;
					}
					else if ( authMode == 'submit' ) {
						checkAuth( authMode );
					}
				}
				else {
					if ( obj.res.state_detail == "short" ) {
						alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
					} else if ( obj.res.state_detail == "long" ) {
						alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
					} else if ( obj.res.state_detail == "invalid" ) {
						alert( '4~20자의 영문 소문자, 숫자만 사용 가능합니다.' );
					} else if ( obj.res.state_detail == "duplication" ) {
						alert( '이미 사용중인 아이디입니다.' );
					} else {
						alert( '오류가 발생하였습니다.' );
					}
					
					$('input[name="member_id"]').focus();
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


// 휴대폰 인증 요청
function requestAuth( mode ) {
	var rePhone = /^(01[016789]{1})-?[0-9]{3,4}-?[0-9]{4}$/;
	
	var $inputedMobno = $.trim( $('input[name="mobno"]').val() );
	
	if ( $inputedMobno.length == 0 ) {
		alert( '휴대전화번호를 입력하세요.' );
		$('input[name="mobno"]').focus();
		return;
	}
	else if ( !rePhone.test($inputedMobno) ) {
		alert( '휴대전화번호를 다시 확인해주세요.' );
		$('input[name="mobno"]').focus();
		return;
	}
	else {
		var parameters = {};
		parameters['s']     = $.trim( $('input[name="store_no"]').val() );
		parameters['mode']  = $.trim( mode );
	    parameters['mobno'] = $inputedMobno;
	    
	    $.ajax({
			url : '/api/member/req_authno.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);
				
				if ( obj.res.state == "success") {
					authIdx = $.trim( obj.res.msg_no );
					
					alert( '인증번호를 발송했습니다.\n인증번호가 오지 않으면 입력하신 정보가 정확한지 확인하여 주세요.' );
					return;
				}
				else {
					if ( obj.res.state_detail == 'already in use' ) {
						alert( '이미 등록된 휴대전화번호입니다.' );
						$('input[name="mobno"]').focus();
						return;
					}
					else {
						alert( '오류가 발생하였습니다.' );
						$('input[name="mobno"]').focus();
						return;	
					}
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


// 인증번호 확인
function checkAuth( authMode ) {
	var $inputedMobno  = $.trim( $('input[name="mobno"]').val() );
	var $inputedAuthno = $.trim( $('input[name="authno"]').val() );
	
	if ( authIdx !== 'done' && $inputedAuthno.length == 0 ) {
		alert( '인증번호를 입력하세요.' );
		$('input[name="authno"]').focus();
		return;
	}
	else if ( authIdx == null ) {
		alert( '인증이 필요합니다.' );
		$('input[name="mobno"]').focus();
		return;
	}
	else {
		if ( authIdx !== 'done' ) {
			var parameters = {};
		    parameters['mobno']  = $inputedMobno;
		    parameters['authno'] = $inputedAuthno;
		    parameters['msg_no'] = authIdx;
		    
		    $.ajax({
				url : '/api/member/chk_authno.php',
				type : 'POST',
				async : false,
				data : parameters,
				beforeSend: function(jqXHR) {
					//
				},
				success : function(data, textStatus, jqXHR) {
					var obj = JSON.parse(data);
					
					if ( obj.res.state == "success") {
						if ( authMode == 'chk' ) {
							alert( '인증이 성공했습니다.' );
							return;	
						}
						else if ( authMode == 'submit' ) {
							$('#inputForm').submit();
						}
					}
					else {
						alert( '인증번호를 다시 확인해주세요.' );
						$('input[name="authno"]').focus();
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
			$('#inputForm').submit();
		}
	}
}


// 회원탈퇴
function checkLoginInfo() {
	// 정규표현식 - 아이디
	var reId    = /^([a-z0-9_-]{4,20})$/;
	// 정규표현식 - 비밀번호
	var rePswd  = /^(.{4,16})$/;
	
	var $inputedId    = $.trim( $('input[name="member_id"]').val() );
	var $inputedPswd1 = $.trim( $('input[name="member_pswd1"]').val() );
	var $inputedPswd2 = $.trim( $('input[name="member_pswd2"]').val() );
	
	// 아이디 확인
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
	else {
		var parameters = {};
		parameters['member_no']   = $.trim( $('input[name="member_no"]').val() );
	    parameters['member_id']   = $inputedId;
	    parameters['member_pswd'] = $inputedPswd1;
	    
	    $.ajax({
			url : '/api/member/chk_login_info.php',
			type : 'POST',
			async : false,
			data : parameters,
			beforeSend: function(jqXHR) {
				//
			},
			success : function(data, textStatus, jqXHR) {
				var obj = JSON.parse(data);
				
				if ( obj.res.state == "success") {
					if ( obj.res.state_detail == 'valid' ) {
						if ( confirm('탈퇴 후에는 아이디와 데이터는 복구할 수 없습니다.\n게시판형 서비스에 남아 있는 게시글은 탈퇴 후 삭제할 수 없습니다.\n\n안내 사항을 모두 확인하였으며, 이에 동의하십니까?') ) {
							$('#inputForm').submit();
						}
					}
					else {
						alert( '오류가 발생하였습니다.' );
						return;
					}
				}
				else {
					alert( '아이디 또는 비밀번호를 다시 확인하세요.\n딜리서비스에 등록되지 않은 아이디이거나, 아이디 또는 비밀번호를 잘못 입력하셨습니다.' );
					$('input[name="member_pswd1"]').focus();
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