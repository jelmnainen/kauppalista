<?php

    /**
     * The core module is responsible for 
     *      - including the config file
     *      - setting up the database connection
     *      - finding the correct controller to be used
     */

    
    //set up $CONFIG
    GLOBAL $CONFIG;
    require_once( __DIR__ . '/config.php' );  

    //set up db    
    require_once($CONFIG['homedir'] . 'lib/db.class.php');    
    $db = new db($CONFIG['dbconfig']);
    
    //by default, load the default controller from config
    $controller = $CONFIG["default_controller"];
    
    //check if user asked for a specific controller
    $requested_controller = filter_input(   INPUT_GET, 
                                            "page", 
                                            FILTER_SANITIZE_STRING );
    
    if(isset($requested_controller) && strlen($requested_controller) > 0){
        
        //if user did ask for a specific controller, get it 
        $controller =  $CONFIG["controllerdir"] 
                                    . $requested_controller
                                    . ".php";

        if(file_exists($controller)){

            require_once($controller);
            
        } else { //controller did not exist, show 404
            
            require_once($CONFIG["controllerdir"] . "404.php");
            
        }

    }
    
        
