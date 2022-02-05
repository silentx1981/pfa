<?php

namespace Raffaelwyss\Pfa;

use Raffaelwyss\Pfa\Core\Analyze;
use Raffaelwyss\Pfa\Core\Database;
use Raffaelwyss\Pfa\Core\Error\ErrorHandler;
use Raffaelwyss\Pfa\Core\Routing\Router;
use Raffaelwyss\Pfa\Core\Server;
use Raffaelwyss\Pfa\Migrate\Migrate;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class App
{
	public function run()
	{
		$this->init();

		$router = new Router();
		$router->run();

		/*
		// First of all Migrate System
		//$migrate = new Migrate();
		//$migrate->run();

		$route = new Route('/migrate', ['_controller1' => Migrate::class]);
		$routes = new RouteCollection();
		$routes->add('migrate', $route);

		$context = new RequestContext();
		$matcher = new UrlMatcher($routes, $context);
		$parameters = $matcher->match('/migrate');

		print_r($parameters);

		return;


		$server = new Server();
		if (!$server->getParameter('analyze')) {
			$html = file_get_contents('../templates/markup.html');
			print_r($html);
		} else {
			$analyze = new Analyze();
			$analyze->analyze($server->getParameter('pfafile'));
		}
		*/
	}

	private function init()
	{
		ErrorHandler::activate();
	}
}
