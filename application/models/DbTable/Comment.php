<?php

class Application_Model_DbTable_Comment extends Zend_Db_Table_Abstract
{

    protected $_name = 'comment';




private function extractData($data,$filter)
	{
		$extractedData =array();
		if(isset($filter))
		{
			$attrs = $filter;
		}else {
			$attrs = $this->attributes;
		}

		foreach ($data as $key => $value) {
			if(in_array($key, $attrs)){
				$extractedData[$key]=$value;
			}
		}
		return $extractedData;

	}



    public function addAction($comment,$O_id,$m_id,$c_id)
    {
        $row = $this->createRow();
        $row->comment_text = $comment;
        $row->owner_id = $O_id;
        $row->matrial_id = $m_id;
        $row->comment_id = $c_id;
        return $row->save();
    }



    function listComment($matrial_id){
    	   $db = Zend_Db_Table::getDefaultAdapter();
        $select=$db->select()
            ->from(array('m' => 'comment'))
            ->where('m.matrial_id='.$matrial_id);
        return $select->query()->fetchAll();
	}
	
	function getCommentById($id){
		return $this->find($id)->toArray();
	}

	function editComment($id, $data){
		$data = $this->extractData($data,array('comment_text'));
		print_r($data);
		$where = $this->getAdapter()->quoteInto('comment_id = ?',$id);
		return $this->update($data,$where);
	}

	function deleteComment($id){
		$beforedel =  $this->find($id)->toArray();
		$this->delete('comment_id='.$id);
		return $beforedel;
	}




}

