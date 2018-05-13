<?php

namespace app\models\products_selection;

use Yii;
use app\models\products\Products;


class ProductsList
{
    public $attributeNames = [];

    public function update(array $productsArr, $product_id = null) {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        //$session->destroySession('productsSelection');
        $session->set('productsSelection', $productsArr);


//        $productsSelection = $session->get('productsSelection');
//        if (count($productsSelection)) {
//            foreach ($productsSelection as $item) {
//                echo "<pre>" . print_r($item ,1) . "</pre>";
//            }
//
//        } else {
//            $session->set('productsSelection', $productsArr);
//        }

        return $productsArr;

    }

    public function searchProducts(array $searchParams)
    {
        $searchParams = array_diff($searchParams, array(''));
        $productsArr = Products::find()->where($searchParams)->asArray()->all();
        return $productsArr;
    }

    public function get()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        return $session->get('productsSelection');
    }

    public function setAttributes($attributes) {
        $product = new Products();
        foreach ($attributes as $attribute) {
            $this->attributeNames['data'][$attribute] = $product->getAttributeLabel($attribute);
        }
        $this->attributeNames['info'] = ['#' => 0, 'check' => 0];
    }

    public function getAttributes() {
        return $this->attributeNames;
    }

}