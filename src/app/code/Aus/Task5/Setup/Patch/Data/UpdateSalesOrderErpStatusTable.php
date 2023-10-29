<?php declare(strict_types=1);

namespace Aus\Task5\Setup\Patch\Data;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactoryInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class UpdateSalesOrderErpStatusTable implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CollectionFactoryInterface
     */
    protected $_orderCollectionFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CollectionFactoryInterface $orderCollectionFactory,

    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->_orderCollectionFactory = $orderCollectionFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $orderCollection = $this->_orderCollectionFactory->create();
        foreach ($orderCollection as $order) {
            $order->setErpStatus('Processing');
            $order->save();
        }

        $this->moduleDataSetup->endSetup();
    }


    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
