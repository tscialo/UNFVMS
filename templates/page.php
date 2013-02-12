<?php


class page {

    public function head($ctrl){
        require_once('templates/header.php');
        $header = new pageHeader;
        $header->pageHead($ctrl);
    }//end head

    public function metaHeader($title){
        echo '
        <!DOCTYPE html>
        <head>
            <meta content="text/html;charset=UTF-8" http-equiv="content-type">
            <title>'.$title.'</title>

            <script src="http://code.jquery.com/jquery-1.8.3.js" type="text/javascript"></script>

            <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
            <script src="http://code.jquery.com/ui/1.10.0/jquery-ui.js"></script>

            <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.0/jquery-ui.min.js"></script>

            <link rel="stylesheet" type="text/css" href="css/jquery.ptTimeSelect.css" />
            <script type="text/javascript" src="js/jquery.ptTimeSelect.js"></script>


            <!-- 1140px Grid styles for IE -->                                                                              
            <!--[if lte IE 9]><link rel="stylesheet" href="/css/ie.css" type="text/css" media="screen" /><![endif]-->       

            <!-- The 1140px Grid - http://cssgrid.net/ -->                                                                  
            <link rel="stylesheet" href="/css/1140.css" type="text/css" media="screen" />                                   

            <link rel="stylesheet" href="/css/styles.css" type="text/css" media="screen" />                                                                                                                                                  
                                                                                                                       
            <!--css3-mediaqueries-js - http://code.google.com/p/css3-mediaqueries-js/ - Enables media queries in some unsupported browsers-->
            <script type="text/javascript" src="/js/css3-mediaqueries.js"></script>

            <link rel="stylesheet" href="css/css.css">
            <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrhcK05jr7a1dMYwWRUiX3_AXDloLHMwg&sensor=false"></script>
            <script type="text/javascript" src="js/jsFunctions.js"></script>
            <script type="text/javascript" src="js/accordion.js"></script>
            <link rel="stylesheet" href="accordion.css">
            <script type="text/javascript" src="js/utility.js"></script>
        </head>
        <body>';

    }//end metaHeader

    public function footer(){
        echo '</body></html>';
    }



}//end class page
