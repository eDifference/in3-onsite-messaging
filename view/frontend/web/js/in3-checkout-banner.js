define([
    'ko',
    'uiComponent',
    'Magento_Checkout/js/model/totals',
    'Magento_Catalog/js/price-utils',
    'Magento_Checkout/js/model/step-navigator',
    'domReady!'
], function (
    ko,
    Component,
    totalsService,
    priceUtils,
    stepNavigator
) {
    "use strict";

    return Component.extend({
        defaults: {
            template: 'Edifference_In3OnsiteMessaging/banner'
        },
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
            totalsService.totals.subscribe(function (newValue) {
                parent.amount(newValue['base_grand_total']);
            });

            return this;
        },

        isVisible: function() {
            if (!this.amount()) {
                return false;
            }
            if (this.amount() < window.checkoutConfig.in3.min) {
                return false;
            }
            if (this.amount() > window.checkoutConfig.in3.max) {
                return false;
            }
            return stepNavigator.isProcessed('shipping');
        },

        getAmount: function() {
            return priceUtils.formatPrice(this.amount()/3);
        },

        getTheme: function() {
          return window.checkoutConfig.in3.theme
        }
    });
});
