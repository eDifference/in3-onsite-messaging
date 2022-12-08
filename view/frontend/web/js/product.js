/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

define([
    'jquery',
    'uiElement',
    'priceBox',
    'domReady!'
], function (
    $,
    Component
) {
    'use strict';

    return Component.extend({

        defaults: {
            template: 'Edifference_In3OnsiteMessaging/label',
            priceBoxSelector: '.price-box',
        },
        min: null,
        max: null,
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
        },

        getAmount: function() {
            return this.amount;
        }
    });
});
