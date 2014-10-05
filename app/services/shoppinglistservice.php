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
    
    public function listUsersLists($id){
        
        $shoppinglistarray = [];
        
        $sql = $this->db->prepare(" SELECT * FROM shoppinglist_shoppinglists as a
                                    INNER JOIN shoppinglist_owners_to_lists_ref as b 
                                    ON a.id = b.shoppinglistid
                                    WHERE b.userid = :id");
        
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($rows as $listRow){
            
                $listitems = $this->getListItemsFromRow($listRow["id"]);
                $shoppinglistarray[] = $this->transformRowToObject($listRow);
                        
            }
        }
        
        return $shoppinglistarray;
    }
    
    public function getListItemsFromRow($id){
        $sql = "SELECT c.id, c.name, c.shop, c.price, c.buyer, c.buyerID, c.isBought";
    }
    
    public function showSingleList($id){
        
        $sql = $this->db->prepare("     SELECT * "
                . "                     FROM shoppinglist_shoppinglists"
                . "                     WHERE id = :id");
        
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $this->transformRowToObject($row);
            
        }
        
    }
    
    public function addNewList(){
        
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        
        $sql = $this->db->prepare(" INSERT INTO shoppinglist_shoppinglists"
                . "                     (name, active)"
                . "                 VALUES"
                . "                     (:name, 'true')");
        
        $sql->bindValue(":name", $name, PDO::PARAM_STR);
        
        if($sql->execute()){
            
            return "Uusi lista lisättiin onnistuneesti";
            
        } else {
            
            return "Uutta listaa ei pystytty lisäämään";
            
        }
        
    }
    
    public function modifySingleList($id){
        
        $name   = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        
        $sql = $this->db->prepare(" UPDATE shoppinglist_shoppinglists"
                . "                 SET name = :name"
                . "                 WHERE id = :id");
        
        $sql->bindValue(":name", $name, PDO::PARAM_STR);
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            return $this->getSingleList($id);
            
        }
        
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