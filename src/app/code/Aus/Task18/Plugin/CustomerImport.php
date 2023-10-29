<?php
namespace Aus\Task18\Plugin;

use Aus\Task18\Model\Transport;
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

    /**
     * @var Transport
     */
    protected $transport;

    public function __construct(
        ConfigResource $configResource,
        ScopeConfigInterface $scopeConfig,
        Transport $transport,
    ) {
        $this->configResource = $configResource;
        $this->scopeConfig = $scopeConfig;
        $this->currentDisableValue = 0;
        $this->transport = $transport;

    }

    public function beforeImportData($subject)
    {
        $this->currentDisableValue = $this->scopeConfig->getValue('system/smtp/disable');
        $this->configResource->saveConfig('system/smtp/disable', 1);
    }

    public function afterImportData($subject, $result)
    {
        $this->configResource->saveConfig('system/smtp/disable', $this->currentDisableValue);
        $newCustomers = $this->getProtectedVariableValue($subject, '_newCustomers');


        foreach ($newCustomers as $rowNumber => $rowData) {
            $this->transport->email[] = $rowNumber;
            $this->transport->sendMessage();
        }
    }

    protected function getProtectedVariableValue($object, $variableName)
    {
        $reflectionClass = new \ReflectionClass($object);
        $property = $reflectionClass->getProperty($variableName);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
