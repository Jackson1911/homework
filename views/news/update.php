<form class="forms" role="form" onsubmit="ajaxNewsUpdate(event, <?= $data->id ?>)">
	<h3>Редактировать новость</h3>
	<small>После того как закончите редактировать данную новость, нажмите "Сохранить"</small>
	<hr>
	<div class="form-group">
		<label>Заголовок:</label>
		<input class="form-control" type="text" name="title" value="<?= $data->title; ?>">		
	</div>
	<div class="form-group">
		<label>Дата публикации:</label>
		<input class="form-control" type="date" name="date" value="<?= $data->date; ?>">
	</div>
	<div class="form-group">
		<label>Содержимое:</label>
		<textarea class="form-control" name="content" placeholder="Текст статьи..." rows="13"><?= $data->content; ?></textarea>
	</div>
	<input class="btn btn-success form-control" id="submit-btn" type="submit" value="Сохранить">
</form>
