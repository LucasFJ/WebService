<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
        $this->load->model('pagina_model', 'pagmod');
    }
    
    //REDIRECIONA O USUARIO PARA AS AÇÕES DE Configuracoes OU Cadastrar
    public function index(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        if($_SESSION['is_dono'] == true){
               redirect('pagina/configuracoes');
        }
        else{
            redirect('pagina/cadastrar');
        }
        $this->load->view('include/footer_view');
    }
    
    //PERMITE AO USUÁRIO VISUALIZAR ALGUMA PAGINA ATRAVÉS DE UM CODIGO PASSADO
    //PELA URL.
    public function visualizar($codigo = false){
        $codigo = hexdec($codigo);
        if($codigo && is_numeric($codigo) && $codigo > 0){
             $dados_pagina = $this->pagmod->CarregarDadosPagina($codigo);
             //$dados_pagina['produtos'] = $this->pagmod->CarregarProdutosPagina($codigo);
            // print_r($dados_pagina);
             $this->load->view('include/head_view');
             $this->load->view('include/header_view');
             $this->load->view('pagina/pagina_view', $dados_pagina);
             $this->load->view('include/footer_view');
        } else { // nenhum valor foi passado pela url
            redirect('home');
        }
    }
    //PERMITE AO USUÁRIO CRIAR UMA NOVA PAGINA VINGULADA A SUA CONTA
    public function cadastrar(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->library('form_validation');
        
        if(isset($_POST['Cadastrar']) && !empty($_POST['codigo_cep'])){
            $nome =     isset($_POST['nome']) ? $_POST['nome'] : false;
            $ramo =     isset($_POST['ramo']) ? $_POST['ramo'] : false;
            $slogan =   isset($_POST['slogan']) ? $_POST['slogan'] : false;
            $site =     isset($_POST['site']) ? $_POST['site'] : false;
            $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : false;
            $cep =      isset($_POST['codigo_cep']) ? $_POST['codigo_cep'] : false;
            $numero =   isset($_POST['numero']) ? $_POST['numero'] : false;
            $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : false;
            $layout =   isset($_POST['layout']) ? $_POST['layout'] : false;
            $contato1 = isset($_POST['contato1']) ? $_POST['contato1'] : false;
            $contato2 = isset($_POST['contato2']) ? $_POST['contato2'] : false;
            $imagem =   $_FILES['imagem'] ;
            
            
            $resultado = $this->pagmod->CadastrarPagina($nome, $ramo, $slogan , 
            $site, $descricao, $cep, $numero, $complemento, $layout, $contato1, $contato2, $imagem);
            
            if($resultado){
                echo "O cadastro foi finalizado e a tela de sucesso será enviada para cá";
            } else {
               echo "O cadastro não foi efetuado e deve ser informado o motivo para tal";
           }
        } else {
            $dados_preload = $this->pagmod->CarregarBoxLayoutRamo();
            $dados = array('opcoes_ramo' => $dados_preload['opcoes_ramo'], 
                'opcoes_layout' => $dados_preload['opcoes_layout'] );
            $this->load->view('pagina/criarpagina_view', $dados);
        }
        $this->load->view('include/footer_view');
    }
    //MOSTRA A PAGINA CUJO PROPRIETÁRIO ADMINISTRA
    public function minhapagina(){
        //MEdida provisoria, o usuario visualiza a propria pagina
        $codigo = $this->pagmod->CarregarPaginaProprietario();
        if($codigo){
             $dados_pagina = $this->pagmod->CarregarDadosPagina($codigo);
            // print_r($dados_pagina);
             $this->load->view('include/head_view');
             $this->load->view('include/header_view');
             $this->load->view('pagina/minhapagina_view', $dados_pagina);
             $this->load->view('include/footer_view');
        } else {
            redirect('home');
        }
    }
    
    public function configuracoes(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('pagina/configuracoes_view');
        $this->load->view('include/footer_view');
    }
    
    

}

