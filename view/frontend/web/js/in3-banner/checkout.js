define([
    'Edifference_In3OnsiteMessaging/js/in3-banner',
    'Magento_Checkout/js/model/totals',
    'Magento_Checkout/js/model/step-navigator',
], function (
    Component,
    totalsService,
    stepNavigator
) {
    "use strict";

    return Component.extend({
        /**
         * Initialize
         *
         * @returns {*}
         */
        initialize: function () {
            this._super();

            this.theme = window.checkoutConfig.in3.theme;

            let parent = this;
            totalsService.totals.subscribe(function (newValue) {
                parent.amount(newValue['grand_total']);
            });

            return this;
        },

        isVisible: function() {
            if (!this.amount()) {
                return false;
            }
            if (!window.checkoutConfig.in3.showInCheckout) {
                return false;
            }
            if (this.amount() < window.checkoutConfig.in3.min) {
                return false;
            }
            if (this.amount() > window.checkoutConfig.in3.max) {
                return false;
            }
            return stepNavigator.isProcessed('shipping');
        }
    });
});
