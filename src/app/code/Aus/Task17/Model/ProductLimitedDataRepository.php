<?php
namespace Aus\Task17\Model;

use Aus\Task17\Api\Data\ProductLimitedDataRepositoryInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Aus\Task17\Api\Data\ProductLimitedDataInterfaceFactory;

class ProductLimitedDataRepository implements ProductLimitedDataRepositoryInterface
{
    protected $productRepository;
    protected $productLimitedDataFactory;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ProductLimitedDataInterfaceFactory $productLimitedDataFactory
    ) {
        $this->productRepository = $productRepository;
        $this->productLimitedDataFactory = $productLimitedDataFactory;
    }

    public function getLimitedProductData($productId)
    {
        $product = $this->productRepository->getById($productId);

        $limitedProductData = $this->productLimitedDataFactory->create();
        $limitedProductData->setSku($product->getSku())
            ->setName($product->getName())
            ->setDescription($product->getStatus());

        return $limitedProductData;
    }
}
