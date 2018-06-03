<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $searchModel \app\models\products\ProductsSearch */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use yii\helpers\Url;

$stores_arr = ArrayHelper::map(\app\models\Stores::getAll(), 'id', 'name');
$field_wrapper_class = 'form-group col-xs-12 col-sm-2 col-md-2 col-lg-2';
$tplDatePicker = '<label class="control-label">{label}</label>
<i class="glyphicon glyphicon-remove"></i>
<br>{input1}<br>{input2}';
?>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'panel1'],
        'method' => 'get',
        'fieldConfig' => [
            'options' => [
                'class' => $field_wrapper_class,
            ],
            'template' => '{label}{input}'
        ],
        'action' => Url::to(['products/index'])
    ]);
    ?>

<div class="row">

    <?= $form->field($searchModel, 'store_id')->dropDownList($stores_arr, ['prompt' => '']); ?>

    <?= $form->field($searchModel, 'id')->textInput() ?>

    <?= $form->field($searchModel, 'art')->textInput() ?>

    <?= $form->field($searchModel, 'weight')->textInput() ?>

    <?= $form->field($searchModel, 'size')->textInput() ?>

    <?= $form->field($searchModel, 'price_sell')->textInput() ?>

    <?= $form->field($searchModel, 'name_id')->dropDownList(
        ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name'),
        ['prompt' => '']);
    ?>
    <?= $form->field($searchModel, 'category_id')->dropDownList(
        ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
        ['prompt' => '']);
    ?>

    <?= $form->field($searchModel, 'supplier_id')->dropDownList(
        ArrayHelper::map(\app\models\Suppliers::getAll(), 'id', 'name_short'),
        ['prompt' => '']);
    ?>
</div>
<div class="row">
    <div class="<?= $field_wrapper_class ?>">
        <? $tpl = str_replace('{label}', $searchModel->getAttributeLabel('date_transfer_invoice'), $tplDatePicker); ?>
        <?= DatePicker::widget([
            'name' => 'ProductsSearch[date_transfer_d1]',
            'value' => $searchModel->date_transfer_d1,
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'ProductsSearch[date_transfer_d2]',
            'value2' => $searchModel->date_transfer_d2,
            'layout' => $tpl,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy'
            ]
        ]); ?>
    </div>
    <div class="<?= $field_wrapper_class ?>">
        <? $tpl = str_replace('{label}', $searchModel->getAttributeLabel('date_sales_invoice'), $tplDatePicker); ?>
        <?= DatePicker::widget([
            'name' => 'ProductsSearch[date_sales_d1]',
            'value' => $searchModel->date_sales_d1,
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'ProductsSearch[date_sales_d1]',
            'value2' => $searchModel->date_sales_d1,
            'layout' => $tpl,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy'
            ]
        ]); ?>
    </div>
    <div class="<?= $field_wrapper_class ?>">
        <? $tpl = str_replace('{label}', $searchModel->getAttributeLabel('date_procur_invoice'), $tplDatePicker); ?>
        <?= DatePicker::widget([
            'name' => 'ProductsSearch[date_procur_d1]',
            'value' => $searchModel->date_procur_d1,
            'type' => DatePicker::TYPE_RANGE,
            'name2' => 'ProductsSearch[date_procur_d2]',
            'value2' => $searchModel->date_procur_d2,
            'layout' => $tpl,
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd.mm.yyyy'
            ]
        ]); ?>
    </div>
</div>
    <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
    <?php ActiveForm::end(); ?>



