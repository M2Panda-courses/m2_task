<?php declare(strict_types=1);

namespace Aus\Task5\Setup\Patch\Data;

use Aus\Task5\Model\ErpSyncFactory;
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
     * @var ErpSyncFactory
     */
    private $erpSyncFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        ErpSyncFactory $erpSyncFactory,
        CollectionFactoryInterface $orderCollectionFactory,

    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->erpSyncFactory = $erpSyncFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $orderCollection = $this->_orderCollectionFactory->create();

        foreach ($orderCollection as $order) {
            $erpSync = $this->erpSyncFactory->create();


            $data = [
                'order_id' => $order->getId(),
                'erp_status' => 'Processing',
            ];
            $erpSync->setData($data);
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
