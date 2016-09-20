<!DOCTYPE html>
<html>
<head>
	<title>Просмотр новости</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/views/styles.css">
</head>
<body>
	<div class="header">
		<div class="header-container">
			<h2><a href="/news/index">Новостной сайт</a>
			</h2><div class="admin"><a href="/news/newsadmin">Управление новостями</a></div>
		</div>
	</div>
	<div class="container">
		<?php echo $content; ?>
	</div>

</body>
</html>