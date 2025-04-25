<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Services\LoginService;

/**
 * Class LoginController
 *
 * Controlador responsável pelas ações de login e logout do usuário, utilizando o serviço de login para validação e autenticação.
 *
 * @package System\Controller
 */
class LoginController
{
    /**
     * Instância do serviço de login.
     *
     * @var LoginService
     */
    private $loginService;

    /**
     * LoginController constructor.
     *
     * Inicializa a instância do serviço de login.
     */
    public function __construct()
    {
        $this->loginService = new LoginService();
    }

    /**
     * Exibe a página de login.
     *
     * Este método verifica se o usuário já está autenticado. Caso esteja, redireciona para a página inicial.
     * Caso contrário, exibe a tela de login.
     *
     * @return void
     */
    public function login()
    {
        if (AuthMiddleware::checkLogin()) {
            Helpers::redirectToUrl('home');
        }

        return Helpers::view('login', ['title' => 'Login']);
    }

    /**
     * Processa o login do usuário.
     *
     * Este método valida os dados de login (email e senha), verifica a autenticidade do usuário
     * utilizando o serviço de login e, em caso de sucesso, cria a sessão de login. Caso contrário,
     * exibe a tela de login exibindo o(s) erros.
     *
     * @return void
     */
    public function store()
    {
        $login = array_filter($_POST);

        $validationResult = $this->loginService->validateLoginData($login);

        if ($validationResult) {
            return Helpers::view('login', array_merge(['title' => 'Login', 'email' => $login['email']], $validationResult));
        }

        $authResult = $this->loginService->authenticateUser($login['email'], $login['password']);

        if ($authResult === true) {
            return Helpers::redirectToUrl('home');
        }

        return Helpers::view('login', [
            'title' => 'Login',
            'email' => $login['email'],
            'message' => $authResult['message'],
            'emailValidator' => $authResult['emailValidator'],
            'passwordValidator' => $authResult['passwordValidator']
        ]);
    }

    /**
     * Realiza o logout do usuário.
     *
     * Este método destrói a sessão de login do usuário e redireciona para a página de login.
     *
     * @return void
     */
    public function logout()
    {
        AuthMiddleware::destroy();
        return Helpers::redirectToUrl();
    }
}
