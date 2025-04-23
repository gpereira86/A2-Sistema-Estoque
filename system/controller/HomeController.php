<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Core\Render;

class HomeController
{
    public function index()
    {
        AuthMiddleware::check();

        Render::renderHTML('home');
    }
}