<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\web\View;
?>

<? $form = ActiveForm::begin([
    'id' => 'create-product-form',
    'validateOnBlur' => false,
    'fieldConfig' => [
        'options' => [
            'class' => 'form-group col-xs-12 col-sm-2',
        ],
        'template' => '{label}{input}'
    ],
]);

$isEditing = ($product->id) ? true : false;
?>

<? if ($isEditing) { ?>
    <div class="row">
        <?= $form->field($product, 'id')->textInput(['readonly' => 'readonly']); ?>
    </div>
<? } ?>

<div class="row">
    <?
    echo $form->field($product, 'manufacturer_id')->dropDownList(
            ArrayHelper::map(\app\models\Manufacturers::getAll(), 'id', 'name'),
            ['prompt' => '']
    );

    echo $form->field($product, 'category_id')->dropDownList(
            ArrayHelper::map(\app\models\ProdCategory::getAll(), 'id', 'name'),
            ['prompt' => '']
    );
    echo  $form->field($product, 'probe')->dropDownList(
        ArrayHelper::map(\app\models\Probe::getAll(), 'id', 'id'),
        ['prompt' => '']
    );

    echo $form->field($product, 'name_id')->dropDownList(
            ArrayHelper::map(\app\models\ProdNames::getAll(), 'id', 'name'),
            ['prompt' => '']);

    echo $form->field($product, 'art')->textInput();

    echo $form->field($product, 'size')->dropDownList(
            ArrayHelper::map(\app\models\Sizes::getAll(), 'size', 'size'),
            ['prompt' => '']
    );
    echo $form->field($product, 'weight')->textInput();

    echo $form->field($product, 'price_procur')->textInput();

    echo $form->field($product, 'price_sell')->textInput();

    if (!$isEditing) {
        echo $form->field($product, 'count_prod')->textInput();
    }
    echo Html::submitButton('', ['class' => 'btn btn-success glyphicon glyphicon-floppy-save']);

    echo $form->field($product, 'supplier_id',
        ['options' =>
            ['class' => 'hidden']
        ]
    )->hiddenInput();
    echo $form->field($product, 'store_id',
        ['options' =>
            ['class' => 'hidden']
        ]
        )->hiddenInput();
    echo $form->field($product, 'invoice_procur_id',
        ['options' =>
            ['class' => 'hidden']
        ]
        )->hiddenInput();
?>

</div>

<? ActiveForm::end(); ?>