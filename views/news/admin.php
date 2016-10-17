<?php 
use classes\SysUser;
?>

<div class="view col-md-2">
	<ul>
		<li><a href="/news/newsadmin">Новости</a></li>
		<li><a href="/news/categories">Категории</a></li>
	</ul>
</div>

<div class="admin-panel col-md-9" style="margin-left:10px;">
	<h3>Управление новостями</h3>
	<hr>
	<a class="btn btn-success" href="/news/create"><i class="glyphicon glyphicon-plus"></i> Добавить новую новость</a>
	
<?php if (!empty($data)): ?>
	<table class="table table-striped table-hover admin-table">
		<tr class="info">
			<th>Заголовок:</th>
			<th class="text-center">Дата публикации:</th>
			<th class="text-center">Категория:</th>
			<th colspan="3">Действия:</th>
		</tr>
<?php else: ?>
	<p>Новости отсутствуют...</p>
<?php endif; ?>
			
	<?php foreach ($data as $value): ?>
		<tr>
			<td><?= $value['title']; ?></td>
			<td class="text-center"><?= $value['date']; ?></td>
			<td><?= $value['name']; ?></td>
			<td width="1">
				<a title="Посмотреть" class="btn btn-success btn-xs" href="/news/view?id=<?= $value['news_id']; ?>">
					<i class="glyphicon glyphicon-eye-open"></i>
				</a>
			</td>
			<?php if (SysUser::getRole() == 'admin'): ?>
				<td width="1">
				<a title="Редактировать" class="btn btn-warning btn-xs" href="/news/update?id=<?= $value['news_id']; ?>">
					<i class="glyphicon glyphicon-pencil"></i>
				</a>
				</td>
				<td width="1">
					<a title="Удалить" class="btn btn-danger btn-xs" onclick="ajaxNewsDelete(<?= $value['news_id']; ?>)">
						<i class="glyphicon glyphicon-remove"></i>
					</a>
				</td>
			<?php endif ?>
		</tr>
	<?php endforeach ?>	
	</table>
	<a class="btn btn-default" href="/news/index"><i class="glyphicon glyphicon-chevron-left"></i> Вернуться на главную</a>
</div>

<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="margin-top: 70px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #d9534f";>
        <h4 class="modal-title" style="color: #fff";>Удаление новости</h4>
      </div>
      <div class="modal-body">
        <p id="modal-text">Этот процесс необратим. Вы уверены что хотите удалить данную новость?&hellip;</p>
      </div>
      <div class="modal-footer">
        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button id="modal-save" type="button" class="btn btn-danger">Удалить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->