<?php
declare(strict_types=1);

namespace Aus\Task13\Model\Resolver;

use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Aus\Task13\Model\ResourceModel\Exported\Collection;
use Magento\Setup\Exception;

/**
 * Resolver for Exported flag
 */
class Exported implements ResolverInterface
{

    /**
     * @var Collection
     */
    public $collection;

    public function __construct(
        \Aus\Task13\Model\ResourceModel\Exported\Collection $collection
    ) {
        $this->collection = $collection;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
              $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    ) {
        $order_id = $args['id'];
        try {
            $orderExported = $this->getOrder($order_id);
            if ($args['exported']) {
                $orderExported->setExported('1');
            } else {
                $orderExported->setExported('0');
            }
            $orderExported->save();
            $result['message'] = 'Order exported';
        } catch (Exception $exception) {
            $result['message'] = $exception->getMessage();
        }

        return $result;
    }

    public function getOrder($order_id)
    {
        $this->collection->addFieldToFilter('order_id', $order_id);
        return $this->collection->getFirstItem();
    }
}
