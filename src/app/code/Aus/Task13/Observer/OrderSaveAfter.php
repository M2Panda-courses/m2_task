<?php

namespace Aus\Task13\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Magento\Sales\Model\OrderFactory;
use Aus\Task13\Model\ExportedFactory;

class OrderSaveAfter implements ObserverInterface
{
    protected $orderFactory;
    protected $exported;

    public function __construct(
        OrderFactory $orderFactory,
        ExportedFactory $exportedFactory
    ) {
        $this->orderFactory = $orderFactory;
        $this->exported = $exportedFactory;
    }

    public function execute(Observer $observer)
    {
        /** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getOrder();

        $exported = $this->exported->create();
        $exported->setOrderId($order->getId());
        $exported->save();

        return $this;
    }
}
