<?php
declare(strict_types=1);

namespace Edifference\In3OnsiteMessaging\Test\Unit\Model;

use Edifference\In3OnsiteMessaging\Model\Config;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\TestCase;

/**
 * @copyright (c) eDifference 2022
 */
class ConfigTest extends TestCase
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
     * Test result of config setting locations
     * @dataProvider locationsProvider
     * @param ?string $config
     * @param array   $expected
     * @return void
     */
    public function testLocations(?string $config, array $expected): void
    {
        $scopeConfig = $this->getMockForAbstractClass(ScopeConfigInterface::class);
        $scopeConfig->expects($this->once())
            ->method('getValue')
            ->with(
                $this->stringContains('in3_onsite_messaging/frontend/locations')
            )->willReturn($config);

        /** @var Config $model */
        $model = $this->objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $scopeConfig,
            ]
        );

        $this->assertEquals($expected, $model->getLocations());
    }

    /**
     * @return array
     */
    public function locationsProvider(): array
    {
        return [
            [null, []],
            ['test', ['test']],
            ['test,test2', ['test', 'test2']],
        ];
    }

    /**
     * Test result of config setting theme
     * @dataProvider themeProvider
     * @param ?string $config
     * @param string  $expected
     * @return void
     */
    public function testTheme(?string $config, string $expected): void
    {
        $scopeConfig = $this->getMockForAbstractClass(ScopeConfigInterface::class);
        $scopeConfig->expects($this->once())
            ->method('getValue')
            ->with(
                $this->stringContains('in3_onsite_messaging/frontend/theme')
            )->willReturn($config);

        /** @var Config $model */
        $model = $this->objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $scopeConfig,
            ]
        );

        $this->assertEquals($expected, $model->getTheme());
    }

    /**
     * @return array
     */
    public function themeProvider(): array
    {
        return [
            [null, ''],
            ['test', 'test'],
        ];
    }

    /**
     * Test result of config setting min price
     * @dataProvider priceProvider
     * @param ?int $config
     * @param int  $expected
     * @return void
     */
    public function testMinPrice(?int $config, int $expected): void
    {
        $scopeConfig = $this->getMockForAbstractClass(ScopeConfigInterface::class);
        $scopeConfig->expects($this->once())
            ->method('getValue')
            ->with(
                $this->stringContains('in3_onsite_messaging/price/min')
            )->willReturn($config);

        /** @var Config $model */
        $model = $this->objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $scopeConfig,
            ]
        );

        $this->assertEquals($expected, $model->getMinPrice());
    }

    /**
     * Test result of config setting max price
     * @dataProvider priceProvider
     * @param ?int $config
     * @param int  $expected
     * @return void
     */
    public function testMaxPrice(?int $config, int $expected): void
    {
        $scopeConfig = $this->getMockForAbstractClass(ScopeConfigInterface::class);
        $scopeConfig->expects($this->once())
            ->method('getValue')
            ->with(
                $this->stringContains('in3_onsite_messaging/price/max')
            )->willReturn($config);

        /** @var Config $model */
        $model = $this->objectManager->getObject(
            Config::class,
            [
                'scopeConfig' => $scopeConfig,
            ]
        );

        $this->assertEquals($expected, $model->getMaxPrice());
    }

    /**
     * @return array
     */
    public function priceProvider(): array
    {
        return [
            [null, 0],
            [100, 100],
        ];
    }
}
