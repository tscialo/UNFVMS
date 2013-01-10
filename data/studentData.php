<?php

class studentData {


    public function studentSession($ctrl){
        $sID = $_SESSION['studentUser'];
        $result = $ctrl->db->mysqli->query("SELECT sID,sEmail,nNumber,firstName,lastName,created,totalHours,password,admin FROM student WHERE sID='$sID'");
        if($result){
            $row=$result->fetch_assoc();
            return $row;
        }//end if
        else{

        }
    }//end studentSession

    public function getEvents($ctrl){
    $result;
    $sID = $_SESSION['studentUser'];
    if(!$result = $ctrl->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
        ,DATE_FORMAT(eDate,'%Y') as year,
        eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,se.seID,e.totalVol
                                FROM Event as e 
                                INNER JOIN organization AS o ON e.oID=o.oID 
                                INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                LEFT JOIN s_Events AS se ON se.sID='$sID' AND e.eID=se.eID 
                                WHERE e.approved=1 ORDER BY e.eDate"))
    {
        echo $ctrl->db->mysqli->error;
        return null;
    }//end if
    else {
        return $result;
    }//end else
    }//end getUnapprovedEvents

    public function getSignedUpEvents($ctrl){
        $sID= $_SESSION['studentUser'];
        $result;
        if(!$result=$ctrl->db->mysqli->query("SELECT se.eID,se.sID,e.eName,DATE_FORMAT(e.eDate,' %W ') AS weekDay,DATE_FORMAT(e.eDate,'%D') AS dayDate, DATE_FORMAT(e.eDate,'%M') AS month
        ,DATE_FORMAT(e.eDate,'%Y') as year,DATE_FORMAT(e.eStartTime, '%r') AS eStartTime,DATE_FORMAT(e.eEndTime,'%r') AS eEndTime
                                    FROM s_Events AS se
                                    INNER JOIN Event As e ON e.eID=se.eID
                                    INNER JOIN organization AS o ON o.oID=e.oID
                                    WHERE se.sID='$sID'
                                    ORDER BY e.eDate"))
        {
            echo $ctrl->db->mysqli->error;
            return null;
        }//end if 
        else {
            return $result;
        }//end else

    }//end getSignedUpEvents

    public function eventAction($ctrl){
        $eID = $_POST['eventID'];
        $s = $_POST['signedUp'];
        $sID = $_SESSION['studentUser'];
        $query="";
        if($s==0){
            $query .= "INSERT INTO s_Events VALUES('null','$sID','$eID'); ";
            $query .= "UPDATE Event SET totalVol=totalVol+1 WHERE eID='$eID';";
            if(!$ctrl->db->mysqli->multi_query($query)){
                echo $ctrl->db->mysqli->error;
            }//end if
        }//end if
        else{
            $query .= "DELETE FROM s_Events WHERE sID='$sID' AND eID='$eID'; ";
            $query .= "UPDATE Event SET totalVol=totalVol-1 WHERE eID='$eID';"; 
            if(!$ctrl->db->mysqli->multi_query($query)){
                echo $ctrl->db->mysqli->error;
            }//end if
        }//end else

    }//end eventAction


    public function updatePassword($ctrl,$newPassword){
        $sID = $ctrl->sCtrl->student->sID;
        $newPassword = $ctrl->db->hashFunction($newPassword);
       $ctrl->db->mysqli->query("UPDATE student SET password='$newPassword' WHERE sID='$sID'"); 
    }//end updatePassword




}//end studentData


?>
