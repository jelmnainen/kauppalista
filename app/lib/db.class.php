<?php

/*
 * The class handels database related functions
 */

class db {
    
    private $dbh;
    private $error;
    
    
    /*
     * 
     * Try to create a new PDO DB connection
     * 
     * @dbconfig array containing 
     *      'dsn':      db data source name
     *      'username': db username
     *      'password': db password
     */
    public function __construct( $dbconfig ){        
        
        $options = array(
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        try{
            
            $this->dbh = new PDO(
                    $dbconfig["dsn"], 
                    $dbconfig["username"], 
                    $dbconfig["passowrd"],
                    $options
                );
                    
        } catch (Exception $ex) {

        }
        
    }
    
            
}
