<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Core\Render;
use System\Model\CategoriesModel;
use System\Model\ProductsModel;

class ProductController
{
    protected array $errors = [];
    public function index()
    {
        AuthMiddleware::check();

        $itemsInstance = new ProductsModel();
        $items = $itemsInstance->searchWithCategory("user_id = {$_SESSION['auth']['id']}");

        $categories = new CategoriesModel();
        $categories = $categories->search()->result(true);


        $errorMessages = $_SESSION['errors'] ?? [];
        $successMessages = $_SESSION['success'] ?? [];
        $old = $_SESSION['old'] ?? [];

        unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['old']);

        return Render::renderHTML('products', [
            'itens' => $items,
            'categories' => $categories,
            'errorMessages' => $errorMessages,
            'successMessages' => $successMessages,
            'old' => $old
        ]);
    }

    public function store()
    {
        AuthMiddleware::check();

        $dataSet = array_filter($_POST, function($value) {
            return $value !== '';
        });

        $validated = $this->validator($dataSet);

        if ($validated !== true) {
            $_SESSION['errors'] = $validated;
            $_SESSION['old'] = $dataSet;
            return Helpers::redirectToUrl('products');
        }

        $productInstance = new ProductsModel();
        $productInstance->productcode = $dataSet['productcode'];
        $productInstance->productname = $dataSet['productname'];
        $productInstance->price = $dataSet['price'] ?? 0;
        $productInstance->quantity = $dataSet['quantity'];
        $productInstance->status = $dataSet['status'];
        $productInstance->description = $dataSet['description'] ?? null;
        $productInstance->category_id = $dataSet['category'];
        $productInstance->user_id = $_SESSION['auth']['id'];
        $productInstance->created_at = date('Y-m-d H:i:s');


        $savedStore = $productInstance->save();

        if ($savedStore) {
            $_SESSION['success'] = ['Produto cadastrado com sucesso!'];
        } else {
            $_SESSION['errors'] = ['Erro ao cadastrar produto!'];
            $_SESSION['old'] = $dataSet;
        }

        return Helpers::redirectToUrl('products');
    }

    public function updateFillForm(int $id)
    {
        authMiddleware::check();

        try {
            $productToUpdate = (new ProductsModel())->searchById($id);

            if ($productToUpdate !== true) {
                $_SESSION['old'] = (array) $productToUpdate->data();
            } else {
                $_SESSION['errors'] = ["Item não localizado!"];
            }

        } catch (\Exception $e) {
            $_SESSION['errors'] = ["Algo deu errado! | Erro: ". $e];
        } finally {
            Helpers::redirectToUrl("products");
        }
    }

    public function updated()
    {
        authMiddleware::check();

        $dataSet = array_filter($_POST, function($value) {
            return $value !== '';
        });

        $validated = $this->updatedValidator($dataSet);

        if ($validated !== true) {
            $_SESSION['errors'] = $validated;
            $_SESSION['old'] = $dataSet;
            return Helpers::redirectToUrl('products');
        }

        try {
            $productInstance = new ProductsModel();

            $productInstance->id = $dataSet['id'];
            $productInstance->productname = $dataSet['productname'];
            $productInstance->price = $dataSet['price'] ?? 0;
            $productInstance->quantity = $dataSet['quantity'];
            $productInstance->status = $dataSet['status'];
            $productInstance->description = $dataSet['description'] ?? null;
            $productInstance->category_id = $dataSet['category_id'];
            $productInstance->user_id_updated = $_SESSION['auth']['id'];
            $productInstance->uploaded_at = date('Y-m-d H:i:s');

            $savedStore = $productInstance->save();

            if ($savedStore) {
                $_SESSION['success'] = ['Produto atualizado com sucesso!'];
            } else {
                $_SESSION['errors'] = ['Erro ao atualizar produto!'];
                $_SESSION['old'] = $dataSet;
            }

        } catch (\Exception $e) {
            $_SESSION['errors'] = ["Algo deu errado! | Erro: ". $e];
        } finally {
            Helpers::redirectToUrl("products");
        }
    }

    public function deleted(int $id)
    {
        authMiddleware::check();
        try {
            $product = (new ProductsModel())->searchById($id);

            $validated = $this->deletedValidator($product);

            if ($validated !== true) {
                $_SESSION['errors'] = $validated;
                return Helpers::redirectToUrl('products');
            }

            if ($product) {
                $productName = $product->productname;
                $product->delete("id = {$id}");
                $_SESSION['success'] = ["Item <strong>{$productName}</strong> deletado com sucesso!"];
            } else {
                $_SESSION['errors'] = ['Erro ao tentar deletar o item, atualize a página e verifique se é um item existente.'];
            }

        } catch (\Exception $e) {
            $_SESSION['errors'] = ["Algo deu errado! | Erro: ". $e];
        } finally {
            Helpers::redirectToUrl("products");
        }
    }

    private function updatedValidator(array $data): bool|array
    {
        $productCodeVeryfied = (new ProductsModel())->searchById($data['id']);
        
        if ($productCodeVeryfied->productcode != $data['productcode']) {
            
            $this->errors[] = "O código do produto não pode ser alterado!";
        }

        $validated = $this->validator($data);

        if ($validated !== true) {
            $_SESSION['errors'] = $validated;
            $_SESSION['old'] = $data;
        }

        return empty($this->errors) ? true : $this->errors;
    }

    private function deletedValidator(object $data): bool|array
    {
        if ($data->quantity > 0){
            $this->errors[] = "Quantidade do item: <strong>'{$data->productname}'</strong> maior do que 0. O item não pode ser excluído";
        }

        if ($data->status == 1){
            $this->errors[] = "Item: <strong>{$data->productname}</strong> marcado como ativo. O item não pode ser excluído";
        }

        return empty($this->errors) ? true : $this->errors;
    }

    private function validator(array $data): bool|array
    {
        $fieldLabels = [
            'productcode' => 'Código do item',
            'productname' => 'Item',
            'quantity'    => 'Quantidade',
            'status'      => 'Status',
            'category_id' => 'Categoria',
        ];

        foreach ($fieldLabels as $field => $label) {
            if (!isset($data[$field]) || trim($data[$field]) === '') {
                $this->errors[] = "O campo '{$label}' é obrigatório.";
            }
        }

        if (!empty($this->errors)) {
            return $this->errors;
        }


        if (!is_numeric($data['productcode']) || (int)$data['productcode'] <= 0) {
            $this->errors[] = "O '{$fieldLabels['productcode']}' deve ser um número inteiro maior que zero.";
        }

        if (!$data['id']){
            if ((new ProductsModel())->search("productcode = {$data['productcode']}")->result()) {
                $this->errors[] = "'{$fieldLabels['productcode']}' já existe em sistema.";
            }
        }

        if (strlen(trim($data['productname'])) < 3) {
            $this->errors[] = "O '{$fieldLabels['productname']}' deve ter pelo menos 3 caracteres.";
        }

//        if (!is_numeric($data['price']) || (float)$data['price'] < 0) {
//            $this->errors[] = "O '{$fieldLabels['price']}' deve ser um número decimal maior que zero.";
//        }

        if (!is_numeric($data['quantity']) || (int)$data['quantity'] < 0) {
            $this->errors[] = "O '{$fieldLabels['quantity']}' deve ser um número inteiro maior ou igual a zero.";
        }

        if (!in_array((string)$data['status'], ['0', '1'], true)) {
            $this->errors[] = "O '{$fieldLabels['status']}' deve ser preenchido com Ativo ou Inativo.";
        }

        return empty($this->errors) ? true : $this->errors;
    }


}