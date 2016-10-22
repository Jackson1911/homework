<div class="col-md-7 col-md-offset-2">
	<form class="forms" role="form" onsubmit="ajaxNewsCreate(event)">
		<h3>Добавить новость</h3>
		<small>Для добавления новости заполните все поля и нажмите на кнопку "Добавить":</small>
		<hr>
		<div class="form-group">
			<label>Заголовок:</label>
			<input class="form-control" type="text" name="name" placeholder="Заголовок..." required autofocus>
		</div>
		<div class="form-group">
			<label>Категория:</label>
			<?php if (!empty($data)): ?>
				<select class="form-control" type="select" name="select_category">
					<option value="0">Без категории</option>
				<?php foreach ($data as $value): ?>
					<option value="<?= $value->id; ?>"><?= $value->name; ?></option>
				<?php endforeach ?>	
				</select>		
			<?php endif ?>
		</div>
		<div class="form-group">
			<label>Дата публикации:</label>
			<input class="form-control" type="date" name="date" required>
		</div>
		<div class="form-group">
			<label>Содержимое:</label>
			<textarea class="form-control" name="content" placeholder="Текст статьи..." rows="13" required></textarea>
		</div>
		<input class="btn btn-success form-control" id="submit-btn" type="submit" value="Добавить">
	</form>
</div>
<div id="modal-create" class="modal fade" tabindex="-1" role="dialog"></div><!-- /.modal -->

