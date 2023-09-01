<?php declare(strict_types=1);

namespace Aus\Task10\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Aus\Task10\Api\Data\ReviewLocationRepositoryInterface;

class CreateReviewPatch implements DataPatchInterface
{
    private $moduleDataSetup;
    private $locationRepository;

    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        \Aus\Task10\Api\Data\ReviewLocationRepositoryInterface $locationRepository,
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->locationRepository = $locationRepository;
    }

    public function apply()
    {
        $this->moduleDataSetup->startSetup();

        $data = [
            "nickname" => "Firstname Lastname",
            "detail" => "This is the best store seen!",
            "created_at" => "2023-01-01",
            "location" => "Adelaide"
        ];
        $this->locationRepository->setReview($data);

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
