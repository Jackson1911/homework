<form class="forms form-horizontal" role="form" onsubmit="ajaxNewsRegistration(event)">
	<h3>Регистрация пользователей</h3>
	<small>Для успешной регистрации заполните все поля и нажмите "Завершить регистрацию"</small>
	<hr>
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