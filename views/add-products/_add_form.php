<?php
use yii\helpers\ArrayHelper;
use yii\bootstrap\Modal;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

$supliers_arr = ArrayHelper::map(\app\models\Suppliers::find()->all(), 'id', 'name_short');
$manufacturers_arr = ArrayHelper::map(\app\models\Manufacturers::find()->all(), 'id', 'name');
$prodCategory_arr = ArrayHelper::map(\app\models\ProdCategory::find()->all(), 'id', 'name');
$sizes_arr = ArrayHelper::map(\app\models\Sizes::find()->all(), 'id', 'size');
$names_arr = ArrayHelper::map(\app\models\ProdNames::find()->all(), 'id', 'name');
?>

<? $form = ActiveForm::begin([
    'id' => 'add-prod-form',
]); ?>

    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($product, 'invoice_procur_id')->textInput(); ?>
        </div>
        <div class="col-sm-2">
            <?= Html::button('+', ['id' => 'find-invoice', 'class' => 'btn btn-primary']); ?>
            <?= Html::a('Новая накладная', '/add-products/new-invoice', ['class' => 'btn btn-primary']); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($product, 'supplier_id')->dropDownList($supliers_arr, ['prompt' => 'не выбрано']); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($product, 'manufacturer_id')->dropDownList($manufacturers_arr, ['prompt' => 'не выбрано']); ?>
        </div>
        <div class="col-sm-2">
            <?= $form->field($product, 'category_id')->dropDownList($prodCategory_arr, ['prompt' => 'не выбрано']); ?>
        </div>
    </div>
    <div class="row">

        <div class="col-sm-2 col-md-1">
            <?= $form->field($product, 'name_id')->dropDownList($names_arr, ['prompt' => 'не выбрано']); ?>
        </div>
        <div class="col-sm-2 col-md-1">
            <?= $form->field($product, 'art')->textInput(); ?>
        </div>
        <div class="col-sm-2 col-md-1">
            <?= $form->field($product, 'size_id')->dropDownList($sizes_arr, ['prompt' => 'не выбрано']); ?>
        </div>

        <div class="col-sm-2 col-md-1">
            <?= $form->field($product, 'weight')->textInput(); ?>
        </div>
        <div class="col-sm-2 col-md-1">
            <?= $form->field($product, 'price_sell')->textInput(); ?>
        </div>
        <div class="col-sm-2 col-md-1">
            <?= $form->field($product, 'price_procur')->textInput(); ?>
        </div>
    </div>
    <div class="row">
        <?= Html::submitButton('Добавить изделие', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

<?
Modal::begin([
    //'size' => 'modal-sm',
    'header' => '<div>Выбор накладной</div>',
    'id' => 'choose-id-invoice-modal',
    'toggleButton' => [
        'id' => 'choose-id-invoice-btn',
        //'label' => 'Выбор накладной',
        'tag' => 'button',
        'data-href' => Url::toRoute(['invoice-procurement/list']),
        'class' => 'btn btn-success hidden'
    ],
]);
Modal::end();
