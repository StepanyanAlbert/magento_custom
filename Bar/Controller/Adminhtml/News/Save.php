<?php

namespace Foo\Bar\Controller\Adminhtml\News;

use Foo\Bar\Controller\Adminhtml\News;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;
use Foo\Bar\Model\NewsFactory;

class Save extends News
{
    protected $fileSystem;

    protected $uploaderFactory;

    protected $allowedExtensions = ['png', 'jpg', 'jpeg', 'gif'];

    protected $fileId = 'image';

    protected $filename ;

    public $media_directory;


    public function __construct($context, $registry, $pageFactory, $newsFactory, $adapterFactory, $uploaderFactory, $filesystem)
    {   $this->filename=md5(date('Y-m-d H:i:s:u')).'.png';
        parent::__construct($context, $registry, $pageFactory, $newsFactory, $adapterFactory, $uploaderFactory, $filesystem);
    }

    public function execute()
    {

        try {
            $uploader = $this->uploader->create(
                ['fileId' => 'image']
            );
            $this->media_directory = $this->filesystem->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $imageAdapter = $this->adapterFactory->create();
            $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $mediaDirectory = $this->media_directory;
            $result = $uploader->save(
                $this->getDestinationPath(), $this->filename
            );


            $data['image'] = $this->getDestinationPath() . $result['file'];
        } catch (\Exception $e) {
            if ($e->getCode() == 0) {
                $this->messageManager->addError($e->getMessage());
            }
        }

        $isPost = $this->getRequest()->getPost();

        if ($isPost) {

            $newsModel = $this->_newsFactory->create();
            $newsId = $this->getRequest()->getParam('id');

            if ($newsId) {
                $newsModel->load($newsId);
            }
            $formData = $this->getRequest()->getParam('news');

            $newsModel->setTitle($this->getRequest()->news['title']);
            $newsModel->setImageUrl('http://localhost/magento/pub/media/images/' . "{$this->filename}");
            $newsModel->setBody($this->getRequest()->news['body']);

            try {
                $newsModel->save();

                $this->messageManager->addSuccess(__('The news has been saved.'));

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', ['id' => $newsModel->getId(), '_current' => true]);
                    return;
                }

                $this->_redirect('*/*/');
                return;
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
            }

            $this->_getSession()->setFormData($formData);
            $this->_redirect('*/*/edit', ['id' => $newsId]);
        }
    }

    public function getDestinationPath()
    {
        return BP . '\\pub\\media\\images\\';
    }



//    public function uploadFile()
//    {
//        $destinationPath = $this->getDestinationPath();
//
//        try {
//            $file_name = $_FILES['image']['name'];
//            $file_size =$_FILES['image']['size'];
//            $file_tmp =$_FILES['image']['tmp_name'];
//            $file_type=$_FILES['image']['type'];
//            $file_ext = end((explode('.', $file_name)));
//            $extensions= array("jpeg","jpg","png");
//
//            if(in_array($file_ext,$extensions)=== false){
//                $errors[]="extension not allowed, please choose a JPEG or PNG file.";
//            }
//
//            if($file_size > 2097152){
//                $errors[]='File size must be excately 2 MB';
//            }
//
//            if(empty($errors)==true){
//                move_uploaded_file($file_tmp,$this->getDestinationPath().$file_name);
//                echo "Success";
//            }else{
//                print_r($errors);
//            }


//            echo '<pre>';
//            var_dump($this->getRequest()->getParam('news'));
//            var_dump($_FILES);
//            echo '</pre>';
//            die;
//            $uploader = $this->uploaderFactory->create(['fileId' => $_FILES['image']])
//                ->setAllowCreateFolders(true)
//                ->setAllowedExtensions($this->allowedExtensions)
//                ->addValidateCallback('validate', $this, 'validateFile');
//            if (!$uploader->save($destinationPath)) {
//                throw new LocalizedException(
//                    __('File cannot be saved to path: $1', $destinationPath)
//                );
//            }

//        } catch (\Exception $e) {
//            $this->messageManager->addError(
//                __($e->getMessage())
//            );
//        }
//    }

}