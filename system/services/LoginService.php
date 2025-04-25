<?php

namespace System\Services;

use System\Model\UsersModel;
use System\Core\AuthMiddleware;

/**
 * Class LoginService
 *
 * Serviço responsável pela validação de dados de login e autenticação de usuários.
 *
 * @package System\services
 */
class LoginService
{
    /**
     * Valida os dados de login fornecidos.
     *
     * Verifica se o array contém os campos 'email' e 'password', se o email está no formato correto e
     * retorna dados de validação para exibição de erros.
     *
     * @param array $data Dados de login (chaves 'email' e 'password').
     * @return array|null Retorna um array associativo com 'message' e validadores CSS em caso de erro,
     *                    ou null se os dados forem válidos.
     */
    public function validateLoginData(array $data)
    {
        if (empty($data)) {
            return [
                'message' => 'Preencha e-mail e senha',
                'emailValidator' => 'is-invalid',
                'passwordValidator' => 'is-invalid'
            ];
        }

        if (empty($data['email'])) {
            return [
                'message' => 'E-mail precisa ser preenchido',
                'emailValidator' => 'is-invalid'
            ];
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return [
                'message' => 'Formato do e-mail inválido',
                'emailValidator' => 'is-invalid'
            ];
        }

        if (empty($data['password'])) {
            return [
                'message' => 'O campo senha precisa ser preenchido',
                'passwordValidator' => 'is-invalid'
            ];
        }

        return null;
    }

    /**
     * Autentica o usuário com base em email e senha.
     *
     * Busca o usuário pelo email, verifica a senha informada e cria a sessão de autenticação.
     *
     * @param string $email    E-mail do usuário.
     * @param string $password Senha em texto plano para verificação.
     * @return bool|array       Retorna true em caso de sucesso, array associativo com dados de erro
     *                          ('message', 'emailValidator', 'passwordValidator') se falhar,
     *                          ou false se ocorrer erro na criação de sessão.
     */
    public function authenticateUser(string $email, string $password)
    {
        $userInstance = new UsersModel();
        $user = $userInstance->searchByEmail($email);

        if (!$user || !password_verify($password, $user->password)) {
            return [
                'message' => 'E-mail ou senha inválidos',
                'emailValidator' => 'is-invalid',
                'passwordValidator' => 'is-invalid'
            ];
        }

        if (AuthMiddleware::create($user)) {
            return true;
        }

        return false;
    }
}