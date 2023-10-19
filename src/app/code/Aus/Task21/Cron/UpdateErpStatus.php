<?php
namespace Aus\Task21\Cron;
//
//use Magento\Framework\Api\SearchCriteriaBuilder;
//use Psr\Log\LoggerInterface;
//use Aus\Task13\Model\ResourceModel\Exported\Collection as ExportedCollection;
//class UpdateErpStatus
//{
//    /**
//     * @var \Magento\Catalog\Api\ProductAttributeRepositoryInterface
//     */
//    protected $exportedCollection;
//
//
//    protected $logger;
//
//    public function __construct(
//        LoggerInterface $logger,
//        ExportedCollection $exportedCollection,
//    ) {
//        $this->exportedCollection = $exportedCollection;
//        $this->logger = $logger;
//    }
//
//    public function execute()
//    {
//        $this->logger->info('Cron Order Export Started');
//        $exportOrderById = [];
//
//        $this->exportedCollection->addFieldToFilter('exported', '0');
//        foreach ($this->exportedCollection as $item){
//            $exportOrderById[] = $item->getOrderId();
//        }
//
//        $this->logger->info('Cron Order Export Finished');
//    }
//}


use Magento\Sales\Model\Order;

class UpdateErpStatus
{
    /**
     * @var \Magento\Sales\Model\ResourceModel\Order\CollectionFactory
     */
    private $orderCollectionFactory;

    public function __construct(
        \Magento\Sales\Model\ResourceModel\Order\CollectionFactory $orderCollectionFactory
    ) {
        $this->orderCollectionFactory = $orderCollectionFactory;
    }

    public function execute()
    {
        $orders = $this->getNonExportedOrders();

        foreach ($orders as $order) {
            // Симуляція експорту
            $this->simulateExport($order);

            // Позначення замовлення як експортоване
            $order->setErpStatus('Success');
            $order->save();
        }
    }

    private function getNonExportedOrders()
    {
        return $this->orderCollectionFactory->create()
            ->addFieldToFilter('erp_status', 'Processing');
    }

    private function simulateExport(Order $order)
    {
        echo "Order Exported: " . $order->getIncrementId() . "\n";
    }
}

