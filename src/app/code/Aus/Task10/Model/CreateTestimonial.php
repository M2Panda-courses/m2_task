<?php

namespace Aus\Task10\Model;

use Aus\Task10\Api\Data\CreateTestimonialInterface;
use DateTime;
use Exception;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Review\Model\Review;
use Magento\Review\Model\ReviewFactory;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\ObjectManagerInterface;

class CreateTestimonial implements CreateTestimonialInterface
{
    /**
     * @var ReviewFactory
     */
    protected $reviewFactory;

    public function __construct(
        ReviewFactory   $reviewFactory,
        ObjectManagerInterface $objectManager,
        ResourceConnection $resourceConnection
    )
    {
        $this->reviewFactory = $reviewFactory;
        $this->resourceConnection = $resourceConnection;
        $this->connection = $this->resourceConnection->getConnection();
    }

    /**
     * @param array $data
     * @throws CouldNotSaveException
     */
    public function createReview(array $data)
    {
        if (!$this->validateData($data)) {
            return ['message' => 'field not valid'];
        }

        $dateTime = new DateTime($data['date']);
        $formattedDate = $dateTime->format('Y-m-d H:i:s.u');

        $reviewData = [
            self::TESTIMONIAL => $data['testimonial'],
            self::TITLE => 'Some Title12',
            self::CUSTOMER_NAME => $data['customer_name'],

        ];

        $review = $this->reviewFactory->create();
        $review->setData($reviewData);
        $review->unsetData('review_id');

        try {
            $review->setEntityId($review->getEntityIdByCode(Review::ENTITY_CUSTOMER_CODE))
                ->setStatusId(Review::STATUS_PENDING);
            $review->save();
            $review->setCreatedAt($formattedDate);
            $review->save();
            $this->updateRecord($review, [self::LOCATION => $data['location']]);
        } catch (Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $review;
    }

    /**
     * @param $data
     * @return bool
     * @throws Exception
     */
    public function validateData($data)
    {
        $expectedFields = ['customer_name', 'testimonial', 'date', 'location'];
        $valid = count(array_diff($expectedFields, array_keys($data))) === 0;

        return $valid;
    }

    /**
     * @param $review
     * @param $data
     * @return void
     */
    public function updateRecord($review, $data)
    {
        $tableName = $this->resourceConnection->getTableName('review_detail');
        $select = $this->connection->select()->from($tableName)->where('review_id = ?', $review->getId());
        $row = $this->connection->fetchRow($select);

        foreach ($data as $field => $value)
            {
                if ($row) {
                    $this->connection->update(
                        $tableName,
                        [$field => $value],
                        ['detail_id = ?' => $row['detail_id']]
                    );
                }
            }
    }
}
