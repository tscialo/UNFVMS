<?php

ini_set('display_errors',1);
error_reporting(E_ALL);

session_start();
if(!isset($_SESSION['studentUser'])){
    header('Location: index.php');
}//end if


require_once('control.php');
require_once('templates/page.php');
require_once('templates/studentPage.php');

    //instantiate control
    $ctrl = new control;
    $ctrl->process();

    //instantiate our markup page
    $markup = new page;
    //build the metaHeader
    $markup->metaHeader('UNF Volunteer');
    //build the universal header
    $markup->head($ctrl);

    //instantiate a student page
    $studentMarkup = new studentPage;

    //go get our necessary data 
    $events = $ctrl->sCtrl->sData->getEvents($ctrl);
    $sEvents = $ctrl->sCtrl->sData->getSignedUpEvents($ctrl);



    echo '<div class="container">
            <div class="row">
            <div class="fourcol ">
            <p class="heading bB">Your events</p>';
                $studentMarkup->signedUpEvents($sEvents);
            echo '</div>
                <div class="eightcol last">
                <p class="heading bB">Upcoming Events</p>';
                    $ctrl->calendar->printCalendar($events);
                //$studentMarkup->printEvents($events);
                echo '</div>
            </div>
        </div>
</body>
</html>';





?>
