<?php declare(strict_types=1);

namespace Aus\Task13\Model;

use Magento\Framework\Model\AbstractModel;
use Aus\Task13\Api\Data\ExportedInterface;

class Exported extends AbstractModel implements ExportedInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Exported::class);
    }

    public function getOrderId()
    {
        return $this->getData(self::ORDER_ID);
    }

    public function setOrderId($orderId)
    {
        $this->setData(self::ORDER_ID, $orderId);
    }

    public function getExported()
    {
        return $this->getData(self::EXPORTED);
    }

    public function setExported($exported)
    {
        $this->setData(self::EXPORTED, $exported);
    }

    public function getUpdateTime()
    {
        return $this->getData(self::UPDATE_TIME);
    }
}
