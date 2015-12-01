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
						        <button class="btn" onclick="document.location.reload()">취소</button>
                <a href="#"><small>비밀번호를 분실 하셨나요?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="register.html">가입 하기</a>
		        <!-- <button type="submit" class="btn btn-primary">확인</button> -->

			</form>
			  <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
		      </div>

			<p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="/prq/include/js/jquery-2.1.1.js"></script>
    <script src="/prq/include/js/bootstrap.min.js"></script>

</body>

</html>