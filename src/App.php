<?php

namespace Raffaelwyss\Pfa;

use Raffaelwyss\Pfa\Core\Analyze;
use Raffaelwyss\Pfa\Core\Server;

class App
{
	public function run()
	{
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
