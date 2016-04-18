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



