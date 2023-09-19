<?php declare(strict_types=1);

namespace Aus\Task13\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Aus\Task13\Api\Data\ExportedInterface;
use Aus\Task13\Api\Data\ExportedRepositoryInterface;
use Aus\Task13\Model\ResourceModel\Exported as ExportedResourceModule;

class ExportedRepository implements ExportedRepositoryInterface
{
    public function __construct(
        private ExportedFactory $exportedFactory,
        private ExportedResourceModule $exportedResourceModule,
    ){}

    public function getById(int $id): ExportedInterface
    {
        $erpSync = $this->exportedFactory->create();
        $this->exportedResourceModule->load($erpSync, $id);

        if (!$erpSync->getId()){
            throw new NoSuchEntityException(__('The exported entity with "%1" id does not exist', $id));
        }

        return $erpSync;
    }

    public function save(ExportedInterface $exported): ExportedInterface
    {
        try{
            $this->exportedResourceModule->save($exported);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $exported;
    }

    public function deleteById(int $id): bool
    {
        try{
            $this->exportedResourceModule->delete($this->getById($id));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
