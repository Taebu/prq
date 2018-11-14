			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>대리점 수정</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>대리점관리</a>
                        </li>
                        <li class="active">
                            <strong>대리점 수정</strong>
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
			echo form_open('partner/write/prq_member', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);

		?>
		<!-- id="my-awesome-dropzone" class="" -->
		<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="mb_business_paper" id="mb_business_paper" value="<?php echo $views->mb_business_paper;?>">
<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper" value="<?php echo $views->mb_distributors_paper;?>">
<input type="hidden" name="mb_bank_paper" id="mb_bank_paper" value="<?php echo $views->mb_bank_paper;?>">

<input type="hidden" name="mb_business_paper_size" id="mb_business_paper_size" value="<?php echo $views->mb_business_paper_size;?>">
<input type="hidden" name="mb_distributors_paper_size" id="mb_distributors_paper_size" value="<?php echo $views->mb_distributors_paper_size;?>">
<input type="hidden" name="mb_bank_paper_size" id="mb_bank_paper_size" value="<?php echo $views->mb_bank_paper_size;?>">
<input type="hidden" name="mb_imgprefix" id="mb_imgprefix" value="<?php echo $views->mb_imgprefix;?>">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>대리점 등록 정보 입니다. <small>대리점의 정보 및 계약서를 작성해 주세요.</small></h5>
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
                                <div class="form-group"><label class="col-sm-2 control-label">총판 부모 코드</label>
                                    <div class="col-sm-10"><?php echo $views->mb_pcode;?><span class="help-block m-b-none">총판 부모 코드.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">대리점 아이디</label>
                                    <div class="col-sm-10"><?php echo $views->mb_id;?></div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

                                <div class="form-group"><label class="col-sm-2 control-label">상호</label>
                                    <div class="col-sm-10"><?php echo $views->mb_name;?><span class="help-block m-b-none">상호입니다.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

                                <div class="form-group"><label class="col-sm-2 control-label">이메일</label>
                                    <div class="col-sm-10"><?php echo $views->mb_email;?><span class="help-block m-b-none">이메일을 기입해주세요.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">주소1</label>
                                    <div class="col-sm-10"><?php echo $views->mb_addr1;?> <span class="help-block m-b-none">시군구를 등록해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">주소2</label>
                                    <div class="col-sm-10"><?php echo $views->mb_addr2;?> <span class="help-block m-b-none">동읍면리.</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">주소3</label>
                                    <div class="col-sm-10"><?php echo $views->mb_addr3;?> <span class="help-block m-b-none">상세주소</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
								
								<div class="form-group"><label class="col-sm-2 control-label">대표자 명</label>
                                    <div class="col-sm-10"><?php echo $views->mb_ceoname;?> <span class="help-block m-b-none">대표자명을 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
                                
								<div class="form-group"><label class="col-sm-2 control-label">휴대폰 번호</label>
                                    <div class="col-sm-10"><?php echo $views->mb_hp;?> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
                                
								<div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">사업자등록번호</label>
                                    <div class="col-sm-10"><?php echo $views->mb_business_num;?>
                                        <span class="help-block">999-99-99999</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">대리점 정산비율</label>
                                    <div class="col-sm-10"><input type="text" class="form-control" name="mb_exactcaculation_ratio" value="<?php echo $views->mb_exactcaculation_ratio;?>"> <span class="help-block m-b-none">정산 비율</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->

							</div><!-- .col-md-6 Left Menu-->
							<div class="col-md-6">
								<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
                                    <div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
									<img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_business_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100">
									<!-- <input type="file" class="form-control" name="mb_hp"> --> 
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">대리점 계약서</label>
                                    <div class="col-sm-10">
									<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
									<img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_distributors_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100">
												<!-- <div id="my-awesome-dropzone2">my-awesome-dropzone2</div> -->
												<!-- <div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div> --><!-- #my-awesome-dropzone2 -->
									<!-- <input type="file" class="form-control" name="mb_hp"> --> 
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">통장 사본</label>
                                    <div class="col-sm-10">
									<div id="my-awesome-dropzone3" class="dropzone">

									<div class="dz-default dz-message"></div>
									</div><!-- #my-awesome-dropzone3 -->
									<img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_bank_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100">
									<!-- <div id="my-awesome-dropzone3">my-awesome-dropzone3</div> --><!-- #my-awesome-dropzone3 -->
  
									<!-- <input type="file" class="form-control" name="mb_hp"> --> 
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
                                    <div class="col-sm-10"><?php echo $views->mb_bankname;?></div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
                                    <div class="col-sm-10"><?php echo $views->mb_banknum;?><span class="help-block m-b-none">계좌번호를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">예금주</label>
                                    <div class="col-sm-10"><?php echo $views->mb_bankholder;?><span class="help-block m-b-none">예금주를 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">비고</label>
                                    <div class="col-sm-10"><?php echo $views->mb_bigo;?><span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


			  <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
		      </div>

								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
<a href="/prq/partner/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a> 
<a href="/prq/partner/modify/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a> 
<a href="/prq/partner/delete/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a> 
<a href="/prq/partner/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a>
                                    </div>
                                </div>
				<!-- 						      <div class="form-actions">
										      		        <button type="submit" class="btn btn-primary" id="write_btn">작성</button>
										      		        <button class="btn" onclick="document.location.reload()">취소</button>
										      		      </div> -->

								<!-- .form-group -->
								<div class="row">
<!-- 								<div id="banner01"><img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_business_paper;?>" alt="" /></div>#banner01
								<div id="banner02"><img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_distributors_paper;?>" alt="" /></div>#banner01
								<div id="banner03"><img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_bank_paper;?>" alt="" /></div>#banner01
								 -->								
								</div>
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
	server에 대리점을 등록 합니다.

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

function set_member(){
	var param=$("#write_action").serialize();

    $.ajax({
		url:"/prq/board/write/prq_member",
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