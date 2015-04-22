<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    public function index(){
        $dados_header = array('possuiNav' => true);
        
        $this->load->view('include/head_view');
        $this->load->view('include/header_view', $dados_header);
        
        
        $this->load->view('include/footer_view');
    }
    
    
 
}

