<!DOCTYPE html>
<html>
<head>
	<title>Редактировать новость</title>
	<meta charset="utf-8">
	<style type="text/css">
		body {background: #D03735}
		.container {background: white; width: 800px; padding: 20px; border: 1px solid black; margin: auto;}
		input {margin-bottom: 10px; width: 100%;}
		textarea {width: 100%; height: 400px;}
	</style>
</head>
<body>
	<div class="container">
		<h3>Форма редактирования новости</h3>
		<hr>
		<form method="POST" action="/news/UpdateProcess?id=<?=$_GET['id']?>">
			<div>
				<p>После того как закончите редактировать данную новость нажмите на кнопку "Сохранить":</p>
				<label>Заголовок: <br>
					<input type="text" name="title" value="<?=$data['title']?>">
				</label><br>
				<label>Дата публикации: <br>
					<input type="date" name="date" value="<?=$data['date']?>">
				</label><br>
				<label>Содержимое: <br>
					<textarea name="content"><?=$data['content']?></textarea>
				</label><br>
				<input type="submit" name="submit" value="Сохранить">
			</div>
		</form>
	</div>

</body>
</html>