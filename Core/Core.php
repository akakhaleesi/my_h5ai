<?php

namespace Core;

class Core {

	public function run() {
		include 'routes.php';
		$basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $url = '/'.substr($_SERVER['REQUEST_URI'], strlen($basepath));
		$router = new \Core\Router;

		if($router->get($url)) {
			$route = Router::get($url);
			$controller = '\Controller\\' . $route['controller'];
			$call = new $controller;
			$call->callMethod($url);
		}
	}
}
