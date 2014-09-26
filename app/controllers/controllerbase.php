<?php


/**
 * Description of ControllerBase
 *
 * @author sanho
 */
abstract class controllerbase {
    
    protected $db;
    protected $action;
    protected $params;
    protected $modelfile;
    protected $model;
    protected $user;
    
    public function __construct( $action, $params, $db ){
        
        GLOBAL $CONFIG;
        
        $this->action       = $action;
        $this->params       = $params;
        $this->db           = $db;
        $this->modelfile    = $CONFIG["modelsdir"] . get_class($this) . "model.php";
        
        if(isset($_SESSION["user"]) && strlen($_SESSION["user"]["name"]) > 0){
            
            $this->user = $_SESSION["user"];
            
        } else {
            
            $this->user = NULL;
            
        }
        
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
    
    public function executeAction(){
        
        $this->{$this->action}();
        
    }
    
    /**
     * 
     * 
     * @param mixed $output from model, used in template
     * @param boolean $fullview true = pass $output to layout
     */
    public function display($output, $fullview, $layout = "default_layout"){
        
        GLOBAL $CONFIG;
        
        /*
         * in views/$controller/$action use $output to generate view
         * in layouts use $view to show generated output
         */
        $view = $CONFIG["viewsdir"] 
                 . get_class($this) 
                 . '/' . $this->action 
                 . '.php';
        
        var_dump(get_class($this));
        var_dump($this->action);
        
        if ($fullview) {
                require($CONFIG["viewsdir"] . $layout . ".php" );
        } else {
                require($views);
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
