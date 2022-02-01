<?php

namespace Raffaelwyss\Pfa\Core;

use PDO;

class Database
{
	/** @var PDO */
	private $pdo;

	public function __construct()
	{
		$config = json_decode(file_get_contents('../config/database.json'), true);
		$this->pdo = new PDO($config['dsn'], $config['username'], $config['password']);
	}

	public function query($sql, $data = [])
	{

	}
}
