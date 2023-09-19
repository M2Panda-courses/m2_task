<?php declare(strict_types=1);

namespace Aus\Task5\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ErpSync extends AbstractDb
{
    const MAIN_TABLE = 'sales_order_erp_status';
    const ID_FIELD_NAME = 'id';
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, self::ID_FIELD_NAME);
    }
}
