<?php declare(strict_types=1);

namespace Aus\Task3\Model\Source;

use Magento\Cms\Model\ResourceModel\Block\CollectionFactory;
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
            $options[] = ['value' => $item->getIdentifier(), 'label' => $item->getTitle()];
        }

        return $options;
    }

    public function getAllOptions()
    {
        $result = [];

        foreach (self::getOptionArray() as $index => $value) {
            $result[] = ['value' => $value['value'], 'label' => $value['label']];
        }

        return $result;
    }
}
