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
    public const XML_PATH_COUNTRY_CODE_PATH = 'general/country/default';
    public const XML_PATH_LOCALE_PATH = 'general/locale/code';

    /** @var ScopeConfigInterface */
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
     *
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return array
     */
    public function getLocations(ScopeConfigInterface $scopeCode = null): array
    {
        $value = $this->scopeConfig->getValue(
            self::XML_PATH_FRONTEND_LOCATIONS,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
        if ($value === null) {
            return [];
        }
        return explode(',', $value);
    }

    /**
     * Get the theme for the banner
     *
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return string
     */
    public function getTheme(ScopeConfigInterface $scopeCode = null): string
    {
        return (string) $this->scopeConfig->getValue(
            self::XML_PATH_FRONTEND_THEME,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Get the min price of the product or quote to show the label
     *
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return int
     */
    public function getMinPrice(ScopeConfigInterface $scopeCode = null): int
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRICE_MIN,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Get the min price of the product or quote to show the label
     *
     * @param int|string|ScopeConfigInterface|null $scopeCode
     * @return int
     */
    public function getMaxPrice(ScopeConfigInterface $scopeCode = null): int
    {
        return (int) $this->scopeConfig->getValue(
            self::XML_PATH_PRICE_MAX,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );
    }

    /**
     * Get Country code by website scope
     *
     * @return string
     */
    public function getCountryCodeByWebsite(): string
    {
        return strtolower($this->scopeConfig->getValue(
            self::XML_PATH_COUNTRY_CODE_PATH,
            ScopeInterface::SCOPE_WEBSITES
        ));
    }

    /**
     * Get Locale language code by website scope
     *
     * @return string
     */
    public function getLocaleLanguageByWebsite(): string
    {
        return current(explode(
            '_',
            $this->scopeConfig->getValue(
                self::XML_PATH_LOCALE_PATH,
                ScopeInterface::SCOPE_WEBSITES
            )
        ));
    }
}
