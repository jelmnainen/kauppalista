<?php

class home extends controllerbase{
    
    protected function index(){
        $output = "<h1>Jee!</h1>";
        $this->display($output, true);
    }  

    
}