<?php

class Application_Model_DbTable_Matrial extends Zend_Db_Table_Abstract
{

    protected $_name = 'matrial';

    function addMatrial($data){
        $row = $this->createRow();
        //$row->id = $data['id'];
        $row->course_id = $data['cid'];
        $row->name = $data['name'];
        $row->status = $data['status'];
        $row->type = $data['type'];
        $row->download = $data['download'];
        $row->link = $data['link'];
        return $row->save();
    }



    function listMatrial($cid){

        $db = Zend_Db_Table::getDefaultAdapter();
        $select=$db->select()
            ->from(array('m' => 'matrial'))
            ->where('m.course_id='.$cid);
            
        return $select->query()->fetchAll();
    }

    function deleteMatrial($id){
        return $this->delete('id='.$id);
    }
    function getMatrialById($id){
        return $this->find($id)->toArray();
    }

    

}

