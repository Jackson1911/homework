<?php foreach ($data as $value): ?>
	<div class="mainstyle">
		<h3><a href="/news/view?id=<?= $value->id; ?>"><?= $value->title; ?></a></h3>
		<em>Опубликовано: <?= $value->date; ?></em>
		<p><?= $value->content; ?></p>
	</div>	
<?php endforeach ?>

