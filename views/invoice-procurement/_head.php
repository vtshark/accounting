<?
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;

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
    'header' => 'Выбор накладной',
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
if ($invoiceProcurement) {
    $invoiceDescription = $invoiceProcurement->id . " " .
        $invoiceProcurement->supplier->name_short . " " .
    $disabledClass = '';
    $disabledAddProd = '';
} else {
    $invoiceDescription = "";
    $disabledClass = 'disabled';
    $disabledAddProd = 'disabled';
}
if ($store_id <> 1) {
    $disabledAddProd = 'disabled';
}
$stores = \app\models\Stores::getStores(['store_type_id' => [1, 2]]);
?>


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

    <li role="presentation">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Филиал: <?=$stores[$store_id]['name']?><span class="caret"></span>
        </a>
        <ul class="dropdown-menu" id="choose-store">
            <?php
            foreach ($stores as $store) { ?>
                <li role="presentation">
                    <a href="<?= Url::current(['store' => $store['id'] ]) ?>"><?= $store['name'] ?></a>
                </li>
                <li role="separator" class="divider"></li>
            <?  }?>
        </ul>
    </li>

    <li role="presentation" class="<?=$disabledAddProd?>"><a href="#add-product" class="procurement-nav-a">Добавить изделие</a></li>
    <li role="presentation" class="<?=$disabledClass?>"><a href="#price" class="procurement-nav-a">Наценка</a></li>
    <li role="presentation" class="dropdown <?=$disabledClass?>">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Печать <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <li role="presentation"><a href="#" id="choose-id-invoice-li">Печать накладной</a></li>
            <li role="separator" class="divider"></li>
            <li role="presentation"><a href="#" id="create-invoice-li">Печать бирок</a></li>
        </ul>

    </li>

    <li role="presentation">
        <a class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
            Перевести на филиал<span class="caret"></span>
        </a>
        <ul class="dropdown-menu" id="choose-store">
            <?php
            foreach ($stores as $store) {
                if ($store['id'] == 1) continue;
            ?>
                <li role="separator" class="divider"></li>
                <li role="presentation">
                    <a href="#"><?= $store['name'] ?></a>
                </li>
            <?  }?>
        </ul>

    </li>

</ul>

<div class="tab-content">

    <div role="tabpanel" class="tab-pane" id="add-product">
        <div class='edit-product-wrapper'>
            <?= $this->render('/product/create_form', ['product' => $product]); ?>
        </div>
    </div>

    <div role="tabpanel" class="tab-pane" id="price">Наценка</div>
    <div role="tabpanel" class="tab-pane" id="print">Печать</div>
</div>