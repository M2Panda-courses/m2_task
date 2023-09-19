<?php

namespace Aus\Task5\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Sales\Model\OrderFactory;
use Aus\Task5\Model\ErpSyncFactory;

class OrderSaveAfter implements ObserverInterface
{
    protected $orderFactory;
    protected $erpSyncFactory;

    public function __construct(
        OrderFactory $orderFactory,
        ErpSyncFactory $erpSyncFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->erpSyncFactory = $erpSyncFactory;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();

        $erpSync = $this->erpSyncFactory->create();
        $erpSync->setOrderId($order->getId());
        $erpSync->setErpStatus('Processing');

        $erpSync->save();

        return $this;
    }
}
