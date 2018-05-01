<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$model = new \app\models\forms\invoice_procurement\ProductsPricingForm();

$model->procurement_id = $procurement_id;
$form = ActiveForm::begin([
    'action' => '/product/pricing'
]); ?>

<?= $form->field($model, 'pricing_method')->dropDownList($model::getPricingMethods(), ['prompt' => '']);?>
<?= $form->field($model, 'procurement_id')->hiddenInput()->label(false);?>
<?= $form->field($model, 'coefficient')->textInput();?>

<?= Html::submitButton('Наценить', ['class' => 'btn btn-success']); ?>

<?php ActiveForm::end(); ?>