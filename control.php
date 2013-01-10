<?php
require_once('database.php');
require_once('controls/loginGate.php');

class control{

public $db;
public $post;
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


    }//end process

    public function clean($inc){
        return $this->db->mysqli->real_escape_string(stripslashes($inc));
    }

    public function metaHeader($title){
echo '<!doctype html>
<head>
<meta content="text/html;charset=UTF-8" http-equiv="content-type">
<title>'.$title.'</title>
<script src="http://code.jquery.com/jquery-latest.min.js"
        type="text/javascript"></script>
 <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>

<!-- 1140px Grid styles for IE -->                                                                              
<!--[if lte IE 9]><link rel="stylesheet" href="/css/ie.css" type="text/css" media="screen" /><![endif]-->       

<!-- The 1140px Grid - http://cssgrid.net/ -->                                                                  
<link rel="stylesheet" href="/css/1140.css" type="text/css" media="screen" />                                   

<link rel="stylesheet" href="/css/styles.css" type="text/css" media="screen" />                                                                                                                                                  
                                                                                                                       
 <!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
<script type="text/javascript" src="/js/css3-mediaqueries.js"></script>

<link rel="stylesheet" href="css/css.css">
<script type="text/javascript" src="js/jsFunctions.js"></script>
<script type="text/javascript" src="js/accordion.js"></script>
<link rel="stylesheet" href="accordion.css">
<script type="text/javascript" src="js/utility.js"></script>
</head>
<body>';


    }//end metaHeader

    public function publicEvents(){
    $result;
    if(!$result = $this->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
        ,DATE_FORMAT(eDate,'%Y') as year,
        eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,e.totalVol
                                FROM Event as e 
                                INNER JOIN organization AS o ON e.oID=o.oID 
                                INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                WHERE e.approved=1 "))
    {
        echo $this->db->mysqli->error;
    }//end if


        if($result->num_rows==0){
            echo '<p>There are no upcoming events</p>';
            return;
        }//end if
        while($row = $result->fetch_assoc()){
            $eID = $row['eID'];
            $oID = $row['oID'];
            $ocID = $row['o_cID'];
            $date = $row['eDate'];
            $location = $row['eLocation'];
            $sTime = $row['eStartTime'];
            $eTime = $row['eEndTime'];
            $desc = $row['eDescription'];
            $volNeeded = $row['volNeeded'];
            $created = $row['created'];
            $eName = $row['eName'];
            $oName = $row['oName'];
            $cEmail = $row['cEmail'];

            $weekDay = $row['weekDay'];
            $dayDate = $row['dayDate'];
            $month = $row['month'];
            $year = $row['year'];

            $totalVol = $row['totalVol'];



            echo '
                <div class="event cB">
                <div class="eApp">
                    <p class="totalVol">'.$totalVol.'</p>
                    <p class="volInfo">Volunteers Currently signed up</p>
               </div> 

                    <div class="eLeft">
                    <p class="eName">'.$eName.'</p>
                    <span class="eLocation">'.$location.'</span>
                    <p class="oName">'.$oName.'</p>
                    <p class="eDesc">'.$desc.'</p>
                    </div>

                    <div class="eRight">
                    <p class="weekDay">'.$weekDay.'</p>
                    <p class="dayDate">'.$dayDate.'</p>
                    <p class="month">'.$month.'</p>
                    <p class="year">'.$year.'</p>
                    <p>'.$sTime.' - '.$eTime.'</p>

                    </div>
                   </div>';

        }//end while
    }//end publicEvents

    public function spotlightEvent(){
    $result;
    if(!$result = $this->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
        ,DATE_FORMAT(eDate,'%Y') as year,
        eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,e.totalVol
                                FROM Event as e 
                                INNER JOIN organization AS o ON e.oID=o.oID 
                                INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                WHERE e.approved=1 
                                ORDER BY totalVol DESC LIMIT 1"))
    {
        echo $this->db->mysqli->error;
    }//end if


    echo '<div class="seCon cB rB">'; 
        while($row = $result->fetch_assoc()){
            $eName = $row['eName'];
            $weekDay = $row['weekDay'];
            $dayDate = $row['dayDate'];
            $month = $row['month'];
            $year = $row['year'];
            $sTime = $row['eStartTime'];
            $eTime = $row['eEndTime'];


            echo '<div class="suEvent">';
            echo '<p class="eName">'.$eName.'</p>'; 
            echo '<p>'.$weekDay.' '.$month.' '.$dayDate.', '.$year.'</p>';
            echo '<p>'.$sTime.' - '.$eTime.'</p>';

            echo '</div>';
        }//end while
        echo '</div>';



    }//end spotlightEvent

}//end class


?>
