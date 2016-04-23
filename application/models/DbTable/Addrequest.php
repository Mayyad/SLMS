<?php

class Application_Model_DbTable_Addrequest extends Zend_Db_Table_Abstract
{

    protected $_name = 'request';

    function sendRequest($data){
        
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
        
        $this->insert($data);
    }
    
    function listrequests(){
        return $this->fetchAll()->toArray();
    }
}

