<?php

class home extends controllerbase{
    
    protected function index(){
        $output = $this->model->index();
        $this->display($output, true);
    }  

    
}