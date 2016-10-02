<div class="col-md-6 col-md-offset-3">
<form class="forms form-horizontal" role="form" onsubmit="ajaxUsersAuthorization(event)">
	<h3>Вход</h3>
	<small>Введите данные которые вы указали при регистрации и нажмите "Войти"</small>
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
			<input class="form-control" type="password" name="password" required>
			<span id="helpBlock1" class="help-block"></span>
		</div>
	</div>
	<input class="btn btn-success form-control" type="submit" value="Войти">
	<span class="help-block">или если вы еще не зарегистрированы: <a href="/users/registration">Регистрация</a></span>
</form>
</div>

<div id="block" class="modal fade" tabindex="-1" role="dialog"></div>