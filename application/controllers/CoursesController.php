<?php

class CoursesController extends Zend_Controller_Action
{

    private $model = null;
    private $category_model = null;
    private $catcour_model = null;
    private $cat_cour_data = array();
    private $user_session;
    private $auth=null;
    public function init()
    {
        /* Initialize action controller here */
         $this->auth = Zend_Auth::getInstance();
        if($this->auth->hasIdentity()){
            $this->view->user=$this->auth->getIdentity();
        }
        $this->model = new Application_Model_DbTable_Courses();
        $this->category_model = new Application_Model_DbTable_Category();
        $this->catcour_model = new Application_Model_DbTable_CatCourse();
        $this->user_session = Zend_Session::namespaceIsset('hany');
    }

    public function indexAction()
    {
        // action body
        $this->view->ss=$this->user_session;
    }

    public function listAction()
    {

        $this->view->courses = $this->model->listCourses();

    }

    public function addAction()
    {
        // action body


        $cats = $this->category_model->listcat();
        $arr = array();
        foreach ($cats as $value) {
            $arr[$value['cat_id']] = $value['cat_name'];
        }

        $this->view->form = new Application_Form_AddCourse($arr);

        $data = $this->getRequest()->getParams();
        unset($data['submit']);
        if ($this->getRequest()->isPost()) {

            $category_id = $data['category'];
            unset($data['category']);

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
            $id = $this->model->getAdapter()->lastInsertId();
            $cat_cour_data = array('cat_id' => "$category_id", 'course_id' => "$id");
            $this->catcour_model->add($cat_cour_data);
            $this->redirect('Courses/list');
        }


    }

    public function deleteAction()
    {
        // action body
        echo '<br> <br> <br> <br>';
        $course_id = $this->getRequest()->getParams();
        $this->model->deleteCourse($course_id);

        $this->catcour_model->deleterelation($course_id);
        $this->redirect('courses/list');
    }

    public function updateAction()
    {
        // action body
        $data = $this->getRequest()->getParams();

        //print_r($data['id']);
        echo '<br> <br> <br><br><br><br> ';

        $course = $this->model->returnCourse($data['id']);

        $category = $this->catcour_model->returnCatID($data['id']);

        $cat_id = $category[0]['cat_id'];

        $cat_info = $this->category_model->returnCategoryName($cat_id);

        $cat_name = $cat_info[0]['cat_name'];

        $course[0]['cat_name'] = $cat_name;

        //print_r($course[0]);
        $cats = $this->category_model->listcat();
        $arr = array();
        foreach ($cats as $value) {
            $arr[$value['cat_id']] = $value['cat_name'];
        }

        $form = new Application_Form_AddCourse($arr);

        $form->populate($course[0]);

        $form->setAction('../../edit/id/' . $data['id']);

        $this->view->form = $form;


    }

    public function editAction()
    {
        // action body

        $newData = $this->getRequest()->getParams();
        //$category_id = $newData['category'];
        unset($newData['category']);

        $this->model->updateCourse($newData, $newData['id']);


        $this->redirect('courses/list');
    }

    public function listoneAction()
    {
        // action body
        $id = $this->getRequest()->getParam('id');

        $course = $this->model->returnCourse($id);

        $this->view->course = $course;

    }


}













