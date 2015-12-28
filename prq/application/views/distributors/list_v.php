	<script>
		$(document).ready(function(){
			$("#search_btn").click(function(){
				if($("#q").val() == ''){
					alert('검색어를 입력해주세요.');
					return false;
				} else {
					var act = '/prq/board/distributors/ci_board/q/'+$("#q").val()+'/page/1';
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
		$('#bd_search').attr('action', "/prq/distributors/write/prq_member/page/1");
          $("#bd_search").submit();		
		
		}

		function chg_list(code){
			var param=$("#write_action").serialize();
			if(param=="")
			{
				alert("하나 이상 선택 하셔야 합니다.");
				return;
			}

			$.ajax({
				url:"/prq/ajax/chg_status",
					data:param,
					dataType:"json",
					type:"POST",
					success:function(data){
						if(data.success){
							alert("변경에 성공하였습니다.");
							$.each(data.posts,function(key,val){
								$("#status_"+val.mb_no).html(val.mb_status);
							});
						}
						if(!data.success){
							alert("변경에 실패하였습니다.");
						}
					}
			});
			alert(code+" : "+param);
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
	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<div class="container-fluid">

    <div class='row'>
	<?php
			echo form_open('prq/board/distributors/ci_board', array('id'=>'bd_search', 'class'=>'well form-search'));
?>
			<!--form id="bd_search" method="post" class="well form-search" -->

<input type="hidden" name="page" id="page" value="<?php echo $this->uri->segment(5);?>">
<input type="hidden" name="mb_code" id="mb_code" value="DS">
		<!-- id="my-awesome-dropzone" class="" -->
        <div class="wrapper wrapper-content animated fadeInRight">
			<div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5><span class="mb_gname">총판</span> 등록 정보 입니다. <small><span class="mb_gname">총판</span>의 정보 및 계약서를 작성해 주세요.</small></h5>
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
                <label for="user_title"><span class="mb_gname">총판</span>명</label>
                <input class="form-control" id="user_title" name="user[title]" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
        <div class='col-sm-6'>
            <div class='form-group'>
                <label for="user_firstname"><span class="mb_gname">총판</span>ID</label>
                <input class="form-control" id="user_firstname" name="mb_status" required="true" size="30" type="text" />
            </div><!-- .form-group -->
        </div><!-- .col-sm-6 -->
    </div><!-- .row -->
    <div class='row'>
        <div class='col-sm-12'>
            <div class='form-group'>
                <label for="user_email"><span class="mb_gname">총판</span> 목록</label>
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
				'id' => 'write_action'
			);
			echo form_open('board/write/ci_board', $attributes);
		?>
	<div class='col-sm-12'>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wait');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('process');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list();">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list();">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list();">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list();">해지</button>
</div><!-- .btn_area -->

		<table cellspacing="0" cellpadding="0" class="table table-striped">
			<thead>
				<tr>
					<th scope="col"><input type="checkbox"></th>
					<th scope="col">No</th>
					<th scope="col">등록일자</th>
					<th scope="col"><span class="mb_gname">총판</span>ID</th>
					<th scope="col"><span class="mb_gname">총판</span>코드</th>
					<!-- <th scope="col">구분</th> -->
					<!-- <th scope="col">대리점</th> -->
					<th scope="col"><span class="mb_gname">총판</span>상태</th>
					<th scope="col">비고</th>
				</tr>
			</thead>
			<tbody>
<?php
foreach ($list as $lt)
{
?>
				<tr>
					<td scope="col"><input type="checkbox" name="chk_seq[]" value="<?php echo $lt->mb_no;?>" onclick="chk_btn_status()"></td>
					<td scope="row"><?php echo $lt->mb_no;?></td>
					<td>
					<a rel="external" href="/prq/<?php echo $this->uri->segment(1);?>/view/<?php echo $this->uri->segment(3);?>/board_id/<?php echo $lt->mb_no;?>/page/<?php echo $page;?>"><?php echo $lt->mb_datetime;?></a></td>
					<td><?php echo $lt->mb_id;?></td>
					<td><?php echo $lt->mb_code;?></td>
					<!-- <td><?php echo $lt->mb_gname_kor;?></td> -->
					<!-- <td><?php echo $lt->mb_gname_eng;?></td> -->
					<!-- <td><?php echo $lt->mb_business_paper;?></td> -->
 					 <td><!-- <time datetime="<?php echo mdate("%Y-%M-%j", human_to_unix($lt->reg_date));?>">  -->
					 <?php //echo mdate("%y-%m-%d",human_to_unix($lt->reg_date));?><!-- </time> -->
					
					<span id="status_<?php echo $lt->mb_no;?>"><?php echo $controllers->get_status($lt->mb_status);?></span>
					</td>
 					<td><span class="mb_gname">총판</span></td> 
 					<td>46	</td> 
 					<td>
			</td> 
 					<td>-</td> 
				</tr>
<?php
}
?>

			</tbody>
			<tfoot>
				<tr>
					<th colspan="12" style="text-align:center">
					<ul class="pagination pagination-lg"><?php echo $pagination;?></ul><!-- .pagination --></th>
				</tr>
			</tfoot>
		</table>
<div class="btn_area">
<button type="button" class="btn btn-sm btn-default" onclick="chg_list('wa');">대기</button>
<button type="button" class="btn btn-sm btn-primary" onclick="chg_list('pr');">처리중</button>
<button type="button" class="btn btn-sm btn-success" onclick="chg_list('ac');">승인</button>
<button type="button" class="btn btn-sm btn-danger" onclick="chg_list('ad');">승인거부</button>
<button type="button" class="btn btn-sm btn-info" onclick="chg_list('ec');">연계완료</button>
<button type="button" class="btn btn-sm btn-warning" onclick="chg_list('ca');">해지</button>
</div><!-- .btn_area -->


</div>
</div>
</div>
<div class="row">        <div class='col-sm-11'></div><div class='col-sm-1'> <a href="javascript:set_write();" class="btn btn-success">쓰기</a></div></div>
	</article>
	