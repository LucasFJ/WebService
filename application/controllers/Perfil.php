<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
        $this->load->model('usuario_model', 'usermod');
    }
    
    public function index(){
        redirect('perfil/informacoes');
    }
    
    public function informacoes($msgErro = "", $msgSucesso = ""){
        $mensagem_erro = " ";
        switch($msgErro){
            case "repeteinvalido":  $mensagem_erro = "O campo de confirmar senha não está igual ao de nova senha.";
                break;
            case "atualinvalido":  $mensagem_erro = "Campo de senha atual inválido.";
                break;
            case "novainvalido":  $mensagem_erro = "Campo de nova senha inválido.";
                break;
            case "atualincorreta":  $mensagem_erro = "a senha atual está incorreta.";
                break;
            case "verificaremail":  $mensagem_erro = "Para criar uma página é preciso validar seu e-mail.";
                break;
        }
        $mensagem_sucesso = " ";
        switch ($msgSucesso){
            case "alteracaosucesso":  $mensagem_sucesso = "Senha alterada com sucesso.";
                break;
            case "verificacaosucesso":  $mensagem_sucesso = "Seu e-mail foi verificado com sucesso. Você já pode criar uma página se desejar.";
                break;
        }
        $dados = $this->usermod->CarregarDadosUsuario();
        $dados['mensagem_erro'] = $mensagem_erro;
        $dados['mensagem_sucesso'] = $mensagem_sucesso;
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('perfil/informacoes_view', $dados);
        $dados_footer = array('javascript' => array('jquery.form.js', 'crudusuario_req.js'));
        $this->load->view('include/footer_view', $dados_footer);
    }
    
    public function POSTalterarsenha(){
        if(isset($_POST["AlterarSenha"])){
            $this->load->library("validacao");
            $senhaAtual = trim($_POST["senha-atual"]);
            $novaSenha = trim($_POST["senha-nova"]);
            $repeteSenha = trim($_POST["senha-repete"]);
            $codigoPagina = trim($_POST["codigoUsuario"]);
            if($novaSenha != $repeteSenha){
                redirect("perfil/informacoes/repeteinvalido");
            } elseif (!$this->validacao->ValidSenha($senhaAtual)){
                redirect("perfil/informacoes/atualinvalido");
            } elseif (!$this->validacao->ValidSenha($novaSenha)){
                redirect("perfil/informacoes/novainvalido");
            } else {
                echo "$codigoPagina,$senhaAtual, $novaSenha";
                $resposta = $this->usermod->AlterarSenha($codigoPagina, $senhaAtual, $novaSenha);
                if($resposta){
                    $_SESSION['user_senha'] = md5($novaSenha);
                    redirect("perfil/informacoes/none/alteracaosucesso");
                } else {
                    redirect("perfil/informacoes/atualincorreta");
                } 
            }
        } else {
            redirect("perfil/informacoes");
        }
    }
}

