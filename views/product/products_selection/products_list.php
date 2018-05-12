<?
//echo "<pre>" . print_r($products,1) . "</pre>"; die;

?>
    <table id="example" class="display" style="width:100%">
        <thead>
        <tr>
            <th>#</th>
            <th>ID</th>
            <th>Name</th>
            <th>supplier_id</th>
            <th>size</th>
            <th>check</th>
        </tr>
        </thead>
        <tbody>
        <? foreach ($products as $product) { ?>
            <tr>
                <td></td>
                <td><?= $product['id'] ?></td>
                <td><?= $product['name_id'] ?></td>
                <td><?= $product['supplier_id'] ?></td>
                <td><?= $product['size'] ?></td>
                <td><input type="checkbox"></td>
            </tr>
        <? } ?>
        </tbody>
    </table>

<?
$script = <<<JS
    $(document).ready(function() {
        $('#example').DataTable({
        scrollY:        '65vh',
        scrollCollapse: true,
        paging:         false
    } );
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