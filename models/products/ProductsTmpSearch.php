<?php

namespace app\models\products;


class ProductsTmpSearch extends ProductsSearch
{
    protected $model = 'ProductsTmp';

    public static function tableName()
    {
        return 'products_tmp';
    }

}