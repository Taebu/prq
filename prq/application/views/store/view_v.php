            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>상점 등록</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>상점 관리</a>
                        </li>
                        <li class="active">
                            <strong>상점 수정</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
		<?php 
			$attributes = array(
				'class' => 'form-horizontal', 
				'id' => 'write_action'
			);
			echo form_open('stoer/write/prq_store', $attributes);
		?>
		<!-- id="my-awesome-dropzone" class="" -->
		<input type="hidden" name="is_join" id="is_join" value="">
		<input type="hidden" name="mb_business_paper" id="mb_business_paper">
		<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper">
		<input type="hidden" name="mb_bank_paper" id="mb_bank_paper">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>상점 정보 입니다. <small>상점의 정보 및 계약서를 작성해 주세요.</small></h5>
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
                                
								<div class="form-group"><label class="col-sm-2 control-label">아이디</label>
                                    <div class="col-sm-10">
									<?php echo $views->prq_fcode;?>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

                                <div class="form-group"><label class="col-sm-2 control-label">이메일</label>
                                    <div class="col-sm-10"><?php echo $views->st_email;?><span class="help-block m-b-none">이메일을 기입해주세요.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">상점명</label>
                                    <div class="col-sm-10"><?php echo $views->st_name;?><span class="help-block m-b-none">상점명 입니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">상단메세지</label>
                                    <div class="col-sm-10"><?php echo $views->st_top_msg;?><span class="help-block m-b-none">MMS 상단에 들어갈 메세지입니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">중단메세지</label>
                                    <div class="col-sm-10"><?php echo nl2br($views->st_middle_msg);?><span class="help-block m-b-none">MMS 중간에 들어갈 메세지 입니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">하단메세지</label>
                                    <div class="col-sm-10"><?php echo $views->st_bottom_msg;?><span class="help-block m-b-none">MMS 하단에 들어갈 메세지 입니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
							</div><!-- .col-md-6 Left Menu-->

							<div class="col-md-6">
								<div class="form-group"><label class="col-sm-2 control-label">계약서</label>
                                    <div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
									<img src="/prq/uploads/ST/<?php echo $views->st_business_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100"><span class="help-block m-b-none">계약서 이미지 입니다.</span>
									<!-- <input type="file" class="form-control" name="st_hp"> --> 
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">썸네일</label>
                                    <div class="col-sm-10">
									<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
									<img src="/prq/uploads/TH/<?php echo $views->st_thumb_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100"><span class="help-block m-b-none">썸네일 이미지 입니다. MMS 전송시 이 이미지가 전송 됩니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">메뉴</label>
                                    <div class="col-sm-10">
									<div id="my-awesome-dropzone3" class="dropzone">
									<div class="dz-default dz-message"></div>
									</div><!-- #my-awesome-dropzone3 -->
									<img src="/prq/uploads/ME/<?php echo $views->st_menu_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100"><span class="help-block m-b-none">메뉴 이미지 입니다.</span></div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


								<div class="form-group"><label class="col-sm-2 control-label">대표</label>
                                    <div class="col-sm-10">
									<div id="my-awesome-dropzone4" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone4 -->
									<img src="/prq/uploads/MA/<?php echo $views->st_main_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100"><span class="help-block m-b-none">대표 이미지 입니다.</span></div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div>

<div class="row">
<div class="form-group"><label class="col-sm-2 control-label">CID Type</label>
<div class="col-sm-10"><?php echo $views->st_cidtype;?> <span class="help-block m-b-none">CID Type</span>
</div><!-- .col-sm-8 -->
</div><!-- .row -->


<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">매장 번호 1</label>
<div class="col-sm-8"><?php echo $views->st_tel_1;?> <span class="help-block m-b-none">상점 번호를 등록 합니다. 예) 031-706-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">핸드폰 번호 1</label>
<div class="col-sm-8"><?php echo $views->st_hp_1;?> <span class="help-block m-b-none">연동할 핸드폰 번호를 등록 합니다. 예) 010-####-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->


<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">매장 번호 2</label>
<div class="col-sm-8"><?php echo $views->st_tel_2;?> <span class="help-block m-b-none">상점 번호를 등록 합니다. 예) 031-706-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">핸드폰 번호 2</label>
<div class="col-sm-8"><?php echo $views->st_hp_2;?> <span class="help-block m-b-none">연동할 핸드폰 번호를 등록 합니다. 예) 010-####-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->

<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">매장 번호 3</label>
<div class="col-sm-8"><?php echo $views->st_tel_3;?> <span class="help-block m-b-none">상점 번호를 등록 합니다. 예) 031-706-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">핸드폰 번호 3</label>
<div class="col-sm-8"><?php echo $views->st_hp_3;?> <span class="help-block m-b-none">연동할 핸드폰 번호를 등록 합니다. 예) 010-####-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->

<div class="row">
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">매장 번호 4</label>
<div class="col-sm-8"><?php echo $views->st_tel_4;?> <span class="help-block m-b-none">상점 번호를 등록 합니다. 예) 031-706-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Left Menu-->
<div class="col-md-6">
<div class="form-group"><label class="col-sm-4 control-label">핸드폰 번호 4</label>
<div class="col-sm-8"><?php echo $views->st_hp_4;?> <span class="help-block m-b-none">연동할 핸드폰 번호를 등록 합니다. 예) 010-####-####</span>
</div><!-- .col-sm-8 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div><!-- .col-md-6 Right Menu-->
</div><!-- .row -->

<div>
			  <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
		      </div>

								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
<a href="/prq/store/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a> <a href="/prq/store/modify/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a> <a href="/prq/store/delete/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a> <a href="/prq/store/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a>
                                    </div>
                                </div>
				<!-- 						      <div class="form-actions">
										      		        <button type="submit" class="btn btn-primary" id="write_btn">작성</button>
										      		        <button class="btn" onclick="document.location.reload()">취소</button>
										      		      </div> -->

								<!-- .form-group -->

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
		if($("#is_join").val()=="TRUE"){
			$("#form_data").html(param);
			//	$("#write_action").submit();
			set_member();
		}

		if($("#is_join").val()=="FALSE"){
			$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
		}
	}

window.onload = function() {



/*End Dropzone*/	

var focus=0,blur=0;
		$( "#mb_id" ).focusout(function() {
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

function set_store(){
	var param=$("#write_action").serialize();

    $.ajax({
		url:"/prq/store/write/prq_store",
		type: "POST",
        data:param,
        cache: false,
        async: false,
        success: function(data) {
            console.log(data);
        }
    });		

}
</script>