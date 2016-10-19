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