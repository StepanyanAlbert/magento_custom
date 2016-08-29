<?php

namespace Foo\Bar\Controller\Index;

use Foo\Bar\Controller\News;

class View extends News
{
    public function execute()
    {
        $newsId = $this->getRequest()->getParam('id');
        $news = $this->_newsFactory->create()->load($newsId);
        $this->_objectManager->get('Magento\Framework\Registry')
            ->register('newsData', $news);

        $pageFactory = $this->_pageFactory->create();

        $pageFactory->getConfig()->getTitle()->set($news->getTitle());

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
                'title' => __('Bar News'),
                'link' => $this->_url->getUrl('news')
            ]
        );
        $breadcrumbs->addCrumb('news',
            [
                'label' => $news->getTitle(),
                'title' => $news->getTitle()
            ]
        );

        return $pageFactory;
    }
}