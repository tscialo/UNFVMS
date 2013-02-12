<?php
class adminPage {

    public function unApprovedEvents($ctrl,$result) {

        if($result->num_rows==0){
            echo 'There are no events awaiting approval';
            return;
        }//end if
        echo '<form action="admin.php" method="post">';	
        while($row = $result->fetch_assoc()){
            $eID = $row['eID'];
            $oID = $row['oID'];
            $ocID = $row['o_cID'];
            $location = $row['eLocation'];
            $sTime = $row['eStartTime'];
            $eTime = $row['eEndTime'];
            $desc = $row['eDescription'];
            $volNeeded = $row['volNeeded'];
            $created = $row['created'];
            $approved = $row['approved'];
            $eName = $row['eName'];
            $oName = $row['oName'];
            $cEmail = $row['cEmail'];

            $weekDay = $row['weekDay'];
            $dayDate = $row['dayDate'];
            $month = $row['month'];

            $left = '<p>Approve</p>
                    <input type="checkbox" name="app[]" value="'.$eID.'">
                    <p>Deny</p>
                    <input type="checkbox" name="deny[]" value="'.$eID.'">';


            $middle = '<p class="eName">'.$eName.'</p>
                    <p class="oName">'.$oName.'</p>
                    <p class="eDesc">'.$desc.'</p>';

            $right ='<div class="dateIcon">
                        <p class="dDay">'.$dayDate.'</p>
                        <p class="dTime">'.$sTime.'</p>
                        <p class="dBreak">-</p>
                        <p class="dTime">'.$eTime.'</p>
                        <p class="dMonth">'.$month.'</span>
                    </div>';

            $ctrl->calendar->calendarMarkup($left,$middle,$right);


        }//end while
        
        echo '<button class="button" name="eApproval" type="submit">Approve/Deny</button>';
        echo '</form>';

    }//end unApprovedEvents

    public function allEvents($ctrl,$result){
        if($result->num_rows==0){
            echo 'There hasn\'t been any events added to the VMS yet';
            return;
        }//end if
        else {
            echo '<div class="statusCon">
                <span>Approved</span><div class="status appColor"></div>
                <span>Waiting Approval</span><div class="status wAppColor"></div>
                <span>Unapproved</span><div class="status unAppColor"></div>
                </div>';
        }//end else

        while($row = $result->fetch_assoc()){
            $eID = $row['eID'];
            $oID = $row['oID'];
            $ocID = $row['o_cID'];
            $location = $row['eLocation'];
            $sTime = $row['eStartTime'];
            $eTime = $row['eEndTime'];
            $desc = $row['eDescription'];
            $volNeeded = $row['volNeeded'];
            $totalVol = $row['totalVol'];
            $created = $row['created'];
            $approved = $row['approved'];
            $eName = $row['eName'];
            $oName = $row['oName'];
            $cEmail = $row['cEmail'];

            $weekDay = $row['weekDay'];
            $dayDate = $row['dayDate'];
            $month = $row['month'];

            $class="";
            if($approved==1){ 
                $class="appColor";
            }//end if
            else if($approved==2) { 
                $class="unAppColor";
            }//end elseif
            else {
                $class="wAppColor";
            }//end else


            $left ='<p class="eStatus">Status</p>
                    <div class="status '.$class.'"></div>
                    <p class="totalVol">'.$totalVol.'</p>
                    <p>Volunteers Currently signed up</p> ';

            $middle ='<p class="eName">'.$eName.'</p>
                    <p class="oName">'.$oName.'</p>
                    <p class="eDesc">'.$desc.'</p>';

            $right ='<div class="dateIcon">
                        <p class="dDay">'.$dayDate.'</p>
                        <p class="dTime">'.$sTime.'</p>
                        <p class="dBreak">-</p>
                        <p class="dTime">'.$eTime.'</p>
                        <p class="dMonth">'.$month.'</span>
                    </div>';


            $ctrl->calendar->calendarMarkup($left,$middle,$right);


        }//end while

    }//end allEvents
}//end adminPage
?>
