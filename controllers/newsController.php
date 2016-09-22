<?php
	namespace controllers;
	use system\CView;
	use system\SystemController;
	use system\App;
	use models\News;

	class newsController extends SystemController
	{
		/**
		 * [cutStr Функция которая обрезает строку, при этом не обрезая слова]
		 * @param  string  $str     [Сюда передается строка которую нужно обрезать]
		 * @param  integer $length  [Указываем сколько символов оставить в строке, по умолчанию 300]
		 * @param  string  $postfix [Постфикс, окончание строки, по умолчанию: ...]
		 * @return string           [Возвращает обработанную строку]
		 */
		function cutStr($str, $length = 300, $postfix = '...')
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
		 */
		public function actionCreate()
		{
			CView::render('create');
		}

		/**
		 * [actionCreateProcess - Добавляет данные с формы /news/create в базу данных]
		 * @var $title - содержит POST данные из формы создания новости
		 * @var $date - содержит POST данные из формы создания новости
		 * @var $content - содержит POST данные из формы создания новости
		 */
		public function actionCreateProcess()
		{
			//Создание коротких переменных для данных из POST
			$title = $_POST['name'];
			$date = $_POST['date'];
			$content = $_POST['content'];
			
			//Проверяем заполненность полей.
			if (empty($title) || empty($date) || empty($content)) {
				//Если хоть одно поле пустое обновляем форму
				header('Location: /news/create');
				die();
			}
			
			$model = new News();
			$model->title = $title;
			$model->date = $date;
			$model->content = $content;
			$model->save();

			//Редирект на actionIndex
			header('Location: /news/newsadmin');
		}

		/**
		 * [actionUpdate Отображает форму редактирования, делает выборку из БД и заполняет поля]
		 * @var $id - получает GET параметр id новости
		 */
		public function actionUpdate(){
			//Получаем GET параметр id
			$id = $_GET['id'];
			//Запрос к БД
			
			$model = new News();
			$data = $model->findOne(['id' => $id]);
			
			/**
			 * Вызываем метод render() класса CView
			 * Рендерим представление
			 * В качестве параметров задаем имя вызываемого представления - 'update'
			 * и данные выбранные в БД - $data
			 */
			CView::render('update', $data);
	
		}

		/**
		 * [actionUpdateProccess - делает SQL-запрос к БД и добавляет отредактированные данные]
		 * @var $id - получает GET параметр id новости
		 * 
		 */
		public function actionUpdateProcess(){
			$id = $_GET['id'];

			//Создание коротких перемнных
			$title = $_POST['title'];
			$date = $_POST['date'];
			$content = $_POST['content'];

			//Запрос к БД
			$model = new News();
			$model = $model->findOne(['id' => $id]);
			$model->title = $title;
			$model->date = $date;
			$model->content = $content;
			$model->save();

			//Редирект
			header('Location: /news/newsadmin'); 
		}
		
		/**
		 * [actionView - отображает отдельную новсть]
		 */
		public function actionView(){
			//Создание короткой переменной
			$id = $_GET['id'];

			//Запрос к БД
			$model = new News();
			$data = $model->findOne(['id' => $id]);

			//Рендерим представление с полученными данными
			CView::render('view', $data);

		}

		/**
		 * [actionDelete - Удаляет новость по ее id]
		 */
		public function actionDelete(){
			//Создение короткой переменной
			$id = $_GET['id'];

			//Запрос к БД
			$model = new News();
			$model = $model->findOne(['id' => $id]);
			$model->remove();
			
			//Редирект
			header('Location: /news/newsadmin');
		}

		/**
		 * [actionNewsAdmin - отображает короткий список новостей и позволяет
		 * манипулировать ими например:
		 * Добавить
		 * Просмотреть
		 * Редактировать
		 * Удалить]
		 */
		public function actionNewsAdmin(){
			//Запрос к БД
			$model = new News();
			$data = $model->findAll();

			//Рендер представления
			CView::render('admin', $data);
		}
	}
?>
