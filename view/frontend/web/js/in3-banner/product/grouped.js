define([
    'Edifference_In3OnsiteMessaging/js/in3-banner/product',
    'mage/translate'
], function (
    Component,
    $t
) {
    'use strict';

    return Component.extend({
        isVisible: function() {
            return true;
        },

        getPayIn3Text: function() {
            return $t('Or pay <strong>in 3 instalments</strong>, 0% interest');
        }
    });
});
