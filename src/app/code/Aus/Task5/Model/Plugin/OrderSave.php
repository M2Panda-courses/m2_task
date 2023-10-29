<?php

namespace Aus\Task5\Model\Plugin;

use Magento\Sales\Api\Data\OrderInterface;

class OrderSave
{

    /**
     * @param OrderInterface $resultOrder
     * @return OrderInterface
     */
    public function afterSave(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    ) {
        $erpStatus = $resultOrder->getData('erp_status');
        $extensionAttributes = $resultOrder->getExtensionAttributes();
        $erpStatus = $extensionAttributes->getErpStatus();

        if(!$erpStatus) {
            $resultOrder->setErpStatus('Processing');
            $resultOrder->save();
        }

        return $resultOrder;
    }
}
