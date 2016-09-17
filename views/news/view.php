<!DOCTYPE html>
<html>
<head>
	<title>Просмотр новости</title>
	<meta charset="utf-8">
	<style type="text/css">
		body {background: #D98CD1}
		.container {background: white; width: 800px; padding: 20px; border: 1px solid black; margin: auto;}
		input {margin-bottom: 10px; width: 90%;}
		textarea {width: 90%; height: 400px;}
	</style>
</head>
<body>
	<div class="container">
		<h3>Просмотр новости</h3>
		<hr>
		<form action="/news/view?id=<?=$_GET['id']?>">
			<div>
				<h3><?=$data['title']?></h3>
				<em>Опубликовано: <?=$data['date']?></em>
				<p><?=$data['content']?></p>
			</div>
		</form
	</div>

</body>
</html>