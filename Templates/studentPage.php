<?php
class studentPage {

    public function printEvents($result) {

        if($result->num_rows==0){
            echo 'There are no upcoming events';
            return;
        }//end if
        echo '<form action="admin.php" method="post">';	
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
            $totalVol = $row['totalVol'];
            $created = $row['created'];
            $eName = $row['eName'];
            $oName = $row['oName'];
            $cEmail = $row['cEmail'];

            $weekDay = $row['weekDay'];
            $dayDate = $row['dayDate'];
            $month = $row['month'];
            $year = $row['year'];

            $signedUp = $row['seID'];

            if(!$signedUp){
                $signedUp='<div class="button seSignUp" eID="'.$eID.'" s=0><span>Sign up</span></div>';
            }
            else{
                $signedUp='<div class="button seSignUp" eID="'.$eID.'" s=1><span>Revoke</span></div>';
            }

            echo '
                <div class="event cB">
                <div class="eApp">
                <p class="totalVol">'.$totalVol.'</p>
                <p class="volInfo">Volunteers Currently signed up</p>

                '.$signedUp.'
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

    }//end printEvents

    public function signedUpEvents($result){
         if($result->num_rows==0){
            echo 'You haven\'t signed up for any events yet';
            return;
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

    }//end signedUpEvents
}//end studentPage

?>
