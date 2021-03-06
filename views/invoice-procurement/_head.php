<?
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\StoreTypes;

$this->title = 'Закупки';
$this->params['breadcrumbs'][] = $this->title;

echo "<div class='edit-product-wrapper'>";
Modal::begin([
    'size' => 'modal-lg',
    'header' => 'Редактирование изделия',
    'id' => 'update-product-modal',
    'toggleButton' => [
        'id' => 'update-product-btn',
        'label' => 'Редактирование изделия',
        'tag' => 'button',
        'data-href' => '',
        'class' => 'btn btn-info hidden'
    ],
]);
Modal::end();
echo "</div>";
Modal::begin([
    //'size' => 'modal-sm',
    'header' => 'Поиск накладной',
    'id' => 'choose-id-invoice-modal',
    'toggleButton' => [
        'id' => 'choose-id-invoice-btn',
        'label' => 'Выбор накладной',
        'tag' => 'button',
        'data-href' => Url::toRoute(['invoice-procurement/list']),
        'class' => 'btn btn-primary hidden'
    ],
]);
Modal::end();

Modal::begin([
    //'size' => 'modal-sm',
    'header' => 'Создание накладной',
    'id' => 'create-invoice-modal',
    'toggleButton' => [
        'id' => 'create-invoice-btn',
        'label' => 'Новая накладная',
        'tag' => 'button',
        'data-href' => Url::toRoute(['invoice-procurement/create-form']),
        'class' => 'btn btn-primary hidden'
    ],
]);
Modal::end();
$disabledClass = $disabledAddProd = '';

if ($invoiceProcurement) {
    $invoiceDescription = $invoiceProcurement->id . " " .
        $invoiceProcurement->supplier->name_short . " ";
    if ($invoiceProcurement->is_closed) {
        $invoiceDescription .= '<span class="glyphicon glyphicon-ok"></span>';
    }
    if ($invoiceProcurement->is_closed) {
        $disabledClass = 'disabled';
        $disabledAddProd = 'disabled';
    }
} else {
    $invoiceDescription = "";
    $disabledClass = 'disabled';
    $disabledAddProd = 'disabled';
}
// по умолчанию используется тип "склад"
$store_type_id = Yii::$app->request->get('store_type') ?: StoreTypes::DEFAULT_TYPE_ID;
if ($store_type_id <> StoreTypes::TMP_TYPE_ID) {
    $disabledAddProd = 'disabled';
}
$stores = \app\models\Stores::getStores(['store_type_id' => [StoreTypes::TMP_TYPE_ID, StoreTypes::DEFAULT_TYPE_ID]]);
$storeTypes = StoreTypes::getTypes(['id' => [StoreTypes::TMP_TYPE_ID, StoreTypes::DEFAULT_TYPE_ID]]);

$invoiceProcurement_id = $invoiceProcurement->id ?? '';
?>

<input id="invoice-id" type="hidden" value="<?= $invoiceProcurement_id ?>">
<ul class="nav nav-tabs">
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Накладная: <?= $invoiceDescription ?><span class="caret"></span>
        </a>
        <ul class="dropdown-menu" id="invoice-menu">
            <li role="presentation"><a href="#" id="choose-id-invoice-li">Поиск накладной</a></li>
            <li role="separator" class="divider"></li>
            <li role="presentation"><a href="#" id="create-invoice-li">Создание накладной</a></li>
        </ul>

    </li>

    <li role="presentation" class="<?=$disabledClass?>">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Филиал: <?=$storeTypes[$store_type_id]['name']?><span class="caret"></span>
        </a>
        <ul class="dropdown-menu" id="choose-store">
            <?php
            foreach ($storeTypes as $type) { ?>
                <li role="presentation">
                    <a href="<?= Url::current(['store_type' => $type['id'] ]) ?>"><?= $type['name'] ?></a>
                </li>
                <li role="separator" class="divider"></li>
            <?  }?>
        </ul>
    </li>

    <li role="presentation" class="<?=$disabledAddProd?>"><a href="#add-product" class="procurement-nav-a">Добавить изделие</a></li>
    <li role="presentation" class="<?=$disabledClass?>"><a href="#margin" class="procurement-nav-a">Наценка</a></li>
    <li role="presentation" class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Печать <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation"><a href="#" id="choose-id-invoice-li">Печать накладной</a></li>
            <li role="separator" class="divider"></li>
            <li role="presentation"><a href="#" id="create-invoice-li">Печать бирок</a></li>
        </ul>

    </li>

    <li role="presentation" class="<?=$disabledClass?>">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Перевести на филиал<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" id="choose-store-for-transfer-products">
            <?php
            foreach ($stores as $store) {
                if ($store['id'] == 1) continue;
            ?>
                <li role="separator" class="divider"></li>
                <li role="presentation">
                    <a href="#" data-store-id="<?= $store['id']?>"><?= $store['name'] ?></a>
                </li>
            <? } ?>
        </ul>

    </li>

    <li role="presentation" class="<?=$disabledClass?>"><a href="#approve-invoice" class="procurement-nav-a">Утвердить накладную</a></li>

</ul>

<div class="tab-content">

    <div role="tabpanel" class="tab-pane" id="add-product">
        <div class='edit-product-wrapper'>
            <?= $this->render('/product/create_form', ['product' => $product]); ?>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="margin">
        <?= $this->render('/invoice-procurement/products_pricing_form', [
            'procurement_id' =>$invoiceProcurement_id
        ]); ?>
    </div>

    <div role="tabpanel" class="tab-pane" id="approve-invoice">
        <div class='edit-product-wrapper'>
            <?= $this->render('/invoice-procurement/approve_invoice_form', [
                'procurement_id' =>  $invoiceProcurement_id
            ]); ?>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="print">Печать</div>
</div>