<?php

namespace Raffaelwyss\Pfa\Analyze;

use Raffaelwyss\Pfa\Core\App;

class Analyze
	extends App
{
	public function run()
	{
		$routeName = $this->getRouteName();

		if ($routeName === 'analyze.import') {
			$this->setTemplateName('Import.html');
			$this->showTemplate();
		} else {
			$this->setTemplateName('Overview.html');
			$this->showTemplate();
		}

	}
}
