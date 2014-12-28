<?php

class home extends controllerbase{
    
    protected function index(){
        $output = $this->model->index();
        $this->display($output, true);
    }  
    
    protected function info(){
        $output = $this->model->info();
        $this->display($output);
    }
    
    protected function login(){
        $output = $this->model->login();
        $this->display($output, true);
    }
    
    //test if login script denies access to non-logged-in visitors
    protected function membersonly(){
        
        if($this->user_is_logged_in()){
          
            $output = $this->model->membersonly();
            $this->display($output, true);

        } else {

            $this->show_loginpage();
        
        }
        
    }
    
}