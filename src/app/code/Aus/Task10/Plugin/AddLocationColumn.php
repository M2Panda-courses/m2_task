<?php
declare(strict_types=1);

namespace Aus\Task10\Plugin;

use Magento\Review\Model\ResourceModel\Review\Collection;

class AddLocationColumn
{
    public function beforeLoad(Collection $subject, bool $printQuery = false, bool $logQuery = false)
    {
        $subject->getSelect()->join(
            ['detail' => $subject->getTable('review_detail')],
            'main_table.review_id = detail.review_id',
            ['location']
        );

        return [$printQuery, $logQuery];
    }
}


