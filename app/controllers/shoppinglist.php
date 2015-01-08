<?php

global $CONFIG;
include($CONFIG["homedir"] . "services/shoppinglistservice.php");
include($CONFIG["homedir"] . "services/itemservice.php");
include($CONFIG["homedir"] . "services/userservice.php");


/**
 * Shoppinglist displays 
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

    protected function index(){
        
        $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $this->model["collablists"] = $this->shoppinglistservice->getUsersCollabLists($_SESSION["user"]["id"]);
        $this->display($this->model, TRUE);

    }
    
    protected function showSingleList(){
        
        $list = $this->shoppinglistservice->getSingleList($this->params[0]);
        $this->model["list"] = $list;
        $this->display($this->model, TRUE);
        
    }


    protected function modify(){
        
        $list = $this->shoppinglistservice->getSingleList($this->params[0]);
        $this->model["list"] = $list;
        $this->display($this->model, TRUE);       
        
    }
    
    protected function modifyList(){

        if($this->shoppinglistservice->modifySingleList($this->params[0])){
            
            $this->model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $this->model["message"] = "Muokkaus onnistui!";
            
        } else {
            
            $this->model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $this->model["message"] = "Muokkaus epäonnistui.";
                        
        }
        
        $this->display($this->model, TRUE);
        
    }  
    
    protected function deleteList(){
        
        if($this->shoppinglistservice->deleteSingleList($this->params[0])){
            
            $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->model["success"] = TRUE;
            $this->model["alertType"] = "alert-success";
            $this->model["message"] = "Poisto onnistui!";
            
        } else {
            
            $this->model["list"] = $this->shoppinglistservice->getSingleList($this->params[0]);
            $this->model["success"] = FALSE;
            $this->model["alertType"] = "alert-danger";
            $this->model["message"] = "Poisto epäonnistui.";
            
        }
        
        $this->display($this->model, TRUE);
        
    }
    
    protected function addForm(){
        $this->display($this->model, TRUE);
    }
    
    protected function addNewList(){
        
        $id = $this->shoppinglistservice->addNewList();
       
        if(($id)){
            
            $this->model["success"] = TRUE;
            $this->model["message"] = "Uusi lista lisättiin onnistuneesti!";
            $this->model["alertType"] = "alert-success";
            $this->model["list"] = $this->shoppinglistservice->getSingleList($id);
            
        } else {
            
           $this->model["success"] = FALSE;
           $this->model["message"] = "Uutta listaa ei voitu luoda";
           $this->model["alertType"] = "alert-danger";
           $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            
        }
        
       $this->display($this->model, TRUE);
    }
    
    protected function deleteItemFromList(){
        
        $this->model["message"]   = "Ostosta ei voitu poistaa";
        $this->model["alertType"] = "alert-danger";
        
        if($this->shoppinglistservice->deleteItemFromList($this->params[0])){

            $this->model["message"]   = "Ostos poistettiin onnistuneesti";
            $this->model["alertType"] = "alert-success";
            
        }
        
        $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
        $this->display($this->model, TRUE);
    }
    
    
    
    protected function addItemToList(){
        if($this->shoppinglistservice->addItemToList($this->params[0])){
         
            $this->model["alertType"] = "alert-success";
            $this->model["message"]   = "Ostos lisättiin";
            $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($this->model);
            
        } else {
            
            $this->model["alertType"] = "alert-danger";
            $this->model["message"]   = "Ostosta ei voitu lisätä";
            $this->model["lists"]     = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($this->model);
            
        }
    }
    
    public function itemHasBeenBought(){
        
        if( $this->itemservice->itemHasBeenBought($this->params[0]) ){
            
            $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($this->model);    
            
        } else {
            
            $this->model["alertType"] = "alert-danger";
            $this->model["message"]   = "Ostosta ei voitu muuttaa ostetuksi";
            $this->display($this->model);
            
        }
                
    }
    
    public function setItemToNotBought(){
        
        if( $this->itemservice->setItemToNotBought($this->params[0]) ){
            
            $this->model["lists"] = $this->shoppinglistservice->getUsersLists($_SESSION["user"]["id"]);
            $this->display($this->model);    
            
        } else {
            
            $this->model["alertType"] = "alert-danger";
            $this->model["message"]   = "Ostosta ei voitu siirtää ostettavaksi";
            $this->display($this->model);
            
        }
                
    }
    
    protected function searchForUsers(){
        $this->model["listID"] = filter_var($this->params[0], FILTER_VALIDATE_INT);
        $this->model["users"] = $this->userservice->searchForUsersNotInList($this->params[0]);
        $this->display($this->model);
    }
    
    protected function addUserByIDAsCollaborator(){
        if( $this->userservice->addUserByIDAsCollaborator( $this->params[0], $this->params[1] )){
            $this->model["message"] = "Uuden kollaborin lisääminen onnistui";
        } else {
            $this->model["message"] = "Uuden kollaborin lisääminen epäonnistui";
        }
        $this->model["listID"] = filter_var($this->params[1], FILTER_VALIDATE_INT);
        $this->model["users"]  = $this->userservice->searchForUsersNotInList($this->params[1]);
        $this->display($this->model);
    }


    protected function showAddCollaboratorForm(){
        
        $this->model["collaborators"] = $this->userservice->getListCollaboratorsByListID($this->params[0]);
        $this->model["id"] = filter_var($this->params[0], FILTER_VALIDATE_INT);
        $this->display($this->model);
        
    }
    
    protected function removeCollaboratorByIDFromListByID(){
        //param 0 = user id
        //param 1 = list id
        if($this->userservice->removeCollaboratorByIDFromListByID($this->params[0], $this->params[1])){
            $this->model["message"] = "Käyttäjä poistettiin onnistuneesti";
        } else {
            $this->model["alertType"] = "alert-danger";
            $this->model["message"] = "Käyttäjän poisto ei onnistunut";
        }
        $this->model["collaborators"] = $this->userservice->getListCollaboratorsByListID($this->params[1]);
        $this->model["id"] = filter_var($this->params[1], FILTER_VALIDATE_INT);
        
        $this->display($this->model);
        
    }
    
    protected function addCollaboratorToList(){
        
        if($this->shoppinglistservice->addCollaboratorToList($this->params[0])){
            
            $id = $_SESSION["user"]["id"];
            
            $this->model["message"]       = "Kollabori lisättiin onnistuneesti!";
            $this->model["lists"]         = $this->shoppinglistservice->getUsersLists($id);
            $this->model["collablists"]   = $this->shoppinglistservice->getUsersCollabLists($id);
            $this->display($this->model);
                    
        } else {
            
            $this->model["message"]       = "Kollaboria ei voitu lisätä";
            $this->model["alertType"]     = "alert-danger";
            $this->model["lists"]         = $this->shoppinglistservice->getUsersLists($id);
            $this->model["collablists"]   = $this->shoppinglistservice->getUsersCollabLists($id);
            $this->display($this->model);
            
        }
        
    }
    
}
