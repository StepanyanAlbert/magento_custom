<?php

namespace Foo\Bar\Model\Resource\News;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init(
            'Foo\Bar\Model\News',
            'Foo\Bar\Model\Resource\News'
        );
    }
}