<?php
declare(strict_types=1);

namespace Aus\Task13\Model\Resolver;

use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Setup\Exception;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactoryInterface;
use Magento\SalesGraphQl\Model\Order\OrderAddress;
use Magento\SalesGraphQl\Model\Order\OrderPayments;

/**
 * Resolver for order by id
 */
class Order implements ResolverInterface
{
    /**
     * @var OrderAddress
     */
    private $orderAddress;

    /**
     * @var OrderPayments
     */
    private $orderPayments;

    /**
     * @var CollectionFactoryInterface
     */
    protected $_orderCollectionFactory;

    public function __construct(
        CollectionFactoryInterface $orderCollectionFactory,
        OrderAddress $orderAddress,
        OrderPayments $orderPayments
    ) {
        $this->_orderCollectionFactory = $orderCollectionFactory;
        $this->orderAddress = $orderAddress;
        $this->orderPayments = $orderPayments;
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
        $orderId = $args['id'];
        $orderCollection = $this->_orderCollectionFactory->create();
        $order = $orderCollection->getItemById($orderId);

        $orderData = $this->getOrderData($order);
        return $orderData;
    }

    public function getOrderData($order)
    {
        $result = [
            'created_at' => $order->getCreatedAt(),
            'grand_total' => $order->getGrandTotal(),
            'id' => base64_encode($order->getEntityId()),
            'increment_id' => $order->getIncrementId(),
            'number' => $order->getIncrementId(),
            'order_date' => $order->getCreatedAt(),
            'order_number' => $order->getIncrementId(),
            'status' => $order->getStatusLabel(),
            'shipping_method' => $order->getShippingDescription(),
            'shipping_address' => $this->orderAddress->getOrderShippingAddress($order),
            'billing_address' => $this->orderAddress->getOrderBillingAddress($order),
            'payment_methods' => $this->orderPayments->getOrderPaymentMethod($order),
            'erp_status' => $order->getData('erp_status'),
        ];;
        return $result;
    }
}
