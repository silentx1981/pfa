<?php

namespace Raffaelwyss\Pfa\Core\Routing;

use Raffaelwyss\Pfa\Core\Config\Routes;
use Raffaelwyss\Pfa\Core\IApp;
use Raffaelwyss\Pfa\Migrate\Migrate;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

class Router
{
	public function run()
	{
		$context = new RequestContext();
		$routes = $this->parseRoutes(Routes::getRoutes());
		$matcher = new UrlMatcher($routes, $context);
		$uri = $_SERVER['REQUEST_URI'];

		try {
			$route = $matcher->match($uri);
			/** @var IApp $class */
			$class = new $route['class']();
		} catch (ResourceNotFoundException $e) {
			print_r('Route not found');
			return;
		}

		$class->setRouteName($route['name']);
		$class->run();
	}

	private function parseRoutes(array $routes)
	{
		$result = new RouteCollection();
		foreach ($routes as $name => $route)
			$result->add($name, new Route($route ['path'], ['name' => $name, 'class' => $route['class']]));

		return $result;
	}

}
