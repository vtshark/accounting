<?
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Выдачи';
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    //'size' => 'modal-sm',
    'header' => 'Поиск накладной',
    'id' => 'choose-id-invoice-modal',
    'toggleButton' => [
        'id' => 'choose-id-invoice-btn',
        'label' => 'Выбор накладной',
        'tag' => 'button',
        'data-href' => Url::toRoute(['invoice-transfer/list']),
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
        'data-href' => Url::toRoute(['invoice-transfer/create-form']),
        'class' => 'btn btn-primary hidden'
    ],
]);
Modal::end();
$disabledClass = $disabledAddProd = '';

if ($invoiceTransfer) {
    $invoiceDescription = $invoiceTransfer->id . " " .
        $invoiceTransfer->store->name . " ";
    if ($invoiceTransfer->is_closed) {
        $invoiceDescription .= '<span class="glyphicon glyphicon-ok"></span>';
    }
    if ($invoiceTransfer->is_closed) {
        $disabledClass = 'disabled';
        $disabledAddProd = 'disabled';
    }
} else {
    $invoiceDescription = "";
    $disabledClass = 'disabled';
    $disabledAddProd = 'disabled';
}

?>

<input id="invoice-id" type="hidden" value="<?= $invoiceTransfer->id ?>">
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
        <a href="<?= Url::toRoute(['product/selection/transfer_products-' . $invoiceTransfer->id]) ?>">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
            Поиск изделий
        </a>
    </li>

</ul>