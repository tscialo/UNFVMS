<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

require_once('control.php');
require_once('Templates/page.php');
require_once('Templates/eventView.php');

    $ctrl = new control;
    $ctrl->process();


    $markup = new page;
    $markup->metaHeader('Event');
    $markup->head($ctrl);

    $eventView = new eventView($ctrl);

?>

    

    <? $markup->footer(); ?> 
