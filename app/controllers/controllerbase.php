<?php


/**
 * Description of ControllerBase
 *
 * @author sanho
 */
abstract class controllerbase {
    
    public      $db;
    protected   $action;
    protected   $params;
    protected   $modelfile;
    protected   $model;
    protected   $user;
    
    public function __construct( $action, $params, $db ){
        
        GLOBAL $CONFIG;
        
        $this->action       = $action;
        $this->params       = $params;
        $this->db           = $db;
        $this->modelfile    = $CONFIG["modelsdir"] 
                                . get_class($this) 
                                . "model.php";
        $this->user = $this->getUserFromSession();
        
        require_once($this->modelfile);
        
        $model = get_class($this) . "model";
        
        $this->model = new $model($this->db);
        
    }
    
    /**
     * 
     * @return boolean true if user is logged in, false if not
     */
    protected function user_is_logged_in(){
       
       if(is_null($this->user)){
           
           return FALSE;
           
       } else {
           
           return TRUE;
           
       }
       
    }
    
    /**
     * Gets user data from $_SESSION
     * 
     * @return array user id, name, email
     */
    protected function getUserFromSession(){
        
        //usernames are always at least 3 charachters long
        if(         isset(  $_SESSION["user"]) 
                &&  strlen( $_SESSION["user"]["username"]) > 3)
            {
            
            return $_SESSION["user"];
            
            
        } else {
            
            return NULL;
            
        }
    }
    
    public function executeAction(){
        
        $this->{$this->action}([]);
        
    }
    
    /**
     * The output rendering function. 
     * 
     * @param mixed $output from model, used in template
     * @param boolean $fullview true = pass $output to layout
     */
    public function display($model, $fullview = TRUE, $layout = "default_layout"){
        
        GLOBAL $CONFIG;
        
        /*
         * in views/$controller/$action use $output to generate view
         * in layouts use $view to show generated output
         */
        $view = $CONFIG["viewsdir"] 
                 . get_class($this) 
                 . '/' . $this->action 
                 . '.php';
        
        if ($fullview) {
                require($CONFIG["viewsdir"] . $layout . ".php" );
        } else {
                require($view);
        }
    }
    
    /**
     * Implemented in base so every controller has access to it. The purpose
     * is to have a fallback page in case user hasn't logged in.
     */
    public function show_loginpage(){
        global $CONFIG;
        header("Location:" . $CONFIG["homeurl"] . "?page=login");
    }
    
}
