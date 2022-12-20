define([
    'ko',
    'uiComponent',
    'jquery',
    'Magento_Catalog/js/price-utils'
], function (
    ko,
    Component,
    jQuery,
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
            this._super();
            this.observe(['amount']);

            jQuery(document).on('click', '.in3-widget .tooltip-toggle', function () {
                jQuery('.in3-tooltip').toggleClass('show');
            });
        },

        getAmount: function() {
            return priceUtils.formatPrice(this.amount()/3);
        },

        /**
         * Handle product price change
         *
         * @param {jQuery.Event} event
         * @param {Object} data
         * @private
         */
        _onPriceChange: function (event, data) {
            if (_.isEmpty(data)) {
                return;
            }
            this.amount(data.finalPrice.amount);
        },

        getTheme: function() {
            return this.theme;
        },

        getPayIn3Url: function() {
            return this.url;
        }
    });
});
