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

			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="/news/index"><span class="glyphicon glyphicon-globe"></span> News</a>
					</div>
					<div class="navbar-inner">	
						<ul class="nav navbar-nav">
							<li><a href="/news/registration"><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>
							<li><a href="/news/newsadmin"><span class="glyphicon glyphicon-user"></span> Управление новостями</a></li>
						</ul>
					</div>
				</div>
			</nav>


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
