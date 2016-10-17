<form class="forms" role="form" onsubmit="ajaxNewsCreate(event)">
	<h3>Добавить новость</h3>
	<small>Для добавления новости заполните все поля и нажмите на кнопку "Добавить":</small>
	<hr>
	<div class="form-group">
		<label>Заголовок:</label>
		<input class="form-control" type="text" name="name" placeholder="Заголовок..." required autofocus>
	</div>
	<div class="form-group">
		<label>Дата публикации:</label>
		<input class="form-control" type="date" name="date" required>
	</div>
	<div class="form-group">
		<label>Содержимое:</label>
		<textarea class="form-control" name="content" placeholder="Текст статьи..." rows="13" required></textarea>
	</div>
	<div class="form-group">
		<label>Категория:</label>
		<?php if (!empty($data)): ?>
			<select class="form-group" type="select" name="select_category">
			<?php foreach ($data as $value): ?>
				<option value="<?= $value->id; ?>"><?= $value->name; ?></option>
			<?php endforeach ?>	
			</select>		
		<?php endif ?>
	</div>
	<input class="btn btn-success form-control" id="submit-btn" type="submit" value="Добавить">
</form>

<div id="modal-create" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="margin-top: 70px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #449d44";>
        <h4 class="modal-title" style="color: #fff";>Добавление новости</h4>
      </div>
      <div class="modal-body">
        <p id="modal-text">Этот процесс необратим. Вы уверены что хотите добавить данную новость?&hellip;</p>
      </div>
      <div class="modal-footer">
        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button id="modal-save" type="button" class="btn btn-success">Добавить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

