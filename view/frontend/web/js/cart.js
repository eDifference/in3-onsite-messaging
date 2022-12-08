define([
    'jquery',
    'ko',
    'uiElement',
    'Magento_Checkout/js/model/quote',
    'Magento_Catalog/js/price-utils',
    'domReady!'
], function (
    $,
    ko,
    Component,
    quote,
    priceUtils
) {
    'use strict';

    return Component.extend({
        defaults: {
            template: 'Edifference_In3OnsiteMessaging/label',
        },
        min: null,
        max: null,
        amount: null,

        /**
         * Initialize
         *
         * @returns {*}
         */
        initialize: function () {
            this._super()
            this.observe(['amount']);

            let parent = this;
            quote.totals.subscribe(function (newValue) {
                parent.amount(newValue['base_grand_total']);
            });

            return this;
        },

        getAmount: function() {
            return priceUtils.formatPrice(this.amount()/3);
        }
    });
});
