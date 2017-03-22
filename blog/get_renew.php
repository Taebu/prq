<!doctype html>
<html lang="en">
 <head>
  <meta charset="UTF-8">
  <meta name="Generator" content="EditPlus®">
  <meta name="Author" content="">
  <meta name="Keywords" content="">
  <meta name="Description" content="">
  <title>nenew</title>
  <script src="/prq/include/js/jquery-2.1.1.js"></script>
  <script type="text/javascript">
  function get_renew()
  {
	var param=$("#naver_auth").serialize();
	alert(param);
	$.ajax({
		url:"https://nid.naver.com/oauth2.0/token",
		data:param,
		dataType:"json",
		type:"GET",
		success:function(data){
			console.log(data);
		}
	});
  
  }
  </script>
 </head>
 <body>
  <form action="" id="naver_auth">
  <input type="hidden" name="grant_type"  value="refresh_token"/>
  <input type="hidden" name="client_id" value="qfvtBcPswnXE4O0veCZU"/>
  <input type="hidden" name="client_secret" value="PK6SrAhm8o" />
  <input type="hidden" name="refresh_token" value="giippIgHGQ7pZuisXnY7zbn5GffmhiiL5ip1YWMQmEiilYYiiSCuZip1QO6jxEiswVD6ip7CXpgDXMGWm1xHzx47ipOUkkbk768AkVlKHLL9fyXUKiiQVkie" />
  </form>
  <button onclick="javascript:get_renew()">get</button>
 </body>
</html>
