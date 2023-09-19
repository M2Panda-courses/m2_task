<?php declare(strict_types=1);

namespace Aus\Task5\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Aus\Task5\Api\Data\ErpSyncInterface;
use Aus\Task5\Api\Data\ErpSyncRepositoryInterface;
use Aus\Task5\Model\ResourceModel\ErpSync as ErpSyncResourceModule;

class ErpSyncRepository implements ErpSyncRepositoryInterface
{
    public function __construct(
        private ErpSyncFactory $erpSyncFactory,
        private ErpSyncResourceModule $erpSyncResourceModule,
    ){}

    public function getById(int $id): ErpSyncInterface
    {
        $erpSync = $this->erpSyncFactory->create();
        $this->erpSyncResourceModule->load($erpSync, $id);

        if (!$erpSync->getId()){
            throw new NoSuchEntityException(__('The erp sync with "%1" id does not exist', $id));
        }

        return $erpSync;
    }

    public function save(ErpSyncInterface $erpSync): ErpSyncInterface
    {
        try{
            $this->erpSyncResourceModule->save($erpSync);
        } catch (\Exception $exception){
            throw new CouldNotSaveException(__($exception->getMessage()));
        }

        return $erpSync;
    }

    public function deleteById(int $id): bool
    {
        try{
            $this->erpSyncResourceModule->delete($this->getById($id));
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__($exception->getMessage()));
        }

        return true;
    }
}
