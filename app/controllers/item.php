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
    
    protected function showModifyForm(){
        
        $this->model["item"] = $this->itemservice->getSingleItem($this->params[0]);
        $this->display($this->model, TRUE);
        
    }
    
    protected function modifyItem(){
        
        if($this->itemservice->modifyItem($this->params[0])){
            
            $this->model["message"]   = "Kohteen muokkaus onnistui!";
            $this->model["item"]      = $this->itemservice->getSingleItem($this->params[0]);
            
        } else {
            
            $this->model["alertType"] = "alert-danger";
            $this->model["message"]   = "Kohteen muokkaus epäonnistui";
            $this->model["item"]      = $this->itemservice->getSingleItem($this->params[0]);
            
        }
        
        $this->display($this->model, TRUE);
    }
    
    protected function showAddItemToListForm(){
        
        $this->model["id"] = $this->params[0];
        $this->display($this->model, TRUE);
        
    }

    
    
}
