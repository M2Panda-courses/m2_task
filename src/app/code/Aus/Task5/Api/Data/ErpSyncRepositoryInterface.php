<?php declare(strict_types=1);

namespace Aus\Task5\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Aus\Task5\Api\Data\ErpSyncInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Tag CRUD interface.
 */
interface ErpSyncRepositoryInterface
{
    /**
     * @param int $id
     * @return ErpSyncInterface
     * @throws LocalizedException
     */
    public function getById(int $id): ErpSyncInterface;

    /**
     * @param ErpSyncInterface $erpSync
     * @return ErpSyncInterface
     * @throws LocalizedException
     */
    public function save(ErpSyncInterface $erpSync): ErpSyncInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
