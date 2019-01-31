<!DOCTYPE html>
<html>
<head>
<meta property="og:image" content="http://prq.co.kr/prq/img/new/meta_logo.png" />
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>톡톡클릭 | Dashboard</title>
<script src="/prq/include/js/jquery-2.1.1.js"></script>
<link href="/prq/include/css/bootstrap.min.css" rel="stylesheet">
<link href="/prq/include/font-awesome/css/font-awesome.css" rel="stylesheet">
<!-- Toastr style -->
<link href="/prq/include/css/plugins/toastr/toastr.min.css" rel="stylesheet">
<!-- Gritter -->
<link href="/prq/include/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
<link href="/prq/include/css/animate.css" rel="stylesheet">
<link href="/prq/include/css/style.css" rel="stylesheet">
<!-- Sweet Alert -->
<link href="/prq/include/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
<!-- Sweet Alert2 -->
<link rel="stylesheet" href="https://npmcdn.com/sweetalert2@4.0.15/dist/sweetalert2.min.css">
<link href="/prq/include/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

 <!-- Date picker -->
<link href="/prq/include/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<script src="/prq/include/js/plugins/datapicker/bootstrap-datepicker.js"></script>


<script type="text/javascript">
console.log("header_v5_v.php");
var application="<?php echo $this->uri->segment(1);?>";
var method="<?php echo $this->uri->segment(2);?>";
	var pdata={application:application,method:method};
	console.log(pdata);
function set_menu_write(id)
{
//	var chk_code=$("#mb_code").val();
	$("#mb_code").val(id);
	switch (id)
	{
	case "DS":
	$(".mb_gname").html("총판");
	$('#bd_search').attr('action', "/prq/board/lists/prq_member/page/1");
	$("#bd_search").submit();
	break;
	case "PT":
	$(".mb_gname").html("대리점");
	$('#bd_search').attr('action', "/prq/board/lists/prq_member/page/1");
	$("#bd_search").submit();
	break;
	case "FR":
	$(".mb_gname").html("가맹점");
	$('#bd_search').attr('action', "/prq/board/lists/prq_member/page/1");
	$("#bd_search").submit();
	break;
	case "ST":
	$(".mb_gname").html("상점");
	$('#bd_search').attr('action', "/prq/board/lists/prq_store/page/1");
	$("#bd_search").submit();
	break;
	}
	
}
</script>
</head>
<body class="skin-3">
    <div id="wrapper">
<input type="hidden" name="logged_in" id="logged_in" value="<?php echo $this->input->cookie('logged_in', TRUE);?>">
<?php
$mb_gcode=@$this->input->cookie('mb_gcode',TRUE);
$prq_fcode=@$this->input->cookie('prq_fcode',TRUE);

/* START 가맹점 인 경우 */
if($mb_gcode=='G5'){
//echo $prq_fcode;
?>
<nav class="navbar-default navbar-static-side" role="navigation">
<div class="sidebar-collapse">
<ul class="nav metismenu" id="side-menu">
<li class="nav-header">
<div class="dropdown profile-element"> <span>
<?php
	/*

    [session] => CI_Session Object
        (
            [userdata] => Array
                (
                    [__ci_last_regenerate] => 1545376154
                    [username] => 
                    [name] => 0319435849
                    [mb_name] => 
                    [email] => 0319435849@naver.com
                    [mb_gcode] => G5
                    [prq_fcode] => DS0001PT0037FR0060
                    [mb_code] => TS0000
                    [logged_in] => 1
                )

            [_driver:protected] => files
*/
echo @$this->session->userdata['email'];
echo @$this->session->userdata['mb_name'];
echo @$this->session->userdata['logged_in'];
echo "<br>";
echo "autologin_YN : ";
echo @$this->input->cookie('autologin_YN', TRUE);;
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
<li><a href="/ttc/auth/logout">Logout</a></li>
<?php }else{?>
<li><a href="/ttc/auth/">LogIn</a></li>
<?php }?>

</ul>
</div>
<div class="logo-element">
TTC

</div>
</li>
<?php echo $this->uri->segment(1)=="franchise"?'<li class="active">':'<li>';?>
<a href="#"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">가맹점 관리</span> <span class="fa arrow"></span></a>
	<ul class="nav nav-second-level">
			<li class="active"><a href="/prq/franchise/lists/prq_member/page/1">가맹점 목록ㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇㅇ <span class="label label-primary pull-right">NEW</span></a></li>
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
}/*if($mb_gcode=='G5'){...}*/
/* END 가맹점 인 경우 */
?>


        <div id="page-wrapper" class="gray-bg">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" class="navbar-form-custom" action="">
                <div class="form-group">
                    <input type="text" placeholder="Search for something..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>
            <ul class="nav navbar-top-links navbar-right">
                <li>
                    <!-- <span class="m-r-sm text-muted welcome-message">Welcome to INSPINIA+ Admin Theme.</span> -->
                    <span class="m-r-sm text-muted welcome-message">PRQ 본사 관리자 1.0</span>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope"></i>  <span class="label label-warning">16</span>
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
                        <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
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
                    <a href="/ttc/auth/logout">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
						<?php }else{?>
                    <a href="/ttc/auth/">
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
<?php
/**
* 상점 리스트 뷰 페이지
* file : /prq/application/views/store/list_v.php
* 작성 : 2018-12-14 (금) 16:06:31 
* 수정 : 
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/

?>
<style type="text/css">
table tr.green:nth-child(2n+1){
	background-color: #aed994;
}
table tr.green:nth-child(2n){
	background-color: #4ad994;
}
</style>

<script type="text/javascript">


		/* onload */
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
//					var act = '/prq/store/lists/ci_board/q/'+$("#q").val()+'/page/1';
					var act = '/prq/store/lists/prq_store/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});

			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/store/lists/prq_store/q/'+$("#gc_receiver").val()+'/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});

			/*버튼 비활성화.*/
			chk_btn_status();
			for(var i in tt_nos){
				//console.log(tt_nos[i]);
				$("#ttno_"+tt_nos[i]).html('<i class="fa fa-refresh  text-success"></i>');
			}


			  $("ul.pagination a").click(function() {
				var kk=$(this).attr('href').split("/");

				var search_key=6;
				if(kk.length == 7){
				search_form(kk[6],'page');
				}else{
				search_form(kk[8],'search');
				}
				

				return false;
			  });  
		
		});

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/store/write/prq_store/page/1");
          $("#bd_search").submit();		
		
		}

		/*ocid를 검색합니다.*/
		function search_form(p,type){
			$("#page").val(p);
			if(type=="search"){
			var act = '/prq/store/lists/prq_store/q/'+$("#gc_receiver").val()+'/page/'+p;
			}else{
			var act = '/prq/store/lists/prq_store/page/'+p;
			}
			$("#bd_search").attr('action', act).submit();
		}
		/* 리스트 상태를 변경, 로그를 기록 합니다. */
		function chg_list(code){
			var param=$("#write_action").serialize();

			if(param=="")
			{
				alert("하나 이상 선택 하셔야 합니다.");
				return;
			}
			
			/* sweet alert */
			swal_status(code);

			//alert(code+" : "+param);
		}
		
		/* 리스트 상태를 변경, 로그를 기록 합니다. */
		function swal_status(code)
		{
			swal({
				title: "정말 변경 하시겠습니까?",
				text: "해당 리스트를 \""+get_status(code)+"\"(으)로 변경 됩니다.<br> 진행 하시겠습니까?<br>변경 사유를 작성해 주세요.",
				html:true,
				type: "input",
				showCancelButton: true,
				closeOnConfirm: false,
				cancelOnConfirm: false,
				confirmButtonText: "네, 변경할래요!",
				cancelButtonText: "아니요, 취소할래요!",
				animation: "slide-from-top",
				showLoaderOnConfirm: true,
				allowEscapeKey:true,
				inputPlaceholder: "변경 사유는 로그에 기록 됩니다." }, function(inputValue){
				//if (inputValue === false) return false;
				if(!inputValue){
					swal("취소!", "취소 하였습니다.", "error");
					return false;
				}

				if ( $.trim(inputValue).length<3) {
				  swal.showInputError("3자이상 사유를 적어 주세요. 공백은 인정하지 않습니다.");
				  return false
				}

				var param=$("#write_action").serialize();
				param=param+"&mb_status="+code;
				/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
				param=param+"&mb_reason="+inputValue;
				console.log(param);
				$.ajax({
				url:"/prq/ajax/chg_status/prq_store",
					data:param,
					dataType:"json",
					type:"POST",
					success:function(data){
						if(data.success){
							//alert("변경에 성공하였습니다.");
							swal("변경!", "변경에 성공하였습니다.. 변경 사유 : "+inputValue, "success");
							$.each(data.posts,function(key,val){
								$("#status_"+val.mb_no).html(val.mb_status);
							});
						}
						console.log(data);
						console.log(data=="9000");
						if(data=="9000"){
							//swal("로그인!", "로그인 되지 않았습니다. 로그인 하시겠습니까?", "error");
							swal({   
								title: "로그인!",
								text: "로그인 되지 않았습니다. 로그인 하시겠습니까?",
								type: "warning",
								showCancelButton: true,
								closeOnConfirm: false,
								animation: "slide-from-top"
							}, 
							function(inputValue)
							{
								/*취소를 눌렀을 때*/
								if (inputValue === false) return false;

								swal("Nice!", "2초 뒤 로그인 페이지로 이동 합니다. ", "success");
								
								setTimeout(function(){console.log('setTimeout');$(location).attr('href', "/ttc/auth/");}, 2000);
								;
							});	
						}
					}
				});

				});
		}

		function chk_btn_status(){
			var param=$("#write_action").serialize();
			
			if(param.indexOf("chk_seq")<0)
			{
				$(".btn_area [class*='btn-']").addClass("disabled").prop('disabled', true); 
			}else{
				$(".btn_area [class*='btn-']").removeClass("disabled").prop('disabled', false); 
			}
		}

		function get_status(code)
		{
			var object=[];
			object['wa']='대기';
			object['pr']='처리중';
			object['ac']='완료';
			//object['ad']='승인거부';
			object['ad']='네이버신규등록';
			object['ec']='네이버권한신청';
			object['ca']='설치실패';
			object['fr']='무료';
			object['tm']='해지';
			return object[code];
		}

		

	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>
		<div class="container-fluid">
 <div class='row'>
 <div id="sync_date">#sync_date</div><!-- #sync_date -->
	<div class='col-sm-12 right'>
            <div class='form-group'><button type="button" class="btn btn-primary" onclick="javascript:stop_sync()">동기화 중지</button> <button type="button" class="btn btn-primary" onclick="javascript:restart_sync()">동기화 재개</button> </div>
        </div>
<?php echo form_open('/prq/store/lists/prq_store/', array('id'=>'bd_search', 'class'=>'well form-search'));?>
<!--form id="bd_search" method="post" class="well form-search" -->
<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="ST">
		<!-- id="my-awesome-dropzone" class="" -->
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><span class="mb_gname">상점</span>  리스트 정보 입니다. <small><span class="mb_gname">총판</span>의 정보 및 계약서를 작성해 주세요.</small></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div><!-- .ibox-title -->
                        <div class="ibox-content">
    <div class='row'>

				<div class='col-sm-12'>    
			<div class='form-group'>
                <label for="st_name">상점명</label>
                <input class="form-control" id="st_name" name="st_name" size="30" type="text"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-12 -->

				<div class='col-sm-12'>    
			<div class='form-group'>
                <label for="st_name">영업일</label>
<!--                 <input class="form-control" id="" name="tc_datetime" size="30" type="text"/> -->
<div class="form-group">
<div class="input-group date">
<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="tc_datetime" id="tc_datetime" value="<?php echo date("Y-m-d");?>">
</div>
</div>
						</div><!-- .form-group -->
        </div><!-- .col-sm-12 -->
				
<script>
	/* datepicker */
	$('.input-group.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			language: 'kr',
			format:'yyyy-mm-dd'
	});

</script>
				<div class='col-sm-12'>    
			<div class='form-group'>
                <label for="st_name">주소</label>
								<textarea class="form-control" name="st_middle_msg" id="st_middle_msg" rows="4" cols="50" onkeyup="textAreaAdjust(this)" placeholder="여기에 주소를 기입해 주세요." style="height: 70px;"><?php echo @$this->session->userdata['email'];?>의 맛과 서비스로 보답하겠습니다.</textarea>
            </div><!-- .form-group -->
        </div><!-- .col-sm-12 -->

				<div class='col-sm-12'>    
			<div class='form-group'>
                <label for="st_name">금액</label>
                <input class="form-control" id="st_name" name="st_name" size="30" type="text"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-12 -->

				<div class='col-sm-12'>    
			<div class='form-group'>
                <label for="st_name">전화번호</label>
                <input class="form-control" id="st_name" name="st_name" size="30" type="text"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-12 -->

				<div class='col-sm-12'>    
			<div class='form-group'>
                <label for="st_name">요청사항</label>
                <input class="form-control" id="st_name" name="st_name" size="30" type="text"/>
            </div><!-- .form-group -->
        </div><!-- .col-sm-12 -->

				<div class='col-sm-12'>    
				<label class="col-sm-2 control-label">결제방식</label>
<div class="form-group">
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="pay_type" id="pay_type_1" value='red'><label for="pay_type_1">선결제</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="pay_type" id="pay_type_2" value='blue'><label for="pay_type_2">카드</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="pay_type" id="pay_type_3" value='orange' checked><label for="pay_type_3">현금</label>
</div><!-- .radio .radio-info .radio-inline -->

</div><!-- .col-sm-12 -->
            </div><!-- .form-group -->
        </div><!-- .col-sm-12 -->

				<div class='col-sm-12'>    
				<label class="col-sm-2 control-label">조리시간</label>
<div class="form-group">
<div class="col-sm-10 ">
<div class="radio radio-info radio-inline">
<input type="radio" name="bt_cook_time" id="bt_cook_time_1" value='red' checked><label for="bt_cook_time_1">5분</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="bt_cook_time" id="bt_cook_time_2" value='blue'><label for="bt_cook_time_2">10분</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="bt_cook_time" id="bt_cook_time_3" value='orange'><label for="bt_cook_time_3">15분</label>
</div><!-- .radio .radio-info .radio-inline -->

<div class="radio radio-info radio-inline">
<input type="radio" name="bt_cook_time" id="bt_cook_time_4" value='green'><label for="bt_cook_time_4">20분</label>
</div><!-- .radio .radio-info .radio-inline -->
</div><!-- .col-sm-12 -->



    </div><!-- .row -->

    <div class='row'>
	<div class='col-sm-12 right'>
            <div class='form-group'>
						<!-- <button type="button" class="btn btn-primary" onclick="javascript:stop_sync()">동기화 중지</button> <button type="button" class="btn btn-primary" onclick="javascript:restart_sync()">동기화 재개</button> -->
						<button type="button" class="btn btn-primary" onclick="javascript:set_request('delivery')" >배달 요청</button> 
						<button type="button" class="btn btn-primary" onclick="javascript:set_request('void')">보류</button> 
						
						</div>
        </div>
    </div>
			</form><!-- #bd_search -->
</div>
	</div>
	</div><!-- .row -->

<div class='row'>
		<?php 
			$attributes = array(
				'class' => 'form-horizontal', 
				'id' => 'write_action',
				'name' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>


<div class="table-responsive">
<?php 
		$mb_pcode=$this->input->cookie('mb_pcode', TRUE);
		$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
		$mb_gcode=$this->input->cookie('mb_gcode', TRUE);
//echo $mb_pcode;echo $prq_fcode;echo $mb_gcode;
		?>
		<table cellspacing="0" cellpadding="0" class="table table-striped"><thead><tr>
<th>bt_no</th>
<th>전문유효성검사. 년도-월. 허용치 +-1, +-12</th>
<th>요청구분.</th>
<th>외부시스템 연계 키</th>
<th>mac address (kwjang. 9월21일추가)</th>
<th>가맹점Id</th>
<th>판매금액</th>
<th>결제방법코드</th>
<th>고객전화번호</th>
<th>배달 상품종류코드</th>
<th>가맹점 전달사항</th>
<th>지연시간. 분단위</th>
<th>라이더 배정후 조리시작 지연시간. 분단위</th>
<th>시/도</th>
<th>시/군/구</th>
<th>도로명 주소인지 여부</th>
<th>- </th>
<th>지번</th>
<th>도로명</th>
<th>건물번호</th>
<th>건물명</th>
<th>상세주소</th>
<th>위도</th>
<th>경도</th>
<th>배달번호</th>
<th>배달상태</th>
<th>입력일시</th>
<th>변경일시</th>
<th>취소일시</th>
</tr>
<tr>
<th>bt_no</th>
<th>bt_check</th>
<th>bt_method</th>
<th>bt_outersystemkey</th>
<th>bt_mac</th>
<th>bt_agencyid</th>
<th>bt_price</th>
<th>bt_approvaltype</th>
<th>bt_customerphone</th>
<th>bt_goodscode</th>
<th>bt_memo</th>
<th>bt_delay</th>
<th>bt_afterassigndelay</th>
<th>bt_city</th>
<th>bt_county</th>
<th>bt_roadaddressyn</th>
<th>bt_town</th>
<th>bt_jibun</th>
<th>bt_road</th>
<th>bt_buildingno</th>
<th>bt_buildingname</th>
<th>bt_detailaddr</th>
<th>bt_lat</th>
<th>bt_long</th>
<th>bt_bnum</th>
<th>bt_state</th>
<th>bt_print</th>
<th>bt_datetime</th>
<th>bt_modifydate</th>
<th>bt_canceldate</th>
</tr>
</thead>
<tbody>
<?php
foreach ($list as $lt)
{
	?>
<tr>
<td scope="row"><?php echo $lt->bt_no;?></td>
<td scope="row"><?php echo $lt->bt_check;?></td>
<td scope="row"><?php echo $lt->bt_method;?></td>
<td scope="row"><?php echo $lt->bt_outersystemkey;?></td>
<td scope="row"><?php echo $lt->bt_mac;?></td>
<td scope="row"><?php echo $lt->bt_agencyid;?></td>
<td scope="row"><?php echo $lt->bt_price;?></td>
<td scope="row"><?php echo $lt->bt_approvaltype;?></td>
<td scope="row"><?php echo $lt->bt_customerphone;?></td>
<td scope="row"><?php echo $lt->bt_goodscode;?></td>
<td scope="row"><?php echo $lt->bt_memo;?></td>
<td scope="row"><?php echo $lt->bt_delay;?></td>
<td scope="row"><?php echo $lt->bt_afterassigndelay;?></td>
<td scope="row"><?php echo $lt->bt_city;?></td>
<td scope="row"><?php echo $lt->bt_county;?></td>
<td scope="row"><?php echo $lt->bt_roadaddressyn;?></td>
<td scope="row"><?php echo $lt->bt_town;?></td>
<td scope="row"><?php echo $lt->bt_jibun;?></td>
<td scope="row"><?php echo $lt->bt_road;?></td>
<td scope="row"><?php echo $lt->bt_buildingno;?></td>
<td scope="row"><?php echo $lt->bt_buildingname;?></td>
<td scope="row"><?php echo $lt->bt_detailaddr;?></td>
<td scope="row"><?php echo $lt->bt_lat;?></td>
<td scope="row"><?php echo $lt->bt_long;?></td>
<td scope="row"><?php echo $lt->bt_bnum;?></td>
<td scope="row"><?php echo $lt->bt_state;?></td>
<td scope="row"><?php echo $lt->bt_print;?></td>
<td scope="row"><?php echo $lt->bt_datetime;?></td>
<td scope="row"><?php echo $lt->bt_modifydate;?></td>
<td scope="row"><?php echo $lt->bt_canceldate;?> </td>
</tr>
	<?php
}

if(!$list){
echo "<tr><td colspan=9 style='text-align:center'>로그 리스트가 존재 하지 않습니다.</td></tr>";
}
?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="5" style="text-align:center">
					<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
				</tr>
			</tfoot>
		</table>
</div><!-- .table-responsive -->

<?php 
if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"||$mb_gcode=="G4"){?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기 <?php echo $wa_cnt;?></button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중 <?php echo $pr_cnt;?></button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">완료 <?php echo $ac_cnt;?></button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">네이버신규등록 <?php echo $ad_cnt;?></button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">네이버권한신청 <?php echo $ec_cnt;?></button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">설치실패 <?php echo $ca_cnt;?></button>
<button type="button" class="btn btn-sm btn-free" onclick="chg_list('fr');">무료 <?php echo $fr_cnt;?></button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('tm');">해지 <?php echo $tm_cnt;?></button>
</div><!-- .btn_area -->
<?php }?>
</div>
</div>
</div>
<div class="row"><div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">쓰기</a></div></div>
</article>
<script>
swal("테스트");
</script>
<div class="footer">
            <div class="pull-right">
			Page rendered in <strong>{elapsed_time}</strong> seconds. {memory_usage}
                <!-- 10GB of <strong>250GB</strong> Free. -->
            </div>
            <div>
                <strong>Copyright</strong> ANPR Company &copy; 2014-2015
            </div>
        </div><!-- .footer -->
        </div>
        <div id="right-sidebar">
            <div class="sidebar-container">

                <ul class="nav nav-tabs navs-3">

                    <li class="active"><a data-toggle="tab" href="#tab-1">
                        Notes
                    </a></li>
                    <li><a data-toggle="tab" href="#tab-2">
                        Projects
                    </a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">
                        <i class="fa fa-gear"></i>
                    </a></li>
                </ul>

                <div class="tab-content">


                    <div id="tab-1" class="tab-pane active">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                            <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                        </div>

                        <div>

                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a1.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">

                                        There are many variations of passages of Lorem Ipsum available.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a2.jpg">
                                    </div>
                                    <div class="media-body">
                                        The point of using Lorem Ipsum is that it has a more-or-less normal.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a4.jpg">
                                    </div>

                                    <div class="media-body">
                                        Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a8.jpg">
                                    </div>
                                    <div class="media-body">

                                        All the Lorem Ipsum generators on the Internet tend to repeat.
                                        <br>
                                        <small class="text-muted">Today 4:21 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a7.jpg">
                                    </div>
                                    <div class="media-body">
                                        Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                        <br>
                                        <small class="text-muted">Yesterday 2:45 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a3.jpg">

                                        <div class="m-t-xs">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                        <br>
                                        <small class="text-muted">Yesterday 1:10 pm</small>
                                    </div>
                                </a>
                            </div>
                            <div class="sidebar-message">
                                <a href="#">
                                    <div class="pull-left text-center">
                                        <img alt="image" class="img-circle message-avatar" src="/prq/include/img/a4.jpg">
                                    </div>
                                    <div class="media-body">
                                        Uncover many web sites still in their infancy. Various versions have.
                                        <br>
                                        <small class="text-muted">Monday 8:37 pm</small>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div id="tab-2" class="tab-pane">

                        <div class="sidebar-title">
                            <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <ul class="sidebar-list">
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Business valuation</h4>
                                    It is a long established fact that a reader will be distracted.

                                    <div class="small">Completion with: 22%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                                    </div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Contract with Company </h4>
                                    Many desktop publishing packages and web page editors.

                                    <div class="small">Completion with: 48%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 48%;" class="progress-bar"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="small pull-right m-t-xs">9 hours ago</div>
                                    <h4>Meeting</h4>
                                    By the readable content of a page when looking at its layout.

                                    <div class="small">Completion with: 14%</div>
                                    <div class="progress progress-mini">
                                        <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="label label-primary pull-right">NEW</span>
                                    <h4>The generated</h4>
                                    <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                                    There are many variations of passages of Lorem Ipsum available.
                                    <div class="small">Completion with: 22%</div>
                                    <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                                </a>
                            </li>

                        </ul>

                    </div>

                    <div id="tab-3" class="tab-pane">

                        <div class="sidebar-title">
                            <h3><i class="fa fa-gears"></i> Settings</h3>
                            <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                        </div>

                        <div class="setings-item">
                    <span>
                        Show notifications
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                                    <label class="onoffswitch-label" for="example">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Disable Chat
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                                    <label class="onoffswitch-label" for="example2">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Enable history
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                                    <label class="onoffswitch-label" for="example3">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Show charts
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                                    <label class="onoffswitch-label" for="example4">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Offline users
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                                    <label class="onoffswitch-label" for="example5">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Global search
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                                    <label class="onoffswitch-label" for="example6">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="setings-item">
                    <span>
                        Update everyday
                    </span>
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                                    <label class="onoffswitch-label" for="example7">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar-content">
                            <h4>Settings</h4>
                            <div class="small">
                                I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                            </div>
                        </div>

                    </div>
                </div>

            </div>



        </div><!-- #right-sidebar -->
    </div><!-- #wrapper -->

    <!-- Mainly scripts -->

    <script src="/prq/include/js/bootstrap.min.js"></script>
    <script src="/prq/include/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="/prq/include/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="/prq/include/js/plugins/flot/jquery.flot.js"></script>
    <script src="/prq/include/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="/prq/include/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="/prq/include/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="/prq/include/js/plugins/flot/jquery.flot.pie.js"></script>
    <script src="/prq/include/js/plugins/flot/jquery.flot.symbol.js"></script>
    <script src="/prq/include/js/plugins/flot/jquery.flot.time.js"></script>

	<!-- Flot demo-->
	<?php if("chart"==$this->uri->segment(1)){?>
    <script src="/prq/include/js/demo/flot-demo.js"></script>
	<?php } ?>

    <!-- Custom and plugin javascript -->
    <script src="/prq/include/js/inspinia.js"></script>
    <script src="/prq/include/js/plugins/pace/pace.min.js"></script>



   <!-- Input Mask-->
    <script src="/prq/include/js/plugins/jasny/jasny-bootstrap.min.js"></script>


    <!-- Sparkline -->
    <script src="/prq/include/js/plugins/sparkline/jquery.sparkline.min.js"></script>


    <!-- Sweet alert -->
    <script src="/prq/include/js/plugins/sweetalert/sweetalert.min.js"></script>

		<!-- Sweet alert2 -->
    <!-- <script src="/prq/include/js/plugins/sweetalert2/sweetalert2.min.js"></script> -->
	
	<!-- Toastr script -->
    <script src="/prq/include/js/plugins/toastr/toastr.min.js"></script>
    <!-- Main script -->	
    <script src="/prq/include/js/main.js"></script>
    <script>
        $(document).ready(function() {

            var sparklineCharts = function(){
                $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline2").sparkline([32, 11, 25, 37, 41, 32, 34, 42], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1ab394',
                    fillColor: "transparent"
                });

                $("#sparkline3").sparkline([34, 22, 24, 41, 10, 18, 16,8], {
                    type: 'line',
                    width: '100%',
                    height: '50',
                    lineColor: '#1C84C6',
                    fillColor: "transparent"
                });
            };

            var sparkResize;

            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });

            sparklineCharts();




            var data1 = [
                [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,20],[11,10],[12,13],[13,4],[14,7],[15,8],[16,12]
            ];
            var data2 = [
                [0,0],[1,2],[2,7],[3,4],[4,11],[5,4],[6,2],[7,5],[8,11],[9,5],[10,4],[11,1],[12,5],[13,2],[14,5],[15,2],[16,0]
            ];
            $("#flot-dashboard5-chart").length && $.plot($("#flot-dashboard5-chart"), [
                        data1,  data2
                    ],
                    {
                        series: {
                            lines: {
                                show: false,
                                fill: true
                            },
                            splines: {
                                show: true,
                                tension: 0.4,
                                lineWidth: 1,
                                fill: 0.4
                            },
                            points: {
                                radius: 0,
                                show: true
                            },
                            shadowSize: 2
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,

                            borderWidth: 2,
                            color: 'transparent'
                        },
                        colors: ["#1ab394", "#1C84C6"],
                        xaxis:{
                        },
                        yaxis: {
                        },
                        tooltip: false
                    }
            );

        });

/* 로그인 여부 체크 */
if($("#logged_in").val()==""){
//	swal("로그인이 필요한 페이지 입니다.", "2초 뒤 로그인 페이지로 이동 합니다. ", "info");

//setTimeout(function(){console.log('setTimeout');$(location).attr('href', "/ttc/auth/login");}, 2000);

}
console.log("footer_v5_v.php");
var myInterval;
var sync_count = 0;
var date;
restart_sync();

function stop_sync()
{
	clearInterval(myInterval);
	$("#sync_date").html("동기화가 중지 되었습니다.");
}

function restart_sync()
{
	myInterval = setInterval(function () {
	sync_count++;
	date = new Date();
	console.log("sync_count : "+sync_count);
	$("#sync_date").html(" 동기화 중입니다. 동기화 시각: "+date);

	console.log(date);
	},2000);
}


/* Textarea to resize based on content length */
function textAreaAdjust(o) {
    o.style.height = "1px";
    o.style.height = (25+o.scrollHeight)+"px";
}

function set_request(mode)
{
	/*
결제 방식을 선택해주세요.
조리시간을 선택해주세요.
배달취소 완료
보류되었습니다.
접수오류
주소가 잘못되었습니다.
배달요청 완료
*/

	var is_delivery = mode=="delivery";
	var is_void = mode=="void";
	if(is_delivery)
	{
		swal("배달요청 완료!!!");
	}

	if(is_void)
	{
		swal("배달취소 완료!!!");
	}
	
}
</script>
</body>
</html>
