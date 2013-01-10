<?php

ini_set('display_errors',1);
error_reporting(E_ALL);
session_start();
if(!isset($_SESSION['orgUser'])){
header('Location: index.php');
}


require_once('control.php');
require_once('Templates/header.php');
require_once('Templates/orgPage.php');

    $ctrl = new control;
    $ctrl->metaHeader('Organization Admin');
    $ctrl->process();


    $header = new pageHeader;
    $page = new orgPage;

    $header->pageHead($ctrl);

    $result= $ctrl->oCtrl->orgData->getOrgEvents($ctrl);

    echo '<div class="container">
            <div class="row">
                <div class="fourcol">';
                $page->addEvent();
                echo '</div>
                <div class="sixcol last eventCon">';
                $page->orgEvents($ctrl,$result);

    echo '</div>
            </div>
        </div>
</body>
</html>';



?>
