<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{

    public function __construct() {
        parent::__construct();
        if($this->status->verificarLogin()){
            redirect('home');
        }
    }
    
    public function index(){
        
    }
}

