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
		dataType: 'json',

		//Перед отправкой запроса:
		//Проверяем не пустые ли значения
		//Выводим блок который перекрывает остальные элементы(во избежание повторной отправки запроса)
		beforeSend: function(){
			$('.block').show();
		},

		//В случае успеха выводим уведомление
		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Вы не заполнили все поля.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				$('.block').hide();
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Новость добавлена');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 2000);
			}	
		},
		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			$('.block').hide();
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

 	var formData = $('form').serialize();

 	$.ajax({
 		url: '/news/AjaxUpdate?id=' + id,
 		method: 'post',
 		data: formData,
 		dataType: 'json',

 		beforeSend: function(){
 			$('.block').show();
 		},

 		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Ошибка обновления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				$('.block').hide();
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Новость обновлена');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 2000);
			}	
		},

		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			$('.block').hide();
		},
 	})
 }

/**
 * [ajaxNewsDelete Функция удаления новости]
 * @param  {int} id [id удаляемой новости]
 */
 function ajaxNewsDelete(id){

 	$.ajax({
 		url: '/news/AjaxDelete?id=' + id,
 		dataType: 'json',

 		beforeSend: function(){
 			$('.block').show();
 		},

 		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Ошибка удаления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				$('.block').hide();
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Новость удалена');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
				window.location.href = "/news/newsadmin";
			}, 2000);
			}	
		},

		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			$('.block').hide();
		},
 	})
 }
