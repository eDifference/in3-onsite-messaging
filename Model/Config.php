<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * @copyright (c) eDifference 2022
 */
class Config
{
    public const XML_PATH_FRONTEND_LOCATIONS = 'in3_onsite_messaging/frontend/locations';
    public const XML_PATH_FRONTEND_THEME = 'in3_onsite_messaging/frontend/theme';
    public const XML_PATH_PRICE_MIN = 'in3_onsite_messaging/price/min';
    public const XML_PATH_PRICE_MAX = 'in3_onsite_messaging/price/max';

    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * Get locations which should display the banner
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return array
     */
    public function getLocations(int|null|string|ScopeConfigInterface $scopeCode = null): array
    {
        $value = $this->scopeConfig->getValue(
            self::XML_PATH_FRONTEND_LOCATIONS,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
        if (is_null($value)) {
            return [];
        }
        return explode(',', $value);
    }

    /**
     * Get the theme for the banner
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return string
     */
    public function getTheme(int|null|string|ScopeConfigInterface $scopeCode = null): string
    {
        return $this->scopeConfig->getValue(
            self::XML_PATH_FRONTEND_THEME,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Get the min price of the product or quote to show the label
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return int
     */
    public function getMinPrice(int|null|string|ScopeConfigInterface $scopeCode = null): int
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRICE_MIN,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Get the min price of the product or quote to show the label
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return int
     */
    public function getMaxPrice(int|null|string|ScopeConfigInterface $scopeCode = null): int
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRICE_MAX,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }
}
