<?php declare(strict_types=1);

namespace Aus\Task5\Model;

use Magento\Framework\Model\AbstractModel;
use Aus\Task5\Api\Data\ErpSyncInterface;

class ErpSync extends AbstractModel implements ErpSyncInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\ErpSync::class);
    }

    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    public function setOrderId($order_id)
    {
        $this->setData(self::ORDER_ID, $order_id);
    }

    public function getErpStatus()
    {
        return $this->getData(self::ERP_STATUS);
    }

    public function setErpStatus($status)
    {
        $this->setData(self::ERP_STATUS, $status);
    }
}
