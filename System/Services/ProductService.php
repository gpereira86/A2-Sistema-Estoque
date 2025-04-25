<?php

namespace System\Services;

use System\Core\Helpers;
use System\Model\CategoriesModel;
use System\Model\ProductsModel;

/**
 * Class ProductService
 *
 * Serviço responsável por operações de negócio relacionadas a produtos,
 * incluindo listagem, validação, criação, atualização e exclusão de produtos.
 *
 * @package System\Services
 */
class ProductService
{
    /**
     * Array de erros ocorridos durante validações.
     *
     * @var array
     */
    protected array $errors = [];

    /**
     * Obtém todos os produtos de um usuário, incluindo dados de categoria e usuário.
     *
     * @param int $userId ID do usuário autenticado.
     * @return array Lista de objetos ProductsModel com dados de categoria e usuário.
     */
    public function getAllByUser(int $userId): array
    {
        return (new ProductsModel())
            ->searchWithCategory("user_id = {$userId}")
            ->result(true);
    }

    /**
     * Obtém todas as categorias disponíveis.
     *
     * @return array Lista de objetos CategoriesModel.
     */
    public function getAllCategories(): array
    {
        return (new CategoriesModel())->search()->result(true);
    }

    /**
     * Valida dados para criação de novo produto.
     *
     * Verifica obrigatoriedade, tipos de campos e unicidade de código.
     *
     * @param array $data Dados do produto a criar (productcode, productname, quantity, status, category_id, etc.).
     * @return true|array True se válido ou lista de mensagens de erro.
     */
    public function validateCreate(array $data): bool|array
    {
        $fieldLabels = [
            'productcode' => 'Código do item',
            'productname' => 'Item',
            'quantity' => 'Quantidade',
            'status' => 'Status',
            'category_id' => 'Categoria',
        ];

        foreach ($fieldLabels as $field => $label) {
            if (!isset($data[$field]) || trim($data[$field]) === '') {
                $this->errors[] = "O campo '{$label}' é obrigatório.";
            }
        }

        if (!is_numeric($data['productcode']) || (int)$data['productcode'] <= 0) {
            $this->errors[] = "O '{$fieldLabels['productcode']}' deve ser um número inteiro maior que zero.";
        }

        if (!$data['id'] && (new ProductsModel())->search("productcode = {$data['productcode']}")->result()) {
            $this->errors[] = "'{$fieldLabels['productcode']}' já existe em sistema.";
        }

        if (strlen(trim($data['productname'])) < 3) {
            $this->errors[] = "O '{$fieldLabels['productname']}' deve ter pelo menos 3 caracteres.";
        }

        if (!is_numeric($data['quantity']) || (int)$data['quantity'] < 0) {
            $this->errors[] = "O '{$fieldLabels['quantity']}' deve ser um número inteiro maior ou igual a zero.";
        }

        if (!in_array((string)$data['status'], ['0', '1'], true)) {
            $this->errors[] = "O '{$fieldLabels['status']}' deve ser preenchido com Ativo ou Inativo.";
        }

        return empty($this->errors) ? true : $this->errors;
    }

    /**
     * Valida dados para atualização de produto.
     *
     * Reutiliza validações de criação e impede alteração de código do produto.
     *
     * @param array $data Dados do produto a atualizar.
     * @return true|array True se válido ou lista de mensagens de erro.
     */
    public function validateUpdate(array $data): bool|array
    {
        $errors = $this->validateCreate($data);

        if ($errors !== true) {
            return $errors;
        }

        $productCodeVerified = (new ProductsModel())->searchById($data['id']);
        if ($productCodeVerified->productcode != $data['productcode']) {
            $this->errors[] = "O código do produto não pode ser alterado!";
        }

        return empty($this->errors) ? true : $this->errors;
    }

    /**
     * Valida regras de negócio antes de excluir um produto.
     *
     * Garante que quantidade=0 e status inativo antes de permitir exclusão.
     *
     * @param object $product Instância de ProductsModel do item a excluir.
     * @return true|array True se válido ou lista de mensagens de erro.
     */
    public function validateDelete(object $product): bool|array
    {
        if ($product->quantity > 0) {
            $this->errors[] = "Quantidade do item: <strong>'{$product->productname}'</strong> maior do que 0. O item não pode ser excluído";
        }

        if ($product->status == 1) {
            $this->errors[] = "Item: <strong>{$product->productname}</strong> marcado como ativo. O item não pode ser excluído";
        }

        return empty($this->errors) ? true : $this->errors;
    }

    /**
     * Cria um novo produto no banco de dados.
     *
     * Preenche os atributos do modelo e chama save().
     *
     * @param array $data Dados do produto.
     * @return bool True em caso de sucesso, false caso contrário.
     */
    public function createProduct(array $data): bool
    {
        $productInstance = new ProductsModel();
        $productInstance->productcode     = $data['productcode'];
        $productInstance->productname     = $data['productname'];
        $productInstance->price           = $data['price'] ?? 0;
        $productInstance->quantity        = $data['quantity'];
        $productInstance->status          = $data['status'];
        $productInstance->description     = $data['description'] ?? null;
        $productInstance->category_id     = $data['category_id'];
        $productInstance->user_id         = $_SESSION['auth']['id'];
        $productInstance->created_at      = date('Y-m-d H:i:s');

        return $productInstance->save();
    }

    /**
     * Atualiza um produto existente no banco de dados.
     *
     * Ajusta atributos permitidos e chama save().
     *
     * @param array $data Dados do produto a atualizar.
     * @return bool True em caso de sucesso, false caso contrário.
     */
    public function updateProduct(array $data): bool
    {
        $productInstance = new ProductsModel();
        $productInstance->id               = $data['id'];
        $productInstance->productname      = $data['productname'];
        $productInstance->price            = $data['price'] ?? 0;
        $productInstance->quantity         = $data['quantity'];
        $productInstance->status           = $data['status'];
        $productInstance->description      = $data['description'] ?? null;
        $productInstance->category_id      = $data['category_id'];
        $productInstance->user_id_updated  = $_SESSION['auth']['id'];
        $productInstance->uploaded_at      = date('Y-m-d H:i:s');

        return $productInstance->save();
    }

    /**
     * Exclui produto diretamente do banco de dados.
     *
     * @param int $id ID do produto a excluir.
     * @return bool True se excluído, false se não encontrado.
     */
    public function deleteProduct(int $id): bool
    {
        $product = (new ProductsModel())->searchById($id);
        if ($product) {
            $product->delete("id = {$id}");
            return true;
        }
        return false;
    }

    /**
     * Gerencia o fluxo de exclusão de produto com validações e redirecionamento.
     *
     * @param int $id    ID do produto.
     * @param string $route Rota para redirecionamento após a operação.
     * @return void
     */
    public function deleted(int $id, string $route)
    {
        try {
            $item = (new ProductsModel())->searchById($id);
            $validated = $this->validateDelete($item);

            if ($validated !== true) {
                $_SESSION['errors'] = $validated;
                return Helpers::redirectToUrl($route);
            }

            if ($this->deleteProduct($id)) {
                $_SESSION['success'] = ["Item deletado com sucesso!"];
            } else {
                $_SESSION['errors'] = ['Erro ao tentar deletar o item.'];
            }

        } catch (\Exception $e) {
            $_SESSION['errors'] = ["Algo deu errado! | Erro: " . $e->getMessage()];
        } finally {
            Helpers::redirectToUrl($route);
        }
    }
}