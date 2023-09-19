<?php
namespace Aus\Task17\Model\Data;

use Aus\Task17\Api\Data\ProductLimitedDataInterface;

class ProductLimitedData implements ProductLimitedDataInterface
{
    protected $sku;
    protected $name;
    protected $description;

    public function getSku()
    {
        return $this->sku;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
}
