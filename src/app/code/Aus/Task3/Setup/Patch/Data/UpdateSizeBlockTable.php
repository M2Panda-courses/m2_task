<?php declare(strict_types=1);

namespace Aus\Task3\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Cms\Model\ResourceModel\Block\CollectionFactory as CmsBlockCollectionFactory;
use Aus\Task3\Model\BlockFactory;

class UpdateSizeBlockTable implements DataPatchInterface
{
    private $moduleDataSetup;
    private $cmsBlockCollectionFactory;
    private $blockFactory;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CmsBlockCollectionFactory $cmsBlockCollectionFactory,
        BlockFactory $blockFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->cmsBlockCollectionFactory = $cmsBlockCollectionFactory;
        $this->blockFactory = $blockFactory;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $cmsBlockCollection = $this->cmsBlockCollectionFactory->create();

        foreach ($cmsBlockCollection as $cmsBlock) {
            $block = $this->blockFactory->create();


            $data = [
                'title' => $cmsBlock->getTitle(),
                'value' => $cmsBlock->getIdentifier(),
            ];
           $block->setData($data);
           $block->save();
        }

        $this->moduleDataSetup->endSetup();
    }


    public static function getDependencies()
    {
        return [];
    }

    public function getAliases()
    {
        return [];
    }
}
