<?php declare(strict_types=1);

namespace Aus\Task3\Setup\Patch\Data;

use Magento\Catalog\Model\Product;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchRevertableInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddAttributePatch implements DataPatchInterface, PatchRevertableInterface
{
    private $eavSetupFactory;
    private $moduleDataSetup;

    public function __construct(
        EavSetupFactory $eavSetupFactory,
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->moduleDataSetup = $moduleDataSetup;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'task_3',
            [
                'type' => 'text',
                'label' => 'Task_3',
                'input' => 'select',
                'source' => \Aus\Task3\Model\Source\BlockOptions::class,
                'required' => false,
                'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
            ]
        );

        $attributeCode = 'task_3';
        $attributeSetId = 4;

        $eavSetup->addAttributeToSet(
            Product::ENTITY,
            $attributeSetId,
            null,
            $attributeCode
        );

        $this->moduleDataSetup->endSetup();
    }

    public function revert()
    {
        $this->moduleDataSetup->startSetup();

        $eavSetup = $this->eavSetupFactory->create(['setup' => $this->moduleDataSetup]);
        $eavSetup->removeAttribute(Product::ENTITY, 'task_3');

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
