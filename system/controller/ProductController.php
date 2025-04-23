<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Core\Render;
use System\Model\ProductsModel;

class ProductController
{
    protected array $errors = [];
    public function index()
    {
        AuthMiddleware::check();

        $itemsInstance = new ProductsModel();
        $items = $itemsInstance->search()->result(true);

        $errorMessages = $_SESSION['errors'] ?? [];
        $successMessages = $_SESSION['success'] ?? [];
        $old = $_SESSION['old'] ?? [];

        unset($_SESSION['errors'], $_SESSION['success'], $_SESSION['old']);

        return Render::renderHTML('products', [
            'itens' => $items, // Corrigido o nome da variável para corresponder ao array correto
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


        $savedStore = $productInstance->save();

        if ($savedStore) {
            $_SESSION['success'] = ['Produto cadastrado com sucesso!'];
        } else {
            $_SESSION['errors'] = ['Erro ao cadastrar produto!'];
            $_SESSION['old'] = $dataSet;
        }

        return Helpers::redirectToUrl('products');
    }

    public function update(int $id)
    {
        var_dump('teste');
    }

    private function validator(array $data): bool|array
    {
        $fieldLabels = [
            'productcode' => 'Código do item',
            'productname' => 'Item',
            'quantity'    => 'Quantidade',
            'status'      => 'Status'
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

        if ((new ProductsModel())->search("productcode = {$data['productcode']}")->result()) {
            $this->errors[] = "'{$fieldLabels['productcode']}' já existe em sistema.";
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
            $this->errors[] = "O '{$fieldLabels['status']}' deve ser '1' para Ativo ou '0' para Inativo.";
        }

        return empty($this->errors) ? true : $this->errors;
    }


}