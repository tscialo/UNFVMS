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
    
    $events = $ctrl->sCtrl->sData->getEvents($ctrl);
    $sEvents = $ctrl->sCtrl->sData->getSignedUpEvents($ctrl);



    echo '<div class="container">
            <div class="row">
            <div class="fourcol ">
            <p class="heading bB">Your events</p>';
                $page->signedUpEvents($sEvents);
            echo '</div>
                <div class="eightcol last">
                <p class="heading bB">Upcoming Events</p>';
                $page->printEvents($events);
                echo '</div>
            </div>
        </div>
</body>
</html>';





?>
