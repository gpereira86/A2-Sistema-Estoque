<?php

namespace system\controller;

use system\core\Render;

class LoginController
{
    public function login()
    {
        Render::renderHTML('login', ['title' => 'Login']);
    }

    public function store()
    {
        var_dump($_POST);
        die();
        Render::renderHTML('home');
    }


}