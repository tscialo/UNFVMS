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

    private function parseTime($time){
        $hr = explode(':',$time);
        $min = explode(' ',$hr[1]);
        $hr = $hr[0];
        $ampm = strtolower($min[1]);
        $min = $min[0];
        $timeSuccess = false;
        $fullTime;

        if($hr <13 && $hr >-1){
            if($ampm=='pm'){
                $hr = $hr + 12;
            }//end if
            if($min <60 && $min >-1){
                $timeSuccess = true;
                $fullTime = $hr.':'.$min.':00';
                return $fullTime;
            }//end if
            else{
                return false;
            }//end else
        }//end if
        else{
            return false;
        }//end else

    }//end parseTime

    private function parseDate($date){
        $curYear = date('Y');$curMon=date('n');
        $date = explode('-',$date);
        $fullDate = false;

        if(strlen($date[0])==4 && $date[0]>=$curYear){
            if(strlen($date[1])==2 && $date[1]>=$curMon){
                if(strlen($date[2])==2){
                    $fullDate = $date[0].$date[1].$date[2];
                    return $fullDate;
                }//end if
            }///end if
        }//end if 
        return $fullDate;
    }//end parseDate

    public function addEvent($ctrl,$oID){
        $eName = $ctrl->clean($_POST['eName']);
        $eLocation = $ctrl->clean($_POST['location']);
        $date = $ctrl->clean($_POST['date']);
        $sTime = $ctrl->clean(trim($_POST['sTime']));
        $eTime = $ctrl->clean(trim($_POST['eTime']));
        $volNeeded = $ctrl->clean($_POST['vol']);
        $desc = $ctrl->clean($_POST['desc']);

        $oCID = $_SESSION['orgUser'];

        $date = $this->parseDate($date);

        $sTime = $this->parseTime($sTime);
        $eTime = $this->parseTime($eTime);
        if($sTime && $eTime){
            if($date){
                if(!$ctrl->db->mysqli->query("INSERT INTO Event VALUES('null','$oID','$oCID','$eName','$date','$eLocation','$sTime','$eTime','$desc','$volNeeded',0,NOW(),0,0)")){
                    echo $ctrl->db->mysqli->error;
                }//end if
                else{
                    //do a header push for now until form is ajaxed
                    //done to prevent multiple submissions
                    header("Location: organization.php");

                }
            }//end if
            else {
                echo 'The date you entered is not valid';
            }//end else
        }//end if
        else {
            echo 'The time you entered is not valid';
        }


    }//end addEvent

    public function getOrgEvents($ctrl){
    $result;
    $oID = $ctrl->oCtrl->org->oID;
    if(!$result = $ctrl->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,
        DATE_FORMAT(eDate,' %W ') AS weekDay,
        DATE_FORMAT(eDate,'%e') AS dayDate,
        DATE_FORMAT(eDate,'%b') AS month,
        eLocation,
        DATE_FORMAT(eStartTime, '%h %i %p') AS eStartTime,
        DATE_FORMAT(eEndTime,'%h %i %p') AS eEndTime,
        eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,e.approved,e.totalVol 
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
