<?php declare(strict_types=1);

namespace Aus\Task3\Model\Source;

use Aus\Task3\Model\ResourceModel\Block\CollectionFactory;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;

class BlockOptions extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    protected CollectionFactory $collectionFactory;

    public function __construct(CollectionFactory $collectionFactory)
    {
        $this->collectionFactory = $collectionFactory;
    }

    public function getOptionArray()
    {
        $options = [];
        $collection = $this->collectionFactory->create();

        foreach ($collection as $item) {
            $options[] = ['value' => $item->getId(), 'label' => $item->getValue()];
        }

        return $options;
    }

    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value['label']];
        }

        return $result;
    }
}
