<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Model\CategoriesModel;
use System\Model\ProductsModel;
use System\Services\ProductService;

/**
 * Class HomeController
 *
 * Controlador responsável pela página inicial.
 *
 * @package System\Controller
 */
class HomeController
{
    /**
     * Exibe a página inicial com os produtos e categorias.
     *
     * Este método verifica a autenticação do usuário, obtém a lista de produtos com suas categorias e
     * exibe a página inicial.
     *
     * @return void
     */
    public function index()
    {
        AuthMiddleware::check();

        $items = (new ProductsModel())->searchWithCategory()->result(true);
        $categories = (new CategoriesModel())->search()->result(true);

        $errorMessages = $_SESSION['errors'] ?? [];
        $successMessages = $_SESSION['success'] ?? [];

        unset($_SESSION['errors'], $_SESSION['success']);

        Helpers::view('home', [
            'items' => $items,
            'categories' => $categories,
            'errorMessages' => $errorMessages,
            'successMessages' => $successMessages
        ]);
    }

    /**
     * Exclui um produto e redireciona para a página inicial.
     *
     * Este método recebe o ID de um produto, verifica a autenticação do usuário e
     * chama o serviço responsável pela exclusão do produto.
     *
     * @param int $id ID do produto a ser excluído
     * @return void
     */
    public function deleted(int $id)
    {
        AuthMiddleware::check();
        (new ProductService())->deleted($id, 'home');
    }
}