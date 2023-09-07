<?php

namespace Aus\Task11\Ui\Component\Listing\Provider;

use Aus\Task5\Model\ResourceModel\ErpSync\CollectionFactory;
use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;

class DataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    protected $erpSyncCollectionFactory;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param ReportingInterface $reporting
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     * @param RequestInterface $request
     * @param FilterBuilder $filterBuilder
     * @param array $meta
     * @param array $data
     * @param CollectionFactory $erpSyncCollectionFactory
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ReportingInterface $reporting,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        RequestInterface $request,
        FilterBuilder $filterBuilder,
        CollectionFactory $erpSyncCollectionFactory,
        $meta = [],
        $data = [],
    ) {
        $this->erpSyncCollectionFactory = $erpSyncCollectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $reporting, $searchCriteriaBuilder, $request, $filterBuilder, $meta, $data);
    }

    protected function searchResultToOutput(SearchResultInterface $searchResult)
    {
        if(isset($_REQUEST['filter']['erp_sync_status'])){

        }

        $output = parent::searchResultToOutput($searchResult);
        $items = $output['items'];

        foreach ($items as &$item) {
            $order_id = $item['entity_id']; // Отримайте ідентифікатор замовлення з джерела даних гріда
            $erpStatus = $this->getErpStatusByOrderId($order_id); // Отримайте статус ERP для цього замовлення

            // Додайте значення статусу ERP до результату
            $item['erp_sync_status'] = $erpStatus;
        }

        $output['items'] = $items;

        return $output;
    }

    protected function getErpStatusByOrderId($orderId)
    {
        $collection = $this->erpSyncCollectionFactory->create();
        $collection->addFieldToFilter('order_id', $orderId);
        $erpStatus = $collection->getFirstItem();

        return $erpStatus->getErpStatus();
    }
}
