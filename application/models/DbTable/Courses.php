<?php

class Application_Model_DbTable_Courses extends Zend_Db_Table_Abstract
{

    protected $_name = 'course';
    
    function listCourses(){
        
        return $this->fetchAll()->toArray();
        
    }
    
    function addCourse($data){
        
        if (isset($data['module'])){
            unset ($data['module']);
        }
        if (isset($data['controller'])){
            unset ($data['controller']);
        }
        if (isset($data['action'])){
            unset ($data['action']);
        }
        
        if (isset($data['MAX_FILE_SIZE'])){
            unset ($data['MAX_FILE_SIZE']);
        }
        
        $data['course_status'] = "Available";
    	
    	$this->insert($data);
    }

    
    function deleteCourse($id){
        if (isset($data['module'])){
            unset ($data['module']);
        }
        if (isset($data['controller'])){
            unset ($data['controller']);
        }
        if (isset($data['action'])){
            unset ($data['action']);
        }
        
        $where = $this->getAdapter()->quoteInto('course_id = ?', $id['id']);
        
        $this->delete($where);
    }
    
    function returnCourse($id){

        
        return $this->find($id)->toArray();
    }
    
   
    
    function updateCourse($data , $id) {
        if (isset($data['module'])){
            unset ($data['module']);
        }
        if (isset($data['controller'])){
            unset ($data['controller']);
        }
        if (isset($data['action'])){
            unset ($data['action']);
        }
        
        if (isset($data['MAX_FILE_SIZE'])){
            unset ($data['MAX_FILE_SIZE']);
        }
        
         if (isset($data['submit'])){
            unset ($data['submit']);
        }
        
        if (isset($data['id'])){
            unset ($data['id']);
        }
        
        $this->update($data, "course_id= $id");
                        
    }
    
    

}

