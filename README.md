# In3 Onsite Messaging for Magento 2

Good things come [In3][in3].
We believe in responsible spending for purchases that matter. Whether you are buying that new washing machine or the new bed you have been thinking about, a worse alternative should never be the option. In3 is here to help.

In3 Onsite Messaging plug-in for Magento 2 enables dynamic labels on the webshop to display that products and quotes can be bought with In3.
Payment method is not provided through this plugin but handled by your PSP.

## Installation

### Magento Marketplace

The recommended way of installing is through Magento Marketplace, where you can
find [In3 Onsite Messaging][marketplace].

### Activate module

1. Enter following commands to enable extension:
   ```bash
   php bin/magento module:enable Edifference_In3OnsiteMessaging
   php bin/magento setup:upgrade
   php bin/magento cache:clean
   ```
2. Configure extension as per configuration instructions

## Configuration
1. Log in to Magento Admin
2. Go to Stores > Configuration > In3 Onsite Messaging and configure settings

[in3]: https://payin3.eu
[marketplace]: https://marketplace.magento.com/
