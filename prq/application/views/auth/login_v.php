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

                <!-- <h1 class="logo-name">PRQ</h1> -->
                <img src="/prq/img/logo.png" width="80%">

            </div>
            <h3>톡톡메시지 방문을 환영합니다!</h3>
            <!--p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.
                <Continually expanded and constantly improved Inspinia Admin Them (IN+)>
            </p-->
            <p>로그인을 해주세요..</p>
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
				
				
			</form>
			<!-- <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
			</div> -->
			
			<div>
				<div style="font-weight:bold;font-size:19px;margin:35px 0 10px 0;">※ TOKTOK MESSAGE 프로그램 ※</div>
				<ul style="padding:0px;margin:0px;list-style:none;">
					<li style="float:left;width:30%;">
						<a href="http://prq.co.kr/prq/uploads/files/PRQ_Serial.zip" target="_blank"><img src="/prq/img/login_icon1.png" width="100%"></a>
					</li>
					<li style="float:left;width:30%;margin-left:15px;">
						<!-- <a href="javascript:alert('준비중입니다.');" target="_blank"> -->
						<a href="/prq/uploads/files/KTProQ.zip" target="_blank"><img src="/prq/img/login_icon2.png" width="100%"></a>
					</li>
					<li style="float:right;width:30%;">
						<!-- <a href="javascript:alert('준비중입니다.');" target="_blank"><img src="/prq/img/login_icon3.png" width="100%"></a> -->
						<a href="/prq/uploads/files/PRQ_KT.zip" target="_blank"><img src="/prq/img/login_icon3.png" width="100%"></a>
					</li>
					<li style="clear:both;"></li>
				</ul>
				
				
				<div style="clear:both;height:15px;"></div>
				
				<a href="/prq/down/dotNetFx40_Full_x86_x64.exe" style="color:#fff;">
				<div style="background:#cecece;color:#000;padding:10px;font-weight:bold;border:1px solid #bbb;">
					닷넷프레임워크 DOWN
				</div>
				</a>
				<div style="clear:both;height:10px;"></div>
				<a href="/prq/down/sqlite-netFx40-setup-bundle-x86-2010-1.0.103.0.exe" style="color:#fff;">
				<div style="background:#cecece;color:#000;padding:10px;font-weight:bold;border:1px solid #bbb;">
					KT OK 전용 닷넷프레임워크 DOWN
				</div>
				</a>

				<div style="clear:both;height:15px;"></div>
								
				
				<div style="width:100%;">
					<ul style="list-style:none;padding:0;margin:0;">
						<!-- <a href="https://download.teamviewer.com/download/TeamViewerQS_ko-rjl.exe" target="_blank">
						<li style="float:left;width:49%;background:#3c3c3c;color:#fff;padding:10px;">
						본사 원격지원 설치
						</li>
						</a> -->
						<a href="http://939.co.kr/anpr" target="_blank">
						<li style="float:left;width:49%;background:#3c3c3c;color:#fff;padding:10px;">
						본사 원격지원 설치
						</li>
						</a>
						<a href="https://open.bizphone.co.kr/api_admin/cp/regist_check.jsp" onClick="window.open(this.href, '', 'width=400, height=430'); return false;">
						<li style="float:right;width:49%;background:#da2327;color:#fff;padding:10px;">
						KT 가입회선 확인
						</li>
						</a>
					</ul>
				</div>
			</div>
			<!-- <div style="width:100%;margin:30px;">
				<a href="">
				test
				</a>
			</div> -->
			<div style="clear:both;"></div>
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
    </div>
    <!-- Mainly scripts -->
    <script src="/prq/include/js/jquery-2.1.1.js"></script>
    <script src="/prq/include/js/bootstrap.min.js"></script>
	<div style="height:80px;"></div>
	<div style="width:140px;position:fixed;bottom:150px;right:0px;text-align:center;">
		<ul style="background:#ececec;list-style:none;margin:0;padding:0;font-size:15px;">
			<li style="background:#3c3c3c;color:#fff;padding:7px;">
				<img src="/prq/img/quick.png" width="10px"> &nbsp;Quick Menu
			</li>
			<li style="border:1px solid #bfbfbf;color:3c3c3c;padding:20px;font-weight:bold;">
				<a href="/prq/down/bdtoktok_proposal.pdf" target="pdf" style="color:3c3c3c;"><img src="/prq/img/bdtoktok.png" width="75px"><p style="margin-top:11px;line-height:16px;">배달톡톡<br>제안서</p></a>
			</li>
			<li style="border:1px solid #bfbfbf;color:#3c3c3c;padding:20px;font-weight:bold;">
				<a href="/prq/down/toktokmessage_proposal.pdf" target="pdf" style="color:#3c3c3c;"><img src="/prq/img/toktokms.png" width="50px"><p style="margin-top:11px;line-height:16px;">톡톡메시지<br>제안서</p></a>
			</li>
		</ul>
		<ul style="list-style:none;margin:0;padding:0;font-size:14px;">
			<li style="float:left;width:49.99%;background:#3c3c3c;color:#fff;padding:10px;border-bottom:1px solid #fff;border-right:1px solid #fff;">
				<a href="/prq/down/toktok_pcguide.pdf" target="pdf" style="color:#fff;"><img src="/prq/img/pc.png" width="40px"><p style="margin-top:11px;line-height:16px;"><b>PC</b><br>설치<br>가이드</p></a>
			</li>
			<li style="float:right;width:49.99%;background:#da2327;color:#fff;padding:10px;">
				<a href="/prq/down/KTok_guide.pdf" target="pdf" style="color:#fff;"><img src="/prq/img/pc_kt.png" width="40px"><p style="margin-top:11px;line-height:16px;"><b>KTok</b><br>설치<br>가이드</p></a>
			</li>
			<li style="clear:both;"></li>
		</ul>
		<div style="width:100%;text-align:center;font-weight:bold;background:#ececec;padding:8px 0 15px 0;">
			<a href="/prq/down/KTok_framework.php" style="color:#000;">
			KTok<br>닷넷프레임워크 설명
			</a>
		</div>
		<div style="width:100%;text-align:center;font-weight:bold;background:#ececec;padding:8px 0 15px 0;border-top:1px solid #bcbcbc;">
			<a href="https://open.bizphone.co.kr/cp/join1.jsp?cpkey=cb514c196a9f5885b62637f898716152cba04c7e" target="_blank" style="color:#000;">
			Web KT회선청약
			</a>
		</div>
	</div>
	
	
</body>

</html>