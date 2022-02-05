<?php

namespace Raffaelwyss\Pfa\Core;

use Exception;

class App
	implements IApp
{
	private $routeName;

	public function getRouteName()
	{
		return $this->routeName;
	}

	public function run()
	{
		throw new Exception('Not Implemented');
	}

	public function setRouteName(string $name)
	{
		$this->routeName = $name;
	}
}
