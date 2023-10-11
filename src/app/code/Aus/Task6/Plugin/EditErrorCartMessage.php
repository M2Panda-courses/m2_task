<?php
namespace Aus\Task6\Plugin;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;

class EditErrorCartMessage
{

    /**
     * @var StoreManagerInterface
     */
    private $storeManager;
    public function __construct(
        StoreManagerInterface $storeManager
    ) {
        $this->storeManager = $storeManager;
    }

    /**
     * @throws NoSuchEntityException
     */
    public function afterExecute(
        $subject,
        $result
    )
    {
        if ($result->getData('has_error'))
        {
            if ($result->getData('message') == 'The requested qty is not available')
            {
                if ($this->storeManager->getStore()->getStoreId() == 2){
                    $result->setMessage('Some of the products are not available');
                    $result->setQuoteMessage('Some of the products are not available');
                }
            }
        }

        return $result;
    }
}
