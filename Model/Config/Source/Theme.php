<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

/**
 * @copyright (c) eDifference 2022
 */
class Theme implements ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => 'light', 'label' => __('Light Theme')],
            ['value' => 'dark', 'label' => __('Dark Theme')],
        ];
    }
}
