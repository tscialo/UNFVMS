<? 
require_once('comment.php');
require_once('commentController.php');

class eventView {

    public function __construct($ctrl){
        if($ctrl->eventData){

        }//end if
        else{
            $ctrl->eventData = $this->getPublicEventData($ctrl);
        }
        $this->eventAllCanSee($ctrl);

    }//end constructor

    public function getPublicEventData($ctrl){
        $eID = $ctrl->clean($_GET['sEventID']);
        if(!$result = $ctrl->db->mysqli->query("SELECT e.eID,e.eName,e.oID,e.o_cID,
            DATE_FORMAT(eDate,' %W %d %D %M %Y') as eDate,
            DATE_FORMAT(eDate,' %W ') AS weekDay,
            DATE_FORMAT(eDate,'%e') AS dayDate,
            DATE_FORMAT(eDate,'%b') AS month
            ,DATE_FORMAT(eDate,'%Y') as year,
            eLocation,
            DATE_FORMAT(eStartTime, '%h %i %p') AS eStartTime,
            DATE_FORMAT(eEndTime,'%h %i %p') AS eEndTime,
            eDescription,volNeeded,ePhoto,e.created,o.oName AS oName, oc.o_cEmail as cEmail,o.photo AS oPhoto,e.totalVol
            FROM Event as e 
            INNER JOIN organization AS o ON e.oID=o.oID 
            INNER JOIN o_contact AS oc ON e.o_cID=oc.o_cID
            WHERE e.eID=$eID"))
        {
            echo $ctrl->db->mysqli->error;
            return null;
        }//end if
        else {
            return $result;
        }//end else

    }//end getPublicEventData

    public function eventAllCanSee($ctrl){
        $result = $ctrl->eventData;
        if($result->num_rows==0){
            echo '<p>This is not the event you were looking for...</p>';
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
            $ePhoto = $row['ePhoto'];
            $oPhoto = $row['oPhoto'];
            $cEmail = $row['cEmail'];

            $weekDay = $row['weekDay'];
            $dayDate = $row['dayDate'];
            $month = $row['month'];
            $year = $row['year'];

            $totalVol = $row['totalVol'];

            if($ePhoto==1){
                $ephotoLoc = '<img id="sEventImg" src="photos/events/'.$eID.'.jpeg"/>';
            }//end if
            else{
                $ephotoLoc ='';
            }//end else

            if($oPhoto==1){
                $photoLoc = '<p id="sOrgImg"><img src="photos/logos/'.$oID.'.jpeg"/></p>';
            }//end if
            else{
                $photoLoc = '';
            }//end else
             

            echo '
                <div class="container">
                    <div id="sEventVol">'.$totalVol.' Volunteers currently signed up.</div>
                    <div class="row">
                        <div class="threecol">
                            '.$ephotoLoc.'
                            <div class="dateIcon">
                                <p class="dDay">'.$dayDate.'</p>
                                <p class="dTime">'.$sTime.'</p>
                                <p class="dBreak">-</p>
                                <p class="dTime">'.$eTime.'</p>
                                <p class="dMonth">'.$month.'</span>
                            </div>
                            <div id="sEventOrgInfo">
                            <p class="heading bB">Hosted By: '.$oName.'</p>
                            '.$photoLoc.'
                            <p class="heading bB">Posted By: '.$cEmail.'</p>

                            </div>

                        </div>
                        <div class="sevencol eventMid">
                            <p class="heading bB">'.$eName.'</p>
                            <span class="eLocation">'.$location.'</span>
                            <p class="oName">'.$oName.'</p>
                            <p class="eDesc">'.$desc.'</p>
                        </div>
                        <div class="twocol eventRight last">
                       </div>
                    </div>
                </div>';


        }//end while

        $result = $this->comments($ctrl,$eID);
        echo '<div id=commentsContainer>';
        $cC = new commentController($ctrl,$result,$eID);


    }//end eventAllCanSee

    private function comments($ctrl,$eID){
        if(!$result = $ctrl->db->mysqli->query("SELECT eID,userID,recipID,commentID,parentID,comment,uVotes,dVotes,c.created,deleted,s.firstName AS firstName FROM comments AS c INNER JOIN student AS s ON c.userID=s.sID WHERE eID=$eID"))
        {
            echo $ctrl->db->mysqli->error;
            return null;
        }//end if
        else {
            return $result;
        }//end else
    }//end comments

}//end class eventView
?>
