<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\products\ProductsSearch;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\products\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="products-index">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered table-striped'
        ],
        'rowOptions' => ['class' => 'table-row'],
        'showFooter' => true,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['style' => 'width:30px;'],
                'footer' => count($dataProvider->models),
            ],

            [
                'attribute' => 'id',
                'headerOptions' => ['style' => 'width:70px;'],
            ],
            [
                'attribute' => 'supplier_id',
                'headerOptions' => ['style' => 'width:130px;'],
                'value' => function($data) {
                    return $data->supplier->name_short;
                },
            ],
            [
                'attribute' => 'manufacturer_id',
                'headerOptions' => ['style' => 'width:130px;'],
                'value' => function($data) {
                    return $data->manufacturer->name;
                },
            ],
            [
                'attribute' => 'name_id',
                'headerOptions' => ['style' => 'width:130px;'],
                'value' => function($data) {
                    return $data->prodName->name;
                },
            ],
            [
                'attribute' => 'size',
                'headerOptions' => ['style' => 'width:60px;'],
            ],
            [
                'attribute' => 'art',
                'headerOptions' => ['style' => 'width:150px;'],
            ],

            [
                'attribute' => 'weight',
                'headerOptions' => ['style' => 'width:60px;'],
                'footer' => ProductsSearch::getTotal($dataProvider->models, 'weight'),
            ],

            [
                'attribute' => 'date_transfer_invoice',
                'headerOptions' => ['style' => 'width:60px;'],
                'value' => function($data) {
                    $date = $data->transferInvoice->created_at;
                    $date = $date ? date("d.m.Y", $date) : "";
                    return $date;
                },
            ],

            [
                'attribute' => 'date_sales_invoice',
                'headerOptions' => ['style' => 'width:60px;'],
                'value' => function($data) {
                    $date = $data->salesInvoice->created_at;
                    $date = $date ? date("d.m.Y", $date) : "";
                    return $date;
                },
            ],
            [
                'attribute' => 'store_id',
                'value' => function($data) {
                    return $data->store->name;
                },
            ],
            [
                'attribute' => 'category_id',
                'value' => function($data) {
                    return $data->category->name;
                },
            ],
            [
                'attribute' => 'date_procur_invoice',
                'headerOptions' => ['style' => 'width:60px;'],
                'value' => function($data) {
                    $date = $data->procurementInvoice->created_at;
                    $date = $date ? date("d.m.Y", $date) : "";
                    return $date;
                },
            ],
            'price_sell',
            'invoice_procur_id',
            'invoice_transfer_id',
            'invoice_sales_id'


            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
