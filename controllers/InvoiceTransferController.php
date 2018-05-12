<?php

namespace app\controllers;

use Yii;
use app\models\products_transfer\InvoiceTransfer;
use app\models\products_transfer\InvoiceTransferSearch;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use app\models\Stores;
use app\models\products\ProductsSearch;

class InvoiceTransferController extends Controller
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

    public function actionIndex($transfer_invoice_id = null) {

        if ($transfer_invoice_id) {
            $invoiceTransfer = InvoiceTransfer::findOne($transfer_invoice_id);
        } else {
            $invoiceTransfer = null;
        }
        $products = new ProductsSearch();
        $dataProvider = $products->searchTransfer(Yii::$app->request->queryParams);

        return $this->render('index',
            [
                'invoiceTransfer' => $invoiceTransfer,
                'dataProvider' => $dataProvider,
            ]
        );
    }

    public function actionList()
    {
        $searchModel = new InvoiceTransferSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 5;
        return $this->renderAjax('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateForm()
    {
        $invoiceTransfer = new InvoiceTransfer();
        $storesArray = ArrayHelper::map(Stores::find()->where(['store_type_id' => 3])->all(), 'id', 'name');
        return $this->renderAjax('create_form', [
            'invoiceTransfer' => $invoiceTransfer,
            'storesArray' => $storesArray
        ]);
    }

    public function actionCreate()
    {
        $invoiceTransfer = new InvoiceTransfer();
        $invoiceTransfer->load(Yii::$app->request->post());
        $invoiceTransfer->user_id = Yii::$app->user->id;
        if ($invoiceTransfer->save()) {
            return $this->redirect(['/invoice-transfer/' . $invoiceTransfer->id]);
        } else {
            Yii::$app->session->setFlash('msgError', 'Ошибка создания новой накладной!');
            return $this->redirect(['/invoice-procurement']);
        }
    }

}