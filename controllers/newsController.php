<?php
	namespace controllers;
	use system\CView;

	class newsController
	{
		public function actionIndex()
		{
			//Будущая страница которая выводит все новости
		}
		public function actionCreate()
		{
			CView::render('create');
		}
		public function actionCreateProcess()
		{
			//Создание коротких переменных для данных из POST
			$name = $_POST['name'];
			$date = $_POST['date'];
			$content = $_POST['content'];
			
			//Проверяем заполненность полей.
			if (empty($name) || empty($date) || empty($content)) {
				//Если хоть одно поле пустое обновляем форму
				header('Location: /news/create');
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
				$db->exec('INSERT INTO news (name, date, content) VALUES ('. $db->quote($name) .', '. $db->quote($date) .', '. $db->quote($content) .')');

			} catch (\PDOException $e){
				echo 'Подключение к базе данных не удалось: ' . $e->getMessage();
				die();
			}
			
			//Редирект на actionIndex
			header('Location: /news/Index');
		}
	}
?>
