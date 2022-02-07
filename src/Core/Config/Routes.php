<?php

namespace Raffaelwyss\Pfa\Core\Config;

use Raffaelwyss\Pfa\Core\Analyze;
use Raffaelwyss\Pfa\Migrate\Migrate;

class Routes
{
	public static function getRoutes()
	{
		$result = [
			"base" => [
				'path'   => '/',
				'class'  => Analyze::class,
			],
			"base.data" => [
				'path'   => '/data',
				'class'  => Analyze::class,
			],
			'migrate' => [
				'path'   => '/migrate',
				'class'  => Migrate::class,
			],
			'migrate.run' => [
				'path'   => '/migrate/run',
				'class'  => Migrate::class,
			],
		];

		return $result;
	}
}
