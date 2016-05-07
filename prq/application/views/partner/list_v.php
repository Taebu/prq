<?php
/**
* 대리점 스킨 페이지.
* file : /prq/application/views/partner/list_v.php
* 작성 : 2015-03-05 (목)
* 수정 : 2016-05-07 (토)
*
* @author Moon Taebu
* @Copyright (c) 2016, 태부
*/

?>
	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/partner/lists/ci_board/q/'+$("#q").val()+'/page/1';
					$("#bd_search").attr('action', act).submit();
				}
			});
			/*버튼 비활성화.*/
			chk_btn_status();
		});

		function board_search_enter(form) {
			var keycode = window.event.keyCode;
			if(keycode == 13) $("#search_btn").click();
		}

		function set_write(){
		$('#bd_search').attr('action', "/prq/partner/write/prq_member/page/1");
          $("#bd_search").submit();		
		
		}

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
		

		function swal_status(code){

			
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
				animation: "slide-from-top",   showLoaderOnConfirm: true,
				allowEscapeKey:true,
				inputPlaceholder: "변경 사유는 로그에 기록 됩니다." }, function(inputValue){
				if (inputValue === false) return false;
				if(!inputValue){
					swal("취소!", "취소 하였습니다.", "error");
				}
				if (inputValue.length<3) {
				  swal.showInputError("3자이상 사유를 적어 주세요.");
				  return false
				}

				var param=$("#write_action").serialize();
				param=param+"&mb_status="+code;
				/*class 에서 mb_reason을 선언 해 주지 않았기 때문에 값을 못가져오는 경우의 에러 발생 다음에는 참고 하도록 하자.*/
				param=param+"&mb_reason="+inputValue;
				$.ajax({
				url:"/prq/ajax/chg_status/prq_member",
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
						if(!data.success){
							//alert("변경에 실패하였습니다.");
							swal("변경!", "변경에 실패하였습니다. 변경 사유 : "+inputValue, "warning");
						}
					}
				});

//				swal("Nice!", "You wrote: " + inputValue, "success"); 
				});
			/*
			
			
			*/
			/*
			swal({
				title: "정말 변경 하시겠습니까?",
				text: "해당 "+get_status(code)+"로 변경 됩니다.\n 진행 하시겠습니까?\n변경 사유",
				type: "warning",
				html:true,
				showCancelButton: true,
				timer: 2000,
				showConfirmButton: false,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "네, 변경할래요!",
				closeOnConfirm: false
			}, function () {

				$.ajax({
				url:"/prq/ajax/chg_status",
					data:param,
					dataType:"json",
					type:"POST",
					success:function(data){
						if(data.success){
							//alert("변경에 성공하였습니다.");
							swal("변경!", "변경에 성공하였습니다..", "success");
							$.each(data.posts,function(key,val){
								$("#status_"+val.mb_no).html(val.mb_status);
							});
						}
						if(!data.success){
							//alert("변경에 실패하였습니다.");
							swal("변경!", "변경에 실패하였습니다.", "warning");
						}
					}
				});
			});
			*/
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
			object['ac']='승인';
			object['ad']='승인거부';
			object['ec']='연계완료';
			object['ca']='해지';
			return object[code];
		}

	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">

    <div class='row'>
	<?php
			echo form_open('prq/partner/lists/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));
?>
			<!--form id="bd_search" method="post" class="well form-search" -->

<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="PT">
		<!-- id="my-awesome-dropzone" class="" -->
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><span class="mb_gname">대리점</span>  입니다. <small><span class="mb_gname">총판</span>의 정보 및 계약서를 작성해 주세요.</small></h5>
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
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title">등록일자</label>
                <input class="form-control" id="user_title" name="user[title]" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname">상태</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-6'>    
            <div class='form-group'>
                <label for="user_title"><span class="mb_gname">대리점</span>명</label>
                <input class="form-control" id="user_title" name="user[title]" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname"><span class="mb_gname">대리점</span>ID</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for="user_email"><span class="mb_gname">대리점</span> 목록</label>
                <input class="form-control required email" id="user_email" name="user[email]" required="true" size="30" type="text" />
            </div>
        </div>
    </div><!-- .row -->
    <div class='row'>
	<div class='col-sm-12 right'>
            <div class='form-group'><input type="button" value="검색" id="search_btn" class="btn btn-primary" /> </div>
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
	<?php $mb_gcode=$this->input->cookie('mb_gcode', TRUE);

if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"){?>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button>
</div><!-- .btn_area -->
<?php }?>
<div class="table-responsive">
		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><input type="checkbox" name="chk_all" onclick="checkAll('write_action');chk_btn_status();return false;"></th>
					<th scope="col">No</th>
					<th scope="col">대리점 코드</th>
					<th scope="col">대리점 아이디</th>
					<th scope="col">가맹점</th>
					<th scope="col">상점</th>
					<th scope="col">등록일자</th>
					<th scope="col">상태</th>
				</tr>
			</thead>
			<tbody>
<?php 
if(count($list)==0){
echo "<tr><td colspan='12' style='text-align:center'>등록된 `대리점`이 없습니다. </td>";
}
//$count=json_decode(json_encode($count), True);

/* 파트너 갯수 가져오기 */
$array_pt = array_column($count, 'mb_pcode');
$pt_cnt = array_column($count, 'cnt');

/* 상점 갯수 가져오기 */
$array_st = array_column($st_count, 'mb_pcode');
$st_cnt = array_column($st_count, 'cnt');

foreach ($list as $lt){?>
<tr>
	<td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->mb_no;?>" onclick="chk_btn_status()"></td>
	<td scope="row"><?php echo $lt->mb_no;?></td>
	<td>	<a rel="external" href="/prq/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $lt->mb_no;?>/page/<?php echo $page;?>"><?php echo $lt->prq_fcode;?></a></td>
	<td><?php echo $lt->mb_id;?></td>
	<!-- <td><?php echo $lt->mb_gname_kor;?></td> -->
	<!-- <td> --><!-- <?php echo $lt->mb_gname_eng;?> --><!-- </td> -->
	<!-- <td> --><!-- <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>">  -->
	<?php //echo mdate("%y-%m-%d",human_to_unix($lt->reg_date));?><!-- </time> -->
	<!-- <?php echo $lt->mb_business_paper;?>	</td> -->
	<td><a rel="external" href="/prq/franchise/lists/prq_member/page/1"><?php $is_pt=array_search($lt->prq_fcode, $array_pt);
			if($is_pt>-1){
			echo $pt_cnt[$is_pt];
			}else{
			echo "0";
			}
			echo "개";
			?></a></td>
	<td><a rel="external" href="/prq/store/lists/prq_store/page/1"><?php $is_st=array_search($lt->prq_fcode, $array_st);
			if($is_st>-1){
			echo $st_cnt[$is_st];
			}else{
			echo "0";
			}
			echo "개";
			?></a></td>
	<td><?php echo date("Y-m-d", strtotime($lt->mb_datetime));?></td>
	<td><!-- <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>">  -->
	 <?php //echo mdate("%y-%m-%d",human_to_unix($lt->reg_date));?><!-- </time> -->
	<span id="status_<?php echo $lt->mb_no;?>"><?php echo $controllers->get_status($lt->mb_status);?></span>
	</td>
</tr>
<?php }?>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="12" style="text-align:left">
					<?php if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"){?>
					<div class="btn_area">
					<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
					<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
					<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
					<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
					<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
					<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button></div><!-- .btn_area --><?php }?></th>
				</tr>
				<tr>
					<th colspan="5" style="text-align:center;border-top:0">
					<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
				</tr>
			</tfoot>
		</table>
		</div><!-- .table-responsive -->
</div>
</div>
</div>
<div class="row">        <div class='col-sm-11'></div><div class='col-sm-1'> 
<?php if($mb_gcode=="G1"||$mb_gcode=="G2"||$mb_gcode=="G3"){?>
<a href="javascript:set_write();" class="btn btn-success">쓰기</a><?php }?>
</div></div>
	</article>