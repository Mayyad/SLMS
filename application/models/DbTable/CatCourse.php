<?php

class Application_Model_DbTable_CatCourse extends Zend_Db_Table_Abstract
{

    protected $_name = 'cat_course';

   function add($data){
        
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
        
      //  $data['course_status'] = "Available";
    	
    	$this->insert($data);
    }
    
    function returnCatID($id){
        
        $query = $this->select();
        $query->where('course_id'.'='.$id);
        $data = $this->fetchAll($query)->toArray();
        return $data ;
    }
    
    function deleterelation($id){
        
       $where = $this->getAdapter()->quoteInto('course_id = ?', $id['id']);
        
       $this->delete($where);
        
    }

}

