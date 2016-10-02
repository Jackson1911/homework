<?php
namespace controllers;
use system\CView;
use system\SystemController;
use system\App;
use models\Users;

class usersController extends SystemController
{
	/**
	 * [actionRegistration - рендер представления регистрации нового пользователя]
	 */
	public function actionRegistration(){

		CView::render('registration');

	}

	/**
	 * [actionRegistrationProcess - добавление данных с формы в БД]
	 */
	public function actionRegistrationProcess(){

		//Создание коротких переменных
		$login = $_POST['login'];
		$password = $_POST['pass1'];
		$passwordAccept = $_POST['pass2'];
		$email = $_POST['email'];

		//Сравниваем пароли
		if ($password != $passwordAccept) {
			die();
		}

		//Шифрование пароля с помощью алгоритма md5
		$hash = md5($password);

		//Запрос к БД
		$model = new Users();
		$model->login = $login;
		$model->password = $hash;
		$model->email = $email;

		if ($model->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}
}
