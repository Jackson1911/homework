<?php if ($data == true): ?>
	<div class="view col-md-7 col-md-offset-2">
		<h3>Ваш профиль:</h3>
		<hr>
		<label>Логин: </label><p><?= $data['login']; ?></p>
		<label>E-mail: </label><p><?= $data['email']; ?></p>
		<hr>
		<label>Имя: </label><p><?= $data['name']; ?></p>
		<label>Фамилия: </label><p><?= $data['surname']; ?></p>
		<label>Дата рождения: </label><p><?= $data['birth_date']; ?></p>
		<hr>
		<a class="btn btn-default" href="/users/editProfile?id=1">Редактировать профиль</a><br>
	</div>
	<div>
		
	</div>
<?php else : ?>
	<div class="view col-md-7 col-md-offset-2">
		<h3>Ваш профиль:</h3>
		<hr>
		<p>Вы еще не заполнили информацию о себе, нажмите "Добавить профиль" и заполните поля.</p>
		<a class="btn btn-default" href="/users/createProfile?id=1">Добавить профиль</a><br>
	</div>
<?php endif ?>