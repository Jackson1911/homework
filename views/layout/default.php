<!DOCTYPE html>
<html>
<head>
	<title>Новостной сайт</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/views/styles.css">
	<script type="text/javascript" src="/assets/js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/assets/js/script.js"></script>
</head>
<body>
	<div class="block" style="opacity: 0.7; background: grey; position: fixed; width:100%; height: 100%; display: none;"></div>
	<div class="header">
		<div class="header-container">
			<h2><a href="/news/index">Новостной сайт</a>
			</h2><div class="admin"><a href="/news/newsadmin">Управление новостями</a></div>
		</div>
	</div>
	<div class="container">
		<?php echo $content; ?>
	</div>
	<div class="error_box">
		<div class="error_msg"></div>	
	</div>
	<div class="success_box">
		<div class="success_msg"></div>	
	</div>

</body>
</html>
