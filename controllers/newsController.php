<?php
	namespace controllers;
	use system\CView;
	use system\SystemController;

	class newsController extends SystemController
	{
		/**
		 * [actionIndex - рендерит представление и выводит список всех новостей]
		 *
		 * @var $dsn - содержит адрес БД, а так же имя БД
		 * @var $username - содержит имя пользователя для доступа БД
		 * @var $password - содержит пароль для доступа к БД
		 */
		public function actionIndex()
		{
			$dsn = 'mysql:host=localhost; dbname=testnews';
			$username = 'root';
			$password = '';

			try{
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$db->exec('SET CHARACTER SET utf8');
				$stmt = $db->query('SELECT * FROM news ORDER BY date');
				$data = $stmt->fetchAll();

			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}

			/**
			 * Вызываем метод render() класса CView
			 * Рендерим представление
			 * В качестве параметров задаем имя вызываемого представления - 'update'
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
			
			$dsn = 'mysql:host=localhost;dbname=testnews';
			$username = 'root';
			$password = '';

			//Соединение с БД средствами PDO
			//Если ошибка то исключение
			try {
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				//Устанавливаем кодировку
				$db->exec('SET CHARACTER SET utf8');

				//Добавление записи в БД
				$db->exec('INSERT INTO news (title, date, content) VALUES ('. $db->quote($title) .', '. $db->quote($date) .', '. $db->quote($content) .')');

			} catch (\PDOException $e){
				echo 'Добавить данные не удалось: ' . $e->getMessage();
				die();
			}

			//Редирект на actionIndex
			header('Location: /news/Index');
		}
		/**
		 * [actionUpdate Отображает форму редактирования, делает выборку из БД и заполняет поля]
		 * @var $id - получает GET параметр id новости
		 * 
		 * @var $dsn - содержит адрес БД, а так же имя БД
		 * @var $username - содержит имя пользователя для доступа БД
		 * @var $password - содержит пароль для доступа к БД
		 */
		public function actionUpdate(){
			//Получаем GET параметр id
			$id = $_GET['id'];
			//Запрос к БД
			$dsn = 'mysql:host=localhost;dbname=testnews';
			$username = 'root';
			$password = '';
			try {
				//Соединяемся с БД
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				//Устанавливаем кодировку
				$db->exec('SET CHARACTER SET utf8');

				//Выборка данных
				$stmt = $db->query('SELECT title, date, content FROM news WHERE id = ' . $id);
				$data = $stmt->fetch();
				
			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
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

			$title = $_POST['title'];
			$date = $_POST['date'];
			$content = $_POST['content'];

			try {
				$dsn = 'mysql:host=localhost;dbname=testnews';
				$username = 'root';
				$password = '';

				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$db->exec('SET CHARACTER SET utf8');
				$db->exec("UPDATE news SET title =" . $db->quote($title) . ", date ="  . $db->quote($date) . ", content ="  . $db->quote($content) . " WHERE id ="  . $id);

			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
			header('Location: /news/newsadmin'); 
		}
		
		/**
		 * [actionView - отображает отдельную новсть]
		 */
		public function actionView(){

			$id = $_GET['id'];

			try {
				$dsn = 'mysql:host=localhost;dbname=testnews';
				$username = 'root';
				$password = '';
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				//Устанавливаем кодировку
				$db->exec('SET CHARACTER SET utf8');

				//Делаем выборку данных
				$stmt = $db->query('SELECT title, date, content FROM news WHERE id = ' . $id);
				$data = $stmt->fetch();
				
			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
			//Рендерим представление с полученными данными
			CView::render('view', $data);

		}

		/**
		 * [actionDelete - Удаляет новость по ее id]
		 */
		public function actionDelete(){
			$id = $_GET['id'];

			$dsn = 'mysql:host=localhost;dbname=testnews';
			$username = 'root';
			$password = '';

			try {
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$db->exec('SET CHARACTER SET utf8');
				$db->exec('DELETE FROM news WHERE id =' . $id);
			} catch (\PDOException $e){
				echo 'Удаление не может быть выполнено: ' . $e->getMessage();
				die();
			}

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
			$dsn = 'mysql:host=localhost;dbname=testnews';
			$username = 'root';
			$password = '';

			try {
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				//Устанавливаем кодировку
				$db->exec('SET CHARACTER SET utf8');

				//Выборка данных
				$stmt = $db->query('SELECT * FROM news ORDER BY date');
				$data = $stmt->fetchAll();
				//Отображение админки
				CView::render('admin', $data);
				
			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
		}
	}
?>
