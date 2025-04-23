<?php

namespace System\Core;

use System\Core\Helpers;

class AuthMiddleware
{
    public static function check()
    {
        session_start();

        if (!isset($_SESSION['auth'])) {
            return Helpers::redirectToUrl();
        }
        return true;
    }

    public static function checkLogin()
    {
        session_start();

        if (!isset($_SESSION['auth'])) {
            return false;
        }
        return true;
    }

    public static function create(object $data)
    {
        session_start();

        $_SESSION['auth'] = [
            'id'    => $data->id,
            'name'  => $data->name,
            'email' => $data->email,
            'level' => $data->level
        ];

        return true;
    }

    public static function get()
    {
        return $_SESSION['auth'];
    }

    public static function destroy()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}