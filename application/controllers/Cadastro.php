<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro extends CI_Controller{
 
   public function __construct() {
       parent::__construct();
       if($this->status->verificarLogin()){
            redirect('home');
       }
       $this->load->model('cadastro_model', 'cadmodel');
   }
    
    public function index($msgErro = " "){ 
        $mensagem_erro = " ";
        switch($msgErro){
            case "nomeinvalido": $mensagem_erro = "O nome inserido é inválido";
                break;
            case "sobrenomeinvalido": $mensagem_erro = "O sobrenome inserido é inválido";
                break;
            case "emailinvalido": $mensagem_erro = "O email inserido é inválido";
                break;
            case "generoinvalido": $mensagem_erro = "Selecione um gênero";
                break;
            case "repetesenhainvalida": $mensagem_erro = "O campo de senha não é igual ao de confirmar senha";
                break;
            case "senhainvalida": $mensagem_erro = "A senha inserida é inválida";
                break;
            case "nascimentoinvalido": $mensagem_erro = "A data de nascimento inserida é inválido";
                break;
            case "termosinvalido": $mensagem_erro = "É necessário aceitar os termos de uso";
                break;
            case "emailindisponivel": $mensagem_erro = "O email inserido já se encontra cadastrado";
                break;
        }
        $dados = array('mensagem_erro' => $mensagem_erro);
        $dados['css'] = array('cadastro.css');
        $this->load->view('include/head_view', $dados);
        $this->load->view('include/headeroff_view');
        $this->load->view('cadastro/cadastro_view', $dados);
        $this->load->view('include/footer_view');          
    }
    
    public function sucesso(){
        $dados['css'] = array('cadastro.css');
        $this->load->view('include/head_view', $dados);
        $this->load->view('include/headeroff_view');
        $this->load->view('cadastro/sucesso_view');
        $this->load->view('include/footer_view');
    }
    
    public function POSTcadastro(){
        if(isset($_POST['CadastroUsuario'])){
            $nome = trim($_POST['nome']);
            $sobrenome =  trim($_POST['sobrenome']);
            $email =  trim($_POST['email']);
            $genero =  trim($_POST['genero']);
            $senha =  trim($_POST['senha']);
            $repeteSenha =  trim($_POST['repeteSenha']);
            $nascimento =  trim($_POST['nascimento']);
            $concorda =  trim($_POST['concorda']); //recebe 'on' se selecionado
            //iniciando a classe de validação
            $this->load->library("validacao");
            if(!$this->validacao->ValidNome($nome)){
                redirect("cadastro/index/nomeinvalido");
            } elseif(!$this->validacao->ValidNome($sobrenome)) {
                redirect("cadastro/index/sobrenomeinvalido");
            } elseif(!$this->validacao->ValidEmail($email)){
                redirect("cadastro/index/emailinvalido");
            } elseif($genero != 1 && $genero != 2) {
                redirect("cadastro/index/generoinvalido");
            } elseif(!$this->validacao->ValidSenha($senha)) {
                redirect("cadastro/index/senhainvalida");
            } elseif($senha != $repeteSenha){
                redirect("cadastro/index/repetesenhainvalida");
            } elseif(!$this->validacao->ValidDataNascimento($nascimento)){
                redirect("cadastro/index/nascimentoinvalido");
            } elseif($concorda != "on"){
                redirect("cadastro/index/termosinvalido");
            } elseif(!$this->cadmodel->cadastrarConta($email, $senha, $nome, $nome, $nascimento, $genero)) {
                redirect("cadastro/index/emailindisponivel");   
            } else {
                redirect("cadastro/sucesso");
            }
        } else {
            redirect('login');
        }
    }
}
