<?php

class RequestController extends Zend_Controller_Action
{

    private $request_model = null;
    private $course_model = null;
    //private $request_form = null;

    public function init()
    {
        /* Initialize action controller here */
        //$this->request_form = new Application_Form_Addrequest();
        $this->request_model = new Application_Model_DbTable_Addrequest ();
        $this->course_model = new Application_Model_DbTable_Courses();
    }

    public function indexAction()
    {
        // action body
    }

    public function addAction()
    {
        // action body
        $course = $this->course_model->listCourses();
        $arr = array();
        
        foreach ($course as $value) {
            $arr[$value['course_id']] = $value['course_name'];
        }
        
        
        $this->view->request = new Application_Form_Addrequest($arr);
        
        $data = $this->getRequest()->getParams();
        
        
        //print_r($data);
        $data['owner_id'] = '1';   //id el current user
        
        
        $this->request_model->sendRequest($data);
        
    }

    public function listAction()
    {
        // action body
        $this->view->requests  = $this->request_model->listrequests();
    }


}





