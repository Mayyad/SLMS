<?php

class MatrialController extends Zend_Controller_Action
{


//get file name from url 
//get it's data from DB (i.e. file type)
//according to the type & status 

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
    }

    public function listAction()
    {
        // action body





/*
$this->getResponse()
                ->setHeader('Content-type', '   image/gif')
                ->setHeader('Content-Disposition', 'attachment; filename="2.gif"')
                ->setHeader('Content-length', filesize(APPLICATION_PATH . "/../public/uploads/2.gif"))
                ->setHeader('Cache-control', 'private');
        readfile(APPLICATION_PATH . "/../public/uploads/2.gif");
        $this->getResponse()->sendResponse();


$this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true); 
*/
    }

    public function deleteAction()
    {
        // action body
    }

    public function editAction()
    {
        // action body
    }


}









