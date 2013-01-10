<?php

class adminData {


    public function adminSession($ctrl){
        $sID = $_SESSION['admin'];
        $result = $ctrl->db->mysqli->query("SELECT sID,sEmail,nNumber,firstName,lastName,created,totalHours,password,admin FROM student WHERE sID='$sID'");
        if($result){
            $row=$result->fetch_assoc();
            return $row;
        }//end if
        else{

        }
    }//end studentSession

    public function getUnapprovedEvents($ctrl){
        $result;
        if(!$result = $ctrl->db->mysqli->query("SELECT eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
            ,DATE_FORMAT(eDate,'%Y') as year,
            eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,approved,o.oName AS oName, oc.o_cEmail as cEmail
                                    FROM Event as e 
                                    INNER JOIN organization AS o ON e.oID=o.oID 
                                    INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                    WHERE approved=0"))
        {
            echo $ctrl->db->mysqli->error;
            return null;
        }//end if
        else {
            return $result;
        }//end else
    }//end getUnapprovedEvents

    public function getAllEvents($ctrl){
        $result;
        if(!$result = $ctrl->db->mysqli->query("SELECT eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
            ,DATE_FORMAT(eDate,'%Y') as year,
            eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,approved,o.oName AS oName, oc.o_cEmail as cEmail,e.totalVol
                                    FROM Event as e 
                                    INNER JOIN organization AS o ON e.oID=o.oID 
                                    INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                    ORDER BY e.eDate  
                                    "))
        {
            echo $ctrl->db->mysqli->error;
            return null;
        }//end if
        else {
            return $result;
        }//end else


    }//end getAllEvents

    public function eventApproval($ctrl){
        $query="";
        if(isset($_POST['app'])){
            $appArr = $_POST['app'];
            foreach($appArr as $app){
                $query .= "UPDATE Event SET approved=1 WHERE eID='$app';";
            }//end foreach
        }//end if
        if(isset($_POST['deny'])){
            $denyArr = $_POST['deny'];
            foreach($denyArr as $deny){
                $query .= "UPDATE Event SET approved=2 WHERE eID='$deny';";
            }//end foreach
        }//end if
            if(!$ctrl->db->mysqli->multi_query($query)){
                echo $ctrl->db->mysqli->error;
            }//end if


    }//end eventApproval

    public function updatePassword($ctrl,$newPassword){
        $sID = $ctrl->sCtrl->student->sID;
        $newPassword = $ctrl->db->hashFunction($newPassword);
       $ctrl->db->mysqli->query("UPDATE student SET password='$newPassword' WHERE sID='$sID'"); 
    }//end updatePassword




}//end studentData


?>
