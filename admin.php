<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['admin'])){
header('Location: index.php');
}


require_once('control.php');
require_once('Templates/header.php');
require_once('Templates/adminPage.php');

    $ctrl = new control;
    $header = new pageHeader;
    $page = new adminPage;

    $ctrl->metaHeader('VMS Admin');

    $ctrl->process();

    $header->pageHead($ctrl);
    
    $unApprovedEvents = $ctrl->adminCtrl->adminData->getUnapprovedEvents($ctrl);
    $allEvents = $ctrl->adminCtrl->adminData->getAllEvents($ctrl);



    echo '<div class="container">
            <div class="row">
                <div class="onecol">
                </div>
                <div class="ninecol last">
                <p class="heading bB">Events Awaiting Approval</p>';
                $page->unApprovedEvents($ctrl,$unApprovedEvents);
                echo '<p class="heading bB">All Events</p>';
                $page->allEvents($allEvents);
                echo '</div>
            </div>
        </div>
</body>
</html>';





?>
