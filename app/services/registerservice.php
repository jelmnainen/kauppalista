<?php

/**
 * Provides register controller with CRUD services
 *
 * @author sanho
 */
class registerservice {
    
    private $db;
    
    public function __construct($db){
        $this->db = $db;
    }
    
    
    public function processRegisteration(){
        
        //handle input
        $input = $this->getRegisterationInput();        
        
        //String to be returned
        $message = "";    
        
        //we don't tolerate input without all elements
        if(count($input) == 4){

            //if 
            if($input["password"] === $input["passwordRe"]){

                if($this->usernameIsUnique($input["username"])){

                    if($this->emailLooksValid($input["email"])){

                        if($this->createNewUser($input["username"],
                                                $input["password"],
                                                $input["email"])){

                            $message = "Uuden käyttäjän luonti onnistui!";

                        } else { //creating a new user failed

                            $message = "Uutta käyttäjää ei voitu luoda :(";
                        }

                    } else { //email wasn't valid

                    }

                } else { //username wasn't unique

                }

            } else { //passwords didn't match
                
            }
            
        } else { //All the variables weren't initialized
        
        } // end registeration process
        
        return $message;
        
        
    }
    
    
    /***********
     * HELPERS *
     ***********/
    
    //TODO
    private function usernameIsUnique($username){
        return true;
    }
    
    //TODO
    private function emailLooksValid($email){
        return true;
    }
    
    private function getRegisterationInput(){
        
        $input = [];
        
        $username   = filter_input( INPUT_POST, 
                                    "username", 
                                    FILTER_SANITIZE_STRING);
        
        $email      = filter_input( INPUT_POST,
                                    "email",
                                    FILTER_SANITIZE_EMAIL);
        
        $password   = filter_input( INPUT_POST,
                                    "password",
                                    FILTER_SANITIZE_STRING);
        
        $passwordRe = filter_input( INPUT_POST,
                                    "password-retype",
                                    FILTER_SANITIZE_STRING);  
        
        if (       strlen($username)    > 3 
                && strlen($email)       > 3
                && strlen($password)    > 3
                ) {
            
                    $input["username"]      = $username;
                    $input["email"]         = $email;
                    $input["password"]      = $password;
                    $input["passwordRe"]    = $passwordRe;
        }
        
        return $input;
        
    }
    
    /**
     * Function creates user a new salt and stores both user and salt in db.
     * Username, password and email are thought to be checked for everything
     * else besides SQL injection
     * 
     * @param type $username    desired username
     * @param type $password    desired password
     * @param type $email       desired email
     * @return boolean          true on db update success, false on failure
     */
    private function createNewUser($username, $password, $email){
        
        //generate random salt for user and apply it to password
        $salt = $this->getNewSalt();
        $password = hash('sha256', $password.$salt);
        
        $sql = $this->db->prepare("INSERT INTO shoppinglist_users("
                                    . "         username, "
                                    . "         email, "
                                    . "         password, "
                                    . "         salt"
                                    . ")"
                
                                    . "VALUES ( :username, "
                                    . "         :email, "
                                    . "         :password, "
                                    . "         :salt"
                                    . ")"
                );
        
        $sql->bindValue(":username",    $username,  PDO::PARAM_STR);
        $sql->bindValue(":email",       $email,     PDO::PARAM_STR);
        $sql->bindValue(":password",    $password,  PDO::PARAM_STR);
        $sql->bindValue(":salt",        $salt,      PDO::PARAM_STR);
        
        if($sql->execute()){
            
            return TRUE;
            
        } else {
            
            return FALSE;
            
        }
        
    }
    
    private function getNewSalt(){
        return dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
    }
}
    
    
    

