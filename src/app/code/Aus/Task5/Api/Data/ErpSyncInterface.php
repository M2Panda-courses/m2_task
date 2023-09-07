<?php declare(strict_types=1);

namespace Aus\Task5\Api\Data;

/**
 * Tag interface.
 */
interface ErpSyncInterface
{
    const ID = 'id';
    const ORDER_ID = 'order_id';
    const ERP_STATUS = 'erp_status';

    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getOrderId();

    /**
     * @param int $order_id
     * @return $this
     */
    public function setOrderId($order_id);

    /**
     * @return string
     */
    public function getErpStatus();

    /**
     * @param string $status
     * @return $this
     */
    public function setErpStatus($status);

}
