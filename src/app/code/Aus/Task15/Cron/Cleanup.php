<?php

namespace Aus\Task15\Cron;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\AbstractAttribute;

class Cleanup
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @param Config $eavConfig
     */
    public function __construct(
        Config $eavConfig,
    ) {
        $this->eavConfig = $eavConfig;
    }

    /**
     * Execute the cron job
     *
     * @return void
     */
    public function execute()
    {
        try {
            $attributes = $this->getAllProductAttributes();

            foreach ($attributes as $attribute) {
                $scope = $attribute->getIsGlobal();

                if ($scope != '0' && $scope != '1' && $scope != '2') {
                    $this->removeAttribute($attribute);
                }
            }
        } catch (\Exception $e) {}
    }

    /**
     * Get all product attributes
     *
     * @return
     */
    private function getAllProductAttributes()
    {
        $entityType = $this->eavConfig->getEntityType('catalog_product');

        return $entityType->getAttributeCollection();
    }

    /**
     * Remove the attribute
     *
     * @param AbstractAttribute $attribute
     * @return void
     */
    private function removeAttribute(AbstractAttribute $attribute)
    {
        $attribute->delete();
    }
}
