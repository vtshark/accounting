<?php

namespace app\controllers;
use app\models\products\ProductsSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class ProductsController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    public function actionIndex() {
        $searchModel = new ProductsSearch();
        $searchModel->load(Yii::$app->request->queryParams);
        //echo "<pre>" . print_r($searchModel ,1) . "</pre>"; die;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index',
            [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]
        );
    }

}