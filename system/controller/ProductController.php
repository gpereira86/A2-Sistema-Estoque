<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Services\ProductService;
use System\Model\ProductsModel;

/**
 * Class ProductController
 *
 * Controlador responsável pela gestão de produtos, incluindo a listagem, criação, atualização e exclusão de produtos.
 *
 * @package System\Controller
 */
class ProductController
{
    /**
     * Armazena mensagens de erro.
     *
     * @var array
     */
    protected array $errors = [];

    /**
     * Instância do serviço de produto.
     *
     * @var ProductService
     */
    protected ProductService $productService;

    /**
     * ProductController constructor.
     *
     * Inicializa a instância do serviço de produtos.
     */
    public function __construct()
    {
        $this->productService = new ProductService();
    }

    /**
     * Exibe a lista de produtos.
     *
     * Este método verifica se o usuário está autenticado, obtém todos os produtos do usuário logado
     * e dados de categorias para utilização no form de cadastro de um novo produto. Exibe a página
     * de produtos com as mensagens de erro e sucesso, se existirem.
     *
     * @return void
     */
    public function index()
    {
        AuthMiddleware::check();

        $items = $this->productService->getAllByUser($_SESSION["auth"]['id']);
        $categories = $this->productService->getAllCategories();

        $errorMessages = $_SESSION['errors'] ?? [];
        $successMessages = $_SESSION['success'] ?? [];
        $old = $_SESSION['old'] ?? [];

        unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['old']);

        return Helpers::view('products', [
            'items' => $items,
            'categories' => $categories,
            'errorMessages' => $errorMessages,
            'successMessages' => $successMessages,
            'old' => $old
        ]);
    }

    /**
     * Cria um novo produto.
     *
     * Este método valida os dados do produto enviados via POST e, se forem válidos, cria o produto em Banco.
     * Caso contrário, exibe erros na tela de produtos.
     *
     * @return void
     */
    public function store()
    {
        AuthMiddleware::check();

        $dataSet = array_filter($_POST, function($value) {
            return $value !== '';
        });

        $validated = $this->productService->validateCreate($dataSet);

        if ($validated !== true) {
            $_SESSION['errors'] = $validated;
            $_SESSION['old'] = $dataSet;
            return Helpers::redirectToUrl('products');
        }

        if ($this->productService->createProduct($dataSet)) {
            $_SESSION['success'] = ['Produto cadastrado com sucesso!'];
        } else {
            $_SESSION['errors'] = ['Erro ao cadastrar produto!'];
            $_SESSION['old'] = $dataSet;
        }

        return Helpers::redirectToUrl('products');
    }

    /**
     * Preenche o formulário de edição com os dados do produto.
     *
     * Este método tenta carregar um produto existente com base no ID fornecido.
     * Caso não encontre o produto ou ocorra um erro, exibe uma mensagem de erro.
     *
     * @param int $id O ID do produto a ser editado.
     * @return void
     */
    public function updateFillForm(int $id)
    {
        AuthMiddleware::check();

        try {
            $productToUpdate = (new ProductsModel())->searchById($id);

            if ($productToUpdate !== true) {
                $_SESSION['old'] = (array) $productToUpdate->data();
            } else {
                $_SESSION['errors'] = ["Item não localizado!"];
            }

        } catch (\Exception $e) {
            $_SESSION['errors'] = ["Algo deu errado! | Erro: ". $e->getMessage()];
        } finally {
            Helpers::redirectToUrl("products");
        }
    }

    /**
     * Atualiza as informações de um produto existente.
     *
     * Este método valida os dados do produto enviados via POST, e se forem válidos, atualiza o produto no banco.
     * Caso contrário, exibe erros na tela de produtos.
     *
     * @return void
     */
    public function updated()
    {
        AuthMiddleware::check();

        $dataSet = array_filter($_POST, function($value) {
            return $value !== '';
        });

        $validated = $this->productService->validateUpdate($dataSet);

        if ($validated !== true) {
            $_SESSION['errors'] = $validated;
            $_SESSION['old'] = $dataSet;
            return Helpers::redirectToUrl('products');
        }

        try {
            if ($this->productService->updateProduct($dataSet)) {
                $_SESSION['success'] = ['Produto atualizado com sucesso!'];
            } else {
                $_SESSION['errors'] = ['Erro ao atualizar produto!'];
                $_SESSION['old'] = $dataSet;
            }

        } catch (\Exception $e) {
            $_SESSION['errors'] = ["Algo deu errado! | Erro: ". $e->getMessage()];
        } finally {
            Helpers::redirectToUrl("products");
        }
    }

    /**
     * Exclui um produto.
     *
     * Este método tenta excluir o produto com base no ID fornecido.
     *
     * @param int $id O ID do produto a ser excluído.
     * @return void
     */
    public function deleted(int $id)
    {
        AuthMiddleware::check();
        $this->productService->deleted($id, 'products');
    }
}
