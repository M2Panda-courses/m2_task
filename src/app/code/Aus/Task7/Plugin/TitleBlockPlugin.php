<?php

namespace Aus\Task7\Plugin;

use Magento\Theme\Block\Html\Title;

class TitleBlockPlugin
{
    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
    ) {
        $this->_storeManager = $storeManager;
    }

    /**
     * @param Title $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(Title $subject, $result)
    {

        $store = $this->_storeManager->getStore();

        if ($store && $store->getId() == "1") {
            if ($subject->getNameInLayout() == 'page.main.title') {
                $result = '';
            }
        } else {
            if ($subject->getNameInLayout() == 'page.main.title.task7') {
                $result = '';
            }
        }

        return $result;
    }
}
