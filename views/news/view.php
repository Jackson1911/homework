<?php 
use classes\SysUser;
?>

<div class="news-view">
	<h3>Просмотр новости</h3>
	<hr>
	<?php if ($category != false): ?>
		Категория: <a href="#"><?= $category->name; ?></a>
	<?php endif ?>	
		<div>
			<h3><?= $news->title; ?></h3>
			<em>Опубликовано: <?= $news->date; ?></em>
			<p><?= $news->content; ?></p>
			<hr>
			<a class="btn btn-default" href="/news/index"><i class="glyphicon glyphicon-chevron-left"></i> Вернуться на главную</a>
		</div>
</div>
<div class="news-view">

<?php if (empty($_SESSION['user_id'])): ?>

	<p>Оставлять комментарии могут только зарегистрированные пользователи.</p>

<?php elseif (SysUser::checkProfile() == false): ?>

	<p>Вы не можете добавлять комментприи пока не создадите <a href="/users/profile?id=<?= $_SESSION['user_id']?>"> профиль</a></p>

<?php else : ?>

	<form onsubmit="ajaxCreateComment(event, <?= $_GET['id']; ?>)">
		<div class="form-group">
			<label><small>Оставьте ваш комментарий:</small></label>
			<textarea class="form-control" name="content" placeholder="Напишите здесь свой комментарий..." rows="6"></textarea>
		</div>
		<div class="form-group">
			<input class="btn btn-success" type="submit" name="submit" value="Отправить">
		</div>
	</form>

<?php endif ?>
	
</div>
<div style="margin-bottom: 80px; padding: 20px;" class="news-view">
<h3>Комментарии:</h3>
<hr>
<?php if (empty($comments)): ?>
	<p>Эту новость еще никто не прокомментировал...</p><br>
	<p>Вы можете быть первым!</p>
<?php else : ?>
	<?php foreach ($comments as $value): ?>
	<div class="comment" style="margin-bottom: 5px; padding: 0 0 0 20px">
		<div style="float: left;" class="avatar"><img style="width: 50px; height: 50px; margin-right: 20px;" src="<?= $value['photo']; ?>"></div>
		<div class="user_name" style="margin-left: 70px">
			<b><a href="/users/profile?id=<?= $value['user_id']; ?>"><?= $value['login']; ?></a></b>
		</div>
		<div class="date" style="margin-left: 70px">
			<em><small><?= $value['date_create']; ?></small></em>
		</div>
		<div class="content" style="margin-left: 70px">
			<p><?= $value['comm_content']; ?></p>
		</div>
		<?php if (SysUser::getRole() == 'admin'): ?>
			<a title="Редактировать" class="btn btn-warning btn-xs" href="/news/comment_update?id=<?= $value['comments_id']; ?>">
				<i class="glyphicon glyphicon-pencil"></i>
				Редактировать
			</a>
			<a title="Удалить" class="btn btn-danger btn-xs" onclick="ajaxDeleteComment(event, <?= $_GET['id']; ?>, <?= $value['comments_id']; ?>)">
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


