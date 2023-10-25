<?php

namespace Aus\Task11\Ui\Component\Listing\Column\Status;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactoryInterface;


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
     * @var CollectionFactoryInterface
     */
    protected $collectionFactory;

    /**
     * Constructor
     *
     * @param CollectionFactoryInterface $collectionFactory
     */
    public function __construct(CollectionFactoryInterface $collectionFactory,)
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
            if (!isset($options[$erpStatus])) {
                $options[$erpStatus] = $erpStatus;
            }
        }

        $formattedOptions = [];
        foreach ($options as $value => $label) {
            $formattedOptions[] = ['value' => $value, 'label' => $label];
        }

        return $formattedOptions;
    }
}
