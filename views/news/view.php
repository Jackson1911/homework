<div class="viewstyle">
	<h3>Просмотр новости</h3>
	<hr>
	<form action="/news/view?id=<?= $_GET['id']; ?>">
		<div>
			<h3><?= $data->title; ?></h3>
			<em>Опубликовано: <?= $data->date; ?></em>
			<p><?= $data->content; ?></p>
			<hr>
			<a href="/news/index">Вернуться на главную</a>
		</div>
	</form
</div>
