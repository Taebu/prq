<!-- 	<script type="text/javascript" src="/prq/include/js/httpRequest.js"></script>
	<script type="text/javascript">
	$(function(){
		$("#comment_add").click(function(){
			$.ajax({
				url: "/prq/ajax_board/ajax_comment_add",
				type: "POST",
				data:{
					"comment_contents":encodeURIComponent($("#input01").val()),
					"csrf_test_name":getCookie('csrf_cookie_name'),
					"table":"<?php echo $this->uri->segment(3);?>",
					"board_id":"<?php echo $this->uri->segment(5);?>"
				},
				dataType: "html",
				complete:function(xhr, textStatus){
					if (textStatus == 'success')
					{
						if ( xhr.responseText == 1000 )
						{
							alert('댓글 내용을 입력하세요');
						}
						else if ( xhr.responseText == 2000 )
						{
							alert('다시 입력하세요');
						}
						else if ( xhr.responseText == 9000 )
						{
							alert('로그인하여야 합니다.');
						}
						else
						{
							$("#comment_area").html(xhr.responseText);
							$("#input01").val('');
						}
					}
				}
			});
		});
	
		$(".comment_delete").click(function(){
			$.ajax({
				url: "/prq/ajax_board/ajax_comment_delete",
				type: "POST",
				data:{
					"csrf_test_name":getCookie('csrf_cookie_name'),
					"table":"<?php echo $this->uri->segment(3);?>",
					"board_id":$(this).attr("vals")
				},
				dataType: "text",
				complete:function(xhr, textStatus){
					if (textStatus == 'success')
					{
						if ( xhr.responseText == 9000 )
						{
							alert('로그인하여야 합니다.');
						}
						else if ( xhr.responseText == 8000 )
						{
							alert('본인의 댓글만 삭제할 수 있습니다.');
						}
						else if ( xhr.responseText == 2000 )
						{
							alert('다시 삭제하세요.');
						}
						else
						{
							$('#row_num_'+xhr.responseText).remove();
							alert('삭제되었습니다.');
						}
					}
				}
			});
		});
	});
	
	function getCookie( name )
	{
		var nameOfCookie = name + "=";
		var x = 0;
	
		while ( x <= document.cookie.length )
		{
			var y = (x+nameOfCookie.length);
	
			if ( document.cookie.substring( x, y ) == nameOfCookie ) {
				if ( (endOfCookie=document.cookie.indexOf( ";", y )) == -1 )
					endOfCookie = document.cookie.length;
	
				return unescape( document.cookie.substring( y, endOfCookie ) );
			}
	
			x = document.cookie.indexOf( " ", x ) + 1;
	
			if ( x == 0 )
	
			break;
		}
	
		return "";
	}
	</script>
	
	
	<article id="board_area">
		<header>
			<h1></h1>
		</header>
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><?php echo $views->subject;?></th>
					<th scope="col">이름 : <?php echo $views->user_name;?></th>
					<th scope="col">조회수 : <?php echo $views->hits;?></th>
					<th scope="col">등록일 : <?php echo $views->reg_date;?></th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<th colspan="4">
						<?php echo nl2br($views->contents);?>
					</th>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="4"><a href="/prq/board/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a> <a href="/prq/board/modify/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a> <a href="/prq/board/delete/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a> <a href="/prq/board/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a></th>
				</tr>
			</tfoot>
		</table>
	
		<form class="form-horizontal" method="post" action="" name="com_add">
		  <fieldset>
		    <div class="control-group">
		      <label class="control-label" for="input01">댓글</label>
		      <div class="controls">
		        <textarea class="input-xlarge" id="input01" name="comment_contents" rows="3"></textarea>
				<input class="btn btn-primary" type="button" id="comment_add" value="작성">
		        <p class="help-block"></p>
		      </div>
		    </div>
		  </fieldset>
		</form>
		<div id="comment_area">
			<table cellspacing="0" cellpadding="0" class="table table-striped" id="comment_table">
	<?php
	foreach ($comment_list as $lt)
	{
	?>
				<tr id="row_num_<?php echo $lt->board_id;?>">
					<th scope="row">
						<?php echo $lt->user_id;?>
					</th>
					<td><?php echo $lt->contents;?></a></td>
					<td><time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>"><?php echo $lt->reg_date;?></time></td>
					<td><a href="#" class="comment_delete" vals="<?php echo $lt->board_id;?>"><i class="icon-trash"></i>삭제</a></td>
				</tr>
	<?php
	}
	?>
			</table>
		</div>
	</article> -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------ -->
<script type="text/javascript">


</script>
			<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>가맹점 수정</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li>
                            <a>가맹점 관리</a>
                        </li>
                        <li class="active">
                            <strong>가맹점 수정</strong>
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
			echo form_open('board/write/prq_member', $attributes);
		?>
		<!-- id="my-awesome-dropzone" class="" -->
		<input type="hidden" name="is_join" id="is_join" value="">
		<input type="hidden" name="mb_business_paper" id="mb_business_paper">
		<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper">
		<input type="hidden" name="mb_bank_paper" id="mb_bank_paper">
		<input type="hidden" name="prq_fcode" id="prq_fcode" value="<?php echo $views->prq_fcode;?>">
		<input type="hidden" name="mb_id" id="mb_id" value="<?php echo $lt->mb_id;?>">
		
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>가맹점 등록 정보 입니다. <small>가맹점 정보 및 계약서를 작성해 주세요.</small></h5>
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
									<?php echo $views->mb_id;?>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">코드</label>
                                    <div class="col-sm-10"><?php echo $views->prq_fcode;?><span class="help-block m-b-none">상호입니다.</span>
                                    </div><!-- .col-sm-10 -->
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

								<div class="form-group"><label class="col-sm-2 control-label">정산비율</label>
                                    <div class="col-sm-10"><?php echo $views->mb_exactcaculation_ratio;?> <span class="help-block m-b-none">정산 비율</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->

							</div><!-- .col-md-6 Left Menu-->
							    <!-- [mb_business_paper] => BS_1450342633.jpg
							        [mb_distributors_paper] => DS_1450342637.png
							        [mb_bank_paper] => BK_1450342642.jpg
							        [mb_business_num] => 0
							        [mb_exactcaculation_ratio] => 654564
							        [mb_bankname] => 654564564456
							        [mb_banknum] => 4564564
							        [mb_bankholder] => 4564564
							        [mb_bigo] => 4564 -->
							<div class="col-md-6">
								<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
                                    <div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
									<img src="/prq/uploads/<?php echo $views->mb_imgprefix;?>/<?php echo $views->mb_business_paper;?>" onerror="this.src='http://static.plaync.co.kr/lineage/bbs/noimg_200_150.gif'" width="100" height="100">
									<!-- <input type="file" class="form-control" name="mb_hp"> --> 
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">계약서</label>
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

								<div class="form-group"><label class="col-sm-2 control-label">생년월일</label>
                                    <div class="col-sm-10"><?php echo $views->mb_birth;?><span class="help-block m-b-none">생년월일을 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">비고</label>
                                    <div class="col-sm-10"><?php echo $views->mb_bigo;?><span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
                                <div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div>
<div class="row"><div class="col-md-12">
			<div class="form-group"><label class="col-sm-1 control-label">CID 정보</label>
			<div class="col-sm-11" id="cid_info">...</div><!-- .col-sm-10 #cid_info -->
			</div><!-- .form-group -->
			<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div></div><!-- .row -->

<div class="row"><div class="col-md-12">
			<div class="form-group"><label class="col-sm-1 control-label">MNO 정보</label>
			<div class="col-sm-11" id="mno_info">mno info</div><!-- .col-sm-10 #mno_info -->
			</div><!-- .form-group -->
			<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->
</div></div><!-- .row -->
<div>
			  <div class="controls">
		        <p class="help-block"><?php echo validation_errors(); ?></p>
		      </div>

								<div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
<a href="/prq/<?php echo $this->uri->segment(1);?>/lists/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-primary">목록</a> 
<a href="/prq/<?php echo $this->uri->segment(1);?>/modify/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-warning">수정</a> 
<a href="/prq/<?php echo $this->uri->segment(1);?>/delete/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $this->uri->segment(5);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-danger">삭제</a> 
<a href="/prq/<?php echo $this->uri->segment(1);?>/write/<?php echo $this->uri->segment(3);?>/page/<?php echo $this->uri->segment(7);?>" class="btn btn-success">쓰기</a>
                                    </div>
                                </div>
				<!-- 						      <div class="form-actions">
										      		        <button type="submit" class="btn btn-primary" id="write_btn">작성</button>
										      		        <button class="btn" onclick="document.location.reload()">취소</button>
										      		      </div> -->

								<!-- .form-group -->

								<div class="row"><div class="col-md-12">
									<!-- <textarea id="form_data">#form_data</textarea> --><!-- #form_data -->
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
		//	$("#write_action").submit();
		set_member();
		}

		if($("#is_join").val()=="FALSE"){
			$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
		}
	}

window.onload = function() {
	/* cid 정보를 불러 옵니다.*/
	get_cidinfo();

	/* mno 정보를 불러 옵니다.*/
	get_mnoinfo();
};
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


function get_cidinfo(){
//	var param=$("#write_action").serialize();

    $.ajax({
		url:"/prq/ajax/get_cidinfo/"+$("#prq_fcode").val(),
		type: "POST",
        data:"",
        cache: false,
        async: false,
        dataType:"json",
        success: function(data) {
            console.log(data);
			var object=[];
			var chk_port="";
			var str="";
			if(data.posts.length<1){
			object.push('등록된 상점 CID 정보가 없습니다.');
			$("#cid_info").html(object.join(""));
			return ;
			}
			object.push('<table class="table">');
			object.push('<thead>');
			object.push('<tr>');
			object.push('<th>#</th>');
			object.push('<th>st_name</th>');
			object.push('<th>st_cidtype</th>');
			object.push('<th>st_tel_1</th>');
			object.push('<th>st_hp_1</th>');
			object.push('</tr>');
			object.push('</thead>');
			object.push('<tbody>');			
			$.each(data.posts,function(key,val){
				object.push('<tr>');
				object.push('<td>');
				object.push(val.st_port);
				object.push('</td>');
				object.push('<td>'+val.st_name+'</td>');
				object.push('<td>'+val.st_cidtype+'</td>');
				object.push('<td>'+val.st_tel_1+'</td>');
				object.push('<td>'+val.st_hp_1+'</td>');
				object.push('</tr>');
			});
			object.push('</tbody>');
			object.push('</table>');
			object.push('<span class="help-block m-b-none"></span>');
			$("#cid_info").html(object.join(""));
        }
    });		

}

function get_mnoinfo(){
//	var param=$("#write_action").serialize();

    $.ajax({
		url:"/prq/ajax/get_mnoinfo/"+$("#mb_id").val(),
		type: "POST",
        data:"",
        cache: false,
        async: false,
        dataType:"json",
        success: function(data) {
            console.log(data);
			var object=[];
			var chk_port="";
			var str="";
			if(data.posts.length<1){
			object.push('등록된 상점 MNO 정보가 없습니다.');
			$("#mno_info").html(object.join(""));
			return ;
			}
			object.push('<table class="table">');
			object.push('<thead>');
			object.push('<tr>');
			object.push('<tbody>');			
			$.each(data.posts,function(key,val){
				object.push('<tr><td>통신사</td><td colspan="5">'+val.mn_operator+'</td></tr>');
				object.push('<tr><td>발송번호</td><td>'+val.mn_hp+'</td>');
				object.push('<td>문자 구분<td><td>'+val.mn_type+'</td></tr>');
				object.push('<tr><td>안드로이드 버전</td><td>'+val.mn_version+'</td>');
				object.push('<td>단말기<td><td>'+val.mn_model+'</td></tr>');
				object.push('<tr><td>문자발송</td><td>'+val.mn_mms_limit+'</td>');
				object.push('<td>중복발송제한<td><td>'+val.mn_dup_limit+'</td></tr>');
			});
			object.push('</tbody>');
			object.push('</table>');
			object.push('<span class="help-block m-b-none"></span>');
			$("#mno_info").html(object.join(""));
        }
    });		
}

</script>