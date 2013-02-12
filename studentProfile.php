<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['studentUser'])){
header('Location: index.php');
}


require_once('control.php');
require_once('Templates/header.php');
require_once('Templates/studentPage.php');

    $ctrl = new control;
    $header = new pageHeader;
    $page = new studentPage;

    $ctrl->metaHeader('UNF Volunteer');

    $ctrl->process();

    $header->pageHead($ctrl);

    echo '<div id="studentProfile">';

    if(!empty($ctrl->message)){
        echo '<h1 class="message">'.$ctrl->message.'</h1>';
    }//end if

    echo '<h1>'.$ctrl->sCtrl->student->sEmail.'</h1>';

    echo '<p>'.$ctrl->sCtrl->student->nNumber.'</p>';

    echo '<p>'.$ctrl->sCtrl->student->fName.' '.$ctrl->sCtrl->student->lName.'</p>';

    echo '<p> Your account was created on: '.$ctrl->sCtrl->student->created.'</p>';

    echo '<p class=totalHours>Volunteer Hours: '.$ctrl->sCtrl->student->totalHours.'</p>';

    echo '<p><span class="button" id="changePassword">Change Password</span></p>';




            echo '<div id="changePasswordDiv" style="display:none;">	
            <form id="form2" action="studentProfile.php" method="post">	
			<fieldset>
                                <p>
					<label for="password">Current Password</label>
					<input type="password" name="curPW" id="curPW" size="60" />
				</p>
	                         <p>
					<label for="password">New Password</label>
					<input type="password" name="newPW1" id="newPW1" size="30" />
					<input type="password" name="newPW2" id="newPW2" size="30" />
				</p>
		
				<p class="submit"><button name="changePassword" type="submit">Send</button></p>		
							
			</fieldset>					
						
		</form>
        </div>';

    echo '</div><!--end studentProfile-->';

?> 
</body>
</html>
