<?php

namespace Raffaelwyss\Pfa\Analyze\Scripts;

use Raffaelwyss\Pfa\Core\Database;
use Raffaelwyss\Pfa\Core\IScript;

class Script1
	implements IScript
{
	public static function getName()
	{
		return 'Initializing Analyze';
	}

	public static function run()
	{
		$db = new Database();

		$sql = 'CREATE TABLE IF NOT EXISTS `pfa_entries` (
					`entrydate` DATE NOT NULL,
					`description` VARCHAR(255),
					`value` DOUBLE(8,2),
					PRIMARY KEY (entrydate, description)
				) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
				';
		$db->query($sql);

		return false;
	}
}
