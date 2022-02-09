<?php

namespace Raffaelwyss\Pfa\Analyze\Config;

use Raffaelwyss\Pfa\Analyze\Analyze;
use Raffaelwyss\Pfa\Core\IRoutes;

class Routes
	implements IRoutes
{
	public static function getRoutes()
	{
		$result = [
			"analyze" => [
				'path'   => '/analyze',
				'class'  => Analyze::class,
			],
			"analyze.import" => [
				'path'   => '/analyze/import',
				'class'  => Analyze::class,
			]
		];

		return $result;
	}
}
