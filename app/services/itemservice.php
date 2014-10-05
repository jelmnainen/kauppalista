<?php

/**
 * Provides database services for items in shoppinglists
 *
 * @author sanho
 */

global $CONFIG;
include_once($CONFIG["homedir"] . "domain/itemdomain.php");


class itemservice {
    
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function getSingleItem($id){
        
        $sql = $this->db->prepare("SELECT * FROM shoppinglist_items WHERE id = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            $row = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            return $this->transformItemRowToObject($row[0]);
            
        }
        
    }
    
    /**
     * Converts an SQL representation of an item to an item object
     * @param mixed $row assoc array of item's sql representation
     * @return Itemdomain 
     */
    private function transformItemRowToObject($row){
        
        $item = new itemdomain();
        $item->setBuyerID($row["buyerID"]);
        $item->setID($row["id"]);
        $item->setIsBought($row["bought"]);
        $item->setName($row["name"]);
        $item->setPrice($row["price"]);
        $item->setShop($row["shop"]);
        
        return $item;
                
    }
    
    public function modifyItem($id){
        //TODO:     add buyer edition
        //          add check for right user
        
        var_dump($_POST);
        var_dump($id);
        
        $name       = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price      = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_INT);
        $shop       = filter_input(INPUT_POST, "shop", FILTER_SANITIZE_STRING);
        $bought    = filter_input(INPUT_POST, "bought", FILTER_SANITIZE_STRING);
        
        $sql = $this->db->prepare("UPDATE shoppinglist_items "
                . "SET "
                . "name = :name, "
                . "shop = :shop, "
                . "price = :price, "
                . "bought = :bought "
                . "WHERE id = :id");
        
        $sql->bindValue(":name", $name, PDO::PARAM_STR);
        $sql->bindValue(":shop", $shop, PDO::PARAM_STR);
        $sql->bindValue(":price", $price, PDO::PARAM_INT);
        $sql->bindValue(":bought", $bought, PDO::PARAM_STR);
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
}
