<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author johannes
 */
class login extends controllerbase {

    protected function index(){
        $output = $this->model->index();
        $this->display($output, TRUE);
    }
    
    protected function processLogin(){
        $output = $this->model->processLogin();
        $this->display($output, TRUE);
    }
    
    protected function logout(){
        $output = $this->model->processLogout();
        $this->display($output, TRUE);
    }
    
}
