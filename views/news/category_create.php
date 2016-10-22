<div class="col-md-7 col-md-offset-2">
	<form id="category_create" class="forms" role="form" onsubmit="ajaxCategoryCreate(event)">
		<h3>Добавление категории</h3>
		<hr>
		<div class="form-group">
			<label>Наименование:</label>
			<input class="form-control" type="text" name="category_name" placeholder="Введите название категории..." size="30" required autofocus>
		</div>
		<input type="submit" class="btn btn-success form-control" value="Добавить категорию">
	</form>
</div>
<div id="modal" class="modal fade" tabindex="-1" role="dialog"></div><!-- /.modal -->