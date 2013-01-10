<?php

class organization {
    public $userID;
    public $email;
    public $oID;
    public $fName;
    public $lName;
    public $photo;
    public $created;
    private $password;


    public $mainEmail;
    public $orgName;
    public $orgCreated;
    public $orgPhoto;
    public $desc;
    public $mainCID;

    public function __construct($row){
        $this->userID=$row['o_cID'];
        $this->email=$row['o_cEmail'];
        $this->oID=$row['oID'];
        $this->fName=$row['o_cFirstName'];
        $this->lName=$row['o_cLastName'];
        $this->photo=$row['ocPhoto'];
        $this->created=$row['ocCreated'];
        $this->password=$row['password'];

        $this->orgName=$row['oName'];
        $this->orgCreated=$row['oCreated'];
        $this->orgPhoto = $row['oPhoto'];
        $this->desc=$row['oDescription'];

    }//end construct

}//end organization

?>
