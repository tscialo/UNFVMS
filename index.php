<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();

require_once('control.php');
require_once('templates/page.php');

    $ctrl = new control;
    $ctrl->process();


    $markup = new page;
    $markup->metaHeader('UNF VMS');
    $markup->head($ctrl);
?>

        <div class="welcome">';

        <?
        if(!empty($ctrl->message)){
            echo '<p class="message cB">'.$ctrl->message.'</p>';
        }
        ?>
            <p class="heading">Welcome to the UNF Volunteer Center!</p>
            <img src="Photos/v3.jpg"/> 
        </div>

        <div class="container">
            <div class="row">
                <div class="fourcol">
                    <p class="heading bB">Spotlight Event</p>
                    <? $ctrl->calendar->spotlightEvent($ctrl); ?>
                </div>

                <div class="eightcol last">
                    <p class="heading bB">Upcoming events</p>
                    <? $ctrl->calendar->printCalendar($ctrl->calendar->publicCalendarData($ctrl)); ?>
                </div>
            </div>
        </div>

    <? $markup->footer(); ?> 
