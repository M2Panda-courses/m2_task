<?php declare(strict_types=1);

namespace Aus\Task3\Model\ResourceModel\Block;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Aus\Task3\Model\Block;
use Aus\Task3\Model\ResourceModel\Block as BlockResourceModule;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Block::class, BlockResourceModule::class);
    }
}
