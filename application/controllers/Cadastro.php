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
        $this->form_validation->set_rules('nome', 'nome', 'required|alpha');
        $this->form_validation->set_rules('sobrenome', 'sobrenome', 'required|alpha');
        $this->form_validation->set_rules('email', 'e-mail', 'required|valid_email');
        $this->form_validation->set_rules('genero', 'gênero', 'required|is_natural_no_zero');
        $this->form_validation->set_message('is_natural_no_zero', 'Selecione um gênero.');
        $this->form_validation->set_rules('senha', 'senha', 'required');
        $this->form_validation->set_rules('repeteSenha', 'confirmar senha', 'required|matches[senha]');
        $this->form_validation->set_rules('nascimento', 'data de nascimento', 'required');
        $this->form_validation->set_rules('concorda', 'concordar com os termos de uso', 'required');
        
        $mensagem_erro = '';
        $nome = '';
        $sobrenome = '';
        $email = '';
        
        if($this->form_validation->run()){

            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $email = $_POST['email'];
            $resultado = $this->cadmodel->cadastrarConta($_POST['email'], 
                    $_POST['senha'], $_POST['nome'], $_POST['sobrenome'],
                    $_POST['nascimento'], $_POST['genero']);
            if($resultado) {
                redirect('login');
            } else {
                $mensagem_erro = 'O e-mail informado já se encontra cadastrado!';
                echo "<script> alert('$mensagem_erro'); </script>";
            }
        } 
        
       echo validation_errors(); 
       
       $dados = array('conteudo_nome' => $nome,
           'conteudo_sobrenome' => $sobrenome, 
           'conteudo_email' => $email);
       $this->load->view('cadastro/cadastro_view', $dados);
       $this->load->view('include/footer_view');
    }
    
    public function sucesso(){
        $this->load->view('cadastro/sucesso_view');
        $this->load->view('include/footer_view');
    }
}
