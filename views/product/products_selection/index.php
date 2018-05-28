<?
use yii\helpers\Url;
use yii\web\View;
$this->title = 'Отбор изделий';
$this->params['breadcrumbs'][] = [
        'label' => 'Выдачи',
        'url' => Url::to(['invoice-transfer/' . $invoiceTransfer->id]),
    ];
$this->params['breadcrumbs'][] = $this->title;

?>


<div class="col-xs-12 col-sm-3 col-lg-2">
    <?= $this->render('search_form', ['searchForm' => $searchForm, 'invoiceTransfer' => $invoiceTransfer]); ?>
</div>
<div class="col-xs-12 col-sm-9 col-lg-10">
    <?= $this->render('products_list',
        [
            'attributeLabels' => $attributeLabels,
            'products' => $products
        ]
    ); ?>
</div>

<?
$this->registerJsFile(Url::to('@web/js/products_selection.js'), ['position' => View::POS_END, 'depends' => 'yii\web\JqueryAsset']);

