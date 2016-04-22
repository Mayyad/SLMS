<?php

class Application_Form_AddMatrial extends Zend_Form
{

    public function init()
    {
    	        $id = new Zend_Form_Element_Hidden("id");


        $name = new Zend_Form_Element_Text("name");
        $name->setRequired();
        $name->addValidator(new Zend_Validate_Alpha());
        $name->setlabel("Name:");
        $name->setAttrib("class",array("form-control","col-lg-9" ));

        $name->setAttrib("placeholder","Enter your name");




        $role = new Zend_Form_Element_Select('role');
        $role->setLabel('Role');
        $role->setAttrib("class",array("form-control","col-lg-9" ));
        $role->addMultiOptions(array(
            'Admin' => 'Admin',
            'User' => 'User',
        ));






        $role = new Zend_Form_Element_Select('role');
        $role->setLabel('Role');
        $role->setAttrib("class",array("form-control","col-lg-9" ));
        $role->addMultiOptions(array(
            'Admin' => 'Admin',
            'User' => 'User',
        ));

        $photo=new Zend_Form_Element_File('photo');
        $photo->setLabel("Photo");
        $photo->setAttrib("class",array("form-control","col-lg-9" ));
        $photo->setAttrib('id','image-file');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($id,$name, $username,$email,$signture,$password,$cpassword,$gender,$country,$role,$photo, $submit));
    



    }


}

