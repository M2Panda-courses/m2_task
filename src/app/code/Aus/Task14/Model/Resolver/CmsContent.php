<?php
declare(strict_types=1);

namespace Aus\Task14\Model\Resolver;



use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Cms\Api\Data\BlockInterface;
use Magento\Cms\Model\ResourceModel\Block\Collection;

/**
 * Resolver for order by id
 */
class CmsContent implements ResolverInterface
{
    /**
     * @var Collection
     */
    private Collection $cmsBlockCollection;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepository;

    public function __construct(
        Collection $cmsBlockCollection,
        ProductRepositoryInterface $productRepository
    ) {
        $this->cmsBlockCollection = $cmsBlockCollection;
        $this->productRepository = $productRepository;
    }

    /**
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $productId = $args['id'];
        $cmsBlockContent = $this->getCmsBlockContentByProductId($productId);

        return $cmsBlockContent;
    }

    /**
     * @param $productId
     * @return string|null
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function getCmsBlockContentByProductId($productId)
    {
        try {
            $product = $this->productRepository->getById($productId);
        } catch (NoSuchEntityException $e) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __("The product wasn't found. Verify the product and try again."),
                $e
            );
        }

        $identifier = $product->getData('task_3');

        if ($identifier) {
            return $this->getBlockByIdentifier($identifier)->getContent();
        }
        else {
            return "product don`t have identifier";
        }
    }

    /**
     * @param $identifier
     * @return BlockInterface|bool
     */
    public function getBlockByIdentifier($identifier)
    {
        $block = $this->cmsBlockCollection->addFieldToFilter('identifier', $identifier)->getItems();
        return reset($block);
    }
}
