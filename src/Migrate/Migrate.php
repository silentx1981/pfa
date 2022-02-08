<?php

namespace Raffaelwyss\Pfa\Migrate;

use PDOException;
use Raffaelwyss\Pfa\Core\App;
use Raffaelwyss\Pfa\Core\Database;
use Raffaelwyss\Pfa\Core\File;
use Raffaelwyss\Pfa\Core\Filesystem;
use Raffaelwyss\Pfa\Core\IScript;
use Raffaelwyss\Pfa\Core\Scripts\Script1;
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
				$this->migrateList();
				break;
			case 'migrate.run':
				$this->migrateScripts();
				break;
			default:
				print_r('NotFound');
				break;
		}
		return;




		//$this->migrateScripts();

		print_r(File::scanDirectory(__DIR__.'/Scripts'));
		echo "Migrate System";
	}

	private function getMigrateScripts()
	{
		$result = [];

		$folders = Filesystem::scanDirectory('../src/', ['isDir' => true]);
		foreach ($folders as $name) {
			$files = Filesystem::scanDirectory("../src/$name/Scripts", ['isFile' => true]);
			foreach ($files as $file) {
				$filename = basename($file, '.php');
				$class = "Raffaelwyss\\Pfa\\$name\\Scripts\\$filename";
				if (!class_exists($class))
					continue;

				$result[] = $class;
			}
		}

		return $result;
	}

	private function init()
	{
		$db = new Database();
		try {
			$db->query('SELECT * FROM pfa_migrate');
		} catch (PDOException $e) {
			Script1::run();
		}
	}

	private function migrateList()
	{
		$scripts = $this->getMigrateScripts();
		foreach ($scripts as $script) {
			print_r($script);
			print_r('<br>');
		}
	}

	private function migrateScripts()
	{
		$db = new Database();
		$keys = array_column($db->query('SELECT `key` FROM pfa_migrate')->fetchAll(), 'key');
		$scripts = $this->getMigrateScripts();
		$scripts = array_diff($scripts, $keys);

		/** @var IScript $script */
		foreach ($scripts as $script) {
			$run = $script::run();
			if (!$run)
				continue;

			$sql = "INSERT INTO pfa_migrate (`key`, `description`) VALUES (?, ?)";
			$db->query($sql, [$script, $script::getName()]);
		}


		/*
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
		*/

	}
}
