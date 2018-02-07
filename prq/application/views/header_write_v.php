
<!DOCTYPE html>
<html>

<head>
	<meta property="og:image" content="http://prq.co.kr/prq/img/new/meta_logo.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>톡톡메시지 | 등록 메뉴</title>

    <link href="/prq/include/css/bootstrap.min.css" rel="stylesheet">
    <link href="/prq/include/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/iCheck/custom.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/chosen/chosen.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/cropper/cropper.min.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/switchery/switchery.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/nouslider/jquery.nouislider.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/ionRangeSlider/ion.rangeSlider.css" rel="stylesheet">
    <link href="/prq/include/css/plugins/ionRangeSlider/ion.rangeSlider.skinFlat.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/clockpicker/clockpicker.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">

    <link href="/prq/include/css/plugins/select2/select2.min.css" rel="stylesheet">

	<!-- Toastr style -->
    <link href="/prq/include/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <link href="/prq/include/css/animate.css" rel="stylesheet">
    <link href="/prq/include/css/style.css" rel="stylesheet">

    <!-- Sweet Alert -->
    <link href="/prq/include/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">

	<!-- form_file_upload.html dropzone-->
	<link href="/prq/include/css/plugins/dropzone/basic.css" rel="stylesheet">
    <link href="/prq/include/css/plugins/dropzone/dropzone.css" rel="stylesheet">

    <!-- signature pad -->
    <link href="/prq/include/css/plugins/signature_pad/signature-pad.css" rel="stylesheet">
<script type="text/javascript">

	var application="<?php echo $this->uri->segment(1);?>";
	var method="<?php echo $this->uri->segment(2);?>";
	var pdata={application:application,method:method};
	console.log("header_write_v.php");
	console.log(pdata);
</script>
</head>
<body class="skin-3">
    <div id="wrapper">
<input type="hidden" name="logged_in" id="logged_in" value="<?php echo $this->input->cookie('logged_in', TRUE);?>">
<?php
$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
$prq_fcode=@$this->input->cookie('prq_fcode',TRUE);
//echo $prq_fcode;
/* START 관리자 인 경우 */
if($mb_gcode=='G1'||$mb_gcode=='G2'){?>
		<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
					<?php
					if( @$this->session->userdata['logged_in'] == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{
						/* 로그인 된 화면 */
						?>
                            <!-- <img alt="image" class="img-circle" src="/prq/include/img/profile_small_mtb.jpg" /> -->
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small.jpg" /> 
							 </span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">
							<?php echo $this->input->cookie('mb_ceoname', TRUE);?> (<?php echo $this->input->cookie('name', TRUE);?>)
							</strong>
                             </span> <span class="text-muted text-xs block">
							 <?php echo $this->input->cookie('username', TRUE);?><b class="caret"></b></span> </span> </a>
						<?php }else{
						/* 로그아웃된 화면 */
						?>
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small_x.png" /> 
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Please Login </strong>
                             </span> <span class="text-muted text-xs block">anonymouse<b class="caret"></b></span> </span> </a>
						<?php }?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
					<?php
						if( @$this->session->userdata['logged_in'] == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{?><li><a href="/prq/auth/logout">Logout</a></li><?php }else{?><li><a href="/prq/auth/">LogIn</a></li><?php }?></ul>
                        </div>
                        <div class="logo-element">
                          톡톡
                        </div>
                    </li>
					<?php 
					$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
					echo $this->uri->segment(1)=="codes"?'<li class="active">':'<li>';
					 ?>
                        <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">코드 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
					<?php 
					if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"){
					echo $this->uri->segment(3)=="prq_dscode"?'<li class="active">':'<li>';
					?><a href="/prq/codes/lists/prq_dscode/page/1">총판 코드 목록</a></li>
                    <?php 
					 }/* 관리자 총판 구룹만 관리 하는 메뉴G1,G2 */
					
					echo $this->uri->segment(3)=="prq_ptcode"?'<li class="active">':'<li>';
					?><a href="/prq/codes/write/prq_ptcode/page/1">대리점 코드</a></li>
                           <?php if($this->uri->segment(3)=="prq_frcode"){
					echo '<li class="active">';
					 }else{
					echo '<li>';
					 }?><a href="/prq/codes/write/prq_frcode/page/1">가맹점 코드</a></li>
                        </ul>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="distributors"?'<li class="active">':'<li>';
					 ?>
                        <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">총판 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/distributors/lists/prq_member/page/1">총판 목록</a></li>
                        </ul>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="partner"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-th-large"></i> <span class="nav-label">대리점 관리</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php echo $this->uri->segment(3)=="prq_member"?'<li class="active">':'<li>';?><a href="/prq/partner/lists/prq_member/page/1">대리점 목록</a></li>
                        </ul>
                    </li>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="franchise"?'<li class="active">':'<li>';

					 ?>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">가맹점 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/franchise/lists/prq_member/page/1">가맹점 목록 </a></li>
                        </ul>
                    </li>
					<?php 
					echo $this->uri->segment(1)=="store"?'<li class="active">':'<li>';
					 ?>
                        <a href="#">
						<i class="fa fa-pie-chart"></i><span class="nav-label">상점</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php echo $this->uri->segment(3)=="prq_store"?'<li class="active">':'<li>';?><a href="/prq/store/lists/prq_store/page/1">상점 목록</a></li>
                            <?php echo $this->uri->segment(3)=="prq_ata_pay"?'<li class="active">':'<li>';?><a href="/prq/store/lists/prq_ata_pay/page/1">알림톡 입금 목록 </a></li>
                        </ul>
                    </li>
					<?php 
//					echo $this->uri->segment(1)=="blog"?'<li class="active">':'<li>';
					echo $this->uri->segment(1)=="blog"||$this->uri->segment(1)=="blogapi"?'<li class="active">':'<li>';
					 ?>
                        <a href="#">
						<i class="fa fa-pie-chart"></i><span class="nav-label">블로그</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php echo $this->uri->segment(1)=="blog"?'<li class="active">':'<li>';?><a href="/prq/blog/">리뷰 목록</a></li>
                            <?php echo $this->uri->segment(1)=="blogapi"?'<li class="active">':'<li>';?><a href="/prq/blogapi/">API 목록</a></li>
						</ul>
                    </li>
					<?php 
					echo $this->uri->segment(1)=="board"||$this->uri->segment(1)=="ata"?'<li class="active">':'<li>';
					 ?>
                        <a href="#">
						<i class="fa fa-desktop"></i><span class="nav-label">Notification</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php echo $this->uri->segment(1)=="board"?'<li class="active">':'<li>';?><a href="/prq/board/write/">GCM Send</a></li>
                            <?php echo $this->uri->segment(1)=="ata"?'<li class="active">':'<li>';?><a href="/prq/ata/write/">ATA Send</a></li>
                        </ul>
                    </li>
<!-- 					<?php 
					echo $this->uri->segment(1)=="call"?'<li class="active">':'<li>';
					 ?>
					                        <a href="#">
						<i class="fa fa-flask"></i><span class="nav-label">CALL</span><span class="fa arrow"></span></a>
					                        <ul class="nav nav-second-level collapse">
					                            <li><a href="/prq/call/lists/">CALL</a></li>
					                        </ul>
					                    </li> -->
					<?php echo $this->uri->segment(1)=="logs"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-files-o"></i><span class="nav-label">LOGS</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <?php echo $this->uri->segment(3)=="cid"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/cid">CID</a></li>
                            <?php echo $this->uri->segment(3)=="ocid"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/ocid">OCID</a></li>
                            <?php echo $this->uri->segment(3)=="gcm"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/gcm">GCM</a></li>
                            <?php echo $this->uri->segment(3)=="sms"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/sms">SMS</a></li>
							<?php echo $this->uri->segment(3)=="mms"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/mms">MMS</a></li>
                            <?php echo $this->uri->segment(3)=="act"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/act">ACT</a></li>
                            <?php echo $this->uri->segment(3)=="ata"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/ata">ATA</a></li>
                            <?php echo $this->uri->segment(3)=="first"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/first">FIRST<span class="label label-danger pull-right">사용안함</span></a></li>
                            <?php echo $this->uri->segment(3)=="vali"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/vali">VALI</a></li>
                            <?php echo $this->uri->segment(3)=="happy"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/happy">HAPPY<span class="label label-danger pull-right">사용안함</span></a></li>
                            <?php echo $this->uri->segment(3)=="post"?'<li class="active">':'<li>';?><a href="/prq/logs/lists/post">POST</a></li>
						</ul>
                    </li>
					<?php echo $this->uri->segment(1)=="appjoin"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-files-o"></i><span class="nav-label">Appjoin</span><span class="fa arrow"></span>
						</a>
                        <ul class="nav nav-second-level collapse">
                            <?php echo $this->uri->segment(3)=="modu_agreement"?'<li class="active">':'<li>';?><a href="/prq/appjoin/lists/modu_agreement">모두톡톡 계약서</a></li>
							</ul>
                    </li>
	<?php 
	$is_menu12=$this->uri->segment(1)=="biztalk"||$this->uri->segment(1)=="template";
	echo $is_menu12?'<li class="active">':'<li>';?>
	<a href="#"><i class="fa fa-bold"></i><span class="nav-label">biztalk </span><span class="fa arrow"></span></a>
	<ul class="nav nav-second-level collapse">
	<?php echo $this->uri->segment(3)=="plusfriend"?'<li class="active">':'<li>';?><a href="/prq/biztalk/lists/plusfriend">플러스친구 <span class="label label-primary pull-right">NEW</span></a></li>
	<?php 
	$is_match=$this->uri->segment(3)=="bt_template"||$this->uri->segment(3)=="template";
	echo $is_match?'<li class="active">':'<li>';?><a href="/prq/template/lists/template">템플릿관리 <span class="label label-primary pull-right">NEW</span></a></li>
	</ul>
	</li>
				
				</ul>
            </div>
        </nav>

<?php
}/*if($mb_gcode=='G1'||$mb_gcode=='G2'){...}*/
/* END 관리자 인 경우 */
?>

<?php
/* START 총판인 경우 */
if($mb_gcode=='G3'){
?>
		<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
					<?php
					if( @$this->session->userdata['logged_in'] == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{
						/* 로그인 된 화면 */
						?>
                            <!-- <img alt="image" class="img-circle" src="/prq/include/img/profile_small_mtb.jpg" /> -->
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small.jpg" /> 
							 </span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php //echo $this->session->userdata['name'];?>
							<?php echo $this->input->cookie('mb_ceoname', TRUE);?> (<?php echo $this->input->cookie('name', TRUE);?>)
							</strong>
                             </span> <span class="text-muted text-xs block">
							 <?php echo $this->input->cookie('username', TRUE);?><b class="caret"></b></span> </span> </a>
						<?php }else{
						/* 로그아웃된 화면 */
						?>
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small_x.png" /> 
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Please Login </strong>
                             </span> <span class="text-muted text-xs block">anonymouse<b class="caret"></b></span> </span> </a>
						<?php }?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
					<?php
						if( @$this->session->userdata['logged_in'] == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{?>
                                <li><a href="/prq/auth/logout">Logout</a></li>
								<?php }else{?>
								<li><a href="/prq/auth/">LogIn</a></li>
						<?php }?>

                            </ul>
                        </div>
                        <div class="logo-element">
                          톡톡
                        </div>
                    </li>
					<?php 
					$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
					if($this->uri->segment(1)=="codes"){
					echo '<li class="active">';
					 }else{
					echo '<li>';
					 }?>
                        <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">코드 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
					<?php 
					if($this->uri->segment(3)=="prq_ptcode"){
					echo '<li class="active">';
					 }else{
					echo '<li>';
					 }?><a href="/prq/codes/write/prq_ptcode/page/1">대리점 코드<span class="label label-primary pull-right">NEW</span></a></li>
                           <?php if($this->uri->segment(3)=="prq_frcode"){
					echo '<li class="active">';
					 }else{
					echo '<li>';
					 }?><a href="/prq/codes/write/prq_frcode/page/1">가맹점 코드<span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="distributors"?'<li class="active">':'<li>';
					 ?>
                        <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">총판 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/distributors/lists/prq_member/page/1">총판 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="partner"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-th-large"></i> <span class="nav-label">대리점 관리</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/prq/partner/lists/prq_member/page/1">대리점 목록</a></li>
                        </ul>
                    </li>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="franchise"?'<li class="active">':'<li>';
					 ?>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">가맹점 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/franchise/lists/prq_member/page/1">가맹점 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
					<?php 
					echo $this->uri->segment(1)=="store"?'<li class="active">':'<li>';
					 ?>
                        <a href="#">
						<i class="fa fa-pie-chart"></i><span class="nav-label">상점</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/prq/store/lists/prq_store/page/1">상점 목록</a></li>
                        </ul>
                    </li>
				</ul>
            </div>
        </nav>

<?php
}/*if($mb_gcode=='G3'){...}*/
/* END 총판인 경우 */
?>

<?php
/* START 대리점 인 경우 */
if($mb_gcode=='G4'){
?>
		<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
					<?php
					if( @$this->session->userdata['logged_in'] == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{
						/* 로그인 된 화면 */
						?>
                            <!-- <img alt="image" class="img-circle" src="/prq/include/img/profile_small_mtb.jpg" /> -->
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small.jpg" /> 
							 </span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php //echo $this->session->userdata['name'];?>
							<?php echo $this->input->cookie('mb_ceoname', TRUE);?> (<?php echo $this->input->cookie('name', TRUE);?>)
							</strong>
                             </span> <span class="text-muted text-xs block">
							 <?php echo $this->input->cookie('username', TRUE);?><b class="caret"></b></span> </span> </a>
						<?php }else{
						/* 로그아웃된 화면 */
						?>
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small_x.png" /> 
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Please Login </strong>
                             </span> <span class="text-muted text-xs block">anonymouse<b class="caret"></b></span> </span> </a>
						<?php }?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
					<?php
						if( @$this->session->userdata['logged_in'] == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{?>
                                <li><a href="/prq/auth/logout">Logout</a></li>
								<?php }else{?>
								<li><a href="/prq/auth/">LogIn</a></li>
						<?php }?>
                            </ul>
                        </div>
                        <div class="logo-element">
                          톡톡
                        </div>
                    </li>
					<?php 
					$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
					echo $this->uri->segment(1)=="codes"?'<li class="active">':'<li>';
					?>
                        <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">코드 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
					<?php 
					echo $this->uri->segment(3)=="prq_ptcode"?'<li class="active">':'<li>';
					?><!-- <a href="/prq/codes/write/prq_ptcode/page/1">대리점 코드<span class="label label-primary pull-right">NEW</span></a></li> -->
                           <?php 
					echo $this->uri->segment(3)=="prq_frcode"?'<li class="active">':'<li>';
					 ?><a href="/prq/codes/write/prq_frcode/page/1">가맹점 코드<span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
					<?php 
					 //echo $this->uri->segment(1)=="distributors"?'<li class="active">':'<li>';
					 ?>
                     <!--    <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">총판 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/distributors/lists/prq_member/page/1">총판 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                                            </li> -->
					<?php 
					 echo $this->uri->segment(1)=="partner"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-th-large"></i> <span class="nav-label">대리점 관리</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/prq/partner/lists/prq_member/page/1">대리점 목록</a></li>
                        </ul>
                    </li>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="franchise"?'<li class="active">':'<li>';
					 ?>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">가맹점 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/franchise/lists/prq_member/page/1">가맹점 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
					<?php 
					echo $this->uri->segment(1)=="store"?'<li class="active">':'<li>';
					 ?>
                        <a href="#">
						<i class="fa fa-pie-chart"></i><span class="nav-label">상점</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/prq/store/lists/prq_store/page/1">상점 목록</a></li>
                        </ul>
                    </li>
				</ul>
            </div>
        </nav>
<?php
}/*if($mb_gcode=='G4'){...}*/
/* END 대리점 인 경우 */
?>

<?php
/* START 가맹점 인 경우 */
if($mb_gcode=='G5'){
?>
		<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
					<?php
					if( @$this->session->userdata['logged_in'] == TRUE ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{
						/* 로그인 된 화면 */
						?>
                            <!-- <img alt="image" class="img-circle" src="/prq/include/img/profile_small_mtb.jpg" /> -->
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small.jpg" /> 
							 </span>
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php //echo $this->session->userdata['name'];?>
							<?php echo $this->input->cookie('mb_ceoname', TRUE);?> (<?php echo $this->input->cookie('name', TRUE);?>)
							</strong>
                             </span> <span class="text-muted text-xs block">
							 <?php echo $this->input->cookie('username', TRUE);?><b class="caret"></b></span> </span> </a>
						<?php }else{
						/* 로그아웃된 화면 */
						?>
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small_x.png" /> 
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
							<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Please Login </strong>
                             </span> <span class="text-muted text-xs block">anonymouse<b class="caret"></b></span> </span> </a>
						<?php }?>

                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
					<?php
						if( @$this->session->userdata['logged_in'] == TRUE  ||@$this->input->cookie('logged_in', TRUE) == TRUE)
					{?>
                                <li><a href="/prq/auth/logout">Logout</a></li>
								<?php }else{?>
								<li><a href="/prq/auth/">LogIn</a></li>
						<?php }?>

                            </ul>
                        </div>
                        <div class="logo-element">
                            PRQ
                        </div>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="distributors"?'<li class="active">':'<li>';?>
                        <a href="index.html"><i class="fa fa-diamond"></i> <span class="nav-label">총판 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/distributors/lists/prq_member/page/1">총판 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
    `                </li>
					<?php 
					 echo $this->uri->segment(1)=="partner"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-th-large"></i> <span class="nav-label">대리점 관리</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/prq/partner/lists/prq_member/page/1">대리점 목록</a></li>
                        </ul>
                    </li>
                    </li>
					<?php 
					 echo $this->uri->segment(1)=="franchise"?'<li class="active">':'<li>';?>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">가맹점 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/franchise/lists/prq_member/page/1">가맹점 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
					<?php 
					echo $this->uri->segment(1)=="store"?'<li class="active">':'<li>';?>
                        <a href="#">
						<i class="fa fa-pie-chart"></i><span class="nav-label">상점</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="/prq/store/lists/prq_store/page/1">상점 목록</a></li>
                        </ul>
                    </li>
				</ul>
            </div>
        </nav>

<?php
}/*if($mb_gcode=='G5'){...}*/
/* END 가맹점 인 경우 */
?>
        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="<?php echo $_SERVER['REQUEST_URI'];?>">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="q" id="q" value="<?php echo isset($_GET['q'])?$_GET['q']:"";?>">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <!-- <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span> -->
                    <span class="m-r-sm text-muted welcome-message">톡톡메시지 본사 관리자 1.0</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="/prq/include/img/a7.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">46h ago</small>
                                    <strong>Mike Loreipsum</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">3 days ago at 7:58 pm - 10.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="/prq/include/img/a4.jpg">
                                </a>
                                <div>
                                    <small class="pull-right text-navy">5h ago</small>
                                    <strong>Chris Johnatan Overtunk</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Yesterday 1:21 pm - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="dropdown-messages-box">
                                <a href="profile.html" class="pull-left">
                                    <img alt="image" class="img-circle" src="/prq/include/img/profile.jpg">
                                </a>
                                <div>
                                    <small class="pull-right">23h ago</small>
                                    <strong>Monica Smith</strong> love <strong>Kim Smith</strong>. <br>
                                    <small class="text-muted">2 days ago at 2:30 am - 11.06.2014</small>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="mailbox.html">
                                    <i class="fa fa-envelope"></i> <strong>Read All Messages</strong>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary">0</span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="mailbox.html">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="profile.html">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="grid_options.html">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="text-center link-block">
                                <a href="notifications.html">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
					<?php
						if( @$this->session->userdata['logged_in'] == TRUE   ||$this->input->cookie('logged_in', TRUE) == TRUE)
					{?>
                    <a href="/prq/auth/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
						<?php }else{?>
                    <a href="/prq/auth/">
                        <i class="fa fa-sign-in"></i> Log In
                    </a>
						<?php }?>
                </li>
                <li>
                    <a class="right-sidebar-toggle">
                        <i class="fa fa-tasks"></i>
                    </a>
                </li>
            </ul>

        </nav>
</div><!-- .row border-bottom -->
<!-- header_write_v.php -->