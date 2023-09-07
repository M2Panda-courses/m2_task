<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Aus\Task11\Ui\Component\Listing\Column\Status;

use Magento\Framework\Data\OptionSourceInterface;
use Aus\Task5\Model\ResourceModel\ErpSync\CollectionFactory;

/**
 * Class Options for Listing Column ERP Status
 */
class Options implements OptionSourceInterface
{
    /**
     * @var array
     */
    protected $options;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {

        return $this->getOptionArray();
    }




    public function getOptionArray()
    {
        $options = [];
        $collection = $this->collectionFactory->create();

        foreach ($collection as $item) {
            $erpStatus = $item->getErpStatus();
            // Додавайте в масив опцій лише унікальні значення
            if (!isset($options[$erpStatus])) {
                $options[$erpStatus] = $erpStatus;
            }
        }

        // Перетворіть асоціативний масив у потрібний формат для опцій
        $formattedOptions = [];
        foreach ($options as $value => $label) {
            $formattedOptions[] = ['value' => $value, 'label' => $label];
        }

        return $formattedOptions;
    }
}
