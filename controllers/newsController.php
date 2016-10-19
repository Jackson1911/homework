<?php
namespace controllers;
use system\CView;
use system\SystemController;
use system\App;
use models\News;
use classes\SysUser;
use models\Users;
use models\Profiles;
use models\Roles;
use models\NewsComments;
use models\NewsCategories;

class newsController extends SystemController
{
	/**
	 * [cutStr Функция которая обрезает строку, при этом не обрезая слова]
	 * @param  string  $str     [Сюда передается строка которую нужно обрезать]
	 * @param  integer $length  [Указываем сколько символов оставить в строке, по умолчанию 300]
	 * @param  string  $postfix [Постфикс, окончание строки, по умолчанию: ...]
	 * @return string           [Возвращает обработанную строку]
	 */
	public function cutStr($str, $length = 300, $postfix = '...')
	{
		if (strlen($str) <= $length)
		    return $str;

		$temp = substr($str, 0, $length);
		return substr($temp, 0, strrpos($temp, ' ') ) . $postfix;
	}

	/**
	 * [actionIndex - рендерит представление и выводит список всех новостей]
	 * @var $data - содержит данные выбранные в БД
	 */
	public function actionIndex()
	{
		$model = new News();
		$data = $model->findAll();

		//Перебираем $data и обрезаем строки
		foreach ($data as $value) 
		{
			$value->content = self::cutStr($value->content);	
		}

		/**
		 * Вызываем метод render() класса CView
		 * Рендерим представление
		 * В качестве параметров задаем имя вызываемого представления - 'index которое находится /../views/news/inedx.php'
		 * и передаем ему данные выбранные в БД - $data
		 */
		CView::render('index', $data);
	}

	/**
	 * [actionCreate Отображает форму добавления новости]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCreate()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение			
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$category = new NewsCategories;
		$data = $category->findAll();

		CView::render('create', $data);
	}

	/**
	 * [actionAjaxCreate - Добавляет данные с формы /news/create в базу данных]
	 * @var $title - содержит POST данные из формы создания новости
	 * @var $date - содержит POST данные из формы создания новости
	 * @var $content - содержит POST данные из формы создания новости
	 *
	 * @throws \classes\EPermissionException
	 */
	public function actionAjaxCreate()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		//Создание коротких переменных для данных из POST
		$title = $_POST['name'];
		$date = $_POST['date'];
		$content = $_POST['content'];
		$categoryId = $_POST['select_category'];

		//Проверяем заполненность полей.
		if (empty($title) || empty($date) || empty($content)) {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка: не все поля заполнены.']);
			die();
		}

		$model = new News();
		$model->title = $title;
		$model->date = $date;
		$model->content = $content;
		$model->category_id = $categoryId;

		if ($model->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionUpdate Отображает форму редактирования, делает выборку из БД и заполняет поля]
	 * @var $id - получает GET параметр id новости
	 *
	 * @throws \classes\EPermissionException
	 */
	public function actionUpdate()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		//Получаем GET параметр id
		$id = $_GET['id'];

		//Запрос к БД
		$model = new News();
		$data = $model->findOne(['id' => $id]);

		$category = new NewsCategories;
		$category = $category->findAll();

		$categories = new NewsCategories;
		$categories = $categories->findAll();

		/**
		 * Вызываем метод render() класса CView
		 * Рендерим представление
		 * В качестве параметров задаем имя вызываемого представления - 'update'
		 * и данные выбранные в БД - $data
		 */
		CView::render('update', ['data' => $data, 'category' => $category, 'categories' => $categories]);

	}

	/**
	 * [actionAjaxUpdate - делает SQL-запрос к БД и добавляет отредактированные данные]
	 * @var $id - получает GET параметр id новости
	 *
	 * @throws \classes\EPermissionException
	 */
	public function actionAjaxUpdate()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$id = $_GET['id'];

		//Создание коротких перемнных
		$title = $_POST['title'];
		$date = $_POST['date'];
		$content = $_POST['content'];
		$categoryId = $_POST['select_category'];

		//Запрос к БД
		$model = new News();
		$model = $model->findOne(['id' => $id]);
		$model->title = $title;
		$model->date = $date;
		$model->content = $content;
		$model->category_id = $categoryId;

		if ($model->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}

	}

	/**
	 * [actionView - отображает отдельную новсть]
	 */
	public function actionView()
	{
		//Создание короткой переменной
		$id = $_GET['id'];

		//Запрос к БД

		$model = new News();
		$data = $model->findOne(['id' => $id]);

		$category = new NewsCategories;
		$category = $category->findOne(['id' => $data->category_id]);

		$comments = App::$db
			->select('n.*, n.id as comments_id, a.*, p.*')
			->from('news_comments n')
			->innerJoin('users a', 'a.id = n.user_id')
			->innerJoin('profiles p', 'p.user_id = n.user_id')
			->where(['n.news_id' => $id])
			->fetchAll();

		//Рендерим представление с полученными данными
		CView::render('view', ['news' => $data, 'category' => $category, 'comments' => $comments]);

	}

	/**
	 * [actionCommentCreateProcess - добавляет новый комментарий в БД]
	 */
	public function actionCommentCreateProcess()
	{
		$news_id = $_GET['id'];

		$userId = SysUser::getUserId();

		$model = new News();
		$data = $model->findOne(['id' => $news_id]);

		$commentDate = date('Y-m-d');
		$commentContent = $_POST['content'];

		$comment = new NewsComments();
		$comment->comm_content = $commentContent;
		$comment->date_create = $commentDate;
		$comment->news_id = $data->id;
		$comment->user_id = $userId;

		if ($comment->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Комментарий добавлен']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка: комментарий не добавлен']);
		}
	}

	/**
	 * [actionCommentEdit - рендер представления редактирования комментария]
	 *
	 * @throws \classes\EPermissionException
	 */
	public function actionComment_update()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		//Получаем GET параметр id
		$id = $_GET['id'];
		
		//Запрос к БД
		$model = new NewsComments();
		$data = $model->findOne(['id' => $id]);

		CView::render('comment_update', $data);
	}

	/**
	 * [actionCommentUpdateProcess - обновляет отредактированный комментарий в БД]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCommentUpdateProcess()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$id = $_GET['id'];

		//Создание коротких перемнных
		$content = $_POST['content'];

		//Запрос к БД
		$model = new NewsComments();
		$model = $model->findOne(['id' => $id]);
		$model->comm_content = $content;

		if ($model->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionCommentDeleteProcess - удаляет комментарий из БД]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCommentDeleteProcess()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		//Создение короткой переменной
		$id = $_GET['id'];

		//Запрос к БД
		$model = new NewsComments();
		$model = $model->findOne(['id' => $id]);

		if ($model->remove()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionAjaxDelete - Удаляет новость по ее id]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionAjaxDelete()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		//Создение короткой переменной
		$id = $_GET['id'];

		//Запрос к БД
		$model = new News();
		$model = $model->findOne(['id' => $id]);

		if ($model->remove()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionNewsAdmin - отображает короткий список новостей и позволяет
	 * манипулировать ими например:
	 * Добавить
	 * Просмотреть
	 * Редактировать
	 * Удалить]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionNewsAdmin()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		//Запрос к БД
		$data = App::$db
			->select('n.*, n.id as news_id, a.*')
			->from('news n')
			->innerJoin('news_categories a', 'a.id = n.category_id')
			->fetchAll();

		if (empty($data)) {
			CView::render('admin');

		} else {
			CView::render('admin', $data);
		}
	}

	/**
	 * [actionCategories - рендер формы управления категориями]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCategories()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$categories = new NewsCategories;
		$data = $categories->findAll();

		CView::render('categories', $data);
	}

	/**
	 * [actionCategoriesCreate - отображение формы добавления новой категории в БД]
	 *
	 * @throws \classes\EPermissionException
	 */
	public function actionCategoriesCreate()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		CView::render('category_create');
	}

	/**
	 * [actionCategoriesCreate - создание новой и категории и добавление ее в БД]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCategoriesCreateProcess()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$name = $_POST['category_name'];

		$category = new NewsCategories;
		$category->name = $name;

		if ($category->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionCategoriesUpdate - отображение формы редактирования новой категории в БД]
	 *
	 * @throws \classes\EPermissionException
	 */
	public function actionCategoriesUpdate()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$id = $_GET['id'];

		$data = new NewsCategories;
		$data = $data->findOne(['id' => $id]);
		
		CView::render('category_update', $data);
	}

	/**
	 * [actionCategoriesUpdate - обновление категории]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCategoriesUpdateProcess()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}

		$id = $_GET['id'];

		$name = $_POST['category_name'];

		$category = new NewsCategories;
		$category = $category->findOne(['id' => $id]);
		$category->name = $name;

		if ($category->save()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}

	/**
	 * [actionCategoriesDelete - удаление категории]
	 * 
	 * @throws \classes\EPermissionException
	 */
	public function actionCategoriesDelete()
	{
		//Проверяем роль пользователя
		$role = SysUser::getRole();
		//Если роль не admin	
		if ($role !== 'admin') {
			//Выбрасываем исключение
			throw new \classes\EPermissionException('У вас нет прав доступа к данной странице');
		}
		
		$id = $_GET['id'];

		$category = new NewsCategories;
		$category = $category->findOne(['id' => $id]);

		if ($category->remove()) {
			echo json_encode(['status' => 'ok', 'message' => 'Успех.']);
		} else {
			echo json_encode(['status' => 'err', 'message' => 'Ошибка']);
		}
	}	
}