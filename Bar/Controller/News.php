<?php

namespace Foo\Bar\Controller;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\View\Result\PageFactory;
use Foo\Bar\Helper\Data;
use Foo\Bar\Model\NewsFactory;

abstract class News extends Action
{

    protected $_pageFactory;


    protected $_dataHelper;

    protected $_newsFactory;


    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Data $dataHelper,
        NewsFactory $newsFactory
    ) {
        parent::__construct($context);
        $this->_pageFactory = $pageFactory;
        $this->_dataHelper = $dataHelper;
        $this->_newsFactory = $newsFactory;
    }


    public function dispatch(RequestInterface $request)
    {
        if ($this->_dataHelper->isEnabledInFrontend()) {
            $result = parent::dispatch($request);
            return $result;
        } else {
            $this->_forward('noroute');
        }
    }
}
     