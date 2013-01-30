<?php
require_once('database.php');
require_once('controls/loginGate.php');

class control{

public $db;
public $calendar;
public $eventData;
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

    public function buildTime($cTime) {
        $curTime=time();$timeSince=round($curTime-$cTime);$now;
        if(!($timeSince>60)){ $now=$timeSince; $now.=($now==1)?' second ago':' seconds ago'; return $now; }//endif
        elseif(!($timeSince>3600)){ $now=round(($timeSince/60)); $now.=($now==1)?' minute ago':' minutes ago'; return $now; }//end elseif
        elseif(!($timeSince>86400)){ $now=round((($timeSince/60)/60)); $now.=($now==1)?' hour ago':' hours ago'; return $now; }//end elseif
        elseif(!($timeSince>2592000)){ $now=round((($timeSince/60)/60)/24); $now.=($now==1)?' day ago':' days ago'; return $now; }//end elseif
        elseif(!($timeSince>31104000)){ $now=round(((($timeSince/60)/60)/24)/30); $now.=($now==1)?' month ago':' months ago'; return $now; }//end elseif
        else{ $now=round((((($timeSince/60)/60)/24)/30)/12); $now.=($now==1)?' year ago':'years ago'; return $now; }//end
    }//end buildTime()



}//end class


?>
