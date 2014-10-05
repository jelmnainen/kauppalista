<?php

global $CONFIG;
include($CONFIG["homedir"] . "services/itemservice.php");

/**
 * Models a single item in shoppinglists
 *
 * @author sanho
 */
class item extends controllerbase{
    
    protected $itemservice;
    
    public function __construct($action, $params, $db) {
        
        parent::__construct($action, $params, $db);
        $this->itemservice = new itemservice($db);
        
    }
    
    protected function showModifyForm($model){
        
        $model["item"] = $this->itemservice->getSingleItem($this->params[0]);
        $this->display($model, TRUE);
        
    }
    
    protected function modifyItem($model){
        
        if($this->itemservice->modifyItem($this->params[0])){
            
            $model["message"]   = "Kohteen muokkaus onnistui!";
            $model["item"]      = $this->itemservice->getSingleItem($this->params[0]);
            
        } else {
            
            $model["message"]   = "Kohteen muokkaus epäonnistui";
            $model["item"]      = $this->itemservice->getSingleItem($this->params[0]);
            
        }
        
        $this->display($model, TRUE);
    }

    
    
}
