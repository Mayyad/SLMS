<?php

class Application_Form_Addrequest extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        
        
        
        $request_body= new Zend_Form_Element_Textarea("	desc");
        $request_body->setRequired();
        $request_body->setLabel("Request Body :");
        $request_body->addValidator(new Zend_Validate_Alpha());
        $request_body->setAttrib("class",array("form-control","col-lg-9" ));
        
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $submit->setAttrib("value", "Send");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        
        
         $this->addElements(array($request_body ,$submit));
        
    }


}

