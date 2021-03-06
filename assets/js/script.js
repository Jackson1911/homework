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

		beforeSend: function(){
			$('#modal-create').modal({backdrop: "static"});
		},

		//В случае успеха или ошибки выводим уведомление
		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Вы не заполнили все поля.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-create').modal('hide');
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
				$('#modal-create').modal('hide');
			}, 3000);
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
			$('#modal-update').modal({backdrop: "static"});
		},

		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Ошибка обновления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-update').modal('hide');
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
				$('#modal-update').modal('hide');
			}, 3000);
		},
	})
}

/**
* [ajaxNewsDelete Функция удаления новости]
* @param  {int} id [id удаляемой новости]
*/
function ajaxNewsDelete(id){

	$('#modal-delete').modal({backdrop: "static"});

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
					$('#modal-delete').modal('hide');
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
					$('#modal-delete').modal('hide');
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
	var password  = $('#pass1').val();
	var passwordAccept = $('#pass2').val();

 	if (password != passwordAccept) {
		$('.passwordAccept').removeClass('has-success').addClass('has-error');
		$('#pass2').after($('#helpBlock2').html('Пароли не совпадают'));
		return false;

	} else if (password.length < 8) {
		$('.password').removeClass('has-success').addClass('has-error');
		$('#pass1').after($('#helpBlock1').html('Пароль должен содержать не менее 8 символов'));
		return false;

	} else if (password.length > 20) {
		$('.password').removeClass('has-success').addClass('has-error');
		$('#pass1').after($('#helpBlock1').html('Пароль должен содержать менее 20 символов'));
		return false;

	} else {
		$('#modal-reg').modal({backdrop: "static"});

		$('#modal-save').click(function(event){

			$('#modal-save').attr('disabled', 'true');
			$('#modal-close').attr('disabled', 'true');

			$.ajax({
				type: 'post',
				url: '/users/RegistrationProcess',
				data: formData,
				dataType: 'json',

				success: function(res){

				if (res.status == 'err') {
					$(".error_msg").html('Ошибка регистрации');
					$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
					setTimeout(function() {
						$('#modal-reg').modal('hide');
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
						$('#modal-reg').modal('hide');
						$('#modal-save').removeAttr('disabled');
						$('#modal-close').removeAttr('disabled');
					}, 3000);
				},
			})
		});
	}
}

/**
* [ajaxUsersAuthorization функция аутентификации и авторизации пользователя]
*/
function ajaxUsersAuthorization(event){

	event.preventDefault();

	var formData = $('form').serialize();

	$.ajax({
		type: 'post',
		url: '/users/AuthorizationProcess',
		data: formData,
		dataType: 'json',

		beforeSend: function(){
			$('#block').modal({backdrop: "static"});
		},

		success: function(res){

			if (res.status == 'err') {
				$(".error_msg").html('Ошибка: такого пользователя не существует');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#block').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Вход был успешно выполнен.');
				$(".success_box").fadeIn(500).delay(3000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/index";
				}, 4000);
			}
		},

		error: function(){
			$(".error_msg").html('Ошибка: Пользователя с таким логином или паролем не существует');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				$('#block').modal('hide');
			}, 3000);
		}
	});
}

/**
 * [ajaxLogOut - функция выхода из текущей сессии]
 */
function ajaxLogOut(){
	
	$.ajax({

		url: '/users/LogOut',
		dataType: 'json',

		beforeSend: function(){
			$('#block').modal({backdrop: "static"});
		},

		success: function(res){

			if (res.status == 'err') {
				$(".error_msg").html('Ошибка');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#block').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Выход выполнен');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/index";
				}, 2000);
			}
		}
	});
}

/**
 * [ajaxCreateProfile - функция создания профиля]
 */
function ajaxCreateProfile(event, id){

	event.preventDefault();

	var files = $('input[name = "user_photo"]')[0].files;
	var fData = new FormData();
	$.each(files, function (index, file){
		fData.append(index, file);
	});

	var formData = $('form').serialize();
	fData.append('data', formData);

	$.ajax({

		url: '/users/CreateProfileProcess',
		type: 'post',
		data: fData,
		dataType: 'json',
		processData: false,
		contentType: false,

		beforeSend: function(){
			$('#block').modal({backdrop: "static"});
		},

		success: function(res){

			if (res.status == 'err') {
				$(".error_msg").html('Ошибка: создать профиль не удалось');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#block').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Ваш профиль успешно создан');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/users/profile?id=" + id;
				}, 2000);
			}
		}
	});
}

/**
 * [ajaxEditProfile функция редактирования профиля]
 */
function ajaxEditProfile(event, id)
{
	event.preventDefault();

	var files = $('input[name = "user_photo"]')[0].files;
	var fData = new FormData();
	$.each(files, function (index, file){
		fData.append(index, file);
	});

	var formData = $('form').serialize();
	fData.append('data', formData);

	$.ajax({

		url: '/users/EditProfileProcess',
		type: 'post',
		data: fData,
		dataType: 'json',
		processData: false,
		contentType: false,

		beforeSend: function(){
			$('#block').modal({backdrop: "static"});
		},

		success: function(res){

			if (res.status == 'err') {
				$(".error_msg").html('Ошибка: не удалось сохранить данные');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#block').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").css('top', ($(window).height()-$(".success_msg").height())/2+ 'px');
				$(".success_msg").html('Новые данные сохранены');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/users/profile?id=" + id;
				}, 2000);
			}
		}
	});
}

/**
 * [ajaxCreateComment - добавляет комментарий в базу данных]
 */
function ajaxCreateComment(event, news_id)
{
	event.preventDefault();

	var fData = $('form').serialize();

	$.ajax({
		type: 'post',
		url: '/news/CommentCreateProcess?id=' + news_id,
		data: fData,
		dataType: 'json',
		beforeSend: function(){
			$('#block').modal({backdrop: "static"});
		},

		success: function(res){

			if (res.status == 'err') {
				$(".error_box").css('left', ($(window).width()-$(".error_box").height())/2+ 'px');
				$(".error_box").css('top', $(document).scrollTop() + ($(window).height()-$(".error_box").height())/2+ 'px');
				$(".error_msg").html('Ошибка: не удалось добавить комментарий');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#block').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_box").css('left', ($(window).width()-$(".success_box").height())/2+ 'px');
				$(".success_box").css('top', $(document).scrollTop() + ($(window).height()-$(".success_box").height())/2+ 'px');
				$(".success_msg").html('Комментарий добавлен');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/view?id=" + news_id;
				}, 2000);
			}
		}
	});
}

/**
 * [ajaxUpdateComment - обновляет комментарий в базе данных]
 */
function ajaxUpdateComment(event, news_id, comm_id)
{
	event.preventDefault();
	console.log('do things...');

	var formData = $('form').serialize();

	$.ajax({
		url: '/news/CommentUpdateProcess?id=' + comm_id,
		method: 'post',
		data: formData,
		dataType: 'json',

		beforeSend: function(){
			$('#modal-update').modal({backdrop: "static"});
		},

		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Ошибка обновления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-update').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Комментарий обновлен');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/view?id=" + news_id;
				}, 2000);
			}	
		},

		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				$('#modal-update').modal('hide');
			}, 3000);
		},
	})
}

/**
 * [ajaxDeleteComment - удаляет комментарий из базы данных]
 */
function ajaxDeleteComment(event, news_id, comm_id)
{
	$('#modal-delete').modal({backdrop: "static"});

	$('#modal-save').click(function(event){

		$('#modal-save').attr('disabled', 'true');
		$('#modal-close').attr('disabled', 'true');

		$.ajax({
		url: '/news/CommentDeleteProcess?id=' + comm_id,
		dataType: 'json',

		success: function(res){
			if (res.status == 'err') {
				$(".error_box").css('left', ($(window).width()-$(".error_box").height())/2+ 'px');
				$(".error_box").css('top', $(document).scrollTop() + ($(window).height()-$(".error_box").height())/2+ 'px');
				$(".error_msg").html('Ошибка удаления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-delete').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_box").css('left', ($(window).width()-$(".success_box").height())/2+ 'px');
				$(".success_box").css('top', $(document).scrollTop() + ($(window).height()-$(".success_box").height())/2+ 'px');
				$(".success_msg").html('Комментарий удален');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/view?id=" + news_id;
				}, 2000);
			}	
		},

			error: function(){
				$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-delete').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			},
		})
	});
}

/**
 * [ajaxCategoryCreate функция добавления категории]
 */
function ajaxCategoryCreate(event){

	event.preventDefault();

	// Заносим в переменную formData данные с формы
	var formData = $('form').serialize();

	//Делаем запрос. Передаем данные.
	$.ajax({
		type: 'post',
		url: '/news/CategoriesCreateProcess',
		data: formData,
		dataType: 'json',

		beforeSend: function(){
			$('#modal').modal({backdrop: "static"})
		},

		//В случае успеха или ошибки выводим уведомление
		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Вы не заполнили все поля.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Категория добавлена');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/categories";
				}, 2000);
			}	
		},
		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				$('#modal').modal('hide');
			}, 3000);
		}
	})	
}

/**
 * [ajaxCategoryCreate функция добавления категории]
 */
function ajaxCategoryUpdate(event, id){

	event.preventDefault();

	// Заносим в переменную formData данные с формы
	var formData = $('form').serialize();

	//Делаем запрос. Передаем данные.
	$.ajax({
		type: 'post',
		url: '/news/CategoriesUpdateProcess?id=' + id,
		data: formData,
		dataType: 'json',

		beforeSend: function(){
			$('#modal').modal({backdrop: "static"})
		},

		//В случае успеха или ошибки выводим уведомление
		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Вы не заполнили все поля.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal').modal('hide');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Категория обновлена');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/categories";
				}, 2000);
			}	
		},
		error: function(){
			$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
			$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
			setTimeout(function() {
				$('#modal').modal('hide');
			}, 3000);
		}
	})
}

/**
* [ajaxCategoriesDelete Функция удаления категории]
* @param  int - id удаляемой категории
*/
function ajaxCategoryDelete(id){

	$('#modal-categories').modal({backdrop: "static"});

	$('#modal-save').click(function(event){

		$('#modal-save').attr('disabled', 'true');
		$('#modal-close').attr('disabled', 'true');

		$.ajax({
		url: '/news/CategoriesDelete?id=' + id,
		dataType: 'json',

		success: function(res){
			if (res.status == 'err') {
				$(".error_msg").html('Ошибка удаления');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-categories').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			}

			if (res.status == 'ok') {
				$(".success_msg").html('Категория удалена');
				$(".success_box").fadeIn(500).delay(1000).fadeOut(500);
				setTimeout(function() {
					window.location.href = "/news/categories";
				}, 2000);
			}	
		},

			error: function(){
				$(".error_msg").html('Произошла непредвиденная ошибка. Обратитесь к администратору или повторите попытку позднее.');
				$(".error_box").fadeIn(500).delay(2000).fadeOut(500);
				setTimeout(function() {
					$('#modal-categories').modal('hide');
					$('#modal-save').removeAttr('disabled');
					$('#modal-close').removeAttr('disabled');
				}, 3000);
			},
		})
	});	
}