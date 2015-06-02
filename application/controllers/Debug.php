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
    
    public function testarcookie(){
        echo $_COOKIE['user_email'];
        echo $_COOKIE['user_senha'];
    }
    
    public function testarsession(){
        echo $_SESSION['user_email'];
        echo $_SESSION['user_senha'];
    }
    
    public function testarRegex(){
       $str = "João da Silva";
      // $result =  preg_match('/^[A-Za-zá-úÁ=Ú.\s0-9 ]+$/i', $str);
       echo "$result";  
    }
}

