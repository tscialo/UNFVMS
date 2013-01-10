<?php
require_once("data/organizationData.php");
require_once("users/organization.php");
class organizationControl {
public $orgData;
public $org;

    public function __construct($ctrl){
        $this->orgData = new organizationData();

            $row = $this->orgData->orgSession($ctrl);
            $this->org = new organization($row);

        if(isset($_POST)){
            if(isset($_POST['oAddEvent'])){
                $oID = $this->org->oID;
                $this->orgData->addEvent($ctrl,$oID);
            }//end if

        }//end if

    }//end construct


}//end class


?>
