<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
?>

<? $form = ActiveForm::begin([
    'id' => 'create-product-form',
    'validateOnBlur' => false
//            'fieldConfig' => [
//            'template' => "<div class='col-xs-12 col-sm-2'>{label}\n{input}\n{error}</div>",
//            'labelOptions' => ['class' => 'col-lg-1 control-label'],
//        ]
]);
?>

    <? if ($product->id) { ?>
        <div class="row">
            <div class="col-xs-6 col-sm-2">
                <?= $form->field($product, 'id')->textInput(['readonly' => 'readonly']); ?>
            </div>
        </div>
    <? } ?>
<div class="row">
    <div class="col-xs-12 col-sm-2">
    <?= $form->field($product, 'manufacturer_id')->dropDownList(
            ArrayHelper::map(\app\models\Manufacturers::getAll(), 'id', 'name'),
            ['prompt' => '']
    ); ?>
    </div>

    <div class="col-xs-12 col-sm-2">
    <?= $form->field($product, 'category_id')->dropDownList(
            ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
            ['prompt' => '']
    ); ?>
    </div>

    <div class="col-xs-3 col-sm-1">
        <?= $form->field($product, 'probe')->dropDownList(
            ArrayHelper::map(\app\models\Probe::getAll(), 'id', 'id'),
            ['prompt' => '']
        ); ?>
    </div>


    <div class="col-xs-12 col-sm-2">
    <?= $form->field($product, 'name_id')->dropDownList(
            ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name'),
            ['prompt' => '']); ?>

    </div>
    <div class="col-xs-12 col-sm-2">
    <?= $form->field($product, 'art')->textInput(); ?>
    </div>

    <div class="col-xs-6 col-sm-2">
<!--    --><?//= $form->field($product, 'size')->dropDownList(
//            ArrayHelper::map(\app\models\Sizes::getAll(), 'size', 'size'),
//            ['prompt' => '']
//    ); ?>
    </div>

    <div class="col-xs-6 col-sm-1">
    <?= $form->field($product, 'weight')->textInput(); ?>
    </div>

</div>

<div class="row">

    <div class="col-xs-6 col-sm-1">
    <?= $form->field($product, 'price_procur')->textInput(); ?>
    </div>

    <div class="col-xs-6 col-sm-1">
    <?= $form->field($product, 'price_sell')->textInput(); ?>
    </div>

    <div class="col-xs-12 col-sm-2">
        <?= $form->field($product, 'supplier_id')->hiddenInput()->label(false); ?>
        <?= $form->field($product, 'branch_id')->hiddenInput()->label(false); ?>
        <?= $form->field($product, 'invoice_procur_id')->hiddenInput()->label(false); ?>
        <?= Html::submitButton('', ['class' => 'btn btn-success glyphicon glyphicon-floppy-save']) ?>
    </div>
</div>

<? ActiveForm::end(); ?>
