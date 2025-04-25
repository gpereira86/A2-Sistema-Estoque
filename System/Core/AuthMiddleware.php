<?php

namespace System\Core;

use System\Core\Helpers;

/**
 * Class AuthMiddleware
 *
 * Responsável pela gestão da autenticação do usuário na aplicação, incluindo verificação de login,
 * criação de sessão de usuário autenticado e destruição de sessão.
 *
 * @package System\Core
 */
class AuthMiddleware
{
    /**
     * Verifica se o usuário está autenticado.
     *
     * Este método verifica se a sessão contém dados de autenticação do usuário. Caso contrário, redireciona
     * o usuário para tela de login.
     *
     * @return bool Retorna true se o usuário estiver autenticado, senão redireciona para tela de login.
     */
    public static function check()
    {
        session_start();

        if (!isset($_SESSION['auth'])) {
            return Helpers::redirectToUrl();
        }
        return true;
    }

    /**
     * Verifica se o usuário está logado.
     *
     * Este método verifica se a sessão contém dados de autenticação do usuário. Retorna false
     * se o usuário não estiver autenticado.
     *
     * @return bool Retorna true se o usuário estiver autenticado, false caso contrário.
     */
    public static function checkLogin()
    {
        session_start();

        if (!isset($_SESSION['auth'])) {
            return false;
        }
        return true;
    }

    /**
     * Cria uma nova sessão de autenticação para o usuário.
     *
     * Este método armazena os dados do usuário autenticado na sessão.
     *
     * @param object $data Dados do usuário a serem armazenados na sessão.
     * @return bool Retorna true após criar a sessão de autenticação.
     */
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

    /**
     * Obtém os dados de autenticação do usuário.
     *
     * Este método retorna os dados armazenados na sessão de autenticação do usuário.
     *
     * @return array Dados do usuário autenticado.
     */
    public static function get()
    {
        return $_SESSION['auth'];
    }

    /**
     * Destrói a sessão de autenticação.
     *
     * Este método encerra a sessão atual e limpa todos os dados de autenticação.
     *
     * @return void
     */
    public static function destroy()
    {
        session_start();
        session_unset();
        session_destroy();
    }
}
