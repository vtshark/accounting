<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
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
        //'filterModel' => $searchModel,
        'rowOptions' => ['class' => 'table-row', 'style' => 'background-color:#778899;'],

        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
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
                    return $data->user->login;
                },
            ],
            [
                'attribute' => 'is_closed',
                'format' => 'raw',
                'value' => function($data) {
                        return ($data->is_closed) ? '<span class="glyphicon glyphicon-ok"></span>' : '';
                },
            ],

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?></div>
