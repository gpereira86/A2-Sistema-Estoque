<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;

/**
 * Class ErrorController
 *
 * Controlador responsável pela exibição da página de erro.
 *
 * @package System\Controller
 */
class ErrorController
{
    /**
     * Exibe a página de erro.
     *
     * Este método verifica a autenticação do usuário e renderiza a página de erro.
     * Utiliza o middleware de autenticação e o renderizador HTML para apresentar a página de erro.
     * Obs.: Usuários não logados ao digitar uma url inválida, são redirecionados para página de login.
     *
     * @return void
     */
    public function errorPage()
    {
        AuthMiddleware::check();
        Helpers::view('error-page');
    }
}
