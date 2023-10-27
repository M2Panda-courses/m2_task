<?php
namespace Aus\Task10\Api\Data;

use Magento\Framework\Exception\CouldNotSaveException;

interface CreateTestimonialInterface
{
    const LOCATION = 'location';
    const CUSTOMER_NAME = 'nickname';
    const DATE = 'created_at';
    const TESTIMONIAL = 'detail';
    const TITLE = 'title';

    /**
     *  Create review from Rest
     *
     * @param array $data
     * @return array
     * @throws CouldNotSaveException
     */
    public function createReview(array $data);
}
