<!-- 	<script>
		$(document).ready(function(){
			$("#write_btn").click(function(){
				if($("#input01").val() == ''){
					alert('제목을 입력해주세요.');
					$("#input01").focus();
					return false;
				} else if($("#input02").val() == ''){
					alert('내용을 입력해주세요.');
					$("#input02").focus();
					return false;
				} else {
					$("#write_action").submit();
				}
			});
		});
	</script> -->
<script type="text/javascript">

function modify_ds(){
var param=$("#write_action").serialize();

$.ajax({
url:"/prq/board/modify/prq_member/board_id/5",
type: "POST",
data:param,
cache: false,
async: false,
success: function(data) {
console.log(data);
}
});		
}
function showDropzone (){
//	$("#my-awesome-dropzone1").html("...");
}
window.onload = function() {
//	/prq/board/write/prq_member
//showDropzone();
};
</script>
	<article id="board_area">

	<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2>가맹점 수정</h2>
<ol class="breadcrumb">
<li><a href="/">Home</a></li><li>
<a href="/prq/board/lists/prq_member/">가맹점 관리</a>
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
//echo form_open('/board/modify/prq_member', $attributes);

//echo form_open('/board/modify/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5), array('id'=>'write_action', 'class'=>'form-horizontal'));
///prq/franchise/modify/prq_member/board_id/19/page/1

echo form_open('/franchise/modify/'.$this->uri->segment(3).'/board_id/'.$this->uri->segment(5), array('id'=>'write_action', 'class'=>'form-horizontal'));
//echo form_open_multipart('/dropzone/upload', $attributes);

?>
<!-- id="my-awesome-dropzone" class="" -->

<input type="hidden" name="is_join" id="is_join">
<input type="hidden" id="mode" value="modify">
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
<h5>가맹점 수정 정보 입니다. <small>가맹점 정보 및 계약서를 수정해 주세요.</small></h5>
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
<div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id" value="<?php echo $views->mb_id;?>"> <span class="help-block m-b-none" id="mb_id_assist">가맹점을 등록 합니다. 중복 된 아이디를 등록할 수 없습니다.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">상호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_name" value="<?php echo $views->mb_name;?>"> <span class="help-block m-b-none">가맹점 상호를 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">이메일</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_email" name="mb_email" value="<?php echo $views->mb_email;?>"> <span class="help-block m-b-none">이메일을 기입해주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">주소1</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_addr1" name="mb_addr1" value="<?php echo $views->mb_addr1;?>"> <span class="help-block m-b-none">시군구를 등록해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">주소2</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_addr2" name="mb_addr2" value="<?php echo $views->mb_addr2;?>"> <span class="help-block m-b-none">동읍면리.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">주소3</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_addr3" name="mb_addr3" value="<?php echo $views->mb_addr3;?>"> <span class="help-block m-b-none">상세주소</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">대표자 명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_ceoname" value="<?php echo $views->mb_ceoname;?>"> <span class="help-block m-b-none">대표자명을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">휴대폰 번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_hp" value="<?php echo $views->mb_hp;?>"> <span class="help-block m-b-none">휴대폰 번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group">
<label class="col-sm-2 col-sm-2 control-label">사업자등록번호</label>
<div class="col-sm-10">
<input type="text" class="form-control" data-mask="999-99-99999" placeholder="" name="mb_business_num" id="mb_business_num" value="<?php echo $views->mb_business_num;?>">
<span class="help-block">999-99-99999</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">정산비율</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_exactcaculation_ratio"  value="<?php echo $views->mb_exactcaculation_ratio;?>"> <span class="help-block m-b-none">정산 비율</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

</div><!-- .col-md-6 Left Menu-->

<div class="col-md-6">

<div class="form-group"><label class="col-sm-2 control-label">사업자등록증</label>
<div class="col-sm-10"><div id="my-awesome-dropzone1" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"사업자등록증"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계약서</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <div id="my-awesome-dropzone2">my-awesome-dropzone2</div> -->
<!-- <div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div> --><!-- #my-awesome-dropzone2 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"계약서"를 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">통장 사본</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone3" class="dropzone">

<div class="dz-default dz-message"></div>
</div><!-- #my-awesome-dropzone3 -->

<!-- <div id="my-awesome-dropzone3">my-awesome-dropzone3</div> --><!-- #my-awesome-dropzone3 -->

<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"통장 사본"을 드래그 하거나 선택해 주세요.</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">은행명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankname" value="<?php echo $views->mb_bankname;?>"> <span class="help-block m-b-none">"거래은행"을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_banknum" value="<?php echo $views->mb_banknum;?>"> <span class="help-block m-b-none">계좌번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">예금주</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder" value="<?php echo $views->mb_bankholder;?>"> <span class="help-block m-b-none">예금주를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">생년월일</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_birth" value="<?php echo $views->mb_birth;?>"> <span class="help-block m-b-none">생년월일 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비고</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo" value="<?php echo $views->mb_bigo;?>"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->


<div class="controls">
<p class="help-block"><?php echo validation_errors(); ?></p>
</div>

<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn btn-white" type="reset">취소</button>

</div>
</div>
<!-- 						      <div class="form-actions">
<button type="submit" class="btn btn-primary" id="write_btn">작성</button>
<button class="btn" onclick="document.location.reload()">취소</button>
</div> -->

<!-- .form-group -->

<!-- <div class="row"><div class="col-md-12">
<textarea id="form_data">#form_data</textarea>#form_data
</div></div> -->
</div><!-- .col-md-6 Right Menu-->
<!-- <button class="btn btn-primary" type="button" onclick="modify_ds()">수정</button> -->
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->

</div><!-- .wrapper .wrapper-content .animated .fadeInRight -->
</article>
