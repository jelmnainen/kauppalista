<?php

    ob_start();
    session_start();
    
    //for debug, remove from production
    ini_set('display_errors', 1);
    
    //load core functions
    require_once('core.php');    
    
    require_once($CONFIG["homedir"] . "views/default_layout.php");

    ob_end_flush();		
    
?>


