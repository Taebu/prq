<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>네이버 가맹점 테이블 수정</h2>
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
		<input type="hidden" name="mb_id" id="mb_id" value="<?php echo $views->mb_id;?>">
		<input type="hidden" name="mb_hp" id="mb_hp" value="<?php echo $views->mb_hp;?>">
		
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

								<div class="form-group"><label class="col-sm-2 control-label">*주소1</label>
                                    <div class="col-sm-10"><?php echo $views->mb_addr1;?> <span class="help-block m-b-none">시군구를 등록해 주세요..</span>
                                    </div><!-- .col-sm-10 -->
                                </div><!-- .form-group -->
								<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

								<div class="form-group"><label class="col-sm-2 control-label">*주소2</label>
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
			<div class="form-group"><label class="col-sm-1 control-label">TOKEN 정보</label>
			<div class="col-sm-11" id="token_info">#token_info</div><!-- .col-sm-10 #token_info -->
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
<a href="<?php echo $list_link;?>" class="btn btn-primary">목록</a> 
<a href="<?php echo $modify_link;?>" class="btn btn-warning">수정</a> 
<a href="<?php echo $delete_link;?>" class="btn btn-danger">삭제</a> 
<a href="<?php echo $write_link;?>" class="btn btn-success">쓰기</a>
                                    </div>
                                </div><!-- .form-group -->

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
console.log("root@175.126.111.21:/var/www/html/prq/application/views/franchise/view_v.php");
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

	/* token_id 정보를 불러 옵니다.*/
	get_token_id();
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
			
			var st_nos=[];
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
			object.push('<th>mid</th>');
			object.push('<th>발송방법</th>');
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
				object.push('<td><span id="code_5013_'+val.st_no+'">5013</span></td>');
				object.push('<td><span id="code_5012_'+val.st_no+'">5012</span></td>');

				object.push('</tr>');
				st_nos.push(val.st_no);
				
			});

			object.push('</tbody>');
			object.push('</table>');
			object.push('<span class="help-block m-b-none"></span>');
			$("#cid_info").html(object.join(""));

			for(var i in st_nos)
			{
				get_codes(st_nos[i]);
			}
        }
    });		

}

function get_codes(st_no)
{
	$.ajax({
		url:"/prq/ajax/get_codes/"+st_no,
		type: "POST",
        data:"",
        cache: false,
        async: false,
        dataType:"json",
        success: function(data) {
			console.log(data.codes.c5012);
			console.log(data.codes.c5013);
            $("#code_5013_"+st_no).html(data.codes.c5013);
			if(data.codes.c5012=="munjac")
			{
 				$("#code_5012_"+st_no).html('<a class="btn btn-warning">문자씨</a>');
			}else{
				$("#code_5012_"+st_no).html('<a class="btn btn-danger">톡톡</a> ');
			}

        }
    });		
}
function get_mnoinfo(){
//	var param=$("#write_action").serialize();
	if($.trim($("#mb_hp").val())=="")
	{
		$("#mno_info").html('휴대폰 번호가 저장 되지 않았습니다.');
		console.log("mb_hp none");
		return;
	}

    $.ajax({
		url:"/prq/ajax/get_mnoinfo2/"+$("#mb_hp").val().replace(/-/gi, ""),
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
			if(data.posts.length<1||data.posts.length>1){
			object.push('등록된 상점 MNO 정보가 없거나 잘못된 정보를 불러 왔습니다.');
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
				object.push('<tr><td>일일문자발송제한</td><td>'+val.mn_mms_limit+'</td>');
				object.push('<td>* 중복발송제한<td><td>'+val.mn_dup_limit+'</td></tr>');
				object.push('<tr><td colspan="2"><a href="javascript:set_mno('+val.mn_no+');">삭제</a></td></tr>');
			});
			object.push('</tbody>');
			object.push('</table>');
			object.push('<span class="help-block m-b-none">* 중복발송제한 : 값이 0이면 제한 없이 전화 할 때마다 전송합니다. 0이상이면 해당 일 수 만큼 상대방에게 문자를 전송하지 않습니다. 전송 거절 내역은 gcm log에 남습니다.</span>');
			$("#mno_info").html(object.join(""));
        }
    });		
}


function get_token_id(){
//	var param=$("#write_action").serialize();
	if($.trim($("#mb_hp").val())=="")
	{
		$("#token_info").html('휴대폰 번호가 저장 되지 않았습니다.');
		console.log("mb_hp none");
		return;
	}

    $.ajax({
		url:"/prq/ajax/get_token_id/"+$("#mb_hp").val().replace(/-/gi, ""),
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
			
			if(!data.success){
			object.push('token_id 정보가 없거나 잘못된 정보를 불러 왔습니다.');
			$("#token_info").html(object.join(""));
			return ;
			}
			
			if(data.success)
			{
			object.push("<table>");
			object.push("<tr><td>");
			object.push("token_id : ");
			object.push("</td><td><b>");
			object.push(data.token.token_id);
			object.push("</td></tr>");
			object.push("<tr><td>");
			object.push("날짜 시간 : ");
			object.push("</td><td><b>");
			object.push(data.token.regdate);
			object.push("</td></tr>");
			object.push("</table>");
			$("#token_info").html(object.join(""));
			}
        
			}
    });		
}


/*mno 정보를 삭제합니다.*/
function set_mno(v){
	var is_del=false;
	is_del=confirm("정말 삭제하시겠습니까?");
	if(is_del){
		alert(v+"삭제");
    $.ajax({
		url:"/prq/ajax/del_mno/"+v,
		type: "POST",
        data:"",
        cache: false,
        async: false,
        dataType:"json",
        success: function(data) {
            console.log(data);
        }
    });		
	}else{
		alert(v+"취소");
	}

}
</script>