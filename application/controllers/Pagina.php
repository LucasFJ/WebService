<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    public function index(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        if($_SESSION['is_dono'] == true){
               $this->load->view('pagina/minhapagina_view');
        }
        else{
            $this->load->view('pagina/criarpagina_view');
        }
        $this->load->view('include/footer_view');
    }
    
    public function configuracoes(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('pagina/comentarios_view');
        $this->load->view('include/footer_view');
    }

}

