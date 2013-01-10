<?php
require_once('users/student.php');
require_once('data/studentData.php');

class studentControl {
public $student;
public $sData;

    public function __construct($ctrl){
        $this->sData = new studentData;

            $row=$this->sData->studentSession($ctrl);
            $this->student= new student($row);

        if(isset($_POST['eventID'])){
            $this->sData->eventAction($ctrl);
        }
        if(isset($_POST['changePassword'])){
            $this->sData->changePassword($ctrl);
        }//end else if

    }//end construct



}//end studentControl

?>
