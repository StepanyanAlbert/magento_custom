<?php

namespace Foo\Bar\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Foo\Bar\Model\NewsFactory;

abstract class News extends Action
{
    protected $_coreRegistry;
    protected $_resultPageFactory;
    protected $_newsFactory;
    protected $adapterFactory;
    protected $uploader;
    protected $filesystem;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        PageFactory $resultPageFactory,
        NewsFactory $newsFactory,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
        \Magento\Framework\Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->_coreRegistry = $coreRegistry;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_newsFactory = $newsFactory;
        $this->adapterFactory = $adapterFactory;
        $this->uploader = $uploader;
        $this->filesystem = $filesystem;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Foo_Bar::manage_news');
    }
}