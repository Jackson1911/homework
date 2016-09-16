<div style="width: 400px; padding: 20px; border: 1px solid black">
<h3>Форма добавления новой новости</h3>
<hr>
<form method="POST" action="/news/createProcess">
	<div style="">
		<p>Для добавления новости заполните следующие поля:</p>
		<label>Название: <input type="text" name="header"></label><br>
		<label>Дата: <input type="date" name="date"></label><br>
		<label>Содержимое: <textarea name="content"></textarea></label><br>
		<input type="submit" name="submit" value="Добавить">
	</div>
</form>
</div>