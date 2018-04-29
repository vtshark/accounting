"use strict";
var currentRow;
$(document).ready(function () {

    $('#products_table').floatThead({
        position: 'fixed'
    });

    $('#invoice-menu A').click(function(e) {
        e.preventDefault();
        var id = $(this).attr('id');
        id = '#' + id.replace('li', 'btn');
        $(id).trigger('click');
    });

    $('.nav-tabs .procurement-nav-a').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    $('#choose-id-invoice-btn').click(function() {
        $('#choose-id-invoice-modal .modal-body').load($(this).data('href'));
    });

    $('#create-invoice-btn').click(function() {
        $('#create-invoice-modal .modal-body').load($(this).data('href'));
    });

    $('#create-product-form-btn').click(function() {
        $('#create-product-wrapper').load($(this).data('href'));
        //$.pjax.reload({container:'#products_list'});
    });
    $('#products_list')
        .on('click', '.edit-product', {}, function (e) {
            currentRow = $(this).closest('TR').data('key');
            e.preventDefault();
            $('#update-product-modal .modal-body').load($(this).data('href'));
            $('#update-product-btn').trigger('click');
        })
        .on('click', '.del-product', {}, function (e) {
            e.preventDefault();
            if (confirm("Удалить изделие?")) {
                var url = $(this).data('href');
                $.ajax({
                    url: url, type: 'GET', dataType: 'json',
                    success: function (json) {
                        if (json.error) {
                            console.log(json.data);
                        } else {
                            delProductRow(json.data.id);
                        }
                    },
                    error: function (json) {
                        console.log('Error!');
                    }
                });
            }
        });

    $('.edit-product-wrapper')
        .on('submit', '#create-product-form', {}, function () {
            return false;
        })
        .on('beforeSubmit', '#create-product-form', {}, function () {
            return false;
        })
        .on('afterValidate', '#create-product-form', function (event, messages, errorAttributes) {
            var data = $(this).serialize();
            $.ajax({
                url: "/product/create",
                data: data,
                type: 'POST',
                dataType: 'json',
                success: function (json) {
                    //console.log(json);
                    if (json.error) {
                        console.log(json.data);
                    } else {
                        addProductRow(json.data, json.newRecord);
                        if (!json.newRecord) {
                            $('.edit-product-wrapper #update-product-modal').modal('toggle');
                        }
                    }
                },
                error: function (json) {
                    console.log('Error!');
                }
            });
        });

    $("#choose-store-for-transfer-products A").click(function(e) {
        e.preventDefault();
        transferProducts($(this));
    });

});


/**
 * функция добавляет/обновляет данные в таблице продуктов
 * @param product
 * @param newRecord
 */
function addProductRow(product, newRecord) {

    //console.log(product.length); return false;

    var newDataArr = [];
    var newProduct = [];

    for(var i = 0; i < product.length; i++) {
        newProduct = [];
        //console.log(product[i]);
        for (var key in product[i]) {
            newProduct.push(product[i][key]);
            //console.log(product[i][key]);
        }
        newDataArr.push(newProduct);
    }
    // console.log(newDataArr);
    // return false;
    if (newRecord) {

        if (!$('#products_table > tbody tr a span').length) {
             $.pjax.reload({container: '#products_list'});
        } else {

            var newRowStr = '';
            for (var j = 0; j < newDataArr.length; j++) {
                //product = newDataArr[i];
                newRowStr += '<tr data-key="' + newDataArr[j][0] + '"><td></td>';
                for (i = 0; i < newDataArr[j].length; i++) {
                    newRowStr += '<td>' + newDataArr[j][i] + '</td>'
                }

                // клонирование ячейки  с иконками из последнего столбца
                // и обновление аттрибутов для новой записи в таблице
                //console.log($('#products_table > tbody tr a span').length);

                var cloneTd = $('#products_table > tbody tr').first().children(':last-child').clone();

                cloneTd.find('a span').each(function (elem) {
                    var href = $(this).data('href');
                    if (href) {
                        var arr = href.split("/");
                        arr[arr.length - 1] = newDataArr[j][0];
                        var newHref = arr.join('/');
                        $(this).attr('data-href', newHref);
                    }
                });
                newRowStr += '<td>' + cloneTd.html() + '</td>';
                newRowStr += '</tr>';
            }

            $('#products_table > tbody').prepend(newRowStr);
        }

    } else {
        $('#products_table > tbody tr[data-key="' + currentRow + '"]').children().each(function(i,elem) {
            if (newDataArr[0][ i - 1 ]) {
                elem.innerHTML = newDataArr[0][i - 1];
            }
        });
    }

}

function delProductRow(idProduct) {
    $('#products_table > tbody tr[data-key="' + idProduct + '"]').remove();
}

function transferProducts(currentObj) {
    var invoice_id = $("#invoice-id").val();
    bootbox.confirm({
        message: "Выполнить перевод изделий на филиал <" + currentObj.text() + ">?",
        buttons: {
            confirm: {label: 'Ok', className: 'btn-default' },
            cancel: {label: 'Отмена', className: 'btn-default' }
        },
        callback: function (result) {
            if (result) {
                $.ajax({
                    url: "/product/transfer-from-tmp-store/",
                    data: {store_id: currentObj.data('store-id'), invoice_id: invoice_id},
                    type: 'POST',
                    dataType: 'json',
                    success: function (json) {
                        //console.log(json);
                        if (json.error) {
                            console.log(json.errors);
                        } else {
                            bootbox.alert("Переведено " + json.data.count + " изделий на филиал <" + currentObj.text() + ">");
                            $.pjax.reload({container: '#products_list'});
                        }
                    },
                    error: function (json) {
                        console.log('Error!');
                    }
                });

                console.log(currentObj.data('store-id'));
            }
        }
    });
}
