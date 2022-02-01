<?php

namespace Raffaelwyss\Pfa;

use Raffaelwyss\Pfa\Core\Analyze;
use Raffaelwyss\Pfa\Core\Database;
use Raffaelwyss\Pfa\Core\Server;
use Raffaelwyss\Pfa\Migrate\Migrate;

class App
{
	public function run()
	{
		// First of all Migrate System
		$migrate = new Migrate();
		$migrate->run();


		$server = new Server();
		if (!$server->getParameter('analyze')) {
			$html = file_get_contents('../templates/markup.html');
			print_r($html);
		} else {
			$analyze = new Analyze();
			$analyze->analyze($server->getParameter('pfafile'));
		}
	}
}
