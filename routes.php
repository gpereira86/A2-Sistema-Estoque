<?php

use system\core\Helpers;
use system\controller\LoginController;

/**
 * Handles routing for both site and API requests.
 * This function maps the incoming URI and request method to the appropriate controller actions.
 *
 * Based on the environment (development or production), it sets the base URIs for both API and site routes.
 *
 * @param string $uri The URI of the incoming request.
 * @param string $requestMethod The HTTP request method (GET, POST, etc.).
 *
 * @return void
 */
function defineRoutes($uri, $requestMethod)
{
    if (Helpers::localhost()) {
        $baseSiteUri = URL_DEVELOPMENT;
    } else {
        $baseSiteUri = URL_PRODUCTION;
    }


    if ($uri === $baseSiteUri && $requestMethod === 'GET') {
        (new LoginController())->login();

    } elseif ($uri === $baseSiteUri && $requestMethod === 'POST') {
        (new LoginController())->store();

//    } elseif (preg_match("#^{$baseSiteUri}movie/([^/]+)$#", $uri, $matches) && $requestMethod === 'GET') {
//        http_response_code(200);
//        $siteController->movieDetailPage();
//
//    } elseif ($uri === "{$baseSiteUri}error-page" && $requestMethod === 'GET') {
//        http_response_code(404);
//        $siteController->errorPage();
//


    } else {
        http_response_code(404);
        Helpers::redirectUrl('error-page');
    }
}
