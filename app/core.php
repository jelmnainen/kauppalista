<?php

/**
 * The core class is responsible for 
 *      - setting up the database connection, available via getDB()
 *      - finding the correct controller to be used, available via 
 *        getController()
 *          -assigning that controller with requested actions and params
 */

class core{
    
    public  $db;
    private $requested_controller;
    private $requested_action;
    private $requested_params;

    public function __construct(){
        
        global $CONFIG;

        //set up db    
        require_once($CONFIG['homedir'] . 'lib/db.class.php');    
        $pdo = new db($CONFIG["dbconfig"]);
        $this->db = $pdo->getConn();
        
        //get controller, action and params from URI
        $this->requested_controller = $this->getRequestedControllerFromURI();
        $this->requested_action     = $this->getRequestedActionFromURI();
        $this->requested_params     = $this->getRequestedParamsFromURI();
        
    }
    
    public function getDB(){
        return $this->db;
    }
    
    public function getController(){
        
        GLOBAL $CONFIG;
        
        $controller = $this->requested_controller;
        
        //getRequestedControllerFromURI() has already checked that the file
        //does indeed exist
        include_once ($CONFIG["controllerdir"] . $controller . ".php");
        
        //
        return new $this->requested_controller( $this->requested_action, 
                                                $this->requested_params,
                                                $this->db );
        
    }
   
    /**
     * Function searches uri for ?page=1, checks if controller file exists
     * and returns the ?page value
     * 
     * @return string requested controller name
     */
    private function getRequestedControllerFromURI(){
        
        GLOBAL $CONFIG;
        
        $controller = filter_input(     INPUT_GET, 
                                        "page", 
                                        FILTER_SANITIZE_STRING );

        if( strlen($controller) > 0 ){
            
            //if user did ask for a specific controller, get it 
            if(file_exists( $CONFIG["controllerdir"] 
                            . $controller 
                            . ".php")){

                
                return $controller;
                

            } else {//controller wasn't found
                
                return "404";
                
            }
            
        } //?page wasn't set -> show homepage
        
        return "home";
        
    }
    
    /**
     * Gets the requested action from URL ?action=
     * 
     * @return string the name of action requested
     */
    private function getRequestedActionFromURI(){

        $action = filter_input( INPUT_GET, "action", FILTER_SANITIZE_STRING);
        
        if(strlen($action) > 0){
            
            return $action;
            
        } 
        
        return "index";
 
    }
    
    /**
     * 
     * @return Array of additional parameters
     */
    private function getRequestedParamsFromURI(){
        $ret = Array();
        
        $params = filter_input(INPUT_GET, "params");
        
        if(strlen($params) > 0){
            
            $ret = explode(";", $params);
                    
        }
        
        return $ret;
    }
    
}    
