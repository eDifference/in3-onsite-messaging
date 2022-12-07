<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Block;

use Edifference\In3OnsiteMessaging\Model\Config\Source\Locations;

/**
 * @copyright (c) eDifference 2022
 */
class CheckoutBanner extends AbstractBanner
{
    /**
     * @return string
     */
    protected function _toHtml()
    {
        if (!$this->isValidLocation(Locations::CHECKOUT)) {
            return '';
        }
        return parent::_toHtml();
    }
}
