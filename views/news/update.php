<div class="updatestyle">
	<h3>Редактировать новость</h3>
	<hr>
	<form method="POST" action="/news/UpdateProcess?id=<?= $_GET['id']; ?>">
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
			<input type="submit" name="submit" value="Сохранить">
		</div>
	</form>
</div>
