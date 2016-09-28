<div class="news-view">
	<h3>Просмотр новости</h3>
	<hr>
	<form action="/news/view?id=<?= $_GET['id']; ?>">
		<div>
			<h3><?= $data->title; ?></h3>
			<em>Опубликовано: <?= $data->date; ?></em>
			<p><?= $data->content; ?></p>
			<hr>
			<a class="btn btn-default" href="/news/index"><i class="glyphicon glyphicon-chevron-left"></i> Вернуться на главную</a>
		</div>
	</form>
</div>
