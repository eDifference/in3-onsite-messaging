<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Model;

use Edifference\In3OnsiteMessaging\Model\Config\Source\Locations;
use Magento\Checkout\Model\ConfigProviderInterface;

/**
 * @copyright (c) eDifference 2022
 */
class ConfigProvider implements ConfigProviderInterface
{
    /** @var Config */
    private Config $config;

    /**
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @inheritdoc
     */
    public function getConfig(): array
    {
        return [
            'in3' => [
                'min' => $this->config->getMinPrice(),
                'max' => $this->config->getMaxPrice(),
                'theme' => $this->config->getTheme(),
                'showInCheckout' => in_array(
                    Locations::CHECKOUT,
                    $this->config->getLocations(),
                    true
                )
            ]
        ];
    }
}
