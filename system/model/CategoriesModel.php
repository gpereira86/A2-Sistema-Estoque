<?php

namespace System\Model;

use System\Core\Model;

/**
 * Class CategoriesModel
 *
 * Modelo específico para interagir com a tabela de categorias.
 * Herda métodos genéricos de consulta, inserção, atualização e exclusão da classe base Model.
 *
 * @package System\Model
 */
class CategoriesModel extends Model
{
    /**
     * CategoriesModel constructor.
     *
     * Chama o construtor da classe base Model, definindo a tabela 'categories'.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('categories');
    }
}
