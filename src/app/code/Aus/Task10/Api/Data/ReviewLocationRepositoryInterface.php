<?php
namespace Aus\Task10\Api\Data;

use Aus\Task10\Api\Data\ReviewLocationInterface;
use Magento\Framework\Exception\LocalizedException;

interface ReviewLocationRepositoryInterface
{

    /**
     * @param array $data
     * @return mixed
     */
    public function setReview(array $data);

    /**
     * @param ReviewLocationInterface $reviewLocation
     * @return ReviewLocationInterface
     * @throws LocalizedException
     */
    public function save(ReviewLocationInterface $reviewLocation): ReviewLocationInterface;
}
