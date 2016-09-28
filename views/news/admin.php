<div class="admin-panel">
	<h3>Управление новостями</h3>
	<hr>
	<a class="btn btn-success" href="/news/create"><i class="glyphicon glyphicon-plus"></i> Добавить новую новость</a>
	
<?php if (!empty($data)): ?>
	<table class="table table-striped table-hover admin-table">
		<tr class="info">
			<th>Заголовок:</th>
			<th class="text-center">Дата публикации:</th>
			<th colspan="3">Действия:</th>
		</tr>
<?php else: ?>
	<p>Новости отсутствуют...</p>
<?php endif; ?>
			
	<?php foreach ($data as $value): ?>
		<tr>
			<td><?= $value->title; ?></td>
			<td class="text-center"><?= $value->date; ?></td>
			<td width="1">
				<a title="Посмотреть" class="btn btn-success btn-xs" href="/news/view?id=<?= $value->id; ?>">
					<i class="glyphicon glyphicon-eye-open"></i>
				</a>
			</td>
			<td width="1">
				<a title="Редактировать" class="btn btn-warning btn-xs" href="/news/update?id=<?= $value->id; ?>">
					<i class="glyphicon glyphicon-pencil"></i>
				</a>
			</td>
			<td width="1">
				<a title="Удалить" class="btn btn-danger btn-xs" onclick="ajaxNewsDelete(<?= $value->id; ?>)">
					<i class="glyphicon glyphicon-remove"></i>
				</a>
			</td>
		</tr>
	<?php endforeach ?>	
	</table>
	<a class="btn btn-default" href="/news/index"><i class="glyphicon glyphicon-chevron-left"></i> Вернуться на главную</a>
</div>
