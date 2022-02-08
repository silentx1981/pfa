<?php

namespace Raffaelwyss\Pfa\Core\Scripts;

use Raffaelwyss\Pfa\Core\Database;
use Raffaelwyss\Pfa\Core\IScript;

class Script1
	implements IScript
{
	public static function getName()
	{
		return 'Initializing';
	}

	public static function run()
	{
		$db = new Database();

		$sql = 'CREATE TABLE IF NOT EXISTS `pfa_migrate` (
					`key` VARCHAR(100) PRIMARY KEY NOT NULL,
					`description` VARCHAR(255),
					`timestamp` TIMESTAMP
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
				';
		$db->query($sql);

		return true;
	}
}
