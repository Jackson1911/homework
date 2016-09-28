<form class="forms" role="form" onsubmit="ajaxNewsCreate(event)">
	<h3>Добавить новость</h3>
	<small>Для добавления новости заполните все поля и нажмите на кнопку "Добавить":</small>
	<hr>
	<div class="form-group">
		<label>Заголовок:</label>
		<input class="form-control" type="text" name="name" placeholder="Заголовок..." required autofocus>
	</div>
	<div class="form-group">
		<label>Дата публикации:</label>
		<input class="form-control" type="date" name="date" required>
	</div>
	<div class="form-group">
		<label>Содержимое:</label>
		<textarea class="form-control" name="content" placeholder="Текст статьи..." rows="13" required></textarea>
	</div>
	<input class="btn btn-success form-control" id="submit-btn" type="submit" value="Добавить">
</form>

