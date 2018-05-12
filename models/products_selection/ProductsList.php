<?php

namespace app\models\products_selection;

use Yii;
use app\models\products\Products;


class ProductsList
{
    public function update(array $productsArr, $product_id = null) {

        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        $productsSelection = $session->get('productsSelection');
        if (count($productsSelection)) {
            foreach ($productsSelection as $item) {
                echo "<pre>" . print_r($item ,1) . "</pre>";
            }

        } else {
            $session->set('productsSelection', $productsArr);
        }

    }

    public function searchProducts(array $searchParams){
        $searchParams = array_diff($searchParams, array(''));
        $productsArr = Products::find()->where($searchParams)->asArray()->all();
        return $productsArr;
    }
}