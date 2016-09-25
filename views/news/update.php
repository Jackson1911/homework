<div class="updatestyle">
	<h3>Редактировать новость</h3>
	<hr>
	<form action="/assets/js/script.js" onsubmit="ajaxNewsUpdate(event, <?= $data->id ?>)">
		<div>
			<p>После того как закончите редактировать данную новость нажмите на кнопку "Сохранить":</p>
			<label>Заголовок: <br>
				<input type="text" name="title" value="<?= $data->title; ?>">
			</label><br>
			<label>Дата публикации: <br>
				<input type="date" name="date" value="<?= $data->date; ?>">
			</label><br>
			<label>Содержимое: <br>
				<textarea name="content"><?= $data->content; ?></textarea>
			</label><br>
			<input id="submit-btn" type="submit" value="Сохранить">
		</div>
	</form>
</div>
