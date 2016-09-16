<!DOCTYPE html>
<html>
<head>
	<title>Добавление новой новости</title>
	<meta charset="utf-8">
	<style type="text/css">
		body {background: #50B4D7}
		.container {background: white; width: 400px; padding: 20px; border: 1px solid black; margin-left:30%; margin-right: 30%}
		input {margin-bottom: 10px; width: 90%;}
		textarea {width: 90%; height: 400px;}

	</style>
</head>
<body>
	<div class="container">
		<h3>Форма добавления новой новости</h3>
		<hr>
		<form method="POST" action="/news/CreateProcess">
			<div>
				<p>Для добавления новости заполните следующие поля и нажмите на кнопку "Добавить":</p>
				<label>Заголовок: <br>
					<input type="text" name="name">
				</label><br>
				<label>Дата публикации: <br>
					<input type="date" name="date">
				</label><br>
				<label>Содержимое: <br>
					<textarea name="content"></textarea>
				</label><br>
				<input type="submit" name="submit" value="Добавить">
			</div>
		</form>
	</div>
</body>
</html>
