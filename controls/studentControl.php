<?php
require_once('users/student.php');
require_once('data/studentData.php');

class studentControl {
public $student;
public $sData;

    public function __construct($ctrl){
        //student CRUD operations through studentData
        $this->sData = new studentData;
        $row=$this->sData->studentSession($ctrl);
        $this->student= new student($row);

        if(isset($_POST)){
            $this->processPostData($ctrl);
        }//end if
        if(isset($_GET)){
            $this->processGetData($ctrl);
        }//end if

    }//end construct

    private function processPostData($ctrl){

        if(isset($_POST['eventID'])){
            $this->sData->eventAction($ctrl);
        }
        if(isset($_POST['changePassword'])){
            $this->sData->changePassword($ctrl);
        }//end else if

    }//end processPostData

    private function processGetData($ctrl){
        if(isset($_GET['sEventID'])){

        }//end if

    }//end processGetData



}//end studentControl

?>
