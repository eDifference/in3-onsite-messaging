<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Block;

use Edifference\In3OnsiteMessaging\Model\Config;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Pricing\Helper\Data as PricingHelper;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Quote\Api\Data\CartInterface;

/**
 * @copyright (c) eDifference 2022
 */
class AbstractBanner extends Template
{
    protected Config $config;
    protected CartInterface $quote;
    protected PricingHelper $priceHelper;

    /**
     * @param Context       $context
     * @param Config        $config
     * @param Session       $checkoutSession
     * @param PricingHelper $priceHelper
     * @param array         $data
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function __construct(
        Context       $context,
        Config        $config,
        Session       $checkoutSession,
        PricingHelper $priceHelper,
        array         $data = []
    ) {
        parent::__construct(
            $context,
            $data
        );
        $this->config = $config;
        $this->quote = $checkoutSession->getQuote();
        $this->priceHelper = $priceHelper;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->priceHelper->currency($this->quote->getGrandTotal()/3);
    }

    /**
     * @return string
     */
    public function getTheme(): string
    {
        return $this->config->getTheme();
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
     * Check if grand total of quote is between min/max config setting
     * @return bool
     */
    protected function isValidQuoteTotal(): bool
    {
        if ($this->quote->getGrandTotal() < $this->config->getMinPrice()) {
            return false;
        }
        if ($this->quote->getGrandTotal() > $this->config->getMaxPrice()) {
            return false;
        }
        return true;
    }
}
