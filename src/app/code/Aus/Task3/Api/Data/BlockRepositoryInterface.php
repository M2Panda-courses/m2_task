<?php declare(strict_types=1);

namespace Aus\Task3\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Aus\Task3\Api\Data\BlockInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Tag CRUD interface.
 */
interface BlockRepositoryInterface
{
    /**
     * @param int $id
     * @return BlockInterface
     * @throws LocalizedException
     */
    public function getById(int $id): BlockInterface;

    /**
     * @param BlockInterface $block
     * @return BlockInterface
     * @throws LocalizedException
     */
    public function save(BlockInterface $block): BlockInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
