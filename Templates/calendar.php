<?php
class calendar {
    private $calData;

    public function __construct($ctrl){


    }//end constructor

    public function publicCalendarData($ctrl){
        $result;
        if(!$result = $ctrl->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,
            DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,
            DATE_FORMAT(eDate,' %W ') AS weekDay,
            DATE_FORMAT(eDate,'%e') AS dayDate,
            DATE_FORMAT(eDate,'%b') AS month
            ,DATE_FORMAT(eDate,'%Y') as year,
            eLocation,
            DATE_FORMAT(eStartTime, '%h %i %p') AS eStartTime,
            DATE_FORMAT(eEndTime,'%h %i %p') AS eEndTime,
            eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,e.totalVol
            FROM Event as e 
            INNER JOIN organization AS o ON e.oID=o.oID 
            INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
            WHERE e.approved=1 "))
        {
            echo $ctrl->db->mysqli->error;
        }//end if
        return $result;
    }//end calendarData

    public function printCalendar($data){
        $result = $data;
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
                <div class="container cB rB calEvent">
                    <div class="row">
                        <div class="twocol eventLeft">
                           <p class="totalVol">'.$totalVol.'</p>
                            <p class="volInfo">Volunteers Currently signed up</p>
                            '.$this->studentSessionCalendar($row).'
                        </div>
                        <div class="sevencol eventMid">
                            <p class="eName"><a href="event.php?sEventID='.$eID.'">'.$eName.'</a></p>
                            <span class="eLocation">'.$location.'</span>
                            <p class="oName">'.$oName.'</p>
                            <p class="eDesc">'.$desc.'</p>
                        </div>
                        <div class="twocol eventRight last">
                            <div class="dateIcon">
                                <p class="dDay">'.$dayDate.'</p>
                                <p class="dTime">'.$sTime.'</p>
                                <p class="dBreak">-</p>
                                <p class="dTime">'.$eTime.'</p>
                                <p class="dMonth">'.$month.'</span>
                            </div>
                       </div>
                    </div>
                </div>';
//                             <p class="weekDay">'.$weekDay.'</p>
//                             <p class="dayDate">'.$dayDate.'</p>
//                             <p class="month">'.$month.'</p>
//                             <p class="year">'.$year.'</p>
//                             <p>'.$sTime.'</p><p> - </p><p> '.$eTime.'</p>
//  

        }//end while

    }//end publicEvents

    public function calendarMarkup($left,$middle,$right){
            echo '
                <div class="container cB rB calEvent">
                    <div class="row">
                        <div class="twocol eventLeft">
                            '.$left.'
                       </div>
                        <div class="sevencol eventMid">
                            '.$middle.'
                        </div>
                        <div class="twocol eventRight last">
                            '.$right.'
                        </div>
                    </div>
                </div>';

    }//end calendarMarkup


    private function studentSessionCalendar($row){
        if(isset($_SESSION['studentUser'])){
            $signedUp = $row['seID'];

            if(!$signedUp){
                $signedUp='<div class="button seSignUp" eID="'.$row['eID'].'" s=0><span>Sign up</span></div>';
            }//end if
            else{
                $signedUp='<div class="button seSignUp" eID="'.$row['eID'].'" s=1><span>Revoke</span></div>';
            }//end else
            return $signedUp;
        }//end if
        else{
            return null;
        }//end else
    }//end studentSessionCalendar

    public function spotlightEvent($ctrl){
    $result;
    if(!$result = $ctrl->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,DATE_FORMAT(eDate,' %W ') AS weekDay,DATE_FORMAT(eDate,'%D') AS dayDate, DATE_FORMAT(eDate,'%M') AS month
        ,DATE_FORMAT(eDate,'%Y') as year,
        eLocation,DATE_FORMAT(eStartTime, '%r') AS eStartTime,DATE_FORMAT(eEndTime,'%r') AS eEndTime,eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,e.totalVol
                                FROM Event as e 
                                INNER JOIN organization AS o ON e.oID=o.oID 
                                INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
                                WHERE e.approved=1 
                                ORDER BY totalVol DESC LIMIT 1"))
    {
        echo $ctrl->db->mysqli->error;
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



}//end class calendar

?>
