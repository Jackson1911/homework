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

<div id="modal-update" class="modal fade" tabindex="-1" role="dialog"></div><!-- /.modal -->
