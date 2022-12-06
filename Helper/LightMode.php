<?php
declare(strict_types = 1);

namespace Edifference\In3\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class LightMode extends AbstractHelper
{
    private Context $context;

    /** @var ScopeConfigInterface */
    protected $scopeConfig;

    /** @const string */
    const CONFIG_XML_PATH_ENABLE_LIGHT_MODE = 'in3_settings/enable_light_mode/light_mode_active';

    /**
     * Config constructor.
     * @param Context              $context
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * helper function to check if the Light Mode is enabled
     * @param boolean|null $scopeCode
     * @return boolean
     */
    public function hasLightModeEnabled(bool $scopeCode = null): bool
    {
        $enableLightMode = $this->scopeConfig->getValue(
            $this::CONFIG_XML_PATH_ENABLE_LIGHT_MODE,
            ScopeInterface::SCOPE_STORE,
            $scopeCode
        );

        if ($enableLightMode !== '1') {
            return false;
        }

        return true;
    }
}
