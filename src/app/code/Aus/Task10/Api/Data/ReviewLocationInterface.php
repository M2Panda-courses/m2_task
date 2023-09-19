<?php
namespace Aus\Task10\Api\Data;

interface ReviewLocationInterface
{
    const LOCATION = 'location';
    const REVIEW_ID = 'review_id';

    /**
     * Get review location
     *
     * @return string
     */
    public function getLocation();

    /**
     * set review location
     *
     * @param string $location
     * @return $this
     */
    public function setLocation($location);

    /**
     * Get review id
     *
     * @return string
     */
    public function getReviewId();

    /**
     * set review id
     *
     * @param string $reviewId
     * @return $this
     */
    public function setReviewId($reviewId);

}
