<form class="forms" role="form" onsubmit="ajaxNewsUpdate(event, <?= $data->id ?>)">
	<h3>Редактировать новость</h3>
	<small>После того как закончите редактировать данную новость, нажмите "Сохранить"</small>
	<hr>
	<div class="form-group">
		<label>Заголовок:</label>
		<input class="form-control" type="text" name="title" value="<?= $data->title; ?>">		
	</div>
	<div class="form-group">
		<label>Категория:</label>
		<?php if (!empty($categories)): ?>
			<select class="form-control" type="select" name="select_category">
			<?php foreach ($categories as $value): ?>
				<option value="<?= $value->id; ?>"<?= $data->category_id == $value->id ? 'selected' : ""?>><?= $value->name; ?></option>
			<?php endforeach ?>	
			</select>		
		<?php endif ?>
	</div>
	<div class="form-group">
		<label>Дата публикации:</label>
		<input class="form-control" type="date" name="date" value="<?= $data->date; ?>">
	</div>
	<div class="form-group">
		<label>Содержимое:</label>
		<textarea class="form-control" name="content" placeholder="Текст статьи..." rows="13"><?= $data->content; ?></textarea>
	</div>
	<input class="btn btn-success form-control" id="submit-btn" type="submit" value="Сохранить">
</form>

<div id="modal-update" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document" style="margin-top: 70px;">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #449d44";>
        <h4 class="modal-title" style="color: #fff";>Редактирование новости</h4>
      </div>
      <div class="modal-body">
        <p id="modal-text">Этот процесс необратим. Вы уверены что хотите сохранить изменения?&hellip;</p>
      </div>
      <div class="modal-footer">
        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
        <button id="modal-save" type="button" class="btn btn-success">Сохранить</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
