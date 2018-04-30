<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceProcurementSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Invoice Procurements';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-procurement-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Create Invoice Procurement', ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->
    <?php Pjax::begin(['id' => 'invoice-procur-list', 'enablePushState' => false]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => [
            'class' => 'table table-bordered'
        ],
        'rowOptions' => ['class' => 'table-row'],

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'format' => 'raw',
            ],
            [
                'attribute' => 'supplier_id',
                'value' => function($data) {
                    return $data->supplier->name_short;
                },
            ],
            [
                'attribute' => 'description',
            ],
            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return date('d.m.Y H:i',$data->created_at);
                },
            ],
            [
                'attribute' => 'user_id',
                'value' => function($data) {
                    return $data->user->username;
                },
            ],
            [
                'attribute' => 'is_closed',
                'format' => 'raw',
                'value' => function($data) {
                        return ($data->is_closed) ? '<span class="glyphicon glyphicon-ok"></span>' : '';
                },
                'filter' => [ 0 => 'Открытые', 1 => 'Закрытые' ],
                'headerOptions' => ['style' => 'width:100px;'],
            ],
            [
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a('<i class="fas fa-folder-open fa-lg"></i>',
                        Url::to('/invoice-procurement/' . $data->id),
                        ['title' => "Открыть накладную"]
                    );
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
