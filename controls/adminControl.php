<?php
require_once("data/adminData.php");
require_once("users/student.php");
class adminControl {
public $adminData;
public $admin;

    public function __construct($ctrl){
        $this->adminData = new adminData();

            $row = $this->adminData->adminSession($ctrl);
            $this->admin = new student($row);

            if(isset($_POST)){
                if(isset($_POST['eApproval'])){
                    $this->adminData->eventApproval($ctrl);
                }//end if
            }//end if
    }//end construct



}//end class


?>
