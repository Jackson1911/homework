<div class="col-md-6 col-md-offset-3">
	<form class="forms" role="form" onsubmit="ajaxCreateProfile(event, <?= $_SESSION['user_id']; ?>)">
		<h3>Создание профиля</h3>
		<hr>
		<div class="form-group">
			<label>Имя:</label>
			<input class="form-control" type="text" name="user_name">
		</div>
		<div class="form-group">
			<label>Фамилия:</label>
			<input class="form-control" type="text" name="user_surname">
		</div>
		
		<div class="form-group">
			<label>Дата рождения:</label>
			<input class="form-control" type="date" name="user_birth_date">
		</div>
		<div class="form-group">
			<label>Фото:</label>
			<input type="file" name="user_photo">
		</div>	
		<input class="btn btn-success" type="submit" name="submit" value="Сохранить">
	</form>
</div>