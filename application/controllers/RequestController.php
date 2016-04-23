<?php

class RequestController extends Zend_Controller_Action
{

    private $request_model ;


    public function init()
    {
        /* Initialize action controller here */
        $this->request_model = new Application_Form_Addrequest();
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $this->view->request = $this->request_model ;
        
        $data = $this->getRequest()->getParams();
        
        print_r($data);
        
    }


}



