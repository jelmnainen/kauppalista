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
    
    public function __construct( $action, $params, $db ){
        
        GLOBAL $CONFIG;
        
        $this->action       = $action;
        $this->params       = $params;
        $this->db           = $db;
        $this->modelfile    = $CONFIG["modelsdir"] . get_class($this) . "model.php";
        
        require_once($this->modelfile);
        
        $model = get_class($this) . "model";
        
        $this->model = new $model($this->db);
        
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
