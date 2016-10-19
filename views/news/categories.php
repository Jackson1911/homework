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
	<h3>Категории</h3>
	<hr>
	<a class="btn btn-success" href="/news/categoriesCreate">Добавить категорию</a>
	
<?php if (!empty($data)): ?>
	<table class="table table-striped table-hover admin-table">
		<tr class="info">
			<th>Наименование категории:</th>
			<th colspan="2">Действия:</th>
		</tr>
<?php else: ?>
	<p>Категории отсутствуют...</p>
<?php endif; ?>
			
	<?php foreach ($data as $value): ?>
		<tr>
			<td><?= $value->name; ?></td>

			<?php if (SysUser::getRole() == 'admin'): ?>
				<td width="1">
				<a id="category_edit" href="/news/categoriesUpdate?id=<?= $value->id; ?>" title="Редактировать" class="btn btn-warning btn-xs">
					<i class="glyphicon glyphicon-pencil"></i>
					Редактировать
				</button>
				</td>
				<td width="1">
					<a title="Удалить" class="btn btn-danger btn-xs" onclick="ajaxCategoryDelete(<?= $value->id; ?>)">
						<i class="glyphicon glyphicon-remove"></i>
						Удалить
					</a>
				</td>
			<?php endif ?>
		</tr>
	<?php endforeach ?>	
	</table>
	<a class="btn btn-default" href="/news/newsadmin"><i class="glyphicon glyphicon-chevron-left"></i> Вернуться назад</a>
</div>

<div id="modal-categories" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="margin-top: 70px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #d9534f";>
        <h4 class="modal-title" style="color: #fff";>Удаление категории</h4>
      </div>
      <div class="modal-body">
        <p id="modal-text">Этот процесс необратим. Вы уверены что хотите Удалить данную категорию?&hellip;</p>
      </div>
      <div class="modal-footer">
        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button id="modal-save" type="button" class="btn btn-danger">Удалить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->