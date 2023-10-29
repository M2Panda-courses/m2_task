<?php
namespace Aus\Task21\Cron;

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
            $this->simulateExport($order);

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

