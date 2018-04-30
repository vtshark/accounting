<?php

namespace app\models;

/**
 * This is the model class for table "products_tmp".
 *
 * @property integer $user_id
 */
class ProductsTmp extends Products
{
    public static function tableName()
    {
        return 'products_tmp';
    }
}