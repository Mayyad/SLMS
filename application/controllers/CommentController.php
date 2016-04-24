<?php

class CommentController extends Zend_Controller_Action
{
    private $userObj = null;
    private $auth=null;
    private $course_id=0;
   public function init()
    {
        /* Initialize action controller here */
        $this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()){
            $this->view->user=$this->auth->getIdentity();
            $this->userObj = $this->auth->getIdentity();
        }
         $this->view->headTitle('Comment'); 
           $this->model = new Application_Model_DbTable_Comment();
    }

    public function indexAction()
    {
        //$this->redirect('comment/list');
    }

    public function deleteAction()
    {
        
            $id = $this->getRequest()->getParam('commentid');
            if($id){
            $this->course_id = $this->model->deleteComment($id);
                $this->redirect('comment/list/cid/'.$this->course_id[0]['matrial_id']);
                
            }

    }

    public function addAction()
    {


        $data = $this->getRequest()->getParams();
        $form = new Application_Form_Comment();
        if($this->getRequest()->isPost()){
            if($form->isValid($data)){
            $comment = $data['comment_text'];
            $O_id= $this->userObj->id;
            $m_id= $this->getRequest()->getParam('cid');;
            $c_id= null;
            if ($this->model->addAction($comment,$O_id,$m_id,$c_id))
            $this->redirect('comment/list/cid/'.$m_id);
        }   
        }

        $this->view->flag = 1;
        $this->view->form = $form;
        $this->render('add');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
            if(! $this->_request->isPost())
            {
                $form = new Application_Form_Comment($id);
                $user = $this->model->getCommentById($id);            
                $form->populate($user[0]);
                $this->view->form = $form;
                $this->render('add');

            }
            else
            {
                $data = $this->_request->getParams();
                $this->model->editComment($id , $data);
                $this->view->comments = $this->model->listComments();
                $this->view->form = $form;
                $this->redirect('comment/');

            }      }

    public function listAction()
    {

        $uid = $this->userObj->id;
        $cid = $this->getRequest()->getParam('cid');
        $this->course_id = $cid;

        $this->view->comments = $this->model->listComment($cid);
    }



}









