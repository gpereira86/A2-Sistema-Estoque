<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Core\Render;
use System\Model\ProductsModel;

class ProductController
{
    public function index()
    {
        AuthMiddleware::check();

        $itemsInstance = new ProductsModel();
        $items [] = $itemsInstance->search()->result(true);

        Render::renderHTML('products', $items);
    }

    public function store()
    {
        $dataSet = filter_input_array(INPUT_POST, FILTER_DEFAULT);


    }

}