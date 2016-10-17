<?php if ($data == true): ?>
	<div class="view col-md-7 col-md-offset-2">
		<h3>Профиль:</h3>
		<hr>

		<?php if (empty($data['photo'])): ?>
			<img style="width: 200px; height: 200px; margin-bottom: 20px;" src="/uploads/avatar.jpg"><br>
		<?php else : ?>
			<img style="width: 200px; height: 200px; margin-bottom: 20px;" src="<?= $data['photo']; ?>"><br>
		<?php endif ?>

		<label>Логин: </label><p><?= $data['login']; ?></p>
		<label>E-mail: </label><p><?= $data['email']; ?></p>
		<hr>
		<?php if (!empty($data['name'])): ?>
			<label>Имя: </label><p><?= $data['name']; ?></p>
		<?php endif ?>
		<?php if (!empty($data['surname'])): ?>
			<label>Фамилия: </label><p><?= $data['surname']; ?></p>
		<?php endif ?>
		<?php if (!empty($data['birth_date']) && $data['birth_date'] != '0000-00-00'): ?>
			<label>Дата рождения: </label><p><?= $data['birth_date']; ?></p>
		<?php endif ?>		
		<hr>
		<?php if (isset($_SESSION['user_id']) && $_GET['id'] == $_SESSION['user_id']): ?>
			<a class="btn btn-default" href="/users/editProfile?id=<?= $data['id']; ?>">Редактировать профиль</a><br>
		<?php endif ?>
	</div>
<?php else : ?>
	<div class="view col-md-7 col-md-offset-2">
		<h3>Профиль:</h3>
		<hr>
		<?php if ($_GET['id'] == $_SESSION['user_id']): ?>
			<p>Вы еще не заполнили информацию о себе, нажмите "Добавить профиль" и заполните поля.</p>
			<a class="btn btn-default" href="/users/createProfile?id=<?= $data['id']; ?>">Добавить профиль</a><br>
		<?php else : ?>
			<p>Пользователь <b><?= $data['login']; ?></b> еще не заполнил информацию о себе.</p>
		<?php endif ?>	
	</div>	
<?php endif ?>