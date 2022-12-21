<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Test\Unit\Model\Config\Source;

use Edifference\In3OnsiteMessaging\Model\Config\Source\Locations;
use PHPUnit\Framework\TestCase;

/**
 * @copyright (c) eDifference 2022
 */
class LocationsTest extends TestCase
{
    /** @var Locations */
    private Locations $model;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->model = new Locations();
    }

    /**
     * Test result of options array
     * @return void
     */
    public function testToOptionArray(): void
    {
        $expectedResult = [
            ['value' => 'product_page', 'label' => __('Product Page')],
            ['value' => 'shopping_cart', 'label' => __('Shopping Cart')],
            ['value' => 'checkout', 'label' => __('Checkout')],
        ];
        $this->assertEquals($expectedResult, $this->model->toOptionArray());
    }
}
