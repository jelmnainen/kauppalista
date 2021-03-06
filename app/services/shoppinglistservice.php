<?php
global $CONFIG;
include_once($CONFIG["homedir"] . "domain/shoppinglistdomain.php");
include_once($CONFIG["homedir"] . "domain/itemdomain.php");

/**
 * Controller for shoppinglist entities
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
    
    public function getUsersLists($id){
        
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
                $shoppinglistarray[] = $this->transformRowToObject($listRow, $listitems);
                        
            }
        }
        
        return $shoppinglistarray;
    }
    
    public function getUsersCollabLists($id){
        
        $shoppinglistarray = [];
        
        $sql = $this->db->prepare(" SELECT * FROM shoppinglist_shoppinglists as a
                                    INNER JOIN shoppinglist_collaborators_to_lists_ref as b 
                                    ON a.id = b.shoppinglistid
                                    WHERE b.userid = :id");
        
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($rows as $listRow){
            
                $listitems = $this->getListItemsFromRow($listRow["id"]);
                $shoppinglistarray[] = $this->transformRowToObject($listRow, $listitems);
                        
            }
        }
        
        return $shoppinglistarray;
    }
 
    /**
     * Returns the items belonging to a specified list as an array
     * @param int $id the id of list the items belong to 
     */
    
    public function getListItemsFromRow($id){
        
        $items = [];
        
        $sql = $this->db->prepare("SELECT c.id, c.name, c.shop, c.price, c.buyerID, c.bought "
                . "FROM shoppinglist_shoppinglists AS a "
                . "INNER JOIN shoppinglist_items_to_lists_ref AS b "
                . "ON a.id = b.shoppinglistid "
                . "INNER JOIN shoppinglist_items AS c "
                . "ON b.itemid = c.id "
                . "WHERE a.id = :id "
                . "ORDER BY c.bought DESC");
        
        $sql->bindValue("id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
        
            $items = $sql->fetchAll(PDO::FETCH_ASSOC);
            
        }
        
        return $items;        
        
    }
    
    /**
     * Returns an shoppinglist object whose id = $id
     * 
     * @param int $id the id of requested list
     * @return shoppinglist 
     */
    public function getSingleList($id){
        //TODO: should write a check to see if the user requesting this entity
        //is owner or collaborator
        
        $sql = $this->db->prepare("     SELECT * "
                . "                     FROM shoppinglist_shoppinglists"
                . "                     WHERE id = :id");
        
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
                        
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            $listitems = $this->getListItemsFromRow($row["id"]);
            return $this->transformRowToObject($row, $listitems);
            
        }
        
    }
    
    public function addNewList(){
        
        $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        
        $sql = $this->db->prepare(" INSERT INTO shoppinglist_shoppinglists "
                . "                     (name, active) "
                . "                 VALUES"
                . "                     (:name, 'true') ");
        
        $sql->bindValue(":name", $name, PDO::PARAM_STR);
        
        if($sql->execute()){
            
            $id = $this->db->lastInsertID();

            $bindsql = $this->db->prepare("INSERT INTO shoppinglist_owners_to_lists_ref "
                    . "(userid, shoppinglistid) "
                    . "VALUES "
                    . "(:userid, :shoppinglistid)");
            
            $bindsql->bindValue(":userid", $_SESSION["user"]["id"], PDO::PARAM_INT);
            $bindsql->bindValue(":shoppinglistid", $id, PDO::PARAM_INT);
            
            if($bindsql->execute()){

                return $id;
                
            }
            
        } else {
            
            
            
            return FALSE;
            
        }
        
    }
    
    private function getUserId($username){
        
        $sql = $this->db->prepare("SELECT id FROM shoppinglist_users WHERE username = :username");
        $sql->bindValue(":username", $username, PDO::PARAM_STR);
        
        if($sql->execute()){
            
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            return $row["id"];
            
        }
        
        return FALSE;
    }
    
    public function addCollaboratorToList($id_unsafe){
        
        $shoppinglistid = filter_var($id_unsafe, FILTER_VALIDATE_INT);
        $username       = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        
        $userid     = $this->getUserId($username);
        
        $sql = $this->db->prepare(""
                . "INSERT INTO "
                .   "shoppinglist_collaborators_to_lists_ref "
                .   "(userid, shoppinglistid) "
                . "VALUES "
                .   "(:userid, :shoppinglistid) ");
        
        $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
        $sql->bindValue(":shoppinglistid", $shoppinglistid, PDO::PARAM_INT);
        
        return $sql->execute();
        
    }
    
    /**
     * Modify list where id = $id
     * @param int $id
     * @return boolean  TRUE,   if modification succeeded
     *                  FALSE,  if modification didn't succeed
     */
    public function modifySingleList($id){
        //TODO: add check for right user
        $name   = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        
        $sql = $this->db->prepare(" UPDATE shoppinglist_shoppinglists"
                . "                 SET name = :name"
                . "                 WHERE id = :id");
        
        $sql->bindValue(":name", $name, PDO::PARAM_STR);
        $sql->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    
    /**
     * Function deletes a single list
     * @param int $id the id of the list to be deleted
     * @return boolean  TRUE  if list was deleted
     *                  FALSE if not
     */
    public function deleteSingleList($id){
        //TODO: write a function to check if this list belongs to the user
        //trying to delete it
        //TODO: write a function deleting all items that belong to a list
        
        $itemrefdel = $this->db->prepare("DELETE FROM shoppinglist_items_to_lists_ref "
                                    . "WHERE shoppinglistid = :id");
        
        $itemrefdel->bindValue(":id", $id, PDO::PARAM_INT);
        
        if($itemrefdel->execute()){
            
            $listdel = $this->db->prepare("DELETE FROM shoppinglist_shoppinglists "
                    . "WHERE id = :id");
            
            $listdel->bindValue(":id", $id, PDO::PARAM_INT);
            
            if($listdel->execute()){
                
                return TRUE;
                
            } else {
                
                return FALSE;
                
            }
            
        }
        
    }
    
    /**
     * Transforms shoppinglist SQL reprepsentation into shoppinglist object
     * 
     * @param mixed $row        an associative array containing SQL values of 
     *                          single list
     * @param mixed $listitems  an associative array containing an array of 
     *                          items that belong to $row["id"] list
     *                          
     * @return $shoppinglistdomain  an shoppinglist object created by parameter
     *                              values
     */
    private function transformRowToObject($row, $listitems){
        
        $shoppinglistdomain = new shoppinglistdomain();
        
        $shoppinglistdomain->setActive($row["active"]);
        $shoppinglistdomain->setName($row["name"]);
        $shoppinglistdomain->setid($row["id"]);
        $shoppinglistdomain->setUpdated($row["updated"]);
        $shoppinglistdomain->setItems($this->transformListItemsToObjects($listitems));
        
        return $shoppinglistdomain;
        
    }
    
    private function transformListItemsToObjects($itemsarray){
        
        $items = [];
        
        foreach($itemsarray as $itemrow){
            
            $item = new itemdomain();
            $item->setName($itemrow["name"]);
            $item->setID($itemrow["id"]);
            $item->setPrice($itemrow["price"]);
            $item->setShop($itemrow["shop"]);
            $item->setBuyer($this->getItemBuyerByItemBuyerID($itemrow["buyerID"]));            
            $item->setIsBought($itemrow["bought"]);
            
            $items[] = $item;          
            
        }
        
        return $items;
    }
    
    /**
     * Returns the name of the user who bought the item. If 
     * item is unbought or if the buyerID is not found in users table returns 
     * an empty string
     * 
     * @param type $buyerID the buyerID of item
     */
    private function getItemBuyerByItemBuyerID($buyerID){
        
        if(is_null($buyerID)){
            return "";
        } else {
            
            $sql = $this->db->prepare("SELECT * FROM shoppinglist_users AS a "
                    . "                 WHERE a.id = :id");
            $sql->bindValue(":id", $buyerID, PDO::PARAM_INT);
            
            if($sql->execute()){
                
                $row = $sql->fetch(PDO::FETCH_ASSOC);
                $name = $row["username"];
                return $name;
                
            } else {
                
                return "";
                
            }
        }
    }
    
    public function deleteItemFromList($id){
        $sql = $this->db->prepare("DELETE FROM shoppinglist_items_to_lists_ref "
                                . "WHERE itemid = :id");
        $sql->bindValue(":id", $id, PDO::PARAM_STR);
        
        return($sql->execute());
    }
    
    public function addItemToList($listId){
        
        $name       = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
        $price      = filter_input(INPUT_POST, "price", FILTER_SANITIZE_NUMBER_INT);
        $shop       = filter_input(INPUT_POST, "shop", FILTER_SANITIZE_STRING);
        $bought    = filter_input(INPUT_POST, "bought", FILTER_SANITIZE_STRING);
        
        if($this->areValidItemValues($name, $price, $shop)){

            $sql = $this->db->prepare("INSERT INTO shoppinglist_items (name, shop, price, bought) VALUES "
                    . "(:name, :shop, :price, :bought)");

            $sql->bindValue(":name", $name, PDO::PARAM_STR);
            $sql->bindValue(":shop", $shop, PDO::PARAM_STR);
            $sql->bindValue(":price", $price, PDO::PARAM_INT);
            $sql->bindValue(":bought", $bought, PDO::PARAM_STR);

            if($sql->execute()){

                $bindsql = $this->db->prepare("INSERT INTO shoppinglist_items_to_lists_ref (itemid, shoppinglistid) VALUES "
                        . "(:itemid, :shoppinglistid)");

                $itemid = $this->db->lastInsertId();

                $bindsql->bindValue(":itemid", $itemid, PDO::PARAM_INT);
                $bindsql->bindValue(":shoppinglistid", $listId, PDO::PARAM_INT);

                return $bindsql->execute();

            }
            
        } else { //item values weren't valid
            
            return FALSE;
            
        }
        
    }
    
    public function areValidItemValues($name, $price = NULL, $shop = NULL){
        
        $ok = TRUE;
        
        if(!isset($name) || strlen($name) < 1){
            
            $ok = FALSE;
            
        }
        
        if(isset($price) && $price < 0){
            
            $ok = FALSE;
            
        }
        
        if(isset($shop) && strlen($shop) < 0){
            
            $ok = FALSE;
            
        }
        
        return $ok;
    }
    
    
}
