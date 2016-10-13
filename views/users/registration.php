<form class="forms form-horizontal" role="form" onsubmit="ajaxUsersRegistration(event)">
	<h3>Регистрация пользователей</h3>
	<small>Для успешной регистрации заполните все поля и нажмите "Завершить регистрацию"</small>
	<hr>
	<?php if (!empty($_SESSION['user_id'])): ?>
		<p style="text-align: center; margin: 30px 0 30px 0">Вы уже зарегистрированы в системе.</p>
		<br>
		<p style="text-align: center;">Перейти на <a href="/news/index">главную</a>, или в Ваш <a href="/users/profile?id=<?= $_SESSION['user_id']; ?>">профиль</a></p>
	<?php else : ?>
		<div class="form-group">
			<label class="col-sm-4 control-label">Логин:</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="login" required autofocus>
			</div>
		</div>
		<div class="password form-group">
			<label class="col-sm-4 control-label">Пароль:</label>
			<div class="col-md-6">
				<input id="pass1" class="form-control" type="password" name="pass1" oninput="passwordCompare()" required>
				<span id="helpBlock1" class="help-block"></span>
			</div>
		</div>
		<div class="passwordAccept form-group">
			<label class="col-sm-4 control-label">Повторите пароль:</label>
			<div class="col-md-6">
				<input id="pass2" class="form-control" type="password" name="pass2" oninput="passwordCompare()" required>
				<span id="helpBlock2" class="help-block"></span>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-4 control-label">Адрес электронной почты (e-mail):</label>
			<div class="col-md-6">
				<input class="form-control" type="text" name="email" required>
			</div>
		</div>
		<input class="btn btn-success form-control" type="submit" value="Завершить регистрацию">
	</form>

	<div id="modal-reg" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document" style="margin-top: 70px;">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #449d44";>
	        <h4 class="modal-title" style="color: #fff";>Завершщение регистрации</h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal-text">Этот процесс необратим. Если вы уверены что ввели правильные данные нажмите "Завершить"&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
	        <button id="modal-save" type="button" class="btn btn-success">Завершить</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	<?php endif ?>
	
