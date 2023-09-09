<?php declare(strict_types=1);

namespace Aus\Task13\Api\Data;

/**
 * Tag interface.
 */
interface ExportedInterface
{
    const ID = 'id';
    const ORDER_ID = 'order_id';
    const EXPORTED = 'exported';
    const UPDATE_TIME   = 'update_time';


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
     * @param int $orderId
     * @return $this
     */
    public function setOrderId($orderId);

    /**
     * @return int
     */
    public function getExported();

    /**
     * @param int $exported
     * @return $this
     */
    public function setExported($exported);

    /**
     * @return string|null
     */
    public function getUpdateTime();

}
