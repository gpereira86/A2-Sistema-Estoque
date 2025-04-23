<?php

use System\Core\Helpers;
use System\Controller\LoginController;
use System\Controller\HomeController;
use System\Controller\ProductController;

function defineRoutes($uri, $requestMethod)
{
    if (Helpers::localhost()) {
        $baseSiteUri = URL_DEVELOPMENT;
    } else {
        $baseSiteUri = URL_PRODUCTION;
    }

    $routes = [
        ['uri' => $baseSiteUri, 'method' => 'GET', 'action' => [LoginController::class, 'login']],
        ['uri' => $baseSiteUri, 'method' => 'POST', 'action' => [LoginController::class, 'store']],
        ['uri' => "{$baseSiteUri}logout", 'method' => 'GET', 'action' => [LoginController::class, 'logout']],
        ['uri' => "{$baseSiteUri}home", 'method' => 'GET', 'action' => [HomeController::class, 'index']],
        ['uri' => "{$baseSiteUri}products", 'method' => 'GET', 'action' => [ProductController::class, 'index']],
    ];

    foreach ($routes as $route) {
        if ($uri === $route['uri'] && $requestMethod === $route['method']) {
            $controller = new $route['action'][0]();
            $method = $route['action'][1];
            return $controller->$method();
        }
    }

    http_response_code(404);
    Helpers::redirectToUrl('error-page');
}
