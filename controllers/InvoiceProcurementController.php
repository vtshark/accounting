<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductsSearch;
use app\models\Suppliers;
use Yii;
use app\models\InvoiceProcurement;
use app\models\InvoiceProcurementSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;


class InvoiceProcurementController extends Controller
{

    public function actionIndex($procurement_invoice_id = null) {
        $searchModel = new ProductsSearch();
        $product = new Products();

        if ($procurement_invoice_id) {
            $invoiceProcurement = InvoiceProcurement::findOne($procurement_invoice_id);
            $product->supplier_id = $invoiceProcurement->supplier_id;
            /**@todo переделать **/
            $product->branch_id = 1;
            $product->invoice_procur_id = $invoiceProcurement->id;
        } else {
            $invoiceProcurement = new InvoiceProcurement();
        }

        $dataProvider = $searchModel->searchProcurement(Yii::$app->request->queryParams);

        return $this->render('index',
            [
                'invoiceProcurement' => $invoiceProcurement,
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'product' => $product
            ]
        );
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

    public function actionCreateForm()
    {
        $invoiceProcurement = new InvoiceProcurement();
        $suppliersArray = ArrayHelper::map(Suppliers::find()->all(), 'id', 'name_short');
        return $this->renderAjax('create_form', [
            'invoiceProcurement' => $invoiceProcurement,
            'suppliersArray' => $suppliersArray
        ]);

    }

    public function actionCreate()
    {
        $invoiceProcurement = new InvoiceProcurement();
        $invoiceProcurement->load(Yii::$app->request->post());
        /** @TODO: убрать после создания авторизации */
        $invoiceProcurement->user_id = 1;
        if ($invoiceProcurement->save()) {
            return $this->redirect(['/invoice-procurement/' . $invoiceProcurement->id]);
        } else {
            Yii::$app->session->setFlash('msgError', 'Ошибка создания новой накладной!');
            return $this->redirect(['/invoice-procurement']);
        }
    }

}
