<?php

namespace Foo\Bar\Controller\Adminhtml\News;

use Foo\Bar\Controller\Adminhtml\News;

class Index extends News
{

    public function execute()
    {
        if ($this->getRequest()->getQuery('ajax')) {
            $this->_forward('grid');
            return ;
        }

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Foo_Bar::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('News'));

        return $resultPage;
    }
}