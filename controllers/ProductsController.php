<?php

namespace app\controllers;
use app\models\products\ProductsSearch;
use app\models\products\SearchForm;
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
        $searchForm = new SearchForm();

        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('index',
            [
                'searchForm' => $searchForm,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider
            ]
        );
    }

}