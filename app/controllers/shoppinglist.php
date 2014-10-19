<?php

global $CONFIG;
include($CONFIG["homedir"] . "services/shoppinglistservice.php");
include($CONFIG["homedir"] . "services/itemservice.php");
include($CONFIG["homedir"] . "services/userservice.php");


/**
 * Description of shoppinglist
 *
 * @author sanho
 */
class shoppinglist extends controllerbase {
    
    protected $shoppinglistservice;
    protected $itemservice;
    protected $userservice;
    
    public function __construct($action, $params, $db){
        
        //restrict access to logged in users
        global $CONFIG;
        
        if(!is_null($_SESSION["user"])){
            
            parent::__construct($action, $params, $db);
            $this->shoppinglistservice = new shoppinglistservice($db);
            $this->itemservice = new itemservice($db);
            $this->userservice = new userservice($db);
        
        } else {
            header("Location: " . $CONFIG["siteurl"] . "/?page=login");
            die();
        }
    }

    protected function index($model){
        
        $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $model["collablists"] = $this->shoppinglistservice->getUsersCollabLists($_SESSION["user"]["id"]);
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
            $model["alertType"] = "alert-success";
            $model["message"] = "Poisto onnistui!";
            
        } else {
            
            $model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $model["success"] = FALSE;
            $model["alertType"] = "alert-danger";
            $model["message"] = "Poisto epäonnistui.";
            
        }
        
        $this->display($model, TRUE);
        
    }
    
    protected function addForm($model){
        $this->display($model, TRUE);
    }
    
    protected function addNewList($model){
        
        $id = $this->shoppinglistservice->addNewList();
       
        if(($id)){
            
            $model["success"] = TRUE;
            $model["message"] = "Uusi lista lisättiin onnistuneesti!";
            $model["alertType"] = "alert-success";
            $model["list"] = $this->shoppinglistservice->getSingleList($id);
            
        } else {
            
           $model["success"] = FALSE;
           $model["message"] = "Uutta listaa ei voitu luoda";
           $model["alertType"] = "alert-danger";
           $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            
        }
        
       $this->display($model, TRUE);
    }
    
    protected function deleteItemFromList($model){
        
        $model["message"]   = "Ostosta ei voitu poistaa";
        $model["alertType"] = "alert-danger";
        
        if($this->shoppinglistservice->deleteItemFromList($this->params[0])){

            $model["message"]   = "Ostos poistettiin onnistuneesti";
            $model["alertType"] = "alert-success";
            
        }
        
        $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $this->display($model, TRUE);
    }
    
    
    
    protected function addItemToList($model){
        if($this->shoppinglistservice->addItemToList($this->params[0])){
         
            $model["alertType"] = "alert-success";
            $model["message"]   = "Ostos lisättiin";
            $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($model);
            
        } else {
            
            $model["alertType"] = "alert-danger";
            $model["message"]   = "Ostosta ei voitu lisätä";
            $model["lists"]     = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($model);
            
        }
    }
    
    public function itemHasBeenBought($model){
        
        if( $this->itemservice->itemHasBeenBought($this->params[0]) ){
            
            $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($model);    
            
        } else {
            
            $model["alertType"] = "alert-danger";
            $model["message"]   = "Ostosta ei voitu muuttaa ostetuksi";
            $this->display($model);
            
        }
                
    }
    
    public function setItemToNotBought($model){
        
        if( $this->itemservice->setItemToNotBought($this->params[0]) ){
            
            $model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($model);    
            
        } else {
            
            $model["alertType"] = "alert-danger";
            $model["message"]   = "Ostosta ei voitu siirtää ostettavaksi";
            $this->display($model);
            
        }
                
    }
    
    protected function searchForUsers($model){
        $model["listID"] = filter_var($this->params[0], FILTER_VALIDATE_INT);
        $model["users"] = $this->userservice->searchForUsersNotInList($this->params[0]);
        $this->display($model);
    }
    
    protected function addUserByIDAsCollaborator($model){
        if( $this->userservice->addUserByIDAsCollaborator( $this->params[0], $this->params[1] )){
            $model["message"] = "Uuden kollaborin lisääminen onnistui";
        } else {
            $model["message"] = "Uuden kollaborin lisääminen epäonnistui";
        }
        $model["listID"] = filter_var($this->params[1], FILTER_VALIDATE_INT);
        $model["users"]  = $this->userservice->searchForUsersNotInList($this->params[1]);
        $this->display($model);
    }


    protected function showAddCollaboratorForm($model){
        
        $model["collaborators"] = $this->userservice->getListCollaboratorsByListID($this->params[0]);
        $model["id"] = filter_var($this->params[0], FILTER_VALIDATE_INT);
        $this->display($model);
        
    }
    
    protected function removeCollaboratorByIDFromListByID($model){
        //param 0 = user id
        //param 1 = list id
        if($this->userservice->removeCollaboratorByIDFromListByID($this->params[0], $this->params[1])){
            $model["message"] = "Käyttäjä poistettiin onnistuneesti";
        } else {
            $model["alertType"] = "alert-danger";
            $model["message"] = "Käyttäjän poisto ei onnistunut";
        }
        $model["collaborators"] = $this->userservice->getListCollaboratorsByListID($this->params[1]);
        $model["id"] = filter_var($this->params[1], FILTER_VALIDATE_INT);
        
        $this->display($model);
        
    }
    
    protected function addCollaboratorToList($model){
        
        if($this->shoppinglistservice->addCollaboratorToList($this->params[0])){
            
            $id = $_SESSION["user"]["id"];
            
            $model["message"]       = "Kollabori lisättiin onnistuneesti!";
            $model["lists"]         = $this->shoppinglistservice->getUsersLists($id);
            $model["collablists"]   = $this->shoppinglistservice->getUsersCollabLists($id);
            $this->display($model);
                    
        } else {
            
            $model["message"]       = "Kollaboria ei voitu lisätä";
            $model["alertType"]     = "alert-danger";
            $model["lists"]         = $this->shoppinglistservice->getUsersLists($id);
            $model["collablists"]   = $this->shoppinglistservice->getUsersCollabLists($id);
            $this->display($model);
            
        }
        
    }
    
}
