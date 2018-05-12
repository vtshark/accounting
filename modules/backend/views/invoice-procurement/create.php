<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model \app\models\products_procurement\InvoiceProcurement */

$this->title = 'Create Invoice Procurement';
$this->params['breadcrumbs'][] = ['label' => 'Invoice Procurements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="invoice-procurement-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
