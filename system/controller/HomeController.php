<?php

namespace System\Controller;

use System\Core\Render;

class HomeController
{
    public function index()
    {
        Render::renderHTML('home');
    }
}