<?php declare(strict_types=1);

namespace Aus\Task3\Model;

use Magento\Framework\Model\AbstractModel;
use Aus\Task3\Api\Data\BlockInterface;

class Block extends AbstractModel implements BlockInterface
{
    protected function _construct()
    {
        $this->_init(ResourceModel\Block::class);
    }

    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    public function getValue()
    {
        return $this->getData(self::VALUE);
    }

    public function setValue($value)
    {
        $this->setData(self::VALUE, $value);
    }
}
