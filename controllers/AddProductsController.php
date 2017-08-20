<?php

namespace app\controllers;

use app\models\Products;
use yii\web\Controller;

class AddProductsController extends Controller {
    public function actionIndex() {
        $product = new Products();
        return $this->render('index', ['product' => $product]);
    }
}