<div class="col-md-10 col-md-offset-1">
<?php foreach ($data as $value): ?>
	<div class="lenta">
		<h3><a href="/news/view?id=<?= $value->id; ?>"><?= $value->title; ?></a></h3>
		<em>Опубликовано: <?= $value->date; ?></em>
		<p><?= $value->content; ?></p>
	</div>	
<?php endforeach ?>
</div>

