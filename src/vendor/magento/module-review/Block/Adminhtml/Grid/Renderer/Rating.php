<?php
namespace Magento\Review\Block\Adminhtml\Grid\Renderer;

use Magento\Review\Model\ResourceModel\Rating\Collection as RatingCollection;

/**
 * Adminhtml review grid item renderer for item rating
 *
 */
class Rating extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{

    protected $_ratingFactory;

    protected $ratingCollection;

    public function __construct(
        RatingCollection $ratingCollection,
        \Magento\Review\Model\RatingFactory $ratingFactory,
    ) {
        $this->ratingCollection = $ratingCollection;
        $this->_ratingFactory = $ratingFactory;
    }

    /**
     * Render review rating
     *
     * @param \Magento\Framework\DataObject $row
     * @return \Magento\Framework\Phrase
     */
    public function render(\Magento\Framework\DataObject $row)
    {
//        $row->getReviewId();
//        $this->ratingCollection->addFieldToFilter('review_id', $row->getReviewId());
        $f = $this->_ratingFactory->create()->getReviewSummary($row->getReviewId());
        return $f->getData('sum')/20;
    }
}
