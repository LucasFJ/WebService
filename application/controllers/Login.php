<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
 
    public function __construct() {
        parent::__construct();
        if($this->status->verificarLogin()){
            redirect('home');
        }
        $this->load->model('login_model','logmodel');
    }
    
    public function index(){
        $mensagem_erro = '';
        //verificando se foram enviados os valores de login ou senha via POST
        if( isset($_POST['email']) && isset($_POST['senha'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            $resultado = $this->logmodel->efetuarLogin($email, $senha);
            if($resultado){
                redirect('home');

            } else {
                echo "<script> alert('E-mail ou senha incorretos'); </script>";
                $mensagem_erro = "E-mail ou senha incorreto";
            }
        }
       
       $dados = array('mensagem_erro' => $mensagem_erro); 
       $this->load->view('login/login_view');
       $this->load->view('include/footer_view');
    }
    
}
