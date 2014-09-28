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
        
        parent::__construct($action, $params, $db);
        $this->shoppinglistservice = new shoppinglistservice($db);
        
    }

    protected function index($model){
        $lists = $this->shoppinglistservice->listAll();
        $model['lists'] = $lists;
        $this->display($model, TRUE);
    }
    
    protected function modify($model){
        
    }
    
}
