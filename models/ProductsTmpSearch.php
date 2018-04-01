<?php

namespace app\models;


class ProductsTmpSearch extends ProductsSearch
{
    protected $model = 'ProductsTmp';

    public static function tableName()
    {
        return 'products_tmp';
    }

}