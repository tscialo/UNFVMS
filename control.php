<?php
require_once('database.php');
require_once('controls/loginGate.php');

class control{

public $db;
public $calendar;
public $sCtrl;
public $oCtrl;
public $adminCtrl;
public $error;
public $message;

    public function __construct(){
       $this->db = new database; 
    }//end construct    

    public function process(){

        if(isset($_GET['logout'])){
            session_destroy();
            header('Location: index.php');
        }//end if

        if(isset($_SESSION['studentUser'])){
            require_once('controls/studentControl.php');
            $this->sCtrl= new studentControl($this);
        }//end else
        else if(isset($_SESSION['orgUser'])){
            require_once('controls/organizationControl.php');
            $this->oCtrl = new organizationControl($this);
        }//end else
        else if(isset($_SESSION['admin'])){
            require_once('controls/adminControl.php');
            $this->adminCtrl = new adminControl($this);
        }//end else
        else if(isset($_POST['loginEmail']) || isset($_POST['signup']) || isset($_POST['oSignup'])){
            $loginGate = new loginGate($this);
        }//end else
        else {
        }//end else

        require_once('Templates/calendar.php');
        $this->calendar = new calendar($this);
        
    }//end process

    public function clean($inc){
        return $this->db->mysqli->real_escape_string(stripslashes($inc));
    }

}//end class


?>
