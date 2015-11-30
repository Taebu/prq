	<article id="board_area">
		<header>
			<h1></h1>
		</header>

		<?php echo validation_errors(); ?>
		<?php
		if( form_error('username') ) {
			$error_username = form_error('username');
		}
		else
		{
			$error_username = form_error('username_check');
		}
		?>
		<form method="post" class="form-horizontal">
			<fieldset>
				<legend>폼 검증</legend>
				<div class="control-group">
					<label class="control-label" for="input01">아이디</label>
					<div class="controls">
						<input type="text" name="username" class="input-xlarge" id="input01" value="<?php echo set_value('username'); ?>">
						<p class="help-block"><?php if( $error_username == FALSE ) { echo "아이디를 입력하세요"; } else { echo $error_username; }?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input02">비밀번호</label>
					<div class="controls">
						<input type="text" name="password" class="input-xlarge" id="input02" value="<?php echo set_value('password'); ?>">
						<p class="help-block"><?php if(form_error('password') == FALSE ) { echo "비밀번호를 입력하세요"; } else { echo  form_error('password'); } ?></p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input03">비밀번호 확인</label>
					<div class="controls">
						<input type="text" name="passconf" class="input-xlarge" id="input03" value="<?php echo set_value('passconf'); ?>">
						<p class="help-block">비밀번호를 한번 더 입력하세요</p>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="input04">이메일</label>
					<div class="controls">
						<input type="text" name="email" class="input-xlarge" id="input04" value="<?php echo set_value('email'); ?>">
						<p class="help-block">이메일을 입력하세요</p>
				</div>
				<div class="control-group">
					<label class="control-label" for="input05">기본 값 설정</label>
					<div class="controls">
						<input type="text" name="count" id="input05" value="<?php echo set_value('count', '0'); ?>">
						<p class="help-block">기본값이 출력됩니다</p>
				</div>
				<div class="control-group">
					<label class="control-label" for="input06">셀렉트값 복원</label>
					<div class="controls">
						<select name="myselect" id="input06">
						<option value="one" <?php echo set_select('myselect', 'one', TRUE); ?> >One</option>
						<option value="two" <?php echo set_select('myselect', 'two'); ?> >Two</option>
						<option value="three" <?php echo set_select('myselect', 'three'); ?> >Three</option>
						</select>
						<p class="help-block">셀렉트하세요</p>
				</div>
				<div class="control-group">
					<label class="control-label" for="input07">체크박스</label>
					<div class="controls">
						1번 <input type="checkbox" name="mycheck[]" id="input07" value="1" <?php echo set_checkbox('mycheck[]', '1', TRUE); ?> />
						2번 <input type="checkbox" name="mycheck[]" id="input07" value="2" <?php echo set_checkbox('mycheck[]', '2'); ?> />
						<p class="help-block">체크박스를 선택하세요</p>
				</div>
				<div class="control-group">
					<label class="control-label" for="input08">라디오</label>
					<div class="controls">
						1번 <input type="radio" name="myradio" id="input08" value="1" <?php echo set_radio('myradio', '1', TRUE); ?> />
						2번 <input type="radio" name="myradio" id="input08" value="2" <?php echo set_radio('myradio', '2'); ?> />
						<p class="help-block">라디오버튼을 선택하세요</p>
				</div>
			</fieldset>


		<div><input type="submit" value="전송" class="btn btn-primary" /></div>

		</form>
	</article>