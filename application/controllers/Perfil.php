<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    public function index(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('perfil/informacoes_view');
        $this->load->view('include/footer_view');
    }
    
    public function informacoes(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('perfil/informacoes_view');
        $this->load->view('include/footer_view');
    }
    

}

