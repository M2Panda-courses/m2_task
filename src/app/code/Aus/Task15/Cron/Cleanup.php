<?php
namespace Aus\Task15\Cron;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Psr\Log\LoggerInterface;

class Cleanup
{
    /**
     * @var \Magento\Catalog\Api\ProductAttributeRepositoryInterface
     */
    protected $attributeRepository;

    protected $searchCriteriaBuilder;

    protected $logger;

    public function __construct(
        \Magento\Catalog\Api\ProductAttributeRepositoryInterface $attributeRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        LoggerInterface $logger,
    ) {
        $this->attributeRepository = $attributeRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->logger = $logger;
    }

    public function execute()
    {
        $searchCriteria = $this->searchCriteriaBuilder->create();

        $attributes = $this->attributeRepository->getList($searchCriteria)->getItems();

        foreach ($attributes as $attribute) {
            $attributeId = $attribute->getAttributeId();
            $attributeCode = $attribute->getAttributeCode();

            if (strpos($attributeCode, 'task15') !== false) {
                try {
                    $this->attributeRepository->deleteById($attributeId);

                    $this->logger->info('Атрибут ' . $attributeCode . ' було видалено.');
                } catch (\Exception $e) {

                    $this->logger->error('Помилка видалення атрибута ' . $attributeCode . ': ' . $e->getMessage());
                }
            }
        }

    }
}
