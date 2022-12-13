<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Test\Unit\Model;

use Edifference\In3OnsiteMessaging\Model\Config;
use Edifference\In3OnsiteMessaging\Model\ConfigProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magento\Store\Model\ScopeInterface;
use PHPUnit\Framework\TestCase;

/**
 * @copyright (c) eDifference 2022
 */
class ConfigProviderTest extends TestCase
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
     * Test config set by config provider for use in frontend
     * @return void
     */
    public function testLocations(): void
    {
        $scopeConfig = $this->getMockForAbstractClass(ScopeConfigInterface::class);
        $scopeConfig->method('getValue')
            ->will($this->returnValueMap([
                ['in3_onsite_messaging/price/min', ScopeInterface::SCOPE_STORE, null, 100],
                ['in3_onsite_messaging/price/max', ScopeInterface::SCOPE_STORE, null, 1000],
                ['in3_onsite_messaging/frontend/theme', ScopeInterface::SCOPE_STORE, null, 'dark'],
                ['in3_onsite_messaging/frontend/locations', ScopeInterface::SCOPE_STORE, null, 'checkout'],
            ]));

        /** @var Config $model */
        $config = $this->objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $scopeConfig,
            ]
        );
        /** @var ConfigProvider $configProvider */
        $configProvider = $this->objectManager->getObject(
            ConfigProvider::class,
            [
                'config' => $config,
            ]
        );
        $this->assertEquals([
            'in3' => [
                'min' => 100,
                'max' => 1000,
                'theme' => 'dark',
                'showInCheckout' => true,
            ],
        ], $configProvider->getConfig());
    }
}
