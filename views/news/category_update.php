<div class="col-md-7 col-md-offset-2">
  <form class="forms" role="form" onsubmit="ajaxCategoryUpdate(event, <?= $data->id ; ?>)">
  	<h3>Редактирование категории</h3>
  	<hr>
  	<div class="form-group">
      <label>Наименованe:</label>
  		<input class="form-control" type="text" name="category_name" value="<?= $data->name; ?>" size="30" required>
  	</div>
    <input type="submit" class="btn btn-success form-control" value="Сохранить">
  </form>
</div>
<div id="modal" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog" role="document" style="margin-top: 70px;"></div><!-- /.modal -->