<?php

namespace Aus\Task7\Plugin;

use Magento\Catalog\Block\Product\View\Gallery;

class GalleryPlugin
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
     * @param Gallery $subject
     * @param string $result
     * @return string
     */
    public function afterToHtml(\Magento\Catalog\Block\Product\View\Gallery $subject, $result)
    {

        $store = $this->_storeManager->getStore();

        if ($store && $store->getId() == "1") {
            if ($subject->getNameInLayout() == 'product.info.media.image') {
                $result = str_replace('<div class="gallery-placeholder', '<div class="gallery-placeholder_default', $result);;
            }
        }

        return $result;
    }
}
