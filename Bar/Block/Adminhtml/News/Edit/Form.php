<?php

namespace Foo\Bar\Block\Adminhtml\News\Edit;

use Magento\Backend\Block\Widget\Form\Generic;

class Form extends Generic
{

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create(
            [
                'data' => [
                    'id'    => 'edit_form',
                    'action' => $this->getData('action'),
                    'method' => 'post',
                    'enctype' => 'multipart/form-data'

                ]
            ]
        );
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}