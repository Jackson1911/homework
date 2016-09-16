<?php
	namespace controllers;
	use system\CView;

	class newsController
	{
		public function actioncreateProcess()
		{
			CView::render('create');
		}

	}
?>