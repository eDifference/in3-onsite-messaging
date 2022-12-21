<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * @copyright (c) eDifference 2022
 */
class Locations implements ArrayInterface
{
    public const PRODUCT_PAGE = 'product_page';
    public const SHOPPING_CART = 'shopping_cart';
    public const CHECKOUT = 'checkout';

    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => self::PRODUCT_PAGE, 'label' => __('Product Page')],
            ['value' => self::SHOPPING_CART, 'label' => __('Shopping Cart')],
            ['value' => self::CHECKOUT, 'label' => __('Checkout')],
        ];
    }
}
