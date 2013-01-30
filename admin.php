<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['admin'])){
header('Location: index.php');
}


require_once('control.php');
require_once('Templates/page.php');
require_once('Templates/adminPage.php');

    $ctrl = new control;
    $ctrl->process();

    //page is our standard view
    $markup = new page;
    //print the metaHeader for our scripts and css
    $markup->metaHeader('VMS Admin');
    //print the header of the page (this is generic to all pages)
    $markup->head($ctrl);

    //adminView 
    $page = new adminPage;
    
    $unApprovedEvents = $ctrl->adminCtrl->adminData->getUnapprovedEvents($ctrl);
    $allEvents = $ctrl->adminCtrl->adminData->getAllEvents($ctrl);

?>
    <div class="container">
        <div class="row">
            <div class="onecol">
            </div>
            <div class="ninecol last">
                <p class="heading bB">Events Awaiting Approval</p>
                <?  $page->unApprovedEvents($ctrl,$unApprovedEvents);?>
                <p class="heading bB">All Events</p>
                <? $page->allEvents($ctrl,$allEvents);?>
            </div>
        </div>
    </div>

<? $markup->footer(); ?>
