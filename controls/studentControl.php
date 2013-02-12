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
            $this->sData->eventSignUpAction($ctrl);
        }
        elseif(isset($_POST['changePassword'])){
            $this->sData->changePassword($ctrl);
        }//end else if
        elseif(isset($_POST['submitComment'])){
            //check to see if there is a comment trying to be left
            if($_POST['submitComment']!=null){
                $comment = $ctrl->clean($_POST['submitComment']);
            }
            else{ return;}

            $eID = $ctrl->clean($_GET['sEventID']);
            $sID = $this->student->sID;

            if(isset($_POST['recipID'])){
                $recipID = $ctrl->clean($_POST['recipID']);
            }//end if
            else{
                $recipID = 0;
            }//end else

            $parentID = isset($_POST['parentID']) ? $ctrl->clean($_POST['parentID']) : 0;

            //insert the comment into the DB
            $this->sData->submitComment($ctrl,$eID,$sID,$recipID,$parentID,$comment,$this->student->fName);

        }//end if

    }//end processPostData

    private function processGetData($ctrl){

    }//end processGetData



}//end studentControl

?>
