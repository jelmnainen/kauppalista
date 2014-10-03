<?php

class loginmodel extends modelbase {
    
    public function index(){
        
        return "";
        
    }
    
    /**
     * Process login form, log user in if credentials are ok
     */
    public function processLogin(){
        
        $input = $this->processLoginInput();
        
        //we need exactly 2 items
        if(count($input) == 2){
            
            if($this->attemptLogin($input)){
                
                return TRUE;
                
            } else {
                
                return FALSE;
                
            }
            
        }
    }
    
    public function processLogout(){
        unset($_SESSION["user"]);
        return TRUE;
    }
  
    
    /**
     * Used to safely process the login input
     * 
     * @return array of safe login inputs
     */
    private function processLoginInput(){
        
        $input = [];
        
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        
        //DB doesn't have usernames or passwords under 3 charchters long
        //  -see /models/registermodel.php
        //also now we don't need to worry about null values etc
        if( strlen($username) > 3 && strlen($password) > 3 ){
            
            $input["username"] = $username;
            $input["password"] = $password;
            
        }
        
        return $input;
        
    }
    
    /**
     * Checks inputted password against inputted user's stored password
     */
    private function attemptLogin($input){
        
        global $CONFIG;
        
        $salt = "";
        
        $sql = $this->db->prepare("     SELECT *"
                                    . " FROM shoppinglist_users"
                                    . " WHERE username = :username");
        
        $sql->bindValue(":username", $input["username"], PDO::PARAM_STR);
        
        if($sql->execute()){
            
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            //hash password
            $input["password"] = hash(  'sha256', 
                                        $input["password"] . $row["salt"]
                    );
            
            //check if passwords match
            if($input["password"] === $row["password"] ) {
                
                //get sensitive information out of $row 
                //and make user known to session
                unset($row["password"]);
                unset($row["salt"]);
                $_SESSION["user"] = $row;
                
                return TRUE;
                
            } else { // passwords didn't match
                
                return FALSE;
                
            }
            
        } else { //SQL didn't fire
            
            return FALSE;
            
        }
        
    }
    
    
}
