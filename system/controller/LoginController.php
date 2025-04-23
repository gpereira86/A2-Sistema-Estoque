<?php

namespace System\Controller;


use System\Core\AuthMiddleware;
use System\Core\Render;
use System\Model\UsersModel;
use System\Core\Helpers;

class LoginController
{
    public function login()
    {
        if (AuthMiddleware::checkLogin()){
            Helpers::redirectToUrl('home');
        };

        return Render::renderHTML('login', ['title' => 'Login']);
    }

    public function store()
    {
        $login = array_filter($_POST);

        if (empty($login)) {
            return Render::renderHTML('login', [
                'title' => 'Login',
                'emailValidator' => 'is-invalid',
                'passwordValidator' => 'is-invalid',
                'message' => 'Preencha e-mail e senha'
            ]);
        }

        if (empty($login['email'])) {
            return Render::renderHTML('login', [
                'title' => 'Login',
                'emailValidator' => 'is-invalid',
                'message' => 'E-mail precisa ser preenchido'
            ]);
        }

        if (!filter_var($login['email'], FILTER_VALIDATE_EMAIL)) {
            return Render::renderHTML('login', [
                'title' => 'Login',
                'emailValidator' => 'is-invalid',
                'message' => 'Formato do e-mail inválido'
            ]);
        }

        if (empty($login['password'])) {
            return Render::renderHTML('login', [
                'title' => 'Login',
                'email' => $login['email'],
                'passwordValidator' => 'is-invalid',
                'message' => 'O campo senha precisa ser preenchido'
            ]);
        }

        $userInstance = new UsersModel();
        $user = $userInstance->searchByEmail((string)$login['email']);

        if (!$user || !password_verify((string)$login['password'], $user->password)) {
            return Render::renderHTML('login', [
                'title' => 'Login',
                'email' => $login['email'],
                'message' => 'E-mail ou senha inválidos',
                'emailValidator' => 'is-invalid',
                'passwordValidator' => 'is-invalid'
            ]);
        }

        if (AuthMiddleware::create($user)){

            return Helpers::redirectToUrl('home');
        };

        return Helpers::redirectToUrl('login');

    }

    public function logout()
    {
        AuthMiddleware::destroy();
        sleep(1);
        return Helpers::redirectToUrl();
    }

}