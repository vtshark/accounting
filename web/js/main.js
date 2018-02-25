"use strict";
$(document).ready(function () {

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
