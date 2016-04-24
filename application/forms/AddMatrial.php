<?php

class Application_Form_AddMatrial extends Zend_Form
{

    private $idval;
    private $cidval;
    public function __construct($idcpy,$cidcpy){
        $this->idval = "";
        $this->idval = $idcpy;
        $this->cidval = "";
        $this->cidval = $cidcpy;
        parent::__construct();
    }

    public function init()
    {
    	$id = new Zend_Form_Element_Hidden("id");
        if($this->idval != -1)
        $id->setValue($this->idval);

    	$cid = new Zend_Form_Element_Hidden("cid");
        if($this->cidval != -1)
        $cid->setValue($this->cidval);


        $name = new Zend_Form_Element_Text("name");
        $name->setRequired();
        $name->addValidator(new Zend_Validate_Alpha());
        $name->setlabel("Name:");
        $name->setAttrib("class",array("form-control","col-lg-9" ));

        $name->setAttrib("placeholder","Enter Matrial Name");




        $status = new Zend_Form_Element_Select('status');
        $status->setLabel('Status');
        $status->setAttrib("class",array("form-control","col-lg-9" ));
        $status->addMultiOptions(array(
            'Active' => 'Active',
            'Deactive' => 'Deactive',
        ));






        $type = new Zend_Form_Element_Select('type');
        $type->setLabel('Type');
        $type->setAttrib("class",array("form-control","col-lg-9" ));
        $type->addMultiOptions(array(
            'PDF' => 'PDF',
            'Video' => 'Video',
            'URL' => 'URL',
            'TXT' => 'TXT',
            'IMG' => 'IMG',
        ));

        $file=new Zend_Form_Element_File('download');
        $file->setLabel("File");
        $file->setAttrib("class",array("form-control","col-lg-9" ));
        $file->setAttrib('id','Matrial-File');


        $notfile = new Zend_Form_Element_Textarea("link");
        $notfile->setRequired();
        $notfile->setlabel("Data:");
        $notfile->setAttrib("class",array("form-control","col-lg-9" ));
        $notfile->setAttrib("placeholder","Enter Matrial Data");
        $notfile->setAttrib('cols', '40')->setAttrib('rows', '4');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib("class","btn-lg btn-primary");
        $this->setAttrib('enctype', 'multipart/form-data');
        $this->setAttrib('class','form-horizontal');
        $this->addElements(array($id,$cid, $name,$status,$type,$file,$notfile,$submit));
    



    }


}

