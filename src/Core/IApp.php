<?php

namespace Raffaelwyss\Pfa\Core;

interface IApp
{
	public function getRouteName();
	public function run();
	public function setRouteName(string $name);
}
