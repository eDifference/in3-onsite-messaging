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
    protected Config $config;

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
     * @return string
     */
    public function getTheme(): string
    {
        return $this->config->getTheme();
    }

    /**
     * @return int
     */
    public function getMin(): int
    {
        return $this->config->getMinPrice();
    }

    /**
     * @return int
     */
    public function getMax(): int
    {
        return $this->config->getMaxPrice();
    }

    /**
     * Check if location of banner is in configured location list and should show
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
     * @return string
     */
    public function getPayIn3Url(): string
    {
        return 'https://payin3.eu/' . $this->config->getLocaleLanguageByWebsite() . '/?country=' .
        $this->config->getCountryCodeByWebsite() .
        '&_&utm_source=' . $this->getBaseUrl() .
        '&utm_medium=onsiteplugin&utm_campaign=magento&utm_content=readmore';
    }
}
