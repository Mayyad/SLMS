<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $id = new Zend_Form_Element_Hidden("id");

        $name = new Zend_Form_Element_Text("name");
        $name->setRequired();
        $name->addValidator(new Zend_Validate_Alpha());
        $name->setlabel("Name:");
        $name->setAttrib("class","form-control");
        $name->setAttrib("placeholder","Enter your name");




        $username = new Zend_Form_Element_Text("username");
        $username->setRequired();
        $username->addValidator(new Zend_Validate_Alpha());
        $username->setlabel("User Name:");
        $username->setAttrib("class","form-control");
        $username->setAttrib("placeholder","Enter your user name");
        $username->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
                'table' => 'user',
                'field' => 'username'
            )
        ));

        $signture= new Zend_Form_Element_Text("signture");
        $signture->setRequired();
        $signture->addValidator(new Zend_Validate_Alpha());
        $signture->setlabel("signture:");
        $signture->setAttrib("class","form-control");
        $signture->setAttrib("placeholder","Enter your signture");


        $email = new Zend_Form_Element_Text("email");
        $email->setRequired();
        $email->setAttrib("class","form-control");

        $email->addValidator(new Zend_Validate_EmailAddress());
        $email->addValidator(new Zend_Validate_Db_NoRecordExists(
            array(
                'table' => 'user',
                'field' => 'email'
            )
        ));
        $email->setlabel("Email:");
        $email->setAttrib("placeholder","Enter your Email");

        $password = new Zend_Form_Element_Password("password");
        $password->setRequired();
        $password->setlabel("Password : ");
        $password->setAttrib("class","form-control");
        $password->addValidator(new Zend_Validate_StringLength(array('min' => 5, 'max' => 10)));


        $cpassword = new Zend_Form_Element_Password("cpassword");
        $cpassword->setRequired();
        $cpassword->setlabel("Confirm Password : ");
        $cpassword->setAttrib("class","form-control");
        $cpassword->addValidator(new Zend_Validate_StringLength(array('min' => 5, 'max' => 10)));

        $gender = new Zend_Form_Element_Radio('gender');
        $gender->setLabel('Gender');
        $gender->setRequired();
        $gender->setValue(array(
            '0' => 'Female',
            '1' => 'Male',
        ));

        $country = new Zend_Form_Element_Select('country');
        $country->setLabel('Country');
        $country->setValue(array(
            '0' => 'Egypt',
            '1' => 'England',
            '2' => 'Japan',
            '3' => 'Chine',
        ));

        $role = new Zend_Form_Element_Select('role');
        $role->setLabel('Role');
        $role->setValue(array(
            'Admin' => 'Admin',
            'User' => 'User',
        ));

        $photo=new Zend_Form_Element_File('photo');
        $photo->setLabel("Photo");
        $photo->setAttrib('id','image-file');
        $submit = new Zend_Form_Element_Submit('submit');

        $this->addElements(array($id,$name, $email,$signture,$password,$cpassword,$gender,$country,$role,$photo, $submit));
    }

}

