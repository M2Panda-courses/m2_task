<?php
namespace Aus\Task17\Api\Data;

use Aus\Task17\Api\Data\ProductLimitedDataInterface;

interface ProductLimitedDataRepositoryInterface
{
    /**
     * Get limited product data by product ID
     *
     * @param int $productId
     * @return \Aus\Task17\Api\Data\ProductLimitedDataInterface
     */
    public function getLimitedProductData($productId);
}
