<?php

namespace controllers;
use system\CView;
use system\SystemController;

/**
 * Class homeController
 * @package controllers
 * @author farZa
 *
 * Actions: action<Name> (camelCase)
 * Controllers: <Name>Controller (camelCase)
 */
class homeController extends SystemController
{
	public function actionIndex()
	{
		CView::render('index');
	}
}