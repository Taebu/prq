<!-- 	<article id="board_area">
		<header>
			<h1></h1>
		</header>
	
		<form class="form-horizontal" method="post" action="" id="write_action">
		  <fieldset>
		    <legend>게시물 쓰기</legend>
		    <div class="control-group">
		      <label class="control-label" for="input01">제목</label>
		      <div class="controls">
		        <input type="text" class="input-xlarge" id="input01" name="subject" value="<?php echo set_value('subject'); ?>">
		        <p class="help-block">게시물의 제목을 써주세요.</p>
		      </div>
		      <label class="control-label" for="input02">내용</label>
		      <div class="controls">
		        <textarea class="input-xlarge" id="input02" name="contents" rows="5"><?php echo set_value('contents'); ?></textarea>
		        <p class="help-block">게시물의 내용을 써주세요.</p>
		      </div>
	
			  <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
		      </div>
	
		      <div class="form-actions">
		        <button type="submit" class="btn btn-primary" id="write_btn">작성</button>
		        <button class="btn" onclick="document.location.reload()">취소</button>
		      </div>
		    </div>
		  </fieldset>
	
	</article>
	 -->

	
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>총판 등록Basic Form</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>총판관리</a>
                        </li>
                        <li class="active">
                            <strong>총판 등록 Basic Form</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
		<?php $attributes = array('class' => 'form-horizontal', 'id' => 'write_action');echo form_open('board/write/ci_board', $attributes);?>
		<input type="hidden" name="is_join" id="is_join" value="">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>총판 등록 정보 입니다. <small>총판의 정보 및 계약서를 작성해 주세요.</small></h5>
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
						<div class="row">
							<div class="col-md-6">
							<!-- <form method="get" class="form-horizontal"> -->
                                
								<div class="form-group"><label class="col-sm-2 control-label">총판 아이디</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id"> <span class="help-block m-b-none" id="mb_id_assist">총판아이디를 등록 합니다. 중복 된 아이디를 등록할 수 없습니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

                                <div class="form-group"><label class="col-sm-2 control-label">이메일</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="mb_email" name="mb_email"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">주소1</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="mb_addr1" name="mb_addr1"> <span class="help-block m-b-none">시군구를 등록해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">주소2</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="mb_addr2" name="mb_addr2"> <span class="help-block m-b-none">동읍면리.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">주소3</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" id="mb_addr3" name="mb_addr3"> <span class="help-block m-b-none">상세주소</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">비밀번호</label>
                                    <div class="col-sm-10"><input type="password" class="form-control" name="password">
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
                                
								<div class="form-group"><label class="col-sm-2 control-label">비밀번호 확인</label>
                                    <div class="col-sm-10"><input type="password" class="form-control" name="password_2">
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">대표자 명</label>
                                    <div class="col-sm-10"><input type="text" class="form-control"> <span class="help-block m-b-none">대표자명을 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
                                
								<div class="form-group"><label class="col-sm-2 control-label">휴대폰 번호</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
                                
								<div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">사업자등록번호</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" data-mask="999-99-99999" placeholder="" name="mb_business_num" id="mb_business_num">
                                        <span class="help-block">999-99-99999</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">총판 정산비율</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_exactcaculation_ratio"> <span class="help-block m-b-none">정산 비율</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
							</div><!-- .col-md-6 Left Menu-->
							
							<div class="col-md-6">

								<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
                                    <div class="col-sm-10"><input type="file" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								<div class="form-group"><label class="col-sm-2 control-label">총판 계약서</label>
                                    <div class="col-sm-10"><input type="file" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								<div class="form-group"><label class="col-sm-2 control-label">통장 사본</label>
                                    <div class="col-sm-10"><input type="file" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


								<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


								<div class="form-group"><label class="col-sm-2 control-label">예금주</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


								<div class="form-group"><label class="col-sm-2 control-label">비고</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_hp"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="reset">취소</button>
                                        <button class="btn btn-primary" type="button" onclick="set_ds()">저장</button>
                                    </div>
                                </div><!-- .form-group -->
								<div class="row"><div class="col-md-12">
									<textarea id="form_data">#form_data</textarea><!-- #form_data -->
								</div></div>
							</div><!-- .col-md-6 Right Menu-->
							</div><!-- .row -->
						</div><!-- .ibox-content -->
                    </div><!-- .ibox float-e-margins -->
                </div><!-- .col-lg-12 -->
			</div><!-- .row -->
        </div><!-- .wrapper .wrapper-content .animated .fadeInRight -->
<script type="text/javascript">
	/*
	server에 총판을 등록 합니다.

	*/
	function set_ds(){
			var param=$("#write_action").serialize();
/*
is_join=TRUE&
mb_id=4645689986489564&
mb_email=45564&
mb_addr1=5656&
mb_addr2=564&
mb_addr3=56456&
password=4564&
password_2=564&
mb_hp=4564564&
mb_business_num=564-56-45645&
mb_exactcaculation_ratio=564564564564564&
mb_hp=564654564564&
mb_hp=564654564654&
mb_hp=564564564564&
mb_hp=6545645646
*/
			if($("#is_join").val()=="TRUE"){
			$("#form_data").html(param);
		}

		if($("#is_join").val()=="FALSE"){
			$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
		}
	}

window.onload = function() {
var focus=0,blur=0;
		$( "#mb_id" )
  .focusout(function() {
    focus++; 
		var object=[];

	if ($("#mb_id").val().length<4)
	{
		object.push("<span  class=\"text-danger\">");
		object.push("아이디 길이가 너무 적습니다. 4자 이상");
		$("#is_join").val("FALSE");
	}else if ($( "#mb_id" ).val()!="erm00")	{
		object.push("<span  class=\"text-success\">");
		object.push("\""+$( "#mb_id" ).val()+"\" 멋진 아이디네요.");
		$("#is_join").val("TRUE");
	}else{
		object.push("<span  class=\"text-danger\">");
		object.push("이미 사용중이거나 탈퇴한 아이디입니다.");	
		$("#is_join").val("FALSE");
	}
		object.push("</span>");
	$( "#mb_id_assist" ).html(object.join(""));
  })
  .blur(function() {
    blur++;
		var object=[];
	if ($("#mb_id").val().length<4)
	{
		object.push("<span  class=\"text-danger\">");
		object.push("아이디 길이가 너무 적습니다. 4자 이상");
		$("#is_join").val("FALSE");
	}else if ($( "#mb_id" ).val()!="erm00")
	{
		object.push("<span  class=\"text-success\">");
		object.push("\""+$( "#mb_id" ).val()+"\" 멋진 아이디네요.");
		$("#is_join").val("TRUE");
	}else{
		object.push("<span  class=\"text-danger\">");
		object.push("이미 사용중이거나 탈퇴한 아이디입니다.");	
		$("#is_join").val("FALSE");
	}
		object.push("</span>");

		if($("#is_join").val()=="TRUE"){
			$( "#mb_id_assist" ).html(object.join(""));		
		}

		if($("#is_join").val()=="FALSE"){
			$( "#mb_id_assist" ).html(object.join(""));		
		}
  });
};
</script>