<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Block;

use Edifference\In3OnsiteMessaging\Model\Config;
use Edifference\In3OnsiteMessaging\Model\Config\Source\Locations;
use Magento\Catalog\Helper\Data as CatalogHelper;
use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\Product\Type;
use Magento\Framework\View\Element\Template\Context;
use Magento\GroupedProduct\Model\Product\Type\Grouped;

/**
 * @copyright (c) eDifference 2022
 */
class ProductBanner extends AbstractBanner
{
    protected CatalogHelper $catalogHelper;

    /**
     * @param Context       $context
     * @param Config        $config
     * @param CatalogHelper $catalogHelper
     * @param array         $data
     */
    public function __construct(
        Context       $context,
        Config        $config,
        CatalogHelper $catalogHelper,
        array         $data = []
    ) {
        parent::__construct(
            $context,
            $config,
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
        if (!$this->hasProductTypeRestriction($product)) {
            return parent::_toHtml();
        }
        foreach (array_merge(
                     $product->getTypeInstance()->getAssociatedProducts($product),
                     [$product]
                 ) as $associatedProduct) {
            if ($product->getTypeId() === Grouped::TYPE_CODE) {
                continue;
            }
            if ($associatedProduct->getFinalPrice() < $this->getMin()) {
                return '';
            }
            if ($associatedProduct->getFinalPrice() > $this->getMax()) {
                return '';
            }
        }

        return parent::_toHtml();
    }

    /**
     * @param Product $product
     * @return bool
     */
    private function hasProductTypeRestriction(Product $product): bool
    {
        if ($product->getTypeId() === Type::TYPE_SIMPLE) {
            return true;
        }
        if ($product->getTypeId() === Grouped::TYPE_CODE) {
            return true;
        }
        return false;
    }
}
