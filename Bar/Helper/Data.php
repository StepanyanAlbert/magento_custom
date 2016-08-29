<?php

namespace Foo\Bar\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const XML_PATH_ENABLED      = 'bar/general/enable_in_frontend';
    const XML_PATH_HEAD_TITLE   = 'bar/general/head_title';
    const XML_PATH_LASTEST_NEWS = 'bar/general/lastest_news_block_position';


    protected $_scopeConfig;

    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfig;
    }

    public function isEnabledInFrontend($store = null)
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }


    public function getHeadTitle()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_HEAD_TITLE,
            ScopeInterface::SCOPE_STORE
        );
    }


    public function getLastestNewsBlockPosition()
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_LASTEST_NEWS,
            ScopeInterface::SCOPE_STORE
        );
    }
}