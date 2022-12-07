<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Block;

use Edifference\In3OnsiteMessaging\Model\Config;
use Edifference\In3OnsiteMessaging\Model\Config\Source\Locations;
use Magento\Catalog\Helper\Data as CatalogHelper;
use Magento\Checkout\Model\Session;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Pricing\Helper\Data as PricingHelper;
use Magento\Framework\View\Element\Template\Context;

/**
 * @copyright (c) eDifference 2022
 */
class ProductBanner extends AbstractBanner
{
    protected CatalogHelper $catalogHelper;

    /**
     * @param Context       $context
     * @param Config        $config
     * @param Session       $checkoutSession
     * @param CatalogHelper $catalogHelper
     * @param array         $data
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function __construct(
        Context       $context,
        Config        $config,
        Session       $checkoutSession,
        PricingHelper $priceHelper,
        CatalogHelper $catalogHelper,
        array         $data = []
    ) {
        parent::__construct(
            $context,
            $config,
            $checkoutSession,
            $priceHelper,
            $data
        );
        $this->catalogHelper = $catalogHelper;
    }

    /**
     * @return string
     */
    public function getAmount(): string
    {
        return $this->priceHelper->currency(
            $this->catalogHelper->getProduct()->getFinalPrice() / 3
        );
    }

    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->isValidLocation(Locations::PRODUCT_PAGE)) {
            return '';
        }
        $product = $this->catalogHelper->getProduct();
        if (!$product) {
            return '';
        }
        if ($product->getFinalPrice() <  $this->config->getMinPrice()) {
            return '';
        }
        if ($product->getFinalPrice() > $this->config->getMaxPrice()) {
            return '';
        }
        return parent::_toHtml();
    }
}
