<?php


/**
 * Description of register
 *
 * @author sanho
 */
class register extends controllerbase {

    protected function index(){
        $output = $this->model->index();
        $this->display($output, TRUE);
    }
    
    protected function processRegisteration(){
        $output = $this->model->processRegisteration();
        $this->display($output, TRUE);
    }
       
}
