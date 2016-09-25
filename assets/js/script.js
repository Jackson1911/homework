/**
 * [ajaxNewsCreate функция добавления новости посредством AJAX]
 */
function ajaxNewsCreate(event){

	event.preventDefault();
	console.log('do things...');

	// Заносим в переменную formData данные с формы
	var formData = $('form').serialize();

	//Делаем запрос. Передаем данные.
	$.ajax({
		type: 'post',
		url: '/news/AjaxCreate',
		data: formData,

		//Перед отправкой запроса:
		//Проверяем не пустые ли значения
		//Выводим блок который перекрывает остальные элементы(во избежание повторной отправки запроса)
		beforeSend: function(){
			$('.block').show();
			if ($('form').find('input[name=name]').val() == '') 
			{	
				return false;

			} else if ($('form').find('input[name=date]').val() == '') 
			{
				return false;

			} else if ($('form').find('textarea[name=content]').val() == '') 
			{
				return false;
			} else {
				return true;
			}
		},

		//В случае успеха выводим уведомление
		success: function(){
			$(".success_msg").html('Новость добавлена');
			$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
		},

		//в случае ошибки выводим уведомление
		//И делаем редирект
		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднеее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 3000);	
		},

		//В случае успешного завершения запроса
		//Делаем редирект
		complete: function(){
			setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 2000);
		}
	})
}

/**
 * [ajaxNewsUpdate функция обновления новости]
 * 
 * @param  {int} id    [id обновляемой новости]
 */
 function ajaxNewsUpdate(event, id){

 	event.preventDefault();
	console.log('do things...');

	var id;
 	var formData = $('form').serialize();

 	$.ajax({
 		url: '/news/AjaxUpdate?id=' + id,
 		method: 'post',
 		data: formData,

 		beforeSend: function(){
 			$('.block').show();
 		},

 		success: function(){
			$(".success_msg").html('Новость обновлена');
			$(".success_box").fadeIn(500).delay(1000).fadeOut(500);	
		},

		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднеее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 3000);	
		},

		complete: function(){
			setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 2000);
		}
 	})
 }

/**
 * [ajaxNewsDelete Функция удаления новости]
 * @param  {int} id [id удаляемой новости]
 */
 function ajaxNewsDelete(id){

 	var id;

 	$.ajax({
 		url: '/news/AjaxDelete?id=' + id,

 		beforeSend: function(){
 			$('.block').show();
 		},

 		success: function(){
			$(".success_msg").html('Новость удалена');
			$(".success_box").fadeIn(500).delay(1000).fadeOut(500);		
		},

		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднеее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 3000);	
		},

		complete: function(){
			setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 2000);
		}
 	})
 }