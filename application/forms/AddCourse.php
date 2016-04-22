<?php

class Application_Form_AddCourse extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $course_name = new Zend_Form_Element_Text("courseName");
        $course_name->setRequired();
        $course_name->addValidator(new Zend_Validate_Alpha());
        $course_name->setlabel("Course Name:");
        $course_name->setAttrib("class",array("form-control","col-lg-9" ));
        $course_name->setAttrib("placeholder","Enter Course name");
        
        $course_desc = new Zend_Form_Element_Text("courseName");
        $course_desc->setRequired();
        $course_desc->addValidator(new Zend_Validate_Alpha());
        $course_desc->setlabel("Course Descrption:");
        $course_desc->setAttrib("class",array("form-control","col-lg-9" ));
        $course_desc->setAttrib("placeholder","Enter Course desc");
        
        $course_photo=new Zend_Form_Element_File('photo');
        $course_photo->setLabel("Course Cover : ");
        $course_photo->setAttrib("class",array("form-control","col-lg-9" ));
        $course_photo->setAttrib('id','image-file');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($course_name , $course_photo));
    }


}

