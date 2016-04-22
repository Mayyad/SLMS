<?php

class CoursesController extends Zend_Controller_Action
{

    private $model = null;


    public function init()
    {
        /* Initialize action controller here */
        $this->model  = new Application_Model_DbTable_Courses();
    }

    public function indexAction()
    {
        // action body
    }

    public function listAction()
    {
        
        $this->view->courses = $this->model->listCourses();
        //$data = $this->getRequest()->getParams();
        //$this->view->add = new Application_Form_AddCourse();
       
        //$this->view = $form;
        
    }

    public function addAction()
    {
        // action body
        $data = $this->getRequest()->getParams();
        unset($data['submit']);
        echo '<br> <br> <br> <br>';
        //print_r($data);

        if ($this->getRequest()->isPost()){
            
            $upload = new Zend_File_Transfer_Adapter_Http();
            $upload->addValidator('Size', false, 52428800, 'image');
            $upload->setDestination(PUBLIC_PATH . '/uploads');

            $data['course_photo'] = $upload->getFileName();
            $files = $upload->getFileInfo();
            foreach ($files as $file => $info) {
                if ($upload->isValid($file)) {
                    $upload->receive($file);
                }
            }
            $this->model->addCourse($data);
            $this->redirect('courses/list');
        }
    }

    public function deleteAction()
    {
        // action body
        echo '<br> <br> <br> <br>';
        $course_id = $this->getRequest()->getParams();
        $this->model->deleteCourse($course_id);
        $this->redirect('courses/list');
    }

    public function updateAction()
    {
        // action body
    }


}









