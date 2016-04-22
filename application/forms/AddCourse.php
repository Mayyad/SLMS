<?php

class Application_Form_AddCourse extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $course_name = new Zend_Form_Element_Text("course_name");
        $course_name->setRequired();
        $course_name->addValidator(new Zend_Validate_Alpha());
        $course_name->setlabel("Course Name:");
        $course_name->setAttrib("class",array("form-control","col-lg-9" ));
        $course_name->setAttrib("placeholder","Enter Course name");
        
        $course_desc = new Zend_Form_Element_Text("course_desc");
        $course_desc->setRequired();
        $course_desc->addValidator(new Zend_Validate_Alpha());
        $course_desc->setlabel("Course Descrption:");
        $course_desc->setAttrib("class",array("form-control","col-lg-9" ));
        $course_desc->setAttrib("placeholder","Enter Course desc");
        
        $course_status = new Zend_Form_Element_Hidden("course_status");
        $course_status->setAttrib("value", "Available");
        
        $course_photo=new Zend_Form_Element_File('course_photo');
        $course_photo->setLabel("Course Cover : ");
        $course_photo->setAttrib("class",array("form-control","col-lg-9" ));
        $course_photo->setAttrib('id','course-img');
        
       
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $submit->setAttrib("value", "add");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        
        $this->addElements(array($course_name , $course_desc , $course_status , $course_photo, $submit ));
    }


}

