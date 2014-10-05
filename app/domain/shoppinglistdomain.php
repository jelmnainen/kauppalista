<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shoppinglistdomain
 *
 * @author sanho
 */
class shoppinglistdomain {
    
    private $name;
    private $active;
    private $id;
    private $updated;
    private $items;

    public function getName(){
        return $this->name;
    }

    public function getActive(){
        return $this->active;
    }
    
    public function getID(){
        return $this->id;
    }
    
    public function getUpdated(){
        return $this->updated;
    }
    
    public function getItems(){
        return $this->items;
    }

    /*** SETTERS ***/
    
    public function setName($name){
        $this->name = $name;
    }

    public function setActive($active){
        $this->active = $active;
    }
    
    public function setId($id){
        $this->id = $id;
    }

    public function setUpdated($updated){
        $this->updated = $updated;
    }
    
    public function setItems($newItems){
        $this->items = $newItems;
    }

}
