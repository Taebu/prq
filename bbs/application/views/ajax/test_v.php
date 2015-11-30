<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no" />
	<title>CodeIgniter</title>
	<!--[if lt IE 9]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<script type="text/javascript" src="/bbs/include/js/httpRequest.js"></script>
	<script type="text/javascript">
	function server_request()
	{
		var csrf_token = getCookie('csrf_cookie_name');
		var name = "name="+encodeURIComponent(document.ajax_test.names.value)+"&csrf_test_name="+csrf_token;
		sendRequest("/bbs/ajax_board/ajax_action", name, callback_hello, "POST");
	}

	function callback_hello()
	{
		if ( httpRequest.readyState == 4 )
		{
			if ( httpRequest.status == 200 )
			{
				var contents = document.getElementById("contents");
				contents.innerHTML = httpRequest.responseText;
			}
		}
	}

	function getCookie( name )
	{
		var nameOfCookie = name + "=";
		var x = 0;

		while ( x <= document.cookie.length )
		{
			var y = (x+nameOfCookie.length);

			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
				if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
					endOfCookie = document.cookie.length;

				return unescape( document.cookie.substring( y, endOfCookie ) );
			}

			x = document.cookie.indexOf( " ", x ) + 1;

			if ( x == 0 )

			break;
		}

		return "";
	}
	</script>
</head>
<body>
<div id="main">
	<form method="post" name="ajax_test">
	<label>이름</label>
	<div>
		<input type="text" name="names" value="웅파">
	</div>

	<div>
		<input type="button" onclick="server_request()" value="전송">
	</div>
	</form>

	<div id="contents"></div>
</div>

</body>
</html>