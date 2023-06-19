define([
    'Edifference_In3OnsiteMessaging/js/in3-banner',
    'Magento_Checkout/js/model/quote',
], function (
    Component,
    quote
) {
    'use strict';

    return Component.extend({
        /**
         * Initialize
         *
         * @returns {*}
         */
        initialize: function () {
            this._super()

            let parent = this;
            quote.totals.subscribe(function (newValue) {
                parent.amount(newValue['grand_total']);
            });
            this.amount(parseFloat(quote.totals().grand_total));

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
        }
    });
});
