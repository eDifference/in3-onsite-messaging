<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Block;

use Edifference\In3OnsiteMessaging\Model\Config;
use Edifference\In3OnsiteMessaging\Model\Config\Source\Locations;
use Magento\Catalog\Helper\Data as CatalogHelper;
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
     * @param PricingHelper $priceHelper
     * @param CatalogHelper $catalogHelper
     * @param array         $data
     */
    public function __construct(
        Context       $context,
        Config        $config,
        PricingHelper $priceHelper,
        CatalogHelper $catalogHelper,
        array         $data = []
    ) {
        parent::__construct(
            $context,
            $config,
            $priceHelper,
            $data
        );
        $this->catalogHelper = $catalogHelper;
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
        return parent::_toHtml();
    }
}
