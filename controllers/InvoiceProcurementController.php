<?php

namespace app\controllers;

use Yii;
use app\models\InvoiceProcurement;
use app\models\InvoiceProcurementSearch;
use yii\web\Controller;
use yii\filters\VerbFilter;


class InvoiceProcurementController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionList()
    {
        $searchModel = new InvoiceProcurementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 5;
        return $this->renderAjax('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /*public function actionCreateAjax()
    {
        $res['error'] = false;
        if ( Yii::$app->request->isAjax && Yii::$app->request->isPost ) {
            $model = new InvoiceProcurement();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                $res['invoice-id'] =  $model->id;
            } else {
                $res['error'] = true;
                $res['message'] =  'error save!';
                echo '<pre>' . print_r($model,1) . '</pre>'; die();
            }
        } else {
            $res['error'] = true;
        }
        return json_encode($res);
    }*/

}
