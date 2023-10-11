<?php declare(strict_types=1);

namespace Aus\Task13\Model\ResourceModel\Exported;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Aus\Task13\Model\Exported;
use Aus\Task13\Model\ResourceModel\Exported as ExportedResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Exported::class, ExportedResourceModule::class);
    }
}
