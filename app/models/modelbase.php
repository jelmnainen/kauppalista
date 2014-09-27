<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of modelbase
 *
 * @author sanho
 */
class modelbase {
    
    public $db;
    
    public function __construct($db) {

        $this->db = $db;
        
    }
    
}
