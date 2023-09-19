<?php declare(strict_types=1);

namespace Aus\Task8\ViewModel;

use Magento\CatalogInventory\Api\Data\StockItemInterface;
use Magento\CatalogInventory\Api\StockConfigurationInterface;
use Magento\CatalogInventory\Model\Spi\StockRegistryProviderInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class StockLevel implements ArgumentInterface
{
    public function __construct(
        private StockRegistryProviderInterface $stockRegistryProvider,
        private StockConfigurationInterface $stockConfiguration,
    ) {}

    /**
     * @param $identifier
     * @return StockItemInterface
     */
    public function getStockLevelByIdentifier($identifier): StockItemInterface
    {
        $websiteId = $this->stockConfiguration->getDefaultScopeId();
        return $this->stockRegistryProvider->getStockItem($identifier, $websiteId);
    }

}
