<?php

namespace Raffaelwyss\Pfa\Migrate;

use PDOException;
use Raffaelwyss\Pfa\Core\App;
use Raffaelwyss\Pfa\Core\Database;
use Raffaelwyss\Pfa\Core\File;
use Raffaelwyss\Pfa\Core\IApp;
use Raffaelwyss\Pfa\Migrate\Scripts AS Scripts;
use Raffaelwyss\Pfa\Migrate\Scripts\V0;

class Migrate
	extends App
{
	public function run()
	{
		$this->init();
		$routeName = $this->getRouteName();


		switch ($routeName) {
			case 'migrate':
				print_r('migrate');
				break;
			case 'migrate.run':
				print_r('migrate.run');
				break;
			default:
				print_r('NotFound');
				break;
		}
		echo '<hr>';
		print_r($this->getRouteName());

		return;




		//$this->migrateScripts();

		print_r(File::scanDirectory(__DIR__.'/Scripts'));
		echo "Migrate System";
	}

	private function init()
	{
		$db = new Database();
		try {
			$db->query('SELECT * FROM pfa_migrate');
		} catch (PDOException $e) {
			V0::run();
		}
	}

	private function migrateScripts()
	{
		$db = new Database();
		$keys = array_column($db->query('SELECT `key` FROM pfa_migrate')->fetchAll(), 'key');
		$scripts = File::scanDirectory(__DIR__.'/Scripts');

		foreach ($scripts as $script) {
			$script = str_replace('.php', '', $script);
			if (in_array($script, $keys))
				continue;

			$class = "Raffaelwyss\\Pfa\\Migrate\\Scripts\\$script";
			$run = $class::run();
			if (!$run)
				continue;

			$sql = "INSERT INTO pfa_migrate (`key`, `description`) VALUES (?, ?)";
			$db->query($sql, [$script, $class::DESCRIPTION]);
		}

	}
}
