<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Debug extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('buscacep');
    }
    
    public function index(){
        $resultado = array('logradouro' => '', 'bairro' => '', 'cidade' => '', 'uf' => '');
        
        if(isset($_POST['cep'])){
            
            $resultado = $this->buscacep->fazerConsulta($_POST['cep']);
            
        }
        
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
            $this->load->view('debug/debug_view', $resultado);
        $this->load->view('include/footer_view');
        
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

