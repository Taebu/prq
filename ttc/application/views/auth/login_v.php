<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>톡톡클릭 | Login</title>
    <link href="/prq/include/css/bootstrap.min.css" rel="stylesheet">
		<link href="/prq/include/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/prq/include/css/animate.css" rel="stylesheet">
    <link href="/prq/include/css/style.css" rel="stylesheet">
		<link href="/prq/include/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
		
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
                <img src="/ttc/img/talktalkclickpc_logo_20181214.png" width="60%">
            </div>
            <h3>톡톡클릭 방문을 환영합니다!</h3>
						<p>Perfectly designed and precisely prepared admin theme with over 50 pages with extra new web app views.</p>
						<p>Continually expanded and constantly improved Inspinia Admin Them (IN+)</p>
            <p>로그인을 해주세요..</p>
						<p class="help-block"><?php echo validation_errors(); ?></p>
            <form class="m-t" role="form" action="index.html">
                <div class="form-group">
                    <!-- <input type="email" class="form-control" placeholder="Username" required=""> -->
					<input type="text" class="input-xlarge form-control" id="input01" name="userid" value="<?php echo set_value('username')?set_value('username'):"0319435849@naver.com"; ?>">
                </div>
                <div class="form-group">
                    <!-- <input type="password" class="form-control" placeholder="Password" required=""> -->
					<input type="password" class="input-xlarge form-control" id="input02" name="password" value="<?php echo set_value('password')?set_value('password'):"5849"; ?>">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">로그인</button>
				
				<div style="clear:both;"></div>
<?php
$is_autologin=$this->input->cookie('autologin_YN', TRUE)=="Y";
echo "cookie id : ";
echo @$this->input->cookie('userid',TRUE);
echo "<br>";
echo "cookie pw : ";
echo @$this->input->cookie('password',TRUE);
echo "<br>";
echo "session email : ";
echo @$this->session->userdata['email'];
echo "<br>";
echo "session mb_name : ";
echo @$this->session->userdata['mb_name'];
echo "<br>";
echo "logged_in : ";
echo @$this->session->userdata['logged_in'];
echo "<br>";
?>
<div class="checkbox checkbox-primary">
<input id="autologin_YN"  name="autologin_YN" type="checkbox" <?php echo $is_autologin?"checked":"";?> value="Y"><label for="autologin_YN">자동 로그인</label></div><!-- checkbox-primary -->
			</form>

			<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>
	<div style="clear:both;"></div>
    <!-- Mainly scripts -->
    <script src="/prq/include/js/jquery-2.1.1.js"></script>
    <script src="/prq/include/js/bootstrap.min.js"></script>
	<div style="height:80px;"></div>
	</div>
</body>
</html>