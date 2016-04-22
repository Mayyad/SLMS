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
        
        $data['course_status'] = '1' ;
    	
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

}

