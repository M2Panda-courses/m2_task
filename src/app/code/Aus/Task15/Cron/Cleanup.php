<?php

namespace Aus\Task15\Cron;

use Magento\Eav\Model\Config;
use Magento\Eav\Model\Entity\Attribute\AbstractAttribute;
use Aus\Task19\Logger\AttributeCleanLogger as Loger;

class Cleanup
{
    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * @var Loger
     */
    private $logger;

    /**
     * @param Config $eavConfig
     * @param Loger $logger
     */
    public function __construct(
        Config $eavConfig,
        Loger $logger
    ) {
        $this->eavConfig = $eavConfig;
        $this->logger = $logger;
    }

    /**
     * Execute the cron job
     *
     * @return void
     */
    public function execute()
    {
        try {
            $this->logger->info('Cron job started.'); // Додайте повідомлення про початок виконання

            $attributes = $this->getAllProductAttributes();
            $deleteCount = 0;

            foreach ($attributes as $attribute) {
                $scope = $attribute->getIsGlobal();

                if ($scope != '0' && $scope != '1' && $scope != '2') {
                    $this->removeAttribute($attribute);
                    $deleteCount++;
                }
            }

            $this->logger->info('Cron job completed. Deleted ' . $deleteCount . ' attributes.');
        } catch (\Exception $e) {
            $this->logger->error('Error in cron job: ' . $e->getMessage());
        }
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
