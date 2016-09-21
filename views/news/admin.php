<div class="adminstyle">
	<h3>Управление новостями</h3>
	<hr>
	<a href="/news/create">Добавить новую новость</a>
	<table border="2" cellspacing="0" cellpadding="0">
		<tr style="font-weight: bold; background: silver; text-align: center">
			<td>Заголовок:</td>
			<td>Дата публикации:</td>
			<td colspan="3">Действия:</td>
		</tr>
	<?php foreach ($data as $value): ?>
		<tr>
			<td><?= $value->title; ?></td>
			<td style="text-align: center"><?= $value->date; ?></td>
			<td style="text-align: center"><a href="/news/view?id=<?= $value->id; ?>">Просмотреть</a></td>
			<td style="text-align: center"><a href="/news/update?id=<?= $value->id; ?>">Редактировать</a></td>
			<td style="text-align: center"><a href="/news/delete?id=<?= $value->id; ?>">Удалить</a></td>
		</tr>
	<?php endforeach ?>	
	</table>
	<a href="/news/index">Вернуться на главную</a>
</div>
