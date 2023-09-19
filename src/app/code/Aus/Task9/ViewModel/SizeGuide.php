<?php declare(strict_types=1);

namespace Aus\Task9\ViewModel;

use Magento\Cms\Api\Data\BlockInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Cms\Model\ResourceModel\Block\Collection;

class SizeGuide implements ArgumentInterface
{
    public function __construct(
        private Collection $cmsBlockCollection,
    ) {}

    /**
     * @param $identifier
     * @return BlockInterface
     */
    public function getBlockByIdentifier($identifier): BlockInterface
    {
        $f = $this->cmsBlockCollection->addFieldToFilter('identifier', $identifier)->getItems();
        return reset($f);
    }

}
