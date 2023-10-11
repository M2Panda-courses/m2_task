<?php
namespace Aus\Task18\Plugin;

use Magento\Config\Model\ResourceModel\Config as ConfigResource;
use Magento\Framework\App\Config\ScopeConfigInterface;

class CustomerImport
{
    /**
     * @var ConfigResource
     */
    protected $configResource;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var int
     */
    protected $currentDisableValue;

    public function __construct(
        ConfigResource $configResource,
        ScopeConfigInterface $scopeConfig,
    ) {
        $this->configResource = $configResource;
        $this->scopeConfig = $scopeConfig;
        $this->currentDisableValue = 0;
    }

    public function beforeImportData()
    {
        $this->currentDisableValue = $this->scopeConfig->getValue('system/smtp/disable');
        $this->configResource->saveConfig('system/smtp/disable', 1);
    }

    public function afterImportData()
    {
        $this->configResource->saveConfig('system/smtp/disable', $this->currentDisableValue);
    }
}
