<?php

namespace Foo\Bar\Block;

use Magento\Framework\View\Element\Template;
use Foo\Bar\Model\NewsFactory;

class NewsList extends Template
{

    protected $_newsFactory;

    public function __construct(
        Template\Context $context,
        NewsFactory $newsFactory,
        array $data = []
    ) {
        $this->_newsFactory = $newsFactory;
        parent::__construct($context, $data);
    }


    protected  function _construct()
    {
        parent::_construct();
        $collection = $this->_newsFactory->create()->getCollection()
            ->setOrder('id', 'DESC');
        $this->setCollection($collection);
    }


    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock(
            'Magento\Theme\Block\Html\Pager',
            'bar.news.list.pager'
        );
        $pager->setLimit(5)
            ->setShowAmounts(false)
            ->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();

        return $this;
    }

    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }
}
     