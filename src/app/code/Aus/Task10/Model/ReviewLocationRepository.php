<?php
namespace Aus\Task10\Model;

use Aus\Task10\Api\Data\ReviewLocationRepositoryInterface;
use Aus\Task10\Api\Data\ReviewLocationInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Review\Model\ReviewFactory;
use Aus\Task10\Model\ReviewLocationFactory;
use Aus\Task10\Model\ResourceModel\ReviewLocation as ReviewLocationResourceModel;

class ReviewLocationRepository implements ReviewLocationRepositoryInterface
{
    protected $reviewFactory;
    protected $reviewLocationFactory;
    protected $reviewLocationResourceModel;

    public function __construct(
        ReviewFactory $reviewFactory,
        ReviewLocationFactory $reviewLocationFactory,
        ReviewLocationResourceModel $reviewLocationResourceModel,
    ) {
        $this->reviewFactory = $reviewFactory;
        $this->reviewLocationFactory = $reviewLocationFactory;
        $this->reviewLocationResourceModel = $reviewLocationResourceModel;
    }

    public function save(ReviewLocationInterface $reviewLocation): ReviewLocationInterface
    {
        try{
            $this->reviewLocationResourceModel->save($reviewLocation);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $reviewLocation;
    }
    public function setReview($data)
    {
        if (!isset($data['title'])) {
            $data['title'] = 'Some title';
        }

        $review = $this->reviewFactory->create();
        $reviewLocation = $this->reviewLocationFactory->create();
        $location = $data['location'];
        unset($data['location']);
        $reviewLocation->setLocation($location);
        $review->setData($data);



        try{
            $review->save();
            $reviewLocation->setReview_id($review->getId());
            $this->save($reviewLocation);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $review;
    }
}
