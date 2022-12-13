<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Test\Unit\Block;

use Edifference\In3OnsiteMessaging\Block\CartBanner;
use Edifference\In3OnsiteMessaging\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\TestCase;

/**
 * @copyright (c) eDifference 2022
 */
class BannerTest extends TestCase
{
    private ObjectManager $objectManager;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->objectManager = new ObjectManager($this);
    }

    /**
     * Test result of config and validation checks
     */
    public function testConfigAndValidCheck(): void
    {
        $scopeConfig = $this->getMockForAbstractClass(ScopeConfigInterface::class);
        $scopeConfig->expects($this->any())
           ->method('getValue')
           ->will($this->returnValueMap([
               ['in3_onsite_messaging/price/min', ScopeInterface::SCOPE_STORE, null, 100],
               ['in3_onsite_messaging/price/max', ScopeInterface::SCOPE_STORE, null, 1000],
               ['in3_onsite_messaging/frontend/theme', ScopeInterface::SCOPE_STORE, null, 'dark'],
               ['in3_onsite_messaging/frontend/locations', ScopeInterface::SCOPE_STORE, null, 'shopping_cart'],
           ]));

        /** @var Config $config */
        $config = $this->objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $scopeConfig,
            ]
        );

        /** @var CartBanner $block */
        $block = $this->objectManager->getObject(
            CartBanner::class,
            [
                'config' => $config
            ]
        );
        $this->assertTrue($block->isValidLocation('shopping_cart'));
        $this->assertFalse($block->isValidLocation('product_page'));
        $this->assertEquals(100, $block->getMin());
        $this->assertEquals(1000, $block->getMax());
        $this->assertEquals('dark', $block->getTheme());
    }
}
