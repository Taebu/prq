<?php
$url=$_SERVER['PATH_INFO'];
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="Generator" content="EditPlus®">
		<meta name="Author" content="">
		<meta name="Keywords" content="">
		<meta name="Description" content="">
		<title></title>

		<style type="text/css">
			body,img{margin:0;padding:0;}
			#mobile_page{
				position:absolute;top:144px;left:636px;
			}
			#title{
				position: absolute;
				top: 314px;
				left: 1055px;
				width: 500px;
				font-size: -webkit-xxx-large;
				font-weight: bold;
				color:#3f4040;
			}
			#url{
				position:absolute;
				top: 387px;
				left: 1055px;
				width: 500px;
				color:#808282;
				/*font-size: -webkit-xx-large;}*/
				font-size: 25px;
			}
			#qr{position:absolute;
				top: 487px;
				left: 1055px;
				width: 500px;
				font-size: -webkit-xx-large;
			}

		</style>
	</head>

	<body>
		<img src="/prq/img/pc_main.png" alt="PR메시지">
		<div id="title"><?php echo $views->st_name;?></div>
		<div id="url">http://prq.co.kr/prq<?php echo $url;?></div>
		<div id="qr">http://prq.co.kr/prq<?php echo $url;?></div>
		<div id="mobile_page"><iframe src="http://prq.co.kr/prq<?php echo $url;?>/mobile" frameborder="0" width='360' height='633'></iframe></div>
	</body>
</html>
