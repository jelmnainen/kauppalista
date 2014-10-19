<?php

/**
 * Description of userdomain
 *
 * @author johannes
 */
class userdomain {
    
    protected $username;
    protected $id;
    
    public function setUsername($username)
            {
        if(is_string($username)){
            $this->username = $username;
        }
    }
    
    public function setID($id){
        
            $this->id = (int)$id;
            
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getID(){
        return $this->id;
    }
    
}
