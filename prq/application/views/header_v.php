<!DOCTYPE html>
<html>

<head>
	<meta property="og:image" content="http://prq.co.kr/prq/img/new/meta_logo.png" />
    <meta charset="utf-8">
	<meta property="og:image" content="http://prq.co.kr/prq/uploads/TH/<?php echo $views->st_thumb_paper;?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>PRQ | Dashboard</title>

    <link href="/prq/include/css/bootstrap.min.css" rel="stylesheet">
    <link href="/prq/include/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="/prq/include/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="/prq/include/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="/prq/include/css/animate.css" rel="stylesheet">
    <link href="/prq/include/css/style.css" rel="stylesheet">
<script type="text/javascript">
var application="<?php echo $this->uri->segment(1);?>";
var method="<?php echo $this->uri->segment(2);?>";

	var pdata={application:application,method:method};
	console.log(pdata);
</script>
</head>

<body class="skin-3">
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="/prq/include/img/profile_small.jpg" />
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
                             </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.html">Profile</a></li>
                                <li><a href="contacts.html">Contacts</a></li>
                                <li><a href="mailbox.html">Mailbox</a></li>
                                <li class="divider"></li>
													<?php
						if( @$this->session->userdata['logged_in'] == TRUE )
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
                    <li class="active">
                        <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">총판 관리</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li class="active"><a href="/prq/">총판 목록 <span class="label label-primary pull-right">NEW</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
<!-- header_v.php -->