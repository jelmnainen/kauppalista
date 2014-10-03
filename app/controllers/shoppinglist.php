<?php

global $CONFIG;
include($CONFIG["homedir"] . "services/shoppinglistservice.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        
        $lists = $this->shoppinglistservice->listUsersLists($_SESSION["user"]["id"]);
        $model['lists'] = $lists;
        $this->display($model, TRUE);

    }
    
    protected function showSingleList($model){
        
        $list = $this->shoppinglistservice->showSingleList($this->params[0]);
        $model["list"] = $list;
        $this->display($model, TRUE);
        
    }


    protected function modify($model){
        
        $list = $this->shoppinglistservice->getSingleList($this->params[0]);
        $model["list"] = $list;
        $this->display($model, TRUE);       
        
    }
    
    protected function modifyList($model){

        $list = $this->shoppinglistservice->modifySingleList($this->params[0]);
        $model["list"] = $list;
        $this->display($model, TRUE);
        
    }                
    
    protected function addForm($model){
        $this->display($model, TRUE);
    }
    
    protected function addNewList($model){
       $message = $this->shoppinglistservice->addNewList();
       $model["message"] = $message;
       $this->display($model, TRUE);
    }
    
}
