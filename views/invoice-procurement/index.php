<?
use yii\helpers\Url;
use yii\web\View;

?>

<?php if (Yii::$app->session->hasFlash('msgError')) { ?>
    <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a>
        <?= Yii::$app->session->getFlash('msgError'); ?>
    </div>
<?php } ?>

<?= $this->render('_head', ['invoiceProcurement' => $invoiceProcurement, 'product' => $product]); ?>


<?= $this->render('/product/procurement_list', [
    'searchModel' => $searchModel,
    'dataProvider' => $dataProvider,
    ]
);
?>


<?
$this->registerJsFile(Url::to('@web/js/invoiceProcurement.js'), ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);
$this->registerJsFile(Url::to('@web/js/product.js'), ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);