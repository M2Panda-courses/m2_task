<?php declare(strict_types=1);

namespace Aus\Task3\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Aus\Task3\Api\Data\BlockInterface;
use Aus\Task3\Api\Data\BlockRepositoryInterface;
use \Aus\Task3\Model\ResourceModel\Block as BlockResourceModule;

class BlockRepository implements BlockRepositoryInterface
{
    public function __construct(
        private BlockFactory $blockFactory,
        private BlockResourceModule $blockResourceModule,
    ){}

    public function getById(int $id): BlockInterface
    {
        $tag = $this->blockFactory->create();
        $this->blockResourceModule->load($tag, $id);

        if (!$tag->getId()){
            throw new NoSuchEntityException(__('The block with "%1" id does not exist', $id));
        }

        return $tag;
    }

    public function save(BlockInterface $block): BlockInterface
    {
        try{
            $this->blockResourceModule->save($block);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $block;
    }

    public function deleteById(int $id): bool
    {
        try{
            $this->blockResourceModule->delete($this->getById($id));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
