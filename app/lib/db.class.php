<?php

/*
 * The class handels database related functions
 */

class db {
    
    public $conn;
    public $error;
    
    /*
     * 
     * Try to create a new PDO DB connection
     * 
     * @param dbconfig array containing 
     *      'dsn':      db data source name
     *      'username': db username
     *      'password': db password
     */
    public function __construct( $dbconfig ){      
        
        try{
            
            $this->conn = new PDO($dbconfig["dsn"], $dbconfig["username"], $dbconfig["password"]);
            
            //set errmode to exception to get all the juicy bits
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    
        } catch (PDOException $e) {
            
            $this->error = $e;

        }
        
    }
    
    public function getConn(){
        
        return $this->conn;
        
    }
    
}
