<?php


namespace Foo\Bar\Block\Adminhtml\News\Edit\Tab;

use Magento\Backend\Block\Widget\Form\Generic;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Backend\Block\Template\Context;
use Magento\Framework\Registry;
use Magento\Framework\Data\FormFactory;
use Magento\Cms\Model\Wysiwyg\Config;
use Foo\Bar\Model\System\Config\Status;

class Info extends Generic implements TabInterface {

    protected $_wysiwygConfig;


    public function __construct(
        Context $context, Registry $registry, FormFactory $formFactory, Config $wysiwygConfig, array $data = []
    ) {
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }


    protected function _prepareForm() {
        $model = $this->_coreRegistry->registry('bar_news');

        $form = $this->_formFactory->create();
        $form->setHtmlIdPrefix('news_');
        $form->setFieldNameSuffix('news');

        $fieldset = $form->addFieldset(
            'base_fieldset', ['legend' => __('General')]
        );

        if ($model->getId()) {
            $fieldset->addField(
                'id', 'hidden', ['name' => 'id']
            );
        }
        $fieldset->addField(
            'name', 'text', [
                'name' => 'title',
                'label' => __('Title'),
                'required' => true
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig();
        $fieldset->addField(
            'text', 'editor', [
                'name' => 'body',
                'label' => __('Body'),
                'required' => true,
                'config' => $wysiwygConfig
            ]
        );
        $fieldset->addField(
            'image',
            'image',
            [
                'title' => __('Image'),
                'label' => __('Image'),
                'name' => 'image',
                'note' => 'Allow image type: jpg, jpeg, gif, png',
            ]
        );
//        $fieldset->addField(
//            'image', 'file', [
//                'title' => __('Image'),
//                'label' => __('Image'),
//                'name' => 'image',
//
//                'note' => 'Allow image type: jpg, jpeg, gif, png',
//            ]
//        );



        $data = $model->getData();
        $form->setValues($data);
        $this->setForm($form);

        return parent::_prepareForm();
    }


    public function getTabLabel() {
        return __('News Info');
    }

    public function getTabTitle() {
        return __('News Info');
    }

    public function canShowTab() {
        return true;
    }


    public function isHidden() {
        return false;
    }

}
