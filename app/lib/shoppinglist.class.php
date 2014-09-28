<?php

/**
 * Description of shoppinglist
 *
 * @author sanho
 */
class shoppinglist {
    
    private $items;
    private $owner;
    private $collaborators;
    
    public function __construct($owner, $collaborators = [], $items = []){
        
        $this->owner            = $owner;
        $this->collaborators    = $collaborators;
        $this->items            = $items;
        
    }
    
    public function getOwner(){
        return $this->owner;
    }
    
    public function getItems(){
        return $this->items;
    }
    
    public function getCollaborators(){
        
    }
            
}
