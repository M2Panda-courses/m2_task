<?php declare(strict_types=1);

namespace Aus\Task5\Model\ResourceModel\ErpSync;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Aus\Task5\Model\ErpSync;
use Aus\Task5\Model\ResourceModel\ErpSync as ErpSyncResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(ErpSync::class, ErpSyncResourceModule::class);
    }
}
