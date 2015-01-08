<?php

    /**
     * Oh hai, katselmoja!
     * 
     * Protippinä tän sotkun ymmärtämiseen siirrän modelit jossain vaiheessa
     * kokonaan domain/service-kombinaatioiksi, ne ovat ikäänkuin päällekkäisiä
     * toteutuksia sillä erotuksella että domain/service-malli on fiksumpi
     */


    
    //for debug, remove from production
    ini_set('display_errors', 1);

    session_start();
    
    //set up $CONFIG
    GLOBAL $CONFIG;
    require_once( __DIR__ . '/config.php' );  
    
    //load core classes
    require_once('core.php');    
    require_once($CONFIG["controllerdir"] . "controllerbase.php");
    
    $core = new Core();
    
    //load controller
    $controller = $core->getController();
    
    //execute requested action
    $controller->executeAction();

    
?>


