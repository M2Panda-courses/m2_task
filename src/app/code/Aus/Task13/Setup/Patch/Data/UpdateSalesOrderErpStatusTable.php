<?php declare(strict_types=1);

namespace Aus\Task13\Setup\Patch\Data;

use Aus\Task13\Model\ExportedFactory;
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

    /**
     * @var ExportedFactory
     */
    private $exportedFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ExportedFactory $exportedFactory,
        CollectionFactoryInterface $orderCollectionFactory,

    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->exportedFactory = $exportedFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();
        $orderCollection = $this->_orderCollectionFactory->create();

        foreach ($orderCollection as $order) {

            $erpSync = $this->exportedFactory->create();
            $erpSync->setData(['order_id' => $order->getId()]);
            $erpSync->save();
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
