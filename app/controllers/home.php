<?php

class home extends controllerbase{
    
    protected function index(){
        $output = $this->model->index();
        $this->display($output, true);
    }  
    
    protected function login(){
        $output = $this->model->login();
        $this->display($output, true);
    }
    
}