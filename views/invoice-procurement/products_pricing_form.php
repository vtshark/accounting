<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

$model = new \app\models\products_procurement\ProductsPricingForm();

$model->procurement_id = $procurement_id;
$store_type = Yii::$app->request->get("store_type");
if ($store_type) {
    $model->store_type = $store_type;
}
$form = ActiveForm::begin([
    'action' => '/product/pricing'
]); ?>

<?= $form->field($model, 'pricing_method')->dropDownList($model::getPricingMethods(), ['prompt' => '']);?>
<?= $form->field($model, 'procurement_id')->hiddenInput()->label(false);?>
<?= $form->field($model, 'coefficient')->textInput();?>
<?= $form->field($model, 'store_type')->hiddenInput()->label(false);?>

<?= Html::submitButton('Наценить', ['class' => 'btn btn-success']); ?>

<?php ActiveForm::end(); ?>