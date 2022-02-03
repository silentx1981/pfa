<?php

namespace Raffaelwyss\Pfa\Migrate\Scripts;

use Raffaelwyss\Pfa\Core\Database;

class V0
{
	const DESCRIPTION = 'Initialisierung';

	public static function run()
	{
		$db = new Database();

		$sql = 'CREATE TABLE IF NOT EXISTS `pfa_migrate` (
					`key` VARCHAR(10) PRIMARY KEY NOT NULL,
					`description` VARCHAR(255),
					`timestamp` TIMESTAMP
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
				';
		$db->query($sql);

		print_r('V0');
		echo "<hr>";

		return true;
	}
}
