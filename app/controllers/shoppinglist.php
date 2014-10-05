<?php

global $CONFIG;
include($CONFIG["homedir"] . "services/shoppinglistservice.php");


/**
 * Description of shoppinglist
 *
 * @author sanho
 */
class shoppinglist extends controllerbase {
    
    protected $shoppinglistservice;
    
    public function __construct($action, $params, $db){
        
        //restrict access to logged in users
        global $CONFIG;
        
        if(!is_null($_SESSION["user"])){
            
            parent::__construct($action, $params, $db);
            $this->shoppinglistservice = new shoppinglistservice($db);
        
        } else {
            header("Location: " . $CONFIG["siteurl"] . "/?page=login");
            die();
        }
    }

    protected function index($model){
        
        $lists = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $model['lists'] = $lists;
        $this->display($model, TRUE);

    }
    
    protected function showSingleList($model){
        
        $list = $this->shoppinglistservice->getSingleList($this->params[0]);
        $model["list"] = $list;
        $this->display($model, TRUE);
        
    }


    protected function modify($model){
        
        $list = $this->shoppinglistservice->getSingleList($this->params[0]);
        $model["list"] = $list;
        $this->display($model, TRUE);       
        
    }
    
    protected function modifyList($model){

        if($this->shoppinglistservice->modifySingleList($this->params[0])){
            
            $model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $model["message"] = "Muokkaus onnistui!";
            
        } else {
            
            $model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $model["message"] = "Muokkaus epäonnistui.";
                        
        }
        
        $this->display($model, TRUE);
        
    }  
    
    protected function deleteList($model){
        
        if($this->shoppinglistservice->deleteSingleList($this->params[0])){
            
            $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $model["success"] = TRUE;
            $model["message"] = "Poisto onnistui!";
            
        } else {
            
            $model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $model["success"] = FALSE;
            $model["message"] = "Poisto epäonnistui.";
            
        }
        
        $this->display($model, TRUE);
        
    }
    
    protected function addForm($model){
        $this->display($model, TRUE);
    }
    
    protected function addNewList($model){
       
        if($this->shoppinglistservice->addNewList()){
            
            $id = $this->db->lastInsertId();
            $model["success"] = TRUE;
            $model["message"] = "Uusi lista lisättiin onnistuneesti!";
            $model["list"] = $this->shoppinglistservice->getSingleList($id);
            
        } else {
            
           $model["success"] = FALSE;
           $model["message"] = "Uutta listaa ei voitu luoda";
           $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            
        }
        
       $this->display($model, TRUE);
    }
    
    protected function deleteItemFromList($model){
        $this->shoppinglistservice->deleteItemFromList($this->params[0]);
        $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $this->display($model, TRUE);
    }
    
    protected function showAddItemForm($model){
        
        $model["id"] = $this->params[0];
        $this->display($model, TRUE);
        
    }
    
    protected function addItemToList($model){
        $this->shoppinglistservice->addItemToList($this->params[0]);
        $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $this->display($model, TRUE);
    }
    
}
