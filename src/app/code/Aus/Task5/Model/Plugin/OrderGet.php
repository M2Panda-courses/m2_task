<?php

namespace Aus\Task5\Model\Plugin;

use Magento\Sales\Api\Data\OrderInterface;

class OrderGet
{

    /**
     * @param OrderInterface $resultOrder
     * @return OrderInterface
     */
    public function afterGet(
        \Magento\Sales\Api\OrderRepositoryInterface $subject,
        \Magento\Sales\Api\Data\OrderInterface $resultOrder
    ) {
        $erpStatus = $resultOrder->getData('erp_status');
        $extensionAttributes = $resultOrder->getExtensionAttributes();
        $extensionAttributes->setErpStatus($erpStatus);
        $resultOrder->setExtensionAttributes($extensionAttributes);

        return $resultOrder;
    }
}
