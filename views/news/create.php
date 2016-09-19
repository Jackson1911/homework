<div class="createstyle">
	<h3>Добавить новость</h3>
	<hr>
	<form method="POST" action="/news/CreateProcess">
		<div>
			<p>Для добавления новости заполните следующие поля и нажмите на кнопку "Добавить":</p>
			<label>Заголовок: <br>
				<input type="text" name="name" required autofocus>
			</label><br>
			<label>Дата публикации: <br>
				<input type="date" name="date" required>
			</label><br>
			<label>Содержимое: <br>
				<textarea name="content" required></textarea>
			</label><br>
			<input type="submit" name="submit" value="Добавить">
		</div>
	</form>
</div>

