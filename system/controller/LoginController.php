<?php

namespace System\Controller;


use System\Core\Render;
use System\Model\UsersModel;
use System\Core\Helpers;

class LoginController
{
    public function login()
    {
        session_start();
        if (isset($_SESSION['auth']['id'])) {
            return Helpers::redirectToUrl('home');
        }
        return Render::renderHTML('login', ['title' => 'Login']);
    }

    public function store()
    {
        session_start();

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

        $_SESSION['auth'] = [
            'id'    => $user->id,
            'name'  => $user->name,
            'email' => $user->email
        ];


        return Helpers::redirectToUrl('home');
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        sleep(1);
        return Helpers::redirectToUrl();
    }

}