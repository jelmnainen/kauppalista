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
    
    public function __construct( $action, $params, $db ){
    
            $this->action   = $action;
            $this->params   = $params;
            $this->db       = $db;
        
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
        
        $views = $CONFIG["viewsdir"] 
                 . get_class($this) 
                 . '/' . $this->action 
                 . '.php';
        
        if ($fullview) {
                require($CONFIG["viewsdir"] . $layout . ".php" );
        } else {
                require($views);
        }
    }
    
    protected function index(){
        
        $output = "<h1>Korvaa jollain</h1>";
        $this->display($output, true);                
        
    }
    
}
