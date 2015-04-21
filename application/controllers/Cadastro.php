<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller{
 
   public function __construct() {
       parent::__construct();
       if($this->status->verificarLogin()){
            redirect('home');
       }
   }
    
    public function index(){   
       $this->load->view('cadastro/cadastro_view');
       $this->load->view('include/footer_view');
    }
}