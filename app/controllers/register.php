<?php


/**
 * Class handles new user registeration
 *
 * @author sanho
 */

global $CONFIG;
include($CONFIG["homedir"] . "services/registerservice.php");

class register extends controllerbase {

    private $registerservice;
    
    public function __construct($action, $params, $db) {
        
        parent::__construct($action, $params, $db);
        $this->registerservice = new registerservice($db);
        
    }
    
    /*** ROUTES ***/
    
    /**
     * Index page is static
     */
    protected function index(){
        $this->display();
    }
    
    protected function processRegisteration(){
        $this->model["success"] = $this->registerservice->processRegisteration();
        $this->display($this->model);
    }
       
}
