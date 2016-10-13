<?php 
use classes\SysUser;
?>

<div class="news-view">
	<h3>Просмотр новости</h3>
	<hr>
		<div>
			<h3><?= $data->title; ?></h3>
			<em>Опубликовано: <?= $data->date; ?></em>
			<p><?= $data->content; ?></p>
			<hr>
			<a class="btn btn-default" href="/news/index"><i class="glyphicon glyphicon-chevron-left"></i> Вернуться на главную</a>
		</div>
</div>
<div class="news-view">
	<form onsubmit="ajaxCreateComment(event, <?= $_GET['id']; ?>)">
		<div class="form-group">
			<label><small>Оставьте ваш комментарий:</small></label>
			<textarea class="form-control" name="content" placeholder="Напишите здесь свой комментарий..." rows="6"></textarea>
		</div>
		<div class="form-group">
			<input class="btn btn-success" type="submit" name="submit" value="Отправить">
		</div>
	</form>
</div>
<div style="margin-bottom: 80px; padding: 20px;" class="news-view">
<h3>Комментарии:</h3>
<hr>
<?php if (empty($more_data)): ?>
	<p>Эту новость еще никто не прокомментировал...</p><br>
	<p>Вы можете быть первым!</p>
<?php else : ?>
	<?php foreach ($more_data as $value): ?>
	<div class="comment" style="margin-bottom: 5px; padding: 0 0 0 20px">
		<div class="user_name">
			<b><?= $value['login']; ?></b>
		</div>
		<div class="date">
			<em><small><?= $value['date_create']; ?></small></em>
		</div>
		<div class="content">
			<p><?= $value['comm_content']; ?></p>
		</div>
		<?php if (SysUser::getRole() == 'admin'): ?>
			<a title="Редактировать" class="btn btn-warning btn-xs" href="/news/comment_update?id=<?= $value['id']; ?>">
				<i class="glyphicon glyphicon-pencil"></i>
				Редактировать
			</a>
			<a title="Удалить" class="btn btn-danger btn-xs" onclick="ajaxDeleteComment(event, <?= $_GET['id']; ?>, <?= $value['id']; ?>)">
				<i class="glyphicon glyphicon-remove"></i>
				Удалить
			</a>
		<?php endif ?>
		<hr>
	</div>
	<?php endforeach ?>
</div>
	<div id="modal-delete" class="modal fade" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document" style="margin-top: 70px;">
	    <div class="modal-content">
	      <div class="modal-header" style="background-color: #d9534f";>
	        <h4 class="modal-title" style="color: #fff";>Удаление комментария</h4>
	      </div>
	      <div class="modal-body">
	        <p id="modal-text">Этот процесс необратим. Вы уверены что хотите удалить данный комментарий?&hellip;</p>
	      </div>
	      <div class="modal-footer">
	        <button id="modal-close" type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
	        <button id="modal-save" type="button" class="btn btn-danger">Удалить</button>
	      </div>
	    </div><!-- /.modal-content -->
	  </div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
<?php endif ?>


