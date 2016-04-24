<?php

class UserController extends Zend_Controller_Action
{

    private $model = null;

    private $aut = null;

    private $auth = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()){
            $this->view->user=$this->auth->getIdentity();
        }
        $this->model = new Application_Model_DbTable_User();

    }

    public function indexAction()
    {
        // action body
        $this->view->users = $this->model->listUsers();
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
                    $data['photo'] = str_replace(PUBLIC_PATH . '/uploads/',"",$upload->getFileName());
                   // $data['photo'] = $upload->getFileName();

                    $files = $upload->getFileInfo();
                    foreach ($files as $file => $info) {
                        if ($upload->isValid($file)) {
                            $upload->receive($file);
                        }
                    }
                    if ($this->model->addUser($data))
                    {
                    include PUBLIC_PATH . '/../library/sendgrid-php/sendgrid-php.php';
                    $sendgrid = new SendGrid("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");
                    $email = new SendGrid\Email();
                    $email
                            ->addTo($data["email"])
                            ->setFrom('admin@zforum.com')
                            ->setSubject('Welcome to Zforum')
                            ->setText('Your Registeration Info')
                            ->setHtml("Dear Mr." . $data['name'] . "<br/>&nbsp;&nbsp;&nbsp;Thanks for registeration.<br/>your username: " . $data['username'] . "<br/>your password: " . $data['password'] . "<br/>your password: ");
                      try {
                        $sendgrid->send($email);
                    }
                    catch (Exception $ex) {
                        $hhhhh="dsadsa";
                        //echo json_encode(array("status" => "errorRedirect"));
                       // exit;
                    }


                        $this->redirect('user/index');
                    }
                }
            }
        }

        $this->view->flag = 1;
        $this->view->form = $form;
        $this->render('add');

    }

    public function deleteAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            if ($this->model->deleteUser($id))
                $this->redirect('user/index');

        } else {
            $this->redirect('user/index');
        }

    }

    public function editAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_User();
        $user = $this->model->getUserById($id);
        $form->populate($user[0]);
        $form->setAction('../../add');
        $this->view->form = $form;
        $this->render('add');
    }

    public function loginAction()
    {
        if ($this->_request->getParam('username')) {
            $username = $this->_request->getParam('username');
            $password = $this->_request->getParam('password');
            $db = Zend_Db_Table::getDefaultAdapter();
            $authAdapter = new Zend_Auth_Adapter_DbTable($db, 'user', 'email', 'password');
            $authAdapter->setIdentity($username);
            $authAdapter->setCredential($password);

            $result = $authAdapter->authenticate();
            if ($result->isValid()) {
                 $storage = $this->auth->getStorage();
                 $storage->write($authAdapter->getResultRowObject());

                $session=new Zend_Session_Namespace('user');

                $session->user=$this->model->getUser($username);
      
                if($this->auth->getIdentity()->role == 'Admin'){ $this->redirect('user/index');}else{ $this->redirect('Courses/list');}
             

            } else {
                echo "auth fail";

            }

        } else {
        }
        // action body

    }

    public function profileAction()
    {
        // action body
    }

    public function logoutAction()
    {
        // action body
        $storage = new Zend_Auth_Storage_Session();
        $storage->clear();
        $this->redirect('user/login');
    }

    public function banAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            if ($this->model->banUser($id))
                $this->redirect('user/index');

        } else {
            $this->redirect('user/index');
        }

    }


}















