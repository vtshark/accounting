<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoiceTransferSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Invoice Transfers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-transfer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Invoice Transfer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'store_id',
            'description',
            'created_at',
            'user_id',
            //'is_closed',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
