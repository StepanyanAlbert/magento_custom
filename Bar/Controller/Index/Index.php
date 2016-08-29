<?php

namespace Foo\Bar\Controller\Index;


use Foo\Bar\Controller\News;

class Index extends News
{
    public function execute()
    {
        $pageFactory = $this->_pageFactory->create();

        $pageFactory->getConfig()->getTitle()->set(
            $this->_dataHelper->getHeadTitle()
        );

        $breadcrumbs = $pageFactory->getLayout()->getBlock('breadcrumbs');
        $breadcrumbs->addCrumb('home',
            [
                'label' => __('Home'),
                'title' => __('Home'),
                'link' => $this->_url->getUrl('')
            ]
        );
        $breadcrumbs->addCrumb('bar',
            [
                'label' => __('Bar News'),
                'title' => __('Bar News')
            ]
        );

        return $pageFactory;
    }
}
