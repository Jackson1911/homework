<form class="forms" role="form" onsubmit="ajaxUpdateComment(event, <?= $data->news_id ?>, <?= $_GET['id'] ?>)">
	<h3>Редактирование комментария</h3>
	<small>После того как закончите редактировать комментарий, нажмите "Сохранить"</small>
	<hr>
	<div class="form-group">
		<label>Содержимое:</label>
		<textarea class="form-control" name="content" rows="13"><?= $data->comm_content; ?></textarea>
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
    </div><!-- /.modal-content
  </div><!-- /.modal-dialog
</div><!-- /.modal
 --> --> -->