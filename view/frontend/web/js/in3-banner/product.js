define([
    'Edifference_In3OnsiteMessaging/js/in3-banner',
    'priceBox'
], function (
    Component
) {
    'use strict';

    return Component.extend({
        /**
         * Initialize
         *
         * @returns {*}
         */
        initialize: function () {
            this._super();

            var priceBox;

            priceBox = jQuery(this.priceBoxSelector);
            priceBox.on('priceUpdated', this._onPriceChange.bind(this));
            priceBox.trigger('updatePrice');

            return this;
        },

        isVisible: function() {
            if (!this.amount()) {
                return false;
            }
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
