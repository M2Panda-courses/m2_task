<?php

namespace Aus\Task12\Ui\DataProvider\Product;

use Magento\Review\Ui\DataProvider\Product\ReviewDataProvider as  VendorProvider;

class ReviewDataProvider extends VendorProvider
{

    /**
     * @inheritdoc
     * @since 100.1.0
     */
    public function getData()
    {
        $this->getCollection();
        $voteTable = $this->getCollection()->getTable('rating_option_vote');
        $this->getCollection()->getSelect()->joinLeft(
            ['vote' => $voteTable],
            'rt.review_id = vote.vote_id',
            ['value']
        );

        $arrItems = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => [],
        ];

        foreach ($this->getCollection() as $item) {
            $arrItems['items'][] = $item->toArray([]);
        }

        return $arrItems;
    }

}
