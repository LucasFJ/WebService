<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Contato extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    public function index(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('contato/sobrenos_view');
        $this->load->view('include/footer_view');
    }
    
    public function sobrenos(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('contato/sobrenos_view');
        $this->load->view('include/footer_view');
    }
    
    public function faleconosco(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('contato/faleconosco_view');
        $this->load->view('include/footer_view');
    }
    
    public function termosdeuso(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('contato/termosdeuso_view');
        $this->load->view('include/footer_view');
    }
}

