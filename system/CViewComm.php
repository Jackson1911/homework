<?php

namespace system;
use system\SystemController;

class CViewComm extends CView
{
	public static function render($path, $data = [], $more_data = [])
	{
		$fullPath = __DIR__ . '/../views/' . App::$currentController . '/' . $path . '.php';

		if (!file_exists($fullPath)) {
			throw new \ErrorException('view cannot be found');
		}

		if (!empty($data)) {
			foreach ($data as $key => $value) {
				$$key = $value;
			}
		}

		if (!empty($else_data)) {
			foreach ($else_data as $key => $value) {
				$$key = $value;
			}
		}

		ob_start();
		include($fullPath);
		$content = ob_get_clean();

		/**
		 * Подключаем Layout
		 */
		ob_start();
		include SystemController::$layout;
		$finalContent = ob_get_clean();

		echo $finalContent;
	}
}
