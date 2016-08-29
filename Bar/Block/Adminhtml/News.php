<?php

namespace Foo\Bar\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class News extends Container
{

    protected function _construct()
    {
        $this->_controller = 'adminhtml_news';
        $this->_blockGroup = 'Foo_Bar';
        $this->_headerText = __('Manage News');
        $this->_addButtonLabel = __('Add News');
        parent::_construct();
    }
}