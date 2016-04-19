<?php

class UserController extends Zend_Controller_Action
{
    private $model;

    public function init()
    {
        /* Initialize action controller here */
        $this->model = new Application_Model_DbTable_User();

    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $data = $this->getRequest()->getParams();
        $form = new Application_Form_User();
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($data)) {
                if ($data['password'] === $data['cpassword']) {
                    $upload = new Zend_File_Transfer_Adapter_Http();
                    $upload->addValidator('Size', false, 52428800, 'image');
                    $upload->setDestination(PUBLIC_PATH . '/uploads');

                    $data['photo']=$upload->getFileName();

                    $files = $upload->getFileInfo();
                    foreach ($files as $file => $info) {
                        if ($upload->isValid($file)) {
                            $upload->receive($file);
                        }
                    }

                    if ($this->model->addUser($data))
                        $this->redirect('user/index');
                }
            }
        }

        $this->view->flag = 1;
        $this->view->form = $form;
        $this->render('add');

    }


}



