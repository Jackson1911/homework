<?php
use classes\SysUser;

if (isset($_SESSION['user_id'])) {
	$model = new \models\Users();

	$user = $model->findOne(['id' => $_SESSION['user_id']]);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Новостной сайт</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/styles.css">
	<script type="text/javascript" src="/assets/js/jquery-3.1.1.js"></script>
	<script type="text/javascript" src="/assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/assets/js/script.js"></script>
</head>
<body>
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand" href="/news/index"><span class="glyphicon glyphicon-globe"></span> News</a>
			</div>
			<div class="navbar-inner">	
			<?php if (SysUser::getRole() == 'admin'): ?>
				<ul class="nav navbar-nav">	
					<li><a href="/news/newsadmin"><span class="glyphicon glyphicon-user"></span> Управление новостями</a></li>
				</ul>
			<?php endif ?>
				<ul class="nav navbar-nav navbar-right">
					<?php if (empty($_SESSION['user_id'])) : ?>
						<li><a href="/users/authorization"><span class="glyphicon glyphicon-log-in"></span> Войти</a></li>
						<li><a href="/users/registration"><span class="glyphicon glyphicon-user"></span> Регистрация</a></li>
					<?php else: ?>
						<li><a href="/users/profile?id=<?= $_SESSION['user_id']; ?>">Привет, <?= $user->login; ?></a></li>
						<li><a href="#" onclick="ajaxLogOut()"><span class="glyphicon glyphicon-log-out"></span> Выход</a></li>
					<?php endif ?>
				</ul>
			</div>
		</div>
	</nav>

	<div id="block" class="modal fade" tabindex="-1" role="dialog"></div>

	<div class="container col-md-10 col-md-offset-1">
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
