<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Processos extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->model('processo_model', 'process');
    }
    
    //OBSERVAÇÃO: como apenas é possivel acessar o controller com os dois dados
    //e url corretos, a função index apenas irá redirecionar o usuário para a home
    public function index(){
        redirect('home');
    }
    
    public function verificacao($codigo_processo = false, $codigo_chave = false){
        if(is_numeric($codigo_processo)  && $codigo_chave){
            //Impedindo SQL injection
            $codigo_chave = html_escape($codigo_chave);
            $codigo_processo = html_escape($codigo_processo);
            $codigo_chave = addslashes($codigo_chave);
            $codigo_processo = addslashes($codigo_processo);
            
            $resultado = $this->process->RealizarVerificacao($codigo_processo, $codigo_chave);
            if($resultado) {
                redirect("perfil/informacoes/none/verificacaosucesso");
            } else { //A validação não ocorreu
                redirect('home');
            }
        } else { // algum dos dois parametros nao foi enviado
            redirect('home');
        }
    }
    
    public function recuperacao($codigo_processo = " ", $codigo_chave =" ", $msgErro = " "){
        $dados = array('mensagem_erro' => '');
        if(is_numeric($codigo_processo)  && $codigo_chave){
            $mensagem_erro = " ";
            switch ($msgErro){
                case "senhainvalida": $mensagem_erro = "A senha escolhida é inválida";
                    break;
                case "repetesenhainvalida": $mensagem_erro = "O campo de senha não é igual ao de confirmar senha";
                    break;
                case "processoinvalido": $mensagem_erro = "O processo ja foi utilizado ou a URL foi modificada";
                    break;
                
            }
            $codigo_chave = html_escape(addslashes($codigo_chave));
            $codigo_processo = html_escape(addslashes($codigo_processo));
            $dados = array("mensagem_erro" => $mensagem_erro,
                "codigoProcesso" => $codigo_processo, 
                'chaveProcesso' => $codigo_chave);
            $dados['css'] = array('login.css');
            $this->load->view('include/head_view', $dados); 
            $this->load->view('include/headeroff_view');
            $this->load->view('processos/mudarsenha_view', $dados);
            $this->load->view('include/footer_view');
        } else { // algum dos dois parametros nao foi enviado
            redirect('home');
        }
        
    }

    public function POSTrecuperacao(){
        if(isset($_POST["AlterarSenha"])){
            $this->load->library("validacao");
            $senha = $_POST['senha'];
            $repeteSenha = $_POST['repeteSenha'];
            $codigoProcesso = $_POST['codigoProcesso'];
            $chaveProcesso  = $_POST['chaveProcesso'];
            echo str_replace(".", "%2E", $chaveProcesso);
            if(!$this->validacao->ValidSenha($senha)){
                redirect("processos/recuperacao/$codigoProcesso/$chaveProcesso/senhainvalida");
            } elseif($senha != $repeteSenha){
                redirect("processos/recuperacao/$codigoProcesso/$chaveProcesso/repetesenhainvalida");
            } elseif(!$this->process->RealizarRecuperacao($codigoProcesso, $chaveProcesso, $senha)){
               redirect("processos/recuperacao/$codigoProcesso/$chaveProcesso/processoinvalido");
            } else {
                redirect("login");
            }
        } else {
            redirect("login");
        }
    }
    
    public function excluir($codigo_processo = false, $codigo_chave = false){
        if(is_numeric($codigo_processo)  && $codigo_chave){
            //Impedindo SQL injection
            $codigo_chave = html_escape($codigo_chave);
            $codigo_processo = html_escape($codigo_processo);
            $codigo_chave = addslashes($codigo_chave);
            $codigo_processo = addslashes($codigo_processo);
            $dados = array("mensagem_erro" => "");
            
            if(isset($_POST['excluir'])){
                $desejaExcluir = $_POST['excluir'];
                if($desejaExcluir == 1){
                    $resultado = $this->process->RealizarExclusaoPagina($codigo_processo, $codigo_chave);
                    if($resultado){
                        redirect('login');
                    } else {
                        $dados["mensagem_erro"] = "Ocorreu um erro ou o processo não existe mais.";
                    }
                } else {
                    $resultado = $this->process->CancelarProcesso($codigo_processo, $codigo_chave);
                    if($resultado){
                        redirect('login');
                    } else {
                        $dados["mensagem_erro"] = "Ocorreu um erro ou o processo não existe mais.";
                    }
                }
            }
            if(!$this->status->verificarLogin()){
            //redirect('login');
            $dados['css'] = array('login.css');
            $this->load->view('include/head_view', $dados);
            $this->load->view('include/headeroff_view');
            } else {
            $this->load->view('include/head_view');
            $this->load->view('include/header_view');
            }
            $this->load->view('processos/excluirpagina_view', $dados);
            $this->load->view('include/footer_view');
        //INSERIR A VIEW COM INPUT DE NOVA SENHA E CONFIRMAR NOVA SENHA
        } else { // algum dos dois parametros nao foi enviado
            redirect('home');
        }
    }
}
