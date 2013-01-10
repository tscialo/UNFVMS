<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();


require_once('control.php');
require_once('Templates/header.php');

    $ctrl = new control;
    $ctrl->process();

    $ctrl->metaHeader('UNF VMS');

    $header = new pageHeader;
    $header->pageHead($ctrl);

    echo '
        <div class="welcome">';
        if(!empty($ctrl->message)){
            echo '<p class="message cB">'.$ctrl->message.'</p>';
        }
            //echo '<p class="message cB">Thanks for signing up Carly Lism, Sign in to get Started</p>';
    echo '
        <p class="heading">Welcome to the UNF Volunteer Center!</p>
        <img src="Photos/v3.jpg"/> 
        </div>
        <div class="container">
        <div class="row">
        <div class="fourcol">
        <p class="heading bB">Spotlight Event</p>';
        $ctrl->spotlightEvent();
        echo '
        </div>

        <div class="eightcol last">
        <p class="heading bB">Upcoming events</p>
        ';
        $ctrl->publicEvents();
       echo ' 
        </div>
        </div>
        </div>';

?> 
</body>
</html>
