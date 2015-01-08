<?php



/**
 * This controller handles the login logic
 *
 * @author johannes
 */

global $CONFIG;
include($CONFIG["homedir"] . "services/loginservice.php");

class login extends controllerbase {
    
    private $loginservice;
    
    public function __construct($action, $params, $db) {
        
        parent::__construct($action, $params, $db);
        $this->loginservice = new loginservice($db);
        
    }
    
    /*** Route functions ***/

    /**
     * Login index is a static form
     */
    protected function index(){
        $this->display();
    }
    
    protected function processLogin(){
        $this->model["success"] = $this->loginservice->processLogin();
        $this->display($this->model);
    }
    
    protected function logout(){
        $this->model["success"] = $this->loginservice->processLogout();
        $this->display($this->model);
    }
    
}
