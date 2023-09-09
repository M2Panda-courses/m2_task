<?php
namespace Aus\Task21\Cron;

use Magento\Framework\Api\SearchCriteriaBuilder;
use Psr\Log\LoggerInterface;
use Aus\Task13\Model\ResourceModel\Exported\Collection as ExportedCollection;
class UpdateErpStatus
{
    /**
     * @var \Magento\Catalog\Api\ProductAttributeRepositoryInterface
     */
    protected $exportedCollection;


    protected $logger;

    public function __construct(
        LoggerInterface $logger,
        ExportedCollection $exportedCollection,
    ) {
        $this->exportedCollection = $exportedCollection;
        $this->logger = $logger;
    }

    public function execute()
    {
        $this->logger->info('Cron Order Export Started');
        $exportOrderById = [];

        $this->exportedCollection->addFieldToFilter('exported', '0');
        foreach ($this->exportedCollection as $item){
            $exportOrderById[] = $item->getOrderId();
        }

        $this->logger->info('Cron Order Export Finished');
    }
}
