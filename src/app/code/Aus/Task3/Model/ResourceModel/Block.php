<?php declare(strict_types=1);

namespace Aus\Task3\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Block extends AbstractDb
{
    const MAIN_TABLE = 'size_block';
    const ID_FIELD_NAME = 'id';
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}