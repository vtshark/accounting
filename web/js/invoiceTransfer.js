"use strict";
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

    $('#choose-id-invoice-btn').click(function() {
        $('#choose-id-invoice-modal .modal-body').load($(this).data('href'));
    });

    $('#create-invoice-btn').click(function() {
        $('#create-invoice-modal .modal-body').load($(this).data('href'));
    });


});