<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemmodel
 *
 * @author sanho
 */
class itemmodel extends modelbase {

    private $name;
    private $ID;
    private $price;
    private $shop;
    private $buyer;
    private $buyerID;
    private $isBought;
            
    
    public function getName(){
        return $this->name;
    }
    
    public function getPrice(){
        return $this->price;
    }
    
    public function getShop(){
        return $this->shop;
    }
    
    public function getBuyer(){
        return $this->buyer;
    }
    
    public function getBuyerID(){
        return $this->$buyerID;
    }
    
    public function getIsBought(){
        return $this->isBought;
    }
    
    public function getID(){
        return $this->ID;
    }
    
    public function setName($name){
        $this->name = $name;
    }
    
    public function setShop($shop){
        $this->shop = $shop;
    }
    
    public function setBuyer($name){
        $this->buyer = $name;
    }
    
    public function setBuyerID($id){
        $this->$buyerID = $id;
    }
    
    public function setIsBought($bool){
        $this->isBought = $bool;
    }
    
    public function setPrice($price){
        $this->price = $price;
    }
    
}
