"use strict";
$(document).ready(function () {
    $('#choose-id-invoice-btn').click(function () {
        $('#choose-id-invoice-modal .modal-body').load($(this).data('href'));
    });
    $('#find-invoice').click(function () {
        $('#choose-id-invoice-btn').trigger('click');
    });
    /*$('#new-invoice').click(function () {
        if (true) {
            $.ajax({
                url: "invoice-procurement/create-ajax",
                data: {},
                type: 'POST',
                dataType: 'json',
                success: function (json) {
                    console.log(json);
                    if (json.error) {

                    } else {

                    }
                },
                error: function (json) {
                    console.log('Error!');
                }
            });
        }
    });*/
});
