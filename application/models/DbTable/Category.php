<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';

    
    
    function listcat(){
        
        return $this->fetchAll()->toArray();
        
    }
    
    function returnCategoryName ($id){
        
        return $this->find($id)->toArray();
    }
    
}

