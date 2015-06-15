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
    
    public function POSTfaleconosco(){
        if(isset($_POST["EnviarContato"])){
            $this->load->library("validacao");
            $this->load->library("sender");
            $nome = trim($_POST["nome"]);
            $email = trim($_POST["email"]);
            $assunto = trim($_POST["assunto"]);
            $mensagem = trim($_POST["mensagem"]);
            
            if(!$this->validacao->ValidNome($nome)){
                redirect("contato/faleconosco");
            } elseif(!$this->validacao->ValidEmail($email)) {
                redirect("contato/faleconosco");
            } elseif(!$this->validacao->ValidNome($assunto)){
                redirect("contato/faleconosco");
            } elseif(!$this->validacao->ValidMensagemContato($mensagem)){
                redirect("contato/faleconosco");
            } elseif(!$this->sender->Contato($nome, $assunto, $email,$mensagem)){
                redirect("contato/faleconosco");
            } else {
                redirect("home");
            }
        } else {
            redirect("contato/faleconosco");
        }
    }
    public function termosdeuso(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('contato/termosdeuso_view');
        $this->load->view('include/footer_view');
    }
}

