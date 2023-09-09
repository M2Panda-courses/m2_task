<?php declare(strict_types=1);

namespace Aus\Task13\Api\Data;

use Magento\Framework\Exception\NoSuchEntityException;
use Aus\Task13\Api\Data\ExportedInterface;
use Magento\Framework\Exception\LocalizedException;

/**
 * Tag CRUD interface.
 */
interface ExportedRepositoryInterface
{
    /**
     * @param int $id
     * @return ExportedInterface
     * @throws LocalizedException
     */
    public function getById(int $id): ExportedInterface;

    /**
     * @param ExportedInterface $exported
     * @return ExportedInterface
     * @throws LocalizedException
     */
    public function save(ExportedInterface $exported): ExportedInterface;

    /**
     * @param int $id
     * @return bool
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function deleteById(int $id): bool;
}
