<?php

class organizationData {


    public function orgSession($ctrl){
        $cID = $_SESSION['orgUser'];
        $result = $ctrl->db->mysqli->query("SELECT oc.o_cID,oc.oID,oc.o_cEmail,oc.o_cFirstName,oc.o_cLastName,oc.photo AS ocPhoto,oc.created AS ocCreated,oc.password,o.oName,o.created AS oCreated, o.photo AS oPhoto, o.oDescription, o.mainContactID 
                                            FROM o_contact AS oc 
                                            INNER JOIN organization AS o ON oc.oID=o.oID 
                                            WHERE oc.o_cID='$cID'");
        if($result){
            $row=$result->fetch_assoc();
            return $row;
        }//end if
        else{
            echo $ctrl->db->mysqli->error;
        }
    }//end studentSession

    public function addEvent($ctrl,$oID){
        $eName = $ctrl->clean($_POST['eName']);
        $eLocation = $ctrl->clean($_POST['location']);
        $date = $ctrl->clean($_POST['date']);
        $sTime = $ctrl->clean($_POST['sTime']);
        $eTime = $ctrl->clean($_POST['eTime']);
        $volNeeded = $ctrl->clean($_POST['vol']);
        $desc = $ctrl->clean($_POST['desc']);

        $oCID = $_SESSION['orgUser'];

        if(!$ctrl->db->mysqli->query("INSERT INTO Event VALUES('null','$oID','$oCID','$eName','$date','$eLocation','$sTime','$eTime','$desc','$volNeeded',0,NOW(),0,0)")){
            echo $ctrl->db->mysqli->error;
        }//end if

    }//end addEvent

    public function getOrgEvents($ctrl){
    $result;
    $oID = $ctrl->oCtrl->org->oID;
    if(!$result = $ctrl->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
        ,DATE_FORMAT(eDate,'%Y') as year,
        eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,e.approved,e.totalVol 
                                FROM Event as e 
                                INNER JOIN organization AS o ON e.oID=o.oID 
                                INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                WHERE e.oID='$oID'
                                ORDER BY e.eDate DESC"))
    {
        echo $ctrl->db->mysqli->error;
        return null;
    }//end if
    else {
        return $result;
    }//end else
    }//end getUnapprovedEvents




}//end class


?>
