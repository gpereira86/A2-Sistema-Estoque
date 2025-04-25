<?php

use System\Core\Helpers;
use System\Controller\LoginController;
use System\Controller\HomeController;
use System\Controller\ProductController;
use System\Controller\ErrorController;

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
        ['uri' => "{$baseSiteUri}home/deleted/{id}", 'method' => 'GET', 'action' => [HomeController::class, 'deleted']],
        ['uri' => "{$baseSiteUri}products", 'method' => 'GET', 'action' => [ProductController::class, 'index']],
        ['uri' => "{$baseSiteUri}products/store", 'method' => 'POST', 'action' => [ProductController::class, 'store']],
        ['uri' => "{$baseSiteUri}products/update/{id}", 'method' => 'GET', 'action' => [ProductController::class, 'updateFillForm']],
        ['uri' => "{$baseSiteUri}products/updated", 'method' => 'POST', 'action' => [ProductController::class, 'updated']],
        ['uri' => "{$baseSiteUri}products/deleted/{id}", 'method' => 'GET', 'action' => [ProductController::class, 'deleted']],
        ['uri' => "{$baseSiteUri}error-page", 'method' => 'GET', 'action' => [ErrorController::class, 'errorPage']],
    ];

    foreach ($routes as $route) {
        $pattern = preg_replace('#\{[^/]+\}#', '([^/]+)', $route['uri']);
        $pattern = '#^' . $pattern . '$#';

        if (preg_match($pattern, $uri, $matches) && $requestMethod === $route['method']) {
            array_shift($matches);
            $controller = new $route['action'][0]();
            $method = $route['action'][1];
            return $controller->$method(...$matches);
        }
    }

    http_response_code(404);
    Helpers::redirectToUrl('error-page');
}
