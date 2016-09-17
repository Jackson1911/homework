<?php
	namespace controllers;
	use system\CView;

	class newsController
	{
		public function actionIndex()
		{
			//Будущий вывод всех статей
			CView::render('index');
		}

		/*Этап 1 - Создание новости*/
		/*1.1 - Отображение формы создания новости*/
		public function actionCreate()
		{
			CView::render('create');
		}
		/*1.2 - Логика создания новости*/
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
		/*Этап 2 - Редактирование новости*/
		/*2.1 - Отображение формы редактирования новости*/
		public function actionUpdate(){
			//Получаем GET параметр id
			$id = $_GET['id'];
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
				$stmt = $db->query('SELECT title, date, content FROM news WHERE id = '.$id);
				$data = $stmt->fetch();
				
			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
			//Рендерим представление с данными
			CView::render('update', $data);
			
		}
		/*2.2 - Логика редактирования новости*/	
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
				$db->exec("UPDATE news SET title = '$title', date = '$date', content = '$content' WHERE id =" .$id);

			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
			header('Location: /news/newsadmin'); 
		}
		/*Этап 3 - Просмотр новости*/
		/*3.1 - Выборка данных из БД, Рендер формы отображения с полученными данными*/
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
				$stmt = $db->query('SELECT title, date, content FROM news WHERE id = '.$id);
				$data = $stmt->fetch();
				
			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
			//Рендерим представление с полученными данными
			CView::render('view', $data);

		}
		/*Этап 4 - Удаление новости*/
		/*4.1 - Логика удаления новости*/
		public function actionDelete(){
			$id = $_GET['id'];

			$dsn = 'mysql:host=localhost;dbname=testnews';
			$username = 'root';
			$password = '';

			try {
				$db = new \PDO($dsn, $username, $password);
				$db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$db->exec('SET CHARACTER SET utf8');
				$db->exec('DELETE FROM news WHERE id ='.$id);
			} catch (\PDOException $e){
				echo 'Удаление не может быть выполнено: ' . $e->getMessage();
				die();
			}
			header('Location: /news/newsadmin');
		}
		/*Этап ??? - Самоуправство*/
		/*Управление новостями*/
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
