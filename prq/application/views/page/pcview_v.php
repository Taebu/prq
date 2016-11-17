<?php

if(empty($views->st_name)){
show_404('page/8');
}

$url=$_SERVER['PATH_INFO'];

 //phone regex http://blog.acronym.co.kr/243
 function phone_format($num){
 	return preg_replace("/(^02.{0}|^01.{1}|[0-9]{3})([0-9]+)([0-9]{4})/","$1-$2-$3",$num);
 }
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
		<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
		<style type="text/css">
			body,img{margin:0;padding:0;}
			#mobile_page{
				position:absolute;top:146px;left:466px;
			}
			#phon{
				position: absolute;
				top: 60px;
				left: 430px;
			}
			#title{
				position: absolute;
				top: 264px;
				left: 875px;
				width: 800px;
				border:0px solid red;
				font-size: 51px;
				font-weight: bold;
				color:#3f4040;
				font-family: '맑은 고딕','Malgun Gothic','돋움',Dotum,Helvetica,AppleGothic,Sans-serif;
			}
			#number{
				position: absolute;
				top: 335px;
				left: 875px;
				width: 500px;
				font-size: 40px;
				color:#3f4040;
				font-family: '맑은 고딕','Malgun Gothic','돋움',Dotum,Helvetica,AppleGothic,Sans-serif;
			}
			#url{
				position:absolute;
				top: 387px;
				left: 875px;
				width: 500px;
				color:#808282;
				/*font-size: -webkit-xx-large;}*/
				font-size: 25px;
				font-family: '맑은 고딕','Malgun Gothic','돋움',Dotum,Helvetica,AppleGothic,Sans-serif;
			}
			#qr{
				position:absolute;
				top: 438px;
				left: 875px;
				width: 500px;
				font-size: -webkit-xx-large;
			}
			#search0{
				position: absolute;
				top: 580px;
				left: 875px;
				font-size: 20px;
				letter-spacing: -1px;
				color:#777979;
			}
			#search1{
				position: absolute;
				top: 669px;
				left: 875px;
			}
			#search{
				position:absolute;
				top: 679px;
				left: 887px;
				font-size: 15px;
				font-family: '맑은 고딕','Malgun Gothic','돋움',Dotum,Helvetica,AppleGothic,Sans-serif;
			}
			#anpr{
				position:absolute;
				top: 0px;
				left: 1430px;
			}
		</style>
		<script type="text/javascript">
		 /**
 * 한글을 초성/중성/종성 단위로 잘라서 배열로 반환한다.
 * 공백은 반환하지 않는다.
 * 
 * 참조: http://dream.ahboom.net/entry/%ED%95%9C%EA%B8%80-%EC%9C%A0%EB%8B%88%EC%BD%94%EB%93%9C-%EC%9E%90%EC%86%8C-%EB%B6%84%EB%A6%AC-%EB%B0%A9%EB%B2%95
 *       http://helloworld.naver.com/helloworld/76650
 */
String.prototype.toKorChars = function() {
    var cCho  = [ 'ㄱ', 'ㄲ', 'ㄴ', 'ㄷ', 'ㄸ', 'ㄹ', 'ㅁ', 'ㅂ', 'ㅃ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅉ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ' ],
        cJung = [ 'ㅏ', 'ㅐ', 'ㅑ', 'ㅒ', 'ㅓ', 'ㅔ', 'ㅕ', 'ㅖ', 'ㅗ', 'ㅘ', 'ㅙ', 'ㅚ', 'ㅛ', 'ㅜ', 'ㅝ', 'ㅞ', 'ㅟ', 'ㅠ', 'ㅡ', 'ㅢ', 'ㅣ' ],
        cJong = [ '', 'ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ' ],
        cho, jung, jong;

    var str = this,
        cnt = str.length,
        chars = [],
        cCode;

    for (var i = 0; i < cnt; i++) {
        cCode = str.charCodeAt(i);
        
        if (cCode == 32) { continue; }

        // 한글이 아닌 경우
        if (cCode < 0xAC00 || cCode > 0xD7A3) {
            chars.push(str.charAt(i));
            continue;
        }

        cCode  = str.charCodeAt(i) - 0xAC00;

        jong = cCode % 28; // 종성
        jung = ((cCode - jong) / 28 ) % 21 // 중성
        cho  = (((cCode - jong) / 28 ) - jung ) / 21 // 초성

        chars.push(cCho[cho], cJung[jung]);
        if (cJong[jong] !== '') { chars.push(cJong[jong]); }
    }

    return chars;
}

function is_jong(str)
{
	var chk_jong=str.toKorChars();
	var index=chk_jong.length-1;
	var cJong = ['ㄱ', 'ㄲ', 'ㄳ', 'ㄴ', 'ㄵ', 'ㄶ', 'ㄷ', 'ㄹ', 'ㄺ', 'ㄻ', 'ㄼ', 'ㄽ', 'ㄾ', 'ㄿ', 'ㅀ', 'ㅁ', 'ㅂ', 'ㅄ', 'ㅅ', 'ㅆ', 'ㅇ', 'ㅈ', 'ㅊ', 'ㅋ', 'ㅌ', 'ㅍ', 'ㅎ','1','3','6','7','8' ];
	var a = cJong.indexOf(chk_jong[index]);
	var result=a>-1;
	return result;
}

$(function(){
	var chk_jong=is_jong($("#stname").val());
	$("#search").html(chk_jong?$("#stname").val()+"을 검색해보세요!":$("#stname").val()+"를 검색해보세요!");
});
		</script>
	</head>
	<!-- <?php
		print_r($views);
	?> -->
	<body style="overflow-x:hidden; overflow-y:hidden;">
		<input type="hidden" name="stname" id="stname" value="<?php echo $views->st_name;?>">
		<img src="/prq/img/pc_main.png" alt="PR메시지">
		<div id="phon"><img src="/prq/img/phon.png"></div>
		<div id="title"><?php echo $views->st_name;?></div>
		<div id="number">☎ <?php echo phone_format($views->st_vtel);?></div>
		<div id="url">http://prq.co.kr/prq<?php echo $url;?></div>
		<div id="search0">
			<ul style="padding:0;margin:0;list-style:none;">
				<li>스마트폰으로 QR코드를 찍어보세요!</li>
				<li>더욱 편리하게 홈페이지를 확인 하실 수 있습니다.</li>
			</ul>
		</div>
		<div id="search1"><img src="/prq/img/search1.png"></div>
		<div id="search"><?php echo $views->st_name;?>를 검색해보세요!</div>
		<div id="qr"><img src="http://chart.apis.google.com/chart?cht=qr&chs=180x180&choe=UTF-8&chld=L|0&chl=http://prq.co.kr/prq<?php echo $url;?>" width="120px;"></div>
		<div id="anpr"><img src="/prq/img/anpr.png" width="140px"></div>
		<div id="mobile_page"><iframe src="http://prq.co.kr/prq<?php echo $url;?>/mobile" frameborder="0" width='360' height='633'></iframe></div>
	</body>
</html>
