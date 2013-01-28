<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['orgUser'])){
header('Location: index.php');
}


require_once('control.php');
require_once('Templates/page.php');
require_once('Templates/orgPage.php');

    $ctrl = new control;
    $ctrl->process();

    $markup = new page;
    $markup->metaHeader('Organization Admin');
    $markup->head($ctrl);


    $page = new orgPage;

    $result= $ctrl->oCtrl->orgData->getOrgEvents($ctrl);
?>
    <div class="container">
        <div class="row">
            <div class="fourcol">';
                <?$page->addEvent();?>
            </div>
            <div class="sixcol last eventCon">';
                <?$page->orgEvents($ctrl,$result);?>
            </div>

        </div>
    </div>

<? $markup->footer();?>
