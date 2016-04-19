<style type="text/css">
option:disabled {
    background: rgb(51, 122, 183);
    color:white;
	font-weight: 900 !important;
	padding:5px;
}
</style>
<div class="row wrapper border-bottom white-bg page-heading">
<div class="col-lg-10">
<h2><span class="mb_gname">대리점</span> 등록</h2>
<ol class="breadcrumb">
<li>
<a href="index.html">Home</a>
</li>
<li>
<a><span class="mb_gname">대리점</span>관리</a>
</li>
<li class="active">
<strong><span class="mb_gname">대리점</span> 등록</strong>
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
echo form_open('/partner/write/prq_member', $attributes);
//echo form_open_multipart('/dropzone/upload', $attributes);
$mb_code=$this->input->post('mb_code',TRUE);
$mb_code=$this->input->cookie('mb_code', TRUE);
$prq_fcode=$this->input->cookie('prq_fcode', TRUE);
?>
<!-- id="my-awesome-dropzone" class="" -->
<input type="hidden" name="is_join" id="is_join" value="">
<input type="hidden" name="is_member" id="is_member">
<input type="hidden" name="mb_code" id="mb_code">
<input type="hidden" name="mb_gtype" id="mb_gtype" value="PT">
<input type="hidden" name="mb_gcode" id="mb_gcode" value="G4">
<input type="hidden" name="mb_gname_eng" id="mb_gname_eng" value="Partner">
<input type="hidden" name="mb_gname_kor" id="mb_gname_kor" value="대리점">
<input type="hidden" name="mb_pcode" id="mb_pcode" value="<?php echo $mb_code;?>">
<input type="hidden" name="mb_business_paper" id="mb_business_paper">
<input type="hidden" name="mb_distributors_paper" id="mb_distributors_paper">
<input type="hidden" name="mb_bank_paper" id="mb_bank_paper">
<input type="hidden" name="mb_business_paper_size" id="mb_business_paper_size">
<input type="hidden" name="mb_distributors_paper_size" id="mb_distributors_paper_size">
<input type="hidden" name="mb_bank_paper_size" id="mb_bank_paper_size">
<input type="hidden" name="mb_imgprefix" id="mb_imgprefix" value="<?php echo date("Ym");?>">
<input type="hidden" name="ds_code" id="ds_code" value="<?php echo @$this->input->cookie('prq_fcode',TRUE);?>">
<div class="row">
<div class="col-lg-12">
<div class="ibox float-e-margins">
<div class="ibox-title">
<h5><span class="mb_gname">대리점</span> 등록 정보 입니다. <small>대리점의 정보 및 계약서를 작성해 주세요.</small></h5>
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
<div class="form-group"><label class="col-sm-2 control-label">총판</label>
<div class="col-sm-10">
<?php 
$mb_gcode=$this->input->cookie('mb_gcode', TRUE);
if($mb_gcode=="G1"||$mb_gcode=="G2"){
?>
<select name="mb_pcode" id="mb_pcode"  class="form-control">
	<option value="DS0001" selected>[DS0001] 총판</option>
</select><!-- #mb_pcode -->
<span class="help-block m-b-none">총판협력사를 선택해 주세요.</span>
<?php 
}else if($mb_gcode=="G3"){
echo $this->input->cookie('name', TRUE);echo "(".$prq_fcode.")";
//echo '<input type="hidden" name="mb_pcode" value="'.$mb_code.'">';
}else{
echo "대리점을 등록할 권한이 없습니다.";
}
?>

</div><!-- .col-sm-10 -->
</div><!-- .form-group -->

<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<!-- <form method="get" class="form-horizontal"> -->
<div class="form-group"><label for="pt_code" class="col-sm-2 control-label">대리점 코드</label>
	<div class="col-sm-10">
	<select name="prq_fcode"  class="form-control" id="prq_fcode" style='width:100%' onchange="javascript:chg_ptcode(this.value)"
	 onclick="javascript:chg_ptcode(this.value)">
		<option value="PT0001">[PT0001] 캐시큐1</option>
		<option value="PT0002">[PT0002] 캐시큐2</option>
		<option value="PT0003">[PT0003] 캐시큐3</option>
		<option value="PT0004">[PT0004] 캐시큐4</option>
		<option value="PT0005">[PT0005] 캐시큐5</option>
		<option value="PT0006">[PT0006] 캐시큐6</option>
		<option value="PT0007">[PT0007] 캐시큐7</option>
		<option value="PT0008">[PT0008] 캐시큐8</option>
		<option value="PT0009">[PT0009] 캐시큐9</option>
		<option value="PT0010">[PT0010] 캐시큐10</option>
		<option value="PT0011">[PT0011] 캐시큐11</option>
	</select>
	<span class="help-block m-b-none">대리점코드를 선택 합니다.</span>
	</div><!-- .col-sm-10 -->
</div><!-- .form-inline-->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">대리점</span> 아이디
</label>
<div class="col-sm-10"><input type="text" class="form-control" id="mb_id" name="mb_id"> <span class="help-block m-b-none" id="mb_id_assist"><span class="mb_gname">대리점</span>아이디를 등록 합니다. 중복 된 아이디를 등록할 수 없습니다.
<?php //echo $this->input->ip_address();?>
<?php //echo $this->agent->referrer();;?>


</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비밀번호</label>
<div class="col-sm-10"><input type="password" class="form-control" name="mb_password">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">이미지 파일 경로</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_imgprefix" value="<?php echo date("Ym");?>">
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비밀번호 확인</label>
<div class="col-sm-10"><input type="password" class="form-control" name="mb_password_2">
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

<div class="form-group"><label class="col-sm-2 control-label">대표자 명</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_ceoname"> <span class="help-block m-b-none">대표자명을 기입해 주세요..</span>
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

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">대리점</span> 정산비율</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_exactcaculation_ratio"> <span class="help-block m-b-none">정산 비율</span>
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

<div class="form-group"><label class="col-sm-2 control-label"><span class="mb_gname">대리점</span> 계약서</label>
<div class="col-sm-10">
<div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div><!-- #my-awesome-dropzone1 -->
<!-- <div id="my-awesome-dropzone2">my-awesome-dropzone2</div> -->
<!-- <div id="my-awesome-dropzone2" class="dropzone"><div class="dz-default dz-message"></div></div> --><!-- #my-awesome-dropzone2 -->
<!-- <input type="file" class="form-control" name="mb_hp"> --> <span class="help-block m-b-none">"<span class="mb_gname">대리점</span> 계약서"를 드래그 하거나 선택해 주세요.</span>
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
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankname"> <span class="help-block m-b-none">"거래은행"을 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">계좌번호</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_banknum"> <span class="help-block m-b-none">계좌번호를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">예금주</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bankholder"> <span class="help-block m-b-none">예금주를 기입해 주세요..</span>
</div><!-- .col-sm-10 -->
</div><!-- .form-group -->
<div class="hr-line-dashed"></div><!-- .hr-line-dashed -->

<div class="form-group"><label class="col-sm-2 control-label">비고</label>
<div class="col-sm-10"><input type="text" class="form-control" name="mb_bigo"> <span class="help-block m-b-none">메모 하실것이나 기타 사항을 기입해 주세요..</span>
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

<div class="row"><div class="col-md-12">
<textarea id="form_data">#form_data</textarea><!-- #form_data -->
</div></div>
</div><!-- .col-md-6 Right Menu-->
<button class="btn btn-primary" type="button" onclick="set_ds()">저장</button>
</div><!-- .row -->
</div><!-- .ibox-content -->
</div><!-- .ibox float-e-margins -->
</div><!-- .col-lg-12 -->
</div><!-- .row -->

</div><!-- .wrapper .wrapper-content .animated .fadeInRight -->
<script type="text/javascript">
var is_idchecking=false;

/*
server에 <span class="mb_gname">대리점</span>을 등록 합니다.
*/
function set_ds()
{
	var param=$("#write_action").serialize();
	if($("#is_join").val()=="TRUE")
	{
		$("#form_data").html(param);
		//	$("#write_action").submit();
		set_member();
	}

	if($("#is_join").val()=="FALSE")
	{
		$("#form_data").html("<span  class=\"text-danger\">가입불</span>");
	}
}
/*End Dropzone*/	

/**
* fn chk_duplicate_id()
 아이디 길이 체크 후 중복 체크
*/
var focus=0,blur=0;
function chk_duplicate_id()
{
	is_idchecking=true;
	focus++; 
	var object=[];
	var mb_id=$("#mb_id").val();
	
	if (mb_id.length<4)
	{
		object.push("<span  class=\"text-danger\">");
		object.push("아이디 길이가 너무 적습니다. 4자 이상");
		object.push("</span>");
		$("#is_join").val("FALSE");
		//}else if ($( "#mb_id" ).val()!="erm00")	{
		$( "#mb_id_assist" ).html(object.join(""));
		return;
	}

	var result=false;
	$.ajax({
	url:"/prq/auth/chk_id",
	type: "POST",
	data:"mb_id="+mb_id,
	dataType:"json",
	success: function(data) {
		console.log(data.success);
		console.log(data);
		$("#is_member").val(data.success);	
		chk_vali_id();
		}
	});
}

/*
chk_vali_id();
아이디 유효성 여부 검사
*/
function chk_vali_id()
{
	var object=[];
	console.log("&gt;"+$("#is_member").val());
	var is_dupid=eval($("#is_member").val());
	if (is_dupid)
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
	$( "#mb_id_assist" ).html(object.join(""));
}

/*mb_code로 등록 정보 변경*/
function chg_gname()
{
	var chk_code=$("#mb_code").val();
	switch (chk_code)
	{
	case "DS":
		$(".mb_gname").html("총판");
		break;
	case "PT":
		$(".mb_gname").html("대리점");
		break;
	case "FR":
		$(".mb_gname").html("가맹점");
		break;
	}
}

/*set_member(){...}*/
function set_member()
{
	var param=$("#write_action").serialize();

	$.ajax({
		url:"/prq/partner/write/prq_member",
		type: "POST",
		data:param,
		cache: false,
		async: false,
		success: function(data) {
		console.log(data);
		}
	});
}

/*get_pcode(){...}*/
function get_pcode()
{
	var object=[];
	$.ajax({
	url:"/prq/ajax/mb_pcode/",
	data:"mb_code="+$("#mb_pcode").val(),
	dataType:"json",
	success:function(data){
		$.each(data.posts,function(key,val){
		object.push('<option value="'+val.mb_code+'">'+val.mb_ceoname+'('+val.mb_code+')</option>');
		});
		$("#mb_pcode").html(object.join(""));
	}
	});
}

/*******************************************************************************************************************/
/*대리점 코드를 불러 옵니다.*/
var pt_code="";
function get_ptcode()
{
	$.ajax({
	url:"/prq/ajax/get_ptcode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		pt_code=data.posts;
		console.log(pt_code);
//		$("#is_member").val(data.success);	
//		chk_vali_id();
			get_used_ptcode();
		}
	});
}

/*사용 중인 대리점 코드를 불러 옵니다.*/
var used_pt_code=[];

function get_used_ptcode()
{
	
	$.ajax({
	url:"/prq/ajax/get_used_ptcode/",
	type: "POST",
	data:"",
	dataType:"json",
	success: function(data) {
		console.log(data.posts.length);
			if(data.posts.length>0){
			$.each(data.posts,function(key,val){
				used_pt_code.push(val.prq_fcode);
			});
			}
		//search_dscode("DS0003");
		search_ptcode("DS0003");
		}
	});
}


/*
대리점코드로 사용중인 코드를  비활성화 합니다.
*/
function search_ptcode(spt_code)
{
	spt_code="";
	var object = [];
	var chk_max_dscode=[];
	/*서버에서 실제 사용중인 코드를 불러 온다. */
	var arr =used_pt_code;
	console.log("사용 중인 코드 갯수 : "+used_pt_code.length);
	console.log("등록한 코드 갯수 : "+pt_code.length);

	if(pt_code.length==used_pt_code.length){
//		alert("대리점 코드를 모두 소진하여 \n 더 이상 대리점 등록이 불가능 합니다.\n 리스트로 돌아갑니다.");
//		$(location).attr('href','/prq/partner/lists/prq_member/page/1');
	}
	/* pt_code는 이미 get_dscode인 부모 코드에서 불러 온다.*/
	$.each(pt_code,function(key,val){
//	if(val.fr_code.indexOf(spt_code)>-1)
//	{
		if(spt_code==val.pt_code){
			object.push('<option value='+val.pt_code+' selected>');
		}else{
			if($.inArray(val.pt_code,arr)>-1){
			object.push('<option value='+val.pt_code+' disabled>');
			}else{
			object.push('<option value='+val.pt_code+'>');
			}
		}
		chk_max_dscode.push(val.pt_code);
		if($.inArray(val.pt_code,arr)>-1){
		object.push('['+val.pt_code+'] ');
		object.push(val.pt_name+" [사용 중] ");
		
		}else{
		object.push('['+val.pt_code+'] ');
		object.push(val.pt_name);
		}
		object.push('</option>');
//	}
	});

	if(chk_max_dscode.length>0)
	{
	var max_pt_code=chk_max_dscode[chk_max_dscode.length-1];
	console.log(max_pt_code);
	console.log(max_pt_code.substr(0,6));
	var next_code_index=Number(max_pt_code.substr(0,6));
	console.log("is array next code index -> "+next_code_index);
	}else{
	var next_code_index=0;
	console.log("is not array next code index -> "+next_code_index);
	}
	next_code_index=10001+next_code_index;
	var next_code_string=next_code_index.toString();
	var pt_code_new="DS"+next_code_string.substr(1,5);
	var result=object.join("");
	$("#prq_fcode").html(result);
//	chg_frcode(spt_code+""+fr_code_new);
}


/*
*/
function chg_ptcode(v)
{
	var ds_code=$("#ds_code").val();
	$("#pt_code_new").val(v);
	$("#display_dscode").html(ds_code);
	$("#display_ptcode").html(v);
	$("#span_pt_code").html(ds_code+""+v);
	var search_code=v;
	console.log(search_code);
	$.each(pt_code,function(key,val){
		if(val.pt_code.indexOf(search_code)>-1)
		$("#edit_pt_name").val(val.pt_name);
//	$("#edit_pt_name").val(ds_code+"_"+v);
	});
}

/*******************************************************************************************************************/


function search_ptcode(ds_code)
{
	var object = [];
	var chk_max_ptcode=[];
	
	$.each(pt_code,function(key,val){
//	if(val.pt_code.indexOf(ds_code)>-1)
//	{
		if("DS0001"==val.pt_code){
			object.push('<option value='+val.pt_code+' selected>');
		}else{
			object.push('<option value='+val.pt_code+'>');
		}
		chk_max_ptcode.push(val.pt_code);
		object.push('['+val.pt_code+'] ');
		object.push(val.pt_name);
		object.push('</option>');
//	}
	});
	if(chk_max_ptcode.length>0)
	{
	var max_pt_code=chk_max_ptcode[chk_max_ptcode.length-1];

	var next_code_index=Number(max_pt_code.substr(8,12));
	console.log("is array next code index -> "+next_code_index);
	}else{
	var next_code_index=0;
	console.log("is not array next code index -> "+next_code_index);
	}
	next_code_index=10001+next_code_index;
	var next_code_string=next_code_index.toString();
	var pt_code_new="PT"+next_code_string.substr(1,5);
	var result=object.join("");
//	$("#pt_code").html(result);
	$("#prq_fcode").html(result);
//	chg_ptcode(ds_code+""+pt_code_new);
}

/* 모든 정보를 불러 오면 아래 코드를 실행합니다.*/
window.onload = function() {

	$( "#mb_id" ).focusout(function() {
	//chk_vali_id();
	chk_duplicate_id();
	})
	.blur(function() {
	blur++;
	//chk_vali_id();
	chk_duplicate_id();
	});

	/*mb_code로 등록 정보 변경*/
	//chg_gname();
	/*총판 코드 가져오기*/
	get_pcode();
	
	//대리점 코드 가져오기
	/* 
	2016-01-25 (월)
	fn get_ptcode();
	대리점 코드   prq_fcode 불러오기
	아래 함수는 get_used_ptcode를 불러서 이미 사용 중인 코드를 호출 합니다.
	그 후 search_ptcode 를 호출 하여 이미 사용중인 코드가 모두 소진 되면 
	입력을 할 수 없도록 대리점 리스트로 돌아 갑니다.
	*/
	get_ptcode();
};/*window.onload = function() {..}*/


</script>