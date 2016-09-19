<?php

namespace components;


class ConfigComponent
{
	public static function getMainConfig()
	{
		$configContent = file_get_contents(__DIR__ . '/../configs/main.json');

		return json_decode($configContent, true);
	}
}