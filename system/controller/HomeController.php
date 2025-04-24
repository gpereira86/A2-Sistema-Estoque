<?php

namespace System\Controller;

use System\Core\AuthMiddleware;
use System\Core\Helpers;
use System\Core\Render;
use System\Model\CategoriesModel;
use System\Model\ProductsModel;

class HomeController
{
    public function index()
    {
        AuthMiddleware::check();

        $items = (new ProductsModel())->searchWithCategory()->result(true);
        $categories = (new CategoriesModel())->search()->result(true);

        Render::renderHTML('home', [
            'items' => $items,
            'categories' => $categories
        ]);
    }


}