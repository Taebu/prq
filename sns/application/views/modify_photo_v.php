	<script>
		$(document).ready(function(){
			$("#write_btn").click(function(){
				if($("#input01").val() == ''){
					alert('업로드할 파일을 선택해주세요.');
					$("#input01").focus();
					return false;
				} else {
					$("#upload_action").submit();
				}
			});
		});
	</script>
	<article id="board_area">
		<header>
			<h1></h1>
		</header>
<?php
$attributes = array('class' => 'form-horizontal', 'id' => 'upload_action');
echo form_open_multipart('/controlls/modify_photo/'.$views->id, $attributes);
?>
		  <fieldset>
		    <legend>SNS 쓰기</legend>
		    <div class="control-group">
			  <label class="control-label" for="input01">사진</label>
		      <div class="controls">
				<img src="/sns/uploads/<?php echo $views->file_name;?>"><br>
				파일명 : <?php echo $views->original_name;?>
		        <p class="help-block"></p>
		      </div>
		      <label class="control-label" for="input02">사진 수정</label>
		      <div class="controls">
		        <input type="file" class="input-xlarge" id="input02" name="userfile" value="<?php echo set_value('userfile'); ?>">
		        <p class="help-block">수정하려는 파일을 선택해주세요. 선택하지 않으면 수정되지 않습니다.</p>
		      </div>
			  <label class="control-label" for="input03">제목</label>
		      <div class="controls">
		        <input type="text" class="input-xlarge" id="input03" name="subject" value="<?php echo $views->subject; ?>">
		        <p class="help-block">제목을 써주세요.</p>
		      </div>
		      <label class="control-label" for="input04">내용</label>
		      <div class="controls">
		        <textarea class="input-xlarge" id="input04" name="contents" rows="5"><?php echo $views->contents; ?></textarea>
		        <p class="help-block">내용을 써주세요.</p>
		      </div>

			  <div class="controls">
		        <p class="help-block">
<?php
if(@$error) {
	echo $error."<BR>";
}
?>
				<?php echo validation_errors(); ?></p>
		      </div>

		      <div class="form-actions">
		        <button type="button" class="btn btn-primary" id="write_btn">수정</button>
		        <button class="btn" onclick="document.location.reload()">취소</button>
		      </div>
		    </div>
		  </fieldset>
		</form>
	</article>