<?php

class MatrialController extends Zend_Controller_Action
{
    private $model = null;

//get file name from url 
//get it's data from DB (i.e. file type)
//according to the type & status 

    public function init()
    {
        /* Initialize action controller here */
                $this->model = new Application_Model_DbTable_Matrial();

    }

    public function indexAction()
    {
        // action body
    //$this->view->matrial = $this->model->listAction();

    }




public function downloadAction()
 {

$id = $this->getRequest()->getParam('id');
$matrial = $this->model->getMatrialById($id);
if($matrial &&$matrial[0]['status'] == 'Active')
    {
        var_dump($matrial); 

header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header("Content-Type: application/octet-stream");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0"); 
header("Content-Type: application/force-download");
header("Content-Type: application/download");
$ext="";
if ($matrial[0]['type'] == "PDF") {
    $ext=".pdf";
}
elseif ($matrial[0]['type'] == "Video") {
    $ext=".mp4";
}
elseif ($matrial[0]['type'] == "IMG") {
    $ext=".jpg";
}

header("Content-Disposition: attachment;filename=".$matrial[0]['name'].$ext);
header('Content-Length: ' . filesize(APPLICATION_PATH . "/../public/matrials/".$matrial[0]['download']));
//header('Content-Disposition: attachment; filename='.basename(APPLICATION_PATH . "/../public/matrials/".$matrial[0]['download']));


while (ob_get_level()) {
                                            ob_end_clean();
                                        }
                readfile(APPLICATION_PATH . "/../public/matrials/".$matrial[0]['download']);

$this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true); 

    }
else
{
    $this->redirect('matrial/index');
}

        

 }


    public function addAction()
    {
        // action body
        $cid = $this->getRequest()->getParam('cid');
        if(!empty($cid)){
        $validFile="false";
        $data = $this->getRequest()->getParams();
        $form = new Application_Form_AddMatrial(-1,$cid);
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($data)) {
                    switch ($data['type']) {
                                case "PDF":
                                            $upload = new Zend_File_Transfer_Adapter_Http();
                                            $upload->addValidator('Extension', false, 'pdf');
                                            //$upload->addValidator('FilesSize',false,array('min' => '10kB', 'max' => '4MB'));
                                            $upload->setDestination(PUBLIC_PATH . '/matrials');
                                            $data['download'] = str_replace(PUBLIC_PATH . '/matrials/',"",$upload->getFileName());
                                            //$upload->getFileName();
                                            $files = $upload->getFileInfo();
                                            str_replace(PUBLIC_PATH . '/matrials/',"",$upload->getFileName());
                                            foreach ($files as $file => $info) {
                                                if ($upload->isValid($file)) {
                                                    
                                                    $upload->receive($file);
                                                    $validFile="true";
                                                }
                                                else{

$form->getElement("download")->setErrors(array("It's Not Valid PDF"));

                                                }
                                            }
                                            $data['link']="";
                                    break;
                                case "Video":
                                            $upload = new Zend_File_Transfer_Adapter_Http();
                                            //$upload->addValidator('Size', false, 52428800, 'avi,mov,mp4,flv');
                                            $upload->addValidator('Extension', false, 'mp4');
                                            $upload->setDestination(PUBLIC_PATH . '/matrials');
                                            $data['download'] = str_replace(PUBLIC_PATH . '/matrials/',"",$upload->getFileName());
                                            $files = $upload->getFileInfo();
                                            foreach ($files as $file => $info) {
                                                if ($upload->isValid($file)) {
                                                    $upload->receive($file);
                                                    $validFile="true";
                                                }
                                            }
                                            $data['link']="";
                                    break;
                                case "URL":
                                            if($data['link'] !="")
                                            $validFile="true";
                                    break;
                                case "TXT":
                                            if($data['link'] !="")
                                            $validFile="true";
                                    break;
                                case "IMG":
                                            $upload = new Zend_File_Transfer_Adapter_Http();
                                            $upload->addValidator('MimeType', false, array('image'));
                                            $upload->addValidator('Extension', false, 'jpg');
                                            $upload->addValidator('FilesSize',false,array('min' => '10kB', 'max' => '4MB'));
                                            $upload->setDestination(PUBLIC_PATH . '/matrials');
                                            $data['download'] = str_replace(PUBLIC_PATH . '/matrials/',"",$upload->getFileName());

                                            $files = $upload->getFileInfo();
                                            foreach ($files as $file => $info) {
                                                if ($upload->isValid($file)) {
                                                    $upload->receive($file);
                                                    $validFile="true";
                                                }
                                            }
                                            $data['link']="";
                                    break;
                                default:
                                    //nothing
                                    
                                         }

                    //exit($validFile);
                    if ($validFile != "false")
                    {if($this->model->addMatrial($data))
                    $this->redirect('matrial/index');
                    }
                
            }
        }

        $this->view->flag = 1;
        $this->view->form = $form;
        $this->render('add');
    }
    else
{
    $this->redirect('matrial/index');
}
    }

    public function listAction()
    {
        // action body

$cid = $this->getRequest()->getParam('cid');
        if ($cid != null) {
$this->view->matrials = $this->model->listMatrial($cid);
}

/*
$this->getResponse()
                ->setHeader('Content-type', '   image/gif')
                ->setHeader('Content-Disposition', 'attachment; filename="2.gif"')
                ->setHeader('Content-length', filesize(APPLICATION_PATH . "/../public/uploads/2.gif"))
                ->setHeader('Cache-control', 'private');
        readfile(APPLICATION_PATH . "/../public/uploads/2.gif");
        $this->getResponse()->sendResponse();


$this->view->layout()->disableLayout();
        $this->_helper->viewRenderer->setNoRender(true); 
*/
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        if ($id) {
            if ($this->model->deleteMatrial($id))
                $this->redirect('matrial/index');

        } else {
            $this->redirect('matrial/index');
        }
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $form = new Application_Form_AddMatrial(-1,-1);
        $matrial = $this->model->getMatrialById($id);
        $form->populate($matrial[0]);
        $form->setAction('../../add');
        $this->view->form = $form;
        $this->render('add');
    }


}









