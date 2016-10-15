<?php
namespace classes;
use models\Users;
use models\Roles;
use system\App;

class SysUser
{
	/**
	 * [getRole - Возвращает роль текущего пользователя]
	 * @return string
	 */
	public static function getRole()
	{
		if (isset($_SESSION['user_id'])) {

			$currentUserId = $_SESSION['user_id'];

			$user = new Users();
			$user = $user->findOne(['id' => $currentUserId]);

			$roles = new Roles();
			$roles = $roles->findOne(['id' => $user->role_id]);

			return $roles->role;

		}	
	}

	/**
	 * [getUserId - возвращает id текущего пользователя]
	 * @return int
	 */
	public static function getUserId()
	{
		if (isset($_SESSION['user_id'])) {

			$currentUserId = $_SESSION['user_id'];

			$user = new Users();
			$user = $user->findOne(['id' => $currentUserId]);

			return $user->id;
		}	
	}

	/**
	 * [checkProfile - проверка существования профиля пользователя]
	 * @return bool
	 */
	public static function checkProfile()
	{
		if (isset($_SESSION['user_id'])) {
			
			$user_id = self::getUserId();

			$profile = App::$db
				->select('id')
				->from('profiles')
				->where(['user_id' => $user_id])
				->fetchRow();

			if (!empty($profile)) {
				return true;
			}
		}
	}
}
