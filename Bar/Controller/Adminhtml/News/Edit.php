<?php

namespace Foo\Bar\Controller\Adminhtml\News;

use Foo\Bar\Controller\Adminhtml\News;

class Edit extends News
{

    public function execute()
    {
        $newsId = $this->getRequest()->getParam('id');
        $model = $this->_newsFactory->create();

        if ($newsId) {
            $model->load($newsId);
            if (!$model->getId()) {
                $this->messageManager->addError(__('This news no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $data = $this->_session->getNewsData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        $this->_coreRegistry->register('bar_news', $model);

        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Foo_Bar::main_menu');
        $resultPage->getConfig()->getTitle()->prepend(__('Bar News'));

        return $resultPage;
    }
}