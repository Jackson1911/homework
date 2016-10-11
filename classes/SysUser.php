<?php
namespace classes;
use models\Users;
use models\Roles;

class SysUser
{
	/**
	 * [getRole - Возвращает роль текущего пользователя]
	 * @return [string]
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

		} else {

			return false;
		}	
	}

	/**
	 * [getUserId - возвращает id текущего пользователя]
	 * @return [int]
	 */
	public static function getUserId()
	{
		if (isset($_SESSION['user_id'])) {

			$currentUserId = $_SESSION['user_id'];

			$user = new Users();
			$user = $user->findOne(['id' => $currentUserId]);

			return $user->id;

		} else {

			return false;
		}	
	}
}