<?
//echo "<pre>" . print_r($products,1) . "</pre>"; die;
$products = $productsList->get();
$attributes = $productsList->getAttributes();
//echo "<pre>" . print_r($attributes ,1) . "</pre>"; die;
?>
    <table id="table" class="cell-border table-hover" style="width:100%">
        <thead>
        <tr>
            <? if (isset($attributes['info']['#'])) { ?>
                <th>#</th>
            <? } ?>
            <? if (isset($attributes['info']['check'])) { ?>
                <th></th>
            <? } ?>

            <? foreach ($attributes['data'] as $label) { ?>
                <th><?=$label?></th>
            <? } ?>
        </tr>
        </thead>
        <tbody>
        <?
        if (!empty($products)) {
            foreach ($products as $product) { ?>
                <tr>
                    <? if (isset($attributes['info']['#'])) { ?>
                        <th></th>
                    <? } ?>

                    <? if (isset($attributes['info']['check'])) { ?>
                        <th>
                            <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default">
                                <input type="checkbox" autocomplete="off">
                                <span class="glyphicon glyphicon-ok"></span>
                            </label>
                            </div>
                        </th>
                    <? } ?>

                    <? foreach ($attributes['data'] as $attribute => $label) { ?>
                        <td><?= $product[$attribute] ?? '' ?></td>
                    <? } ?>

                </tr>
            <? }
        }
        ?>
        </tbody>
    </table>

<?
$script = <<<JS
    $(document).ready(function() {
        var t = $('#table').DataTable({
            scrollY:        '65vh',
            scrollCollapse: true,
            paging:         false,
            "order": [[ 1, 'asc' ]],
            "language": {
                "info": "Показаны записи <b>_START_-_END_</b> из <b>_TOTAL_</b>"
            }
        });
        
        t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                cell.innerHTML = i+1;
            } );
        } ).draw();
        
    } );
JS;
$this->registerCssFile("https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::className()]
]);
$this->registerJsFile(
    'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js',
    ['depends' => [\yii\web\JqueryAsset::className()]]
);
$this->registerJs($script, \yii\web\View::POS_READY);
?>