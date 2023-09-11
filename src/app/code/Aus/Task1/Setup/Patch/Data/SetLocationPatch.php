<?php
namespace Aus\Task1\Setup\Patch\Data;

use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Config\Model\Config\Factory as ConfigFactory;

class SetLocationPatch implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var ConfigFactory
     */
    private $configFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ConfigFactory $configFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->configFactory = $configFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $config1 = $this->configFactory->create();
        $config1->setDataByPath('general/locale/timezone', 'Australia/Sydney');
        $config1->setDataByPath('general/locale/code', 'en_US');

        $config1->save();
        $config2 = $this->configFactory->create();
        $config2->setDataByPath('currency/options/default', 'AUD');
        $config2->setDataByPath('currency/options/base', 'AUD');
        $config2->setDataByPath('currency/options/allow', 'AUD');
        $config2->save();

        $this->moduleDataSetup->endSetup();
    }

    public function getAliases()
    {
        return [];
    }

    public static function getDependencies()
    {
        return [];
    }
}
