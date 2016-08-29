<?php

namespace Foo\Bar\Controller\Adminhtml\News;

use Foo\Bar\Controller\Adminhtml\News;

class NewAction extends News
{

    public function execute()
    {
        $this->_forward('edit');
    }
}
     