"use strict";
$(document).ready(function () {

    $('.sidebar-wrapper .test').click(function (e) {
        //$(".sidebar-wrapper .table").toggle();
        $(".sidebar-wrapper span").toggleClass("hidden");
        // $(".sidebar-wrapper a").toggleClass("short-item");
    });

    $('#sidebar-btn').click(function (e) {
        e.preventDefault();
        $(".sidebar-wrapper").toggle();
    });


});
function confirmDelete(message) {
    bootbox.confirm({
        message: "message",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
            console.log('This was logged in the callback: ' + result);
        }
    });
}
