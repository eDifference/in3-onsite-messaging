define([
    'jquery',
    'uiElement',
    'Magento_Catalog/js/price-utils',
    'priceBox',
    'domReady!'
], function (
    $,
    Component,
    priceUtils
) {
    'use strict';

    return Component.extend({

        defaults: {
            template: 'Edifference_In3OnsiteMessaging/banner',
            priceBoxSelector: '.price-box',
        },
        min: null,
        max: null,
        theme: null,
        amount: 0,

        /**
         * Initialize
         *
         * @returns {*}
         */
        initialize: function () {
            var priceBox;

            this._super()
                .observe(['amount']);

            priceBox = $(this.priceBoxSelector);
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
        },

        /**
         * Handle product price change
         *
         * @param {jQuery.Event} event
         * @param {Object} data
         * @private
         */
        _onPriceChange: function (event, data) {
            console.debug(data);
            console.debug(data.finalPrice.final);
            console.debug(this.min, this.max);
            this.amount(data.finalPrice.final);
        },

        getAmount: function() {
            return priceUtils.formatPrice(this.amount()/3);
        },

        getTheme: function() {
            return this.theme;
        }
    });
});
