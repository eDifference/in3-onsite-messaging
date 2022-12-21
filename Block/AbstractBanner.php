<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Block;

use Edifference\In3OnsiteMessaging\Model\Config;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

/**
 * @copyright (c) eDifference 2022
 */
abstract class AbstractBanner extends Template
{
    /** @var Config */
    protected Config $config;

    private const DEFAULT_LOCAL_LANGUAGE = 'en';
    private const DEFAULT_LOCAL_LANGUAGE_LIST = [
        self::DEFAULT_LOCAL_LANGUAGE,
        'nl'
    ];

    /**
     * @param Context       $context
     * @param Config        $config
     * @param array         $data
     */
    public function __construct(
        Context       $context,
        Config        $config,
        array         $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );
        $this->config = $config;
    }

    /**
     * Get the configured theme
     *
     * @return string
     */
    public function getTheme(): string
    {
        return $this->config->getTheme();
    }

    /**
     * Get the configured min amount to display the in3 banner
     *
     * @return int
     */
    public function getMin(): int
    {
        return $this->config->getMinPrice();
    }

    /**
     * Get the configured max amount to display the in3 banner
     *
     * @return int
     */
    public function getMax(): int
    {
        return $this->config->getMaxPrice();
    }

    /**
     * Check if location of banner is in configured location list and should show
     *
     * @param string $location
     * @return bool
     */
    public function isValidLocation(string $location): bool
    {
        return in_array(
            $location,
            $this->config->getLocations(),
            true
        );
    }

    /**
     * Return payin3.eu link with Current Country and Language code and Base URL for Analytic measurements
     *
     * @return string
     */
    public function getPayIn3Url(): string
    {
        return 'https://payin3.eu/' . $this->getValidLocalLanguageByWebsite() . '/?country=' .
        $this->config->getCountryCodeByWebsite() .
        '&_&utm_source=' . $this->getBaseUrl() .
        '&utm_medium=onsiteplugin&utm_campaign=magento&utm_content=readmore';
    }

    /**
     * Return the valid local language `nl` or `en` for a specific website
     *
     * @return string
     */
    private function getValidLocalLanguageByWebsite(): string
    {
        $localeLanguage = $this->config->getLocaleLanguageByWebsite();
        if (in_array($localeLanguage, self::DEFAULT_LOCAL_LANGUAGE_LIST, true)) {
            return $localeLanguage;
        }
        return self::DEFAULT_LOCAL_LANGUAGE;
    }
}
