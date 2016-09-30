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

	<div id="myModal" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h4 class="modal-title">Modal title</h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal-text">One fine body&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button id="modal-save" type="button" class="btn btn-primary">Save changes</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
</body>
</html>
