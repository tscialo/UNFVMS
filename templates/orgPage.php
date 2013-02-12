<?php
class orgPage {

public function addEvent(){
    echo '<div id="oAddEvent">
        <div id="addEventTitle" class="heading bB">Add an Event<span><img src="photos/icons/plus.png"/></span></div>
<form id="addEvent" action="organization.php" method="post">	
            <fieldset>
                    <p>
            		<label for="Title">Event Title</label>
            		<input type="text" name="eName" id="eName" size="60" />
            	</p>
                     <p>
            		<label for="location">Street Address</label>
            		<input type="text" name="streetAddr" id="location" size="30" />
            	</p>
                <p>
            		<label for="location">City</label>
            		<input type="text" name="cityAddr" id="location" size="30" value="Jacksonville" />
            	</p>
                <p>
            		<label for="location">State</label>
            		<input type="text" name="stateAddr" id="location" size="30" value="Florida" />
            	</p>

                    <p>
            		<label for="date">Date</label>
            		<input type="text" name="date" id="datepicker" size="5" />
            	</p>

                    <p>
            		<label for="time">Start Time</label>
            		<input type="time" name="sTime" id="sTime" size="5" />
            	</p>
                    <p>
            		<label for="time">End Time</label>
            		<input type="time" name="eTime" id="eTime" size="5" />
            	</p>
                    <p>
            		<label for="vol"># of Volunteers needed</label>
            		<input type="number" name="vol" id="vol" size="5" />
            	</p>
                    <p>
            		<label for="desc">Description</label>
            		<textarea type="text" name="desc" id="desc" size="600"></textarea>
            	</p>


      
            	<p class="submit"><button class="button" id="subOEvent" name="oAddEvent">Submit</button></p>		
            				
            </fieldset>					
            			
		</form>
                </div>
                ';
}//end addEvent

public function orgEvents($ctrl,$result){
        $org = $ctrl->oCtrl->org->orgName;
        echo '<p class="heading bB">'.$org .' all events</p>';
        if($result->num_rows==0){
            echo '<p class="message">Your organization hasn\'t posted any events yet.</p>';
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
            $created = $row['created'];
            $eName = $row['eName'];
            $oName = $row['oName'];
            $cEmail = $row['cEmail'];
            $approved = $row['approved'];
            $totalVol = $row['totalVol'];

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
            <p>Volunteers Currently signed up</p>';

            $middle='<p class="eName">'.$eName.'</p>
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

}//end orgEvents

}//end orgPage
?>
