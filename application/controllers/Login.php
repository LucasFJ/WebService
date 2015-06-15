<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
 
    public function __construct() {
        parent::__construct();
        if($this->status->verificarLogin()){
            redirect('home');
        }
        $this->load->model('login_model','logmodel');
    }
    
    public function index($msgErro = " "){
       $mensagem_erro = " ";
       switch($msgErro){
           case "emailinvalido": $mensagem_erro = "O email inserido é inválido";
               break;
           case "senhainvalida": $mensagem_erro = "A senha inserida é inválida";
               break;
           case "combinacaoincorreta": $mensagem_erro = "A combinação está errada.";
               break;
       }
       $dados = array('mensagem_erro' => $mensagem_erro); 
       $this->load->view('login/login_view', $dados);
       $this->load->view('include/footer_view');
    }
    
    public function POSTindex(){
        if(isset($_POST["RealizarLogin"])){
            $this->load->library("validacao");
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            if(!$this->validacao->ValidEmail($email)){
                redirect("login/index/emailinvalido");
            } elseif(!$this->validacao->ValidSenha($senha)){
                redirect("login/index/senhainvalida");
            } elseif(!$this->logmodel->efetuarLogin($email, $senha)){
                redirect("login/index/combinacaoincorreta");
            } else {
                redirect("home");
            }
        } else {
            redirect("login");
        }
    }
    
    public function recuperar($msgErro = ""){
        $mensagem_erro = " ";
        switch($msgErro){
            case "emailinvalido": $mensagem_erro = "Digite um email válido";
                break;
            case "containvalida": $mensagem_erro = "O e-mail digitado se encontra cadastrado";
                break;
        }
       $dados = array('mensagem_erro' => $mensagem_erro);
       $this->load->view('login/recuperar_view', $dados);
       $this->load->view('include/footer_view');
    }
    
    public function POSTrecuperar(){
        if($_POST['RecuperarSenha']){
            $this->load->library("validacao");
            $this->load->model('processo_model', 'procmod');
            $email = $_POST['email'];
            if(!$this->validacao->ValidEmail($email)){
                redirect("login/recuperar/emailinvalido");
            } elseif(!$this->procmod->NovaRecuperacaoSenha($email)) {
                redirect("login/recuperar/containvalida");
            } else {
               redirect("login");
            }
        } else {
            redirect("login/recuperar");
        }
    }
    
} /* EXIBIÇÃO DE ERROS:
 *   --> De acordo com o a form_validation: validation_errors();
 *      *OBS: retorna uma array, logo pode exibir mais de uma linha de erros;
 *   --> De acordo com a chamada da $mensagem_erro que exibe falhas lógicas como
 *       a incompatibilidade de dados no banco de dados;
 *   --> Implementação de uma verificação javascript.
 */
