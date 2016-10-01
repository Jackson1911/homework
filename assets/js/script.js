/**
* [ajaxNewsCreate функция добавления новости посредством AJAX]
*/
function ajaxNewsCreate(event){

	event.preventDefault();
	console.log('do things...');

	// Заносим в переменную formData данные с формы
	var formData = $('form').serialize();

	//Формируем модальное окно
	$('#myModal').modal({backdrop: "static"});
	$('.modal-dialog').css('margin-top','70px');
	$('.modal-header').css('background','#449d44');
	$('.modal-title').html('Добавление новости').css('color','#fff');
	$("#modal-text").html('Этот процесс необратим. Вы уверены что хотите добавить эту новость?');
	$("#modal-close").html('Отмена');
	$("#modal-save").removeClass('btn-primary').addClass('btn-success').html('Добавить');

	//Обрабатываем нажатие кнопки подтверждения действия
	$('#modal-save').click(function(event){

		//В момент выполнения запроса делаем кнопки неактивными
		$('#modal-save').attr('disabled', 'true');
		$('#modal-close').attr('disabled', 'true');

		//Делаем запрос. Передаем данные.
		$.ajax({
			type: 'post',
			url: '/news/AjaxCreate',
			data: formData,
			dataType: 'json',

			//В случае успеха или ошибки выводим уведомление
			success: function(res){
				if (res.status == 'err') {
					$(".error_msg").html('Вы не заполнили все поля.');
					$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
					setTimeout(function() {
						$('#myModal').modal('hide');
						$('#modal-save').removeAttr('disabled');
						$('#modal-close').removeAttr('disabled');
					}, 3000);
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
				setTimeout(function() {
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			}
		})
	});	
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

	//Формируем модальное окно
	$('#myModal').modal({backdrop: "static"});
	$('.modal-dialog').css('margin-top','70px');
	$('.modal-header').css('background','#449d44');
	$('.modal-title').html('Редактирование новости').css('color','#fff');
	$("#modal-text").html('Этот процесс необратим. Вы уверены что хотите сохранить изменения?');
	$("#modal-close").html('Отмена');
	$("#modal-save").removeClass('btn-primary').addClass('btn-success').html('Сохранить');

	//Обрабатываем нажатие кнопки подтверждения действия
	$('#modal-save').click(function(event){

		$('#modal-save').attr('disabled', 'true');
		$('#modal-close').attr('disabled', 'true');

		$.ajax({
			url: '/news/AjaxUpdate?id=' + id,
			method: 'post',
			data: formData,
			dataType: 'json',

			success: function(res){
				if (res.status == 'err') {
					$(".error_msg").html('Ошибка обновления');
					$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
					setTimeout(function() {
						$('#myModal').modal('hide');
						$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
					}, 3000);
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
				setTimeout(function() {
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			},
		})
	});	
}

/**
* [ajaxNewsDelete Функция удаления новости]
* @param  {int} id [id удаляемой новости]
*/
function ajaxNewsDelete(id){

	$('#myModal').modal({backdrop: "static"});
	$('.modal-dialog').css('margin-top','70px');
	$('.modal-header').css('background','#d9534f');
	$('.modal-title').html('Удаление новости').css('color','#fff');
	$("#modal-text").html('Этот процесс необратим. Вы уверены что хотите удалить эту новость?');
	$("#modal-close").html('Отмена');
	$("#modal-save").removeClass('btn-primary').addClass('btn-danger').html('Удалить');

	$('#modal-save').click(function(event){

		$('#modal-save').attr('disabled', 'true');
		$('#modal-close').attr('disabled', 'true');

		$.ajax({
		url: '/news/AjaxDelete?id=' + id,
		dataType: 'json',

		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Ошибка удаления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
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
				setTimeout(function() {
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			},
		})
	});	
}

/**
 * [passwordCompare - функция валидации паролей]
 */
function passwordCompare(){

	$(document).ready(function(){
		var password  = $('#pass1').val();
		var passwordAccept = $('#pass2').val();

		if (password != passwordAccept) {
			$('.passwordAccept').removeClass('has-success').addClass('has-error');
			$('#pass2').after($('#helpBlock2').html('Пароли не совпадают'));

		} else if (password = passwordAccept) {
			$('.passwordAccept').removeClass('has-error').addClass('has-success');
			$('#pass2').after($('#helpBlock2').html(''));
		}

		if (password.length < 8) {
			$('.password').removeClass('has-success').addClass('has-error');
			$('#pass1').after($('#helpBlock1').html('Пароль должен содержать не менее 8 символов'));
		} else if (password.length >= 8){
			$('.password').removeClass('has-error').addClass('has-success');
			$('#pass1').after($('#helpBlock1').html(''));
		}

		if (password.length > 20) {
			$('.password').removeClass('has-success').addClass('has-error');
			$('#pass1').after($('#helpBlock1').html('Пароль должен содержать менее 20 символов'));
		}
	});
}

/**
 * [ajaxNewsRegistration - функция регистрации нового пользователя]
 */
function ajaxUsersRegistration(event){

	event.preventDefault();
	console.log('do things...');

	var formData = $('form').serialize();

	$('#myModal').modal({backdrop: "static"});
	$('.modal-dialog').css('margin-top','70px');
	$('.modal-header').css('background','#449d44');
	$('.modal-title').html('Завершение регистрации').css('color','#fff');
	$("#modal-text").html('Этот процесс необратим. Если вы уверены что ввели правильные данные нажмите \"Завершить\"');
	$("#modal-close").html('Отмена');
	$("#modal-save").removeClass('btn-primary').addClass('btn-success').html('Завершить');

	$('#modal-save').click(function(event){

		$('#modal-save').attr('disabled', 'true');
		$('#modal-close').attr('disabled', 'true');

		$.ajax({
			type: 'post',
			url: '/users/RegistrationProcess',
			data: formData,
			dataType: 'json',
			beforeSend: function(){

				var password  = $('#pass1').val();
				var passwordAccept = $('#pass2').val();

			 	if (password != passwordAccept) {
					$('.passwordAccept').removeClass('has-success').addClass('has-error');
					$('#pass2').after($('#helpBlock2').html('Пароли не совпадают'));
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
					return false;
				}
			 	if (password.length < 8) {
					$('.password').removeClass('has-success').addClass('has-error');
					$('#pass1').after($('#helpBlock1').html('Пароль должен содержать не менее 8 символов'));
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
					return false;
				}
				if (password.length > 20) {
					$('.password').removeClass('has-success').addClass('has-error');
					$('#pass1').after($('#helpBlock1').html('Пароль должен содержать менее 20 символов'));
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
					return false;
				}
			},

			success: function(res){

			if (res.status == 'err') {
				$(".error_msg").html('Ошибка регистрации');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Успешная регистрация. \n Сейчас будет выполнен переход на главную страницу...');
				$(".success_box").fadeIn(500).delay(3000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/index";
				}, 4000);
			}	
		},

			error: function(){
				$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#myModal').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			},
		})
	});
}