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
	<form id="category_create" class="form-inline" onsubmit="ajaxCategoryCreate(event)">
		<div class="form-group">
			<input class="form-control" type="text" name="category_name" placeholder="Введите название категории..." size="30" required autofocus>
			<input type="submit" class="btn btn-success form-control" value="Добавить категорию">
		</div>
	</form>

<?php if (!empty($data)): ?>
	<table class="table table-striped table-hover admin-table">
		<tr class="info">
			<th>Наименование категории:</th>
			<th colspan="3">Действия:</th>
		</tr>
<?php else: ?>
	<p>Категории отсутствуют...</p>
<?php endif; ?>
			
	<?php foreach ($data as $value): ?>
		<tr>
			<td><?= $value->name; ?></td>

			<?php if (SysUser::getRole() == 'admin'): ?>
				<td>
					<form id="category_update<?= $value->id ?>" class="form-inline" onsubmit="ajaxCategoryUpdate(event, <?= $value->id; ?>)" style="display: none">
						<div class="form-group">
							<input class="form-control" type="text" name="category_name" value="<?= $value->name; ?>" size="30" required autofocus>
							<input type="submit" class="btn btn-success form-control" value="OK">
						</div>
					</form>
				</td>
				<td width="1">
				<a id="category_edit" title="Редактировать" class="btn btn-warning btn-xs" onclick="showUpdateForm(<?= $value->id;?>)">
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
      <div class="modal-header" style="background-color: #449d44";>
        <h4 class="modal-title" style="color: #fff";>Добавление категории</h4>
      </div>
      <div class="modal-body">
        <p id="modal-text">Этот процесс необратим. Вы уверены что хотите добавить данную категорию?&hellip;</p>
      </div>
      <div class="modal-footer">
        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button id="modal-save" type="button" class="btn btn-success">Добавить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->