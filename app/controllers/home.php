<?php

/**
 * This controller handles the general pages, such as landingpage
 * and info page
 */
class home extends controllerbase{
    
    /**
     *Landing page is a static page at this point so.
     */
    protected function index(){
        $this->display();
    }  
    
    protected function info(){
        $this->display();
    }
    
}