<?php

namespace System\Model;

use System\Core\Model;

/**
 * Class UsersModel
 *
 * Modelo específico para interagir com a tabela de usuários.
 * Herda métodos genéricos de consulta, inserção, atualização e exclusão da classe base Model.
 *
 * @package System\Model
 */
class UsersModel extends Model
{
    /**
     * UsersModel constructor.
     *
     * Chama o construtor da classe base Model, definindo a tabela 'users'.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('users');
    }
}
