<?php

/**
 * Provides database services for users in shoppinglists
 *
 * @author sanho
 */

global $CONFIG;
include_once($CONFIG["homedir"] . "domain/userdomain.php");


class userservice {
    
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    public function searchForUsersNotInList($listid_unsafe){
        
        $userarray = [];
        
        $username   = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $listid     = filter_var($listid_unsafe, FILTER_VALIDATE_INT);
        
        $sql = $this->db->prepare("SELECT id, username "
                . "FROM shoppinglist_users "
                . "WHERE username LIKE :username "
                . "AND id NOT IN ( "
                . " SELECT b.id "
                . " FROM shoppinglist_collaborators_to_lists_ref AS a "
                . " INNER JOIN shoppinglist_users AS b "
                . " ON b.id = a.userid "
                . " WHERE a.shoppinglistid = :listid) ");
        
        $sql->bindValue(":username", "%" . $username . "%", PDO::PARAM_STR);
        $sql->bindValue(":listid", $listid, PDO::PARAM_INT);
        
        if($sql->execute()){
            
            $rows = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            foreach($rows as $row){
                
                if(!($row["id"] === $_SESSION["user"]["id"])){
                    
                    $userarray[] = $this->transformUserRowToObject($row);
                
                }
            }
            
        }
        
        return $userarray;
        
    }
    
    public function removeCollaboratorByIDFromListByID($userid_unsafe, $listid_unsafe){
        
        $userid = filter_var($userid_unsafe, FILTER_VALIDATE_INT);
        $listid = filter_var($listid_unsafe, FILTER_VALIDATE_INT);
        
        $sql = $this->db->prepare("DELETE FROM shoppinglist_collaborators_to_lists_ref "
                . "WHERE userid = :userid AND shoppinglistid = :listid ");
        
        $sql->bindValue(":userid", $userid, PDO::PARAM_INT);
        $sql->bindValue(":listid", $listid, PDO::PARAM_INT);
        
        return $sql->execute();
    }
    
    
    public function getListCollaboratorsByListID($unsafe_listid){
        $listid = filter_var($unsafe_listid, FILTER_VALIDATE_INT);
        
        $sql = $this->db->prepare("SELECT b.username, b.id "
                . "FROM shoppinglist_collaborators_to_lists_ref AS a "
                . "INNER JOIN shoppinglist_users AS b "
                . "ON b.id = a.userid "
                . "WHERE a.shoppinglistid = :listid ");
        
        $sql->bindValue(":listid", $listid, PDO::PARAM_INT);
        
        $returnedusers = [];
        
        if( $sql->execute() ){
            
            $rows = $sql->fetchAll();
            
            foreach($rows as $row){
                
                $returnedusers[] = $this->transformUserRowToObject($row);
                
            }
            
            return $returnedusers;
            
        }
    }
    
    public function transformUserRowToObject($row){
        
        $user = new Userdomain();
        
        $user->setUsername($row["username"]);
        $user->setID($row["id"]);
        
        return $user;
        
    }
    
    public function addUserByIDAsCollaborator($userID_unsafe, $listID_unsafe){
        $userID = filter_var($userID_unsafe, FILTER_VALIDATE_INT);
        $listID = filter_var($listID_unsafe, FILTER_VALIDATE_INT);
        
        $sql = $this->db->prepare("INSERT INTO shoppinglist_collaborators_to_lists_ref (userid, shoppinglistid) VALUES (:userid, :listid) ");
        $sql->bindValue(":userid", $userID, PDO::PARAM_INT);
        $sql->bindValue("listid", $listID, PDO::PARAM_INT);
        
        return $sql->execute();
    }
            
    
}