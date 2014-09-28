<?php
global $CONFIG;
include_once($CONFIG["homedir"] . "domain/shoppinglistdomain.php");
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shoppinglistservice
 *
 * @author sanho
 */
class shoppinglistservice {
    
    private $db;
    
    public function __construct($db) {
        $this->db = $db;
    }
       
    public function listAll(){
 
        
        $shoppinglistarray = [];
        
        $sql = $this->db->prepare("SELECT * FROM shoppinglist_shoppinglists");
        
        
        
        if( $sql->execute() ){
            
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($rows as $row){
            
                $shoppinglistarray[] = $this->transformRowToObject($row);
                
            }
            
        }
        
        return $shoppinglistarray;
        
    }
    
    private function transformRowToObject($row){
        
        $shoppinglistdomain = new shoppinglistdomain();
        $shoppinglistdomain->setActive($row["active"]);
        $shoppinglistdomain->setName($row["name"]);
        $shoppinglistdomain->setid($row["id"]);
        $shoppinglistdomain->setUpdated($row["updated"]);
        
        return $shoppinglistdomain;
        
        
    }
}

      /*
        $sql = $this->db->prepare( "SELECT * FROM shoppinglist_shoppinglists AS a "
        . "LEFT JOIN shoppinglist_items_to_lists_ref AS b "
        . "ON a.id = b.shoppinglistid "
        . "LEFT JOIN shoppinglist_items AS c "
        . "on b.itemid = c.id"
                . "WHERE a.id = :id");
        */