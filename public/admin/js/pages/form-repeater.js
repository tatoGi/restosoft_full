/*=========================================================================================
    File Name: form-repeater.js
    Description: form repeater page specific js
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy HTML Admin Template
    Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function() {
    'use strict';

    // Check if repeater plugin is loaded
    if (typeof $.fn.repeater === 'undefined') {
        console.error('jQuery repeater plugin is not loaded');
        return;
    }

    // Initialize repeater for all repeater elements
    $('.invoice-repeater, .repeater-default').each(function() {
        $(this).repeater({
            show: function () {
                $(this).slideDown();
            },
            hide: function (deleteElement) {
                if (confirm('Are you sure you want to delete this element?')) {
                    $(this).slideUp(deleteElement);
                }
            },
            ready: function() {
                // Any initialization code for new elements
            }
        });
    });
});
