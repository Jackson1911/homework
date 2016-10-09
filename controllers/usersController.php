<?php
namespace controllers;
use system\CView;
use system\SystemController;
use system\App;
use models\Users;
use models\Profiles;

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
	
	/**
	 * [actionAuthorization - рендер представления формы входа в систему]
	 */
	public function actionAuthorization(){

		CView::render('authorization');

	}
	
	/**
	 * [actionAuthorizationProcess - процесс аутентификации и авторизации]
	 */
	public function actionAuthorizationProcess(){

		$login = $_POST['login'];
		$password = $_POST['password'];

		$hash = md5($password);

		$model = new Users();
		$model = $model->findOne(['login' => $login]);

		if ($login == $model->login && $hash == $model->password) {

			$_SESSION['user_id'] = $model->id;
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);

		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionlogOut - выход из текущей сессии]
	 */
	public function actionLogOut(){

		unset($_SESSION['user_id']);

		if (empty($_SESSION['user_id'])) {

			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);

		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionProfile - рендер представления с информацией о пользователе]
	 */
	public function actionProfile(){

		$user_id = $_GET['id'];

		$data = App::$db
			->select('n.*, a.*')
			->from('profiles n')
			->innerJoin('users a', 'a.id = n.user_id')
			->where(['a.id' => $user_id])
			->fetchRow();

		CView::render('profile', $data);


	}

	/**
	 * [actionCreateProfile - рендер формы создания нового профиля пользователя]
	 */
	public function actionCreateProfile()
	{
		CView::render('create');
	}

	/**
	 * [actionCreateProfileProcess - создание нового профиля пользователя]
	 */
	public function actionCreateProfileProcess(){

		$user_id = $_SESSION['user_id'];

		$user_name = $_POST['user_name'];
		$user_surname = $_POST['user_surname'];
		$user_birth_date = $_POST['user_birth_date'];

		$model = new Profiles();
		$model->user_id = $user_id;
		$model->name = $user_name;
		$model->surname = $user_surname;
		$model->birth_date = $user_birth_date;
		
		if ($model->save()) {
			
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);

		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionEditProfile - рендер формы редактирования профиля]
	 */
	public function actionEditProfile()
	{
		$user_id = $_GET['id'];

		$data = App::$db
			->select('n.*, a.*')
			->from('profiles n')
			->innerJoin('users a', 'a.id = n.user_id')
			->where(['a.id' => $user_id])
			->fetchRow();

		CView::render('edit', $data);
	}

	/**
	 * [actionEditProfileProcess - обновление данных о пользователе]
	 */
	public function actionEditProfileProcess(){

		$user_id = $_SESSION['user_id'];

		$user_name = $_POST['user_name'];
		$user_surname = $_POST['user_surname'];
		$user_birth_date = $_POST['user_birth_date'];

		$model = new Profiles();
		$model->user_id = $user_id;
		$model = $model->findOne(['user_id' => $user_id]);
		$model->name = $user_name;
		$model->surname = $user_surname;
		$model->birth_date = $user_birth_date;

		if ($model->save()) {
			
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);

		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}
}
