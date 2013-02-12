<?php
class student{

    public $sID;
    public $sEmail; 
    public $nNumber;
    public $fName;
    public $lName;
    public $created;
    public $totalHours;
    public $password;
    public $admin;


    public function __construct($row){
        $this->sID = $row['sID'];
        $this->sEmail = $row['sEmail'];
        $this->nNumber = $row['nNumber'];
        $this->fName = $row['firstName'];
        $this->lName = $row['lastName'];
        $this->created = $row['created'];
        $this->totalHours = $row['totalHours'];
        $this->password = $row['password'];
        $this->admin = $row['admin'];
    }//end construct


    public function changePassword($ctrl){
        $currentPW = $_POST['curPW'];
        $newPW1 = $_POST['newPW1'];  
        $newPW2 = $_POST['newPW2'];  
    
        if($ctrl->db->hashFunction($currentPW)==$this->password){
            if($newPW1==$newPW2){
                $ctrl->db->updatePassword($ctrl,$newPW1);
                $ctrl->message= 'Password successfully Updated';
            }
            else{
                $ctrl->message = 'Your new passwords did not match';
            }//end else
        }//end if
        else {
            $ctrl->message = 'Your current password did not match';
        }

    }//end changePassword



}//end class
?>
