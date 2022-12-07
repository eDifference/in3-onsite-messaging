<?php
declare(strict_types = 1);

namespace Edifference\In3OnsiteMessaging\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }
}
