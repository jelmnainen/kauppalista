<?php
    
    //for debug, remove from production
    ini_set('display_errors', 1);

    session_start();

    //set up $CONFIG
    GLOBAL $CONFIG;
    require_once( __DIR__ . '/config.php' );  
    
    
    //load core classes
    require_once('core.php');    
    require_once($CONFIG["controllerdir"] . "controllerbase.php");
    require_once($CONFIG["modelsdir"] . "modelbase.php");
    
    $core = new Core();
    
    //load controller
    $controller = $core->getController();
    
    /*
    print_r($core);
    echo "<br><br>";
    print_r($controller);
    */
    
    //execute requested action
    $controller->executeAction();

    
?>


