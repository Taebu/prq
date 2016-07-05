<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>INSPINIA | Login</title>

    <link href="/prq/include/css/bootstrap.min.css" rel="stylesheet">
    <link href="/prq/include/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/prq/include/css/animate.css" rel="stylesheet">
    <link href="/prq/include/css/style.css" rel="stylesheet">

</head>

<body class="gray-bg">
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'auth_login');
echo form_open('/auth/login', $attributes);
?>
    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">PRQ</h1>

            </div>
            <h3>Welcome to PRQ</h3>
            <p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
            </p>
            <p>로그인. 시도 해 주세요..</p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <!-- <input type="email" class="form-control" placeholder="Username" required=""> -->
					<input type="text" class="input-xlarge form-control" id="input01" name="username" value="<?php echo set_value('username'); ?>">
                </div>
                <div class="form-group">
                    <!-- <input type="password" class="form-control" placeholder="Password" required=""> -->
					<input type="password" class="input-xlarge form-control" id="input02" name="password" value="<?php echo set_value('password'); ?>">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">로그인</button>
				
				<div style="clear:both;"></div>
				
				<div style="">
					<ul style="padding:0px;margin:0px;list-style:none;">
						<li style="float:left;width:45%;">
							<!-- <button class="btn" onclick="document.location.reload()">취소</button><br> -->
							<!-- <a href="#"> --><small>비밀번호를 분실 하셨나요?</small><!-- </a> -->
							<div style="border:1px solid #e7eaec;width:130px;background:#fff;margin-top:10px;padding:5px;">PW찾기</div>
						</li>
						<li style="float:right;width:45%;">
							<p class="text-muted text-center"><small><!-- Do not have an account? -->방문을 환영합니다.</small></p>
							<!-- <a class="btn btn-sm btn-white btn-block" href="register.html" style="width:130px;"> --><div style="border:1px solid #e7eaec;width:130px;background:#fff;margin-top:10px;padding:5px;">가입 하기</div><!-- </a> -->
						</li>
						<li style="clear:both;"></li>
					</ul>
					<!-- <button type="submit" class="btn btn-primary">확인</button> -->
				</div>
			</form>
			<!-- <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
			</div> -->
			
			<div>
				<div style="font-weight:bold;font-size:19px;margin:35px 0 10px 0;">PRQ 프로그램</div>
				<ul style="padding:0px;margin:0px;list-style:none;">
					<li style="float:left;width:30%;">
						<a href="http://prq.co.kr/prq/uploads/files/Setup.zip" target="_blank"><img src="/prq/img/login_icon1.png" width="100%"></a>
					</li>
					<li style="float:left;width:30%;margin-left:15px;">
						<!-- <a href="javascript:alert('준비중입니다.');" target="_blank"> -->
						<a href="/prq/down/KTProQ.zip" target="_blank"><img src="/prq/img/login_icon2.png" width="100%"></a>
					</li>
					<li style="float:right;width:30%;">
						<a href="javascript:alert('준비중입니다.');" target="_blank"><img src="/prq/img/login_icon3.png" width="100%"></a>
					</li>
					<li style="clear:both;"></li>
				</ul>
				<div style="clear:both;height:15px;"></div>
				<a href="/prq/down/TeamViewer_Setup_ko-rjl.exe" target="_blank">
				<div style="background:#828282;color:#fff;padding:10px;">
					본사 원격지원 설치하기
				</div>
				</a>
			</div>

			<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

	<div style="clear:both;"></div>
				
	


<!-- 내가<div style="position:absolute; top:30px; right:0; z-index: 1;"><img src="/prq/include/img/down_link.png" title="설치가이드버튼" usemap="#Map">
      <map name="Map">
 		  <area shape="rect" coords="54,58,250,97" href="http://prq.co.kr/prq/uploads/files/PRQ_CID.zip" target="_blank"> -->
 		            <!-- <area shape="rect" coords="54,113,250,150" href="http://lomc.co.kr/download/naverdaum/file/naver.html" target="_blank"> -->
					<!--내가 <area shape="rect" coords="54,113,250,150" href="javascript:alert('준비중입니다.');" target="_blank"> -->
		            <!-- <area shape="rect" coords="54,176,250,214" href="http://lomc.co.kr/download/naverdaum/file/daum_20150506.pdf" target="_blank"> -->
		            <!--내가 <area shape="rect" coords="54,176,250,214" href="javascript:alert('준비중입니다.');" target="_blank">
		            <area shape="rect" coords="54,290,250,330" href="http://download.teamviewer.com/download/TeamViewerQS_ko.exe" target="_blank"> -->
<!--		            <area shape="rect" coords="106,327,251,356" href="http://lomc.co.kr/guide/delishop_m_guide.mp4" target="_blank">
		            <area shape="rect" coords="106,293,250,323" href="http://lomc.co.kr/download/delishop/delishop_manual_20150706.pdf" target="_blank">
		            <area shape="rect" coords="107,205,249,235" href="http://lomc.co.kr/guide/delim_m_guide.mp4" target="_blank">
		            <area shape="rect" coords="107,172,251,204" href="http://lomc.co.kr/download/delimessage/file/delimessage_manual_20150623.pdf" target="_blank">
		            <area shape="rect" coords="106,84,251,112" href="http://lomc.co.kr/download/delimessage/file/nelonlinepatch.exe_131107.zip">
		            <area shape="rect" coords="107,50,251,78" href="#delimessage_setup_content" class="delimessage_setup_pop"> -->
      <!-- </map>
    </div> -->
    <!-- Mainly scripts -->
    <script src="/prq/include/js/jquery-2.1.1.js"></script>
    <script src="/prq/include/js/bootstrap.min.js"></script>

</body>

</html>