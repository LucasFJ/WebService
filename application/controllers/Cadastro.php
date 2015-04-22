<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller{
 
   public function __construct() {
       parent::__construct();
       if($this->status->verificarLogin()){
            redirect('home');
       }
       $this->load->model('cadastro_model', 'cadmodel');
       $this->load->library('form_validation');
   }
    
    public function index(){ 
        // SETANDO AS REGRAS DE VALIDAÇÃO DO FORM
        $this->form_validation->set_rules('nome', 'Nome', 'required|alpha');
        $this->form_validation->set_rules('sobrenome', 'Sobrenome', 'required|alpha');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('genero', 'Gênero', 'required|is_natural_no_zero');
        $this->form_validation->set_message('is_natural_no_zero', 'Selecione um gênero.');
        $this->form_validation->set_rules('senha', 'Senha', 'required');
        $this->form_validation->set_rules('repeteSenha', 'Confirmar senha', 'required|matches[senha]');
        $this->form_validation->set_rules('nascimento', 'Data de nascimento', 'required');
        $this->form_validation->set_rules('concorda', 'Concordar com os termos de uso', 'required');
        
        $mensagem_erro = '';
        if( isset($_POST['concorda'])){
            if($this->form_validation->run()){
                
                $resultado = $this->cadmodel->cadastrarConta($_POST['email'], 
                        $_POST['senha'], $_POST['nome'], $_POST['sobrenome'],
                        $_POST['nascimento'], $_POST['genero']);
                if($resultado) {
                    // CHAMAR VIEW DE SUCESSO DE CADASTRO!!
                }
            } 
        }
       $this->load->view('cadastro/cadastro_view');
       $this->load->view('include/footer_view');
    }
}