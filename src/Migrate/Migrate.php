<?php

namespace Raffaelwyss\Pfa\Migrate;


use Raffaelwyss\Pfa\Migrate\V_0_0_0\V_0_0_0_Init;

class Migrate
{
	public function run()
	{
		echo "Migrate System";

		V_0_0_0_Init::run();
	}
}
