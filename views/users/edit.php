<div class="col-md-6 col-md-offset-3">
	<form class="forms" role="form" onsubmit="ajaxEditProfile(event, <?= $_SESSION['user_id']; ?>)">
		<h3>Редактирование профиля</h3>
		<hr>
		<div class="form-group">
			<label>Имя:</label>
			<input id="name" class="form-control" type="text" name="user_name" value="<?= $data['name']; ?>">
		</div>
		<div class="form-group">
			<label>Фамилия:</label>
			<input class="form-control" type="text" name="user_surname" value="<?= $data['surname']; ?>">
		</div>
		
		<div class="form-group">
			<label>Дата рождения:</label>
			<input class="form-control" type="date" name="user_birth_date" value="<?= $data['birth_date']; ?>">
		</div>
		<div class="form-group">
			<label>Фото:</label>
			<input type="file" name="user_photo">
		</div>	
		<input class="btn btn-success" type="submit" name="submit" value="Сохранить">
	</form>
</div>