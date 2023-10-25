<?php
declare(strict_types=1);

namespace Aus\Task11\Plugin;

use Magento\Sales\Model\ResourceModel\Order\Grid\Collection;

class AddErpStatusColumn
{
    public function beforeLoad(Collection $subject, bool $printQuery = false, bool $logQuery = false)
    {
        $select = $subject->getSelect();
        $select->joinLeft(
            ['sales_order' => $subject->getTable('sales_order')],
            'main_table.entity_id = sales_order.entity_id',
            ['erp_status']
        );

        return [$printQuery, $logQuery];
    }
}


