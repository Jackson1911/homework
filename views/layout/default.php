<!DOCTYPE html>
<html>
<head>
	<title>Новостной сайт</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
	<script type="text/javascript" src="/assets/js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/assets/js/script.js"></script>
</head>
<body>
	<div class="block"></div>
	<div class="header container-fluid">
		<div class="row">
			<div class=" nav container">
				<div class="col-md-1"><a href="/news/index"><span class="glyphicon glyphicon-globe"></span> News</a></div>
				<div class="col-md-3"><a href="/news/newsadmin"><span class="glyphicon glyphicon-user"></span> Управление новостями</a></div>
			</div>
		</div>
		</div>
		<div class="container">
			<div class="content">
				<?php echo $content; ?>
			</div>
		</div>
		
		<div class="error_box">
			<div class="error_msg"></div>	
		</div>
		<div class="success_box">
			<div class="success_msg"></div>	
		</div>
</body>
</html>
