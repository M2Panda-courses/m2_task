<?php

namespace Aus\Task11\Ui\Component\Listing\Column;

use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Aus\Task5\Model\ResourceModel\ErpSync\CollectionFactory;

class ErpSyncStatus extends Column
{
    protected $erpSyncCollectionFactory;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CollectionFactory $erpSyncCollectionFactory,
        array $components = [],
        array $data = []
    ) {
        $this->erpSyncCollectionFactory = $erpSyncCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['entity_id'])) {
                    $order_id = $item['entity_id'];
                    $erpStatus = $this->getErpStatusByOrderId($order_id);

                    $item[$this->getData('name')] = $erpStatus;
                }
            }
        }

        return $dataSource;
    }

    public function applyFilter($dataSource, $field, $value)
    {
        if ($value) {
            $dataSource->getSelect()->where('main_table.erp_status = ?', $value);
        }
    }

    protected function getErpStatusByOrderId($orderId)
    {
        $collection = $this->erpSyncCollectionFactory->create();
        $collection->addFieldToFilter('order_id', $orderId);
        $erpStatus = $collection->getFirstItem();

        return $erpStatus->getErpStatus();
    }
}
