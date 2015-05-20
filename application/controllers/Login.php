<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
 
    public function __construct() {
        parent::__construct();
        if($this->status->verificarLogin()){
            redirect('home');
        }
        $this->load->model('login_model','logmodel');
        $this->load->library('form_validation');
    }
    
    public function index(){
        $mensagem_erro = '';
        $login = "";
        //verificando se foram enviados os valores de login ou senha via POST
        if( isset($_POST['email']) && isset($_POST['senha'])){
            //definindo as regras de validação e executando
            $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
            $this->form_validation->set_rules('senha', 'Senha', 'required');
            if($this->form_validation->run()){
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                $login = $email;
                
                $resultado = $this->logmodel->efetuarLogin($email, $senha);
                if($resultado){
                    redirect('home');

                } else { // erro durante a verificação de login e senha
                echo "<script> alert('E-mail ou senha incorretos'); </script>";
                $mensagem_erro = "E-mail ou senha incorreto";
                }
            } // erro durante a validação dos formulários
        } // email ou senha se encontram vazios
       
       $dados = array('mensagem_erro' => $mensagem_erro, 
           'conteudo_login' => $login); 
       $this->load->view('login/login_view', $dados);
       $this->load->view('include/footer_view');
    }
    
    public function recuperar(){
       $this->load->view('login/recuperar_view');
       $this->load->view('include/footer_view');
        
    }
} /* EXIBIÇÃO DE ERROS:
 *   --> De acordo com o a form_validation: validation_errors();
 *      *OBS: retorna uma array, logo pode exibir mais de uma linha de erros;
 *   --> De acordo com a chamada da $mensagem_erro que exibe falhas lógicas como
 *       a incompatibilidade de dados no banco de dados;
 *   --> Implementação de uma verificação javascript.
 */
