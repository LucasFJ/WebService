<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index(){
      
    }
    
    public function testarstatus(){
        echo "Resultado do método: verificarLogin() da biblioteca: Status <br/>";
        if($this->status->verificarLogin()){
            echo "verdadeiro";
        }
        else {
            echo "falso";
        }
    }
}

