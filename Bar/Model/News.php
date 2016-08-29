<?php

namespace Foo\Bar\Model;

use Magento\Framework\Model\AbstractModel;

class News extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Foo\Bar\Model\Resource\News');
    }
}