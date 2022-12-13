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
            template: 'Edifference_In3OnsiteMessaging/banner',
        },
        min: null,
        max: null,
        theme: null,
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
                parent.amount(newValue['grand_total']);
            });
            this.amount(quote.totals().grand_total);

            return this;
        },

        isVisible: function() {
            if (this.amount() < this.min) {
                return false;
            }
            if (this.amount() > this.max) {
                return false;
            }
            return true;
        },

        getAmount: function() {
            return priceUtils.formatPrice(this.amount()/3);
        },

        getTheme: function() {
            return this.theme;
        }
    });
});
