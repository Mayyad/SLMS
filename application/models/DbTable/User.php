<?php

class Application_Model_DbTable_User extends Zend_Db_Table_Abstract
{

    protected $_name = 'user';

    function addUser($data){
        $row = $this->createRow();
        $row->name = $data['name'];
        $row->username = $data['username'];
        $row->password = md5($data['password']);
        $row->email = $data['email'];
        $row->gender = $data['gender'];
        $row->country = $data['country'];
        $row->photo = $data['photo'];
        $row->signture = $data['signture'];
        //$row->status = $data['status'];
        $row->role = $data['role'];
        return $row->save();
    }

    function listUsers(){

        return $this->fetchAll()->toArray();
    }

    function deleteUser($id){
        return $this->delete('id='.$id);
    }
    function getUserById($id){
        return $this->find($id)->toArray();
    }

    function getUser($user){
        $db = Zend_Db_Table::getDefaultAdapter();
        $select=$db->select()
            ->from(array('p' => 'user'))
            ->where('p.email=?',$user)
            ->ORwhere('p.username=?',$user);
        return $select->query()->fetchAll();
    }
}

