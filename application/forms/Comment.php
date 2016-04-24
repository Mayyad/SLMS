<?php

class Application_Form_Comment extends Zend_Form
{

/*
private $idval;
	public function __construct($idcpy){
		$this->idval = "";
		$this->idval = $idcpy;
		parent::__construct();
	}
*/


    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
       
		$comment_id = new Zend_Form_Element_Hidden("id");
		$content = new Zend_Form_Element_Textarea("comment_text");
		$content->setRequired();
		$content->addValidator(new Zend_Validate_Alpha());
		$content->setlabel("Comment:");
		$content->setAttrib("class","form-control");
		$content->setAttrib("placeholder","Enter your Comment");
		$content->setAttrib('cols', '40')->setAttrib('rows', '4');

		$matrial_id = new Zend_Form_Element_Hidden("matrial_id");

		$submit = new Zend_Form_Element_Submit('submit');

		$this->addElements(array($comment_id,$matrial_id,$content, $submit));
    }


}

