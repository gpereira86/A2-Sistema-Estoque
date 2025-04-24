<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Render;

class ErrorController
{
    public function errorPage()
    {
        AuthMiddleware::check();

        Render::renderHTML('error-page');
    }
}