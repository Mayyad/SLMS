<?php

class RequestController extends Zend_Controller_Action
{

    private $request_model = null;
    private $course_model = null;
    private $user_model = null;
    //private $request_form = null;
    private $user = array();
    

    public function init()
    {
        /* Initialize action controller here */
        //$this->request_form = new Application_Form_Addrequest();
        $this->request_model = new Application_Model_DbTable_Addrequest ();
        $this->course_model = new Application_Model_DbTable_Courses();
        $this->user_model = new Application_Model_DbTable_User();
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
        $i = 0;
        $data = $this->request_model->listrequests();
        //print_r($data);
        foreach ( $data as  $id ) {
            $us_id = $id['owner_id'];
            $user = $this->user_model->getUserById($us_id);
            $owner_name  = $user[0]['name'];
            $owner_photo = $user[0]['photo'];
            
            $course_id =  $id['course_id'];
            $course = $this->course_model->returnCourse($course_id);
            $course_name = $course[0]['course_name'];
            //echo $owner_name;
            $data[$i]['owner_name'] = $owner_name;
            $data[$i]['owner_photo'] = $owner_photo;
            $data[$i]['course_name'] = $course_name;
            $i ++;
        }
        
        
        //print_r($data);
        
        $this->view->requests  = $data; 
    }
    

}





