<?
use yii\helpers\Url;
use yii\web\View;
?>

<?php if (Yii::$app->session->hasFlash('msgError')) { ?>
    <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>
        <?= Yii::$app->session->getFlash('msgError'); ?>
    </div>
<?php } ?>

<?= $this->render('_add_form', ['product' => $product]); ?>
<?= $this->renderAjax('_products_list', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider]
);
?>

<?
$this->registerJsFile(Url::to('@web/js/addProducts.js'), ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);
