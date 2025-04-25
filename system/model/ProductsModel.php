<?php

namespace System\Model;

use System\Core\Model;

/**
 * Class ProductsModel
 *
 * Modelo específico para interagir com a tabela de produtos.
 * Herda métodos genéricos de consulta, inserção, atualização e exclusão da classe base Model.
 *
 * @package System\Model
 */
class ProductsModel extends Model
{
    /**
     * ProductsModel constructor.
     *
     * Chama o construtor da classe base Model, definindo a tabela 'products'.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct('products');
    }
}