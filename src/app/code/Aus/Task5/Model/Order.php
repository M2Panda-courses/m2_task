<?php

namespace Aus\Task5\Model;

use Magento\Sales\Model\Order as VendorOrder;

class Order extends VendorOrder
{
    public function getErpStatus()
    {
        return $this->getData('erp_status');
    }

    public function setErpStatus($status)
    {
        $this->setData('erp_status', $status);
    }
}
