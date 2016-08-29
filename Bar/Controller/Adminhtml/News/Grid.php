<?php

namespace Foo\Bar\Controller\Adminhtml\News;

use Foo\Bar\Controller\Adminhtml\News;

class Grid extends News
{

    public function execute()
    {
        return $this->_resultPageFactory->create();
    }
}