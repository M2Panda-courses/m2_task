<?php
namespace Aus\Task10\Model;

use Magento\Framework\Model\AbstractModel;
use Aus\Task10\Api\Data\ReviewLocationInterface;

class ReviewLocation extends AbstractModel implements ReviewLocationInterface
{
    protected $location;

    protected function _construct()
    {
        $this->_init(ResourceModel\ReviewLocation::class);
    }

    public function getLocation()
    {
        return $this->getData(self::LOCATION);
    }

    public function setLocation($location)
    {
        $this->setData(self::LOCATION, $location);
    }

    public function getReviewId()
    {
        return $this->getData(self::REVIEW_ID);
    }

    public function setReviewId($reviewId)
    {
        $this->setData(self::REVIEW_ID, $reviewId);
    }
}
