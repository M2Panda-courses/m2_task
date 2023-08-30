<?php
namespace Aus\Task17\Api\Data;

interface ProductLimitedDataInterface
{

    /**
     * Get product SKU
     *
     * @return string
     */
    public function getSku();

    /**
     * Get product name
     *
     * @return string
     */
    public function getName();

    /**
     * Get product description
     *
     * @return string
     */
    public function getDescription();
}
