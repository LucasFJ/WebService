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
        if($codigo && is_numeric($codigo) && $codigo > 0){
             $dados = $this->pagmod->CarregarDadosPagina($codigo);
             $dados['proprietario'] = false; 
             //$dados_pagina['produtos'] = $this->pagmod->CarregarProdutosPagina($codigo);
            // print_r($dados_pagina);
             $this->load->view('include/head_view');
             $this->load->view('include/header_view');
             $this->load->view('pagina/pagina_view', $dados);
             $this->load->view('include/footer_view');
        } else { // nenhum valor foi passado pela url
            redirect('home');
        }
    }
    //PERMITE AO USUÁRIO CRIAR UMA NOVA PAGINA VINGULADA A SUA CONTA
    
    public function cadastrar($msgErro = " "){
        if($_SESSION['is_dono'] == true){
            redirect('home');
        }
        //validando erros
        $mensagem_erro = " ";
        switch ($msgErro){
            case "nomeinvalido": $mensagem_erro = "Insira um nome válido.";
                break;
            case "ramoinvalido": $mensagem_erro = "Escolha um ramo.";
                break;
            case "sloganinvalido": $mensagem_erro = "Insira um slogan válido.";
                break;
            case "siteinvalido": $mensagem_erro = "Insira uma url válida. Não utilize o http://.";
                break;
            case "descinvalido": $mensagem_erro = "Insira uma descrição válida.";
                break;
            case "cepinvalido": $mensagem_erro = "Insira um cep válido.";
                break;
            case "numeroinvalido": $mensagem_erro = "Número de endereço inválido.";
                break;
            case "compinvalido": $mensagem_erro = "Insira um complemento válido.";
                break;
            case "layoutinvalido": $mensagem_erro ="Escolha um layout.";
                break;
            case "telefoneinvalido": $mensagem_erro = "Insira um telefone válido.";
                 break;
            case "celinvalido": $mensagem_erro = "Insira um celular válido.";
                break;
            case "imginvalido": $mensagem_erro = "Insira apenas arquivos .jpg ou .png de no máximo 3,9MB de tamanho";
                break;
            case "cadastroinvalido": $mensagem_erro = "Não foi possivel efetuar o cadastro";
                break;
        }
        
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        //carregando as boxes de ramo e de layout
        $dados_preload = $this->pagmod->CarregarBoxLayoutRamo();
        $dados = array('opcoes_ramo' => $dados_preload['opcoes_ramo'], 
            'opcoes_layout' => $dados_preload['opcoes_layout'],
            'mensagem_erro' => $mensagem_erro);
        $this->load->view('pagina/criarpagina_view', $dados);
        $this->load->view('include/footer_view');
    }
    
    public function POSTcadastrar(){
        if(isset($_POST["CriarPagina"])){
            $this->load->library("validacao");
            $nome =     trim($_POST['nome']);
            $ramo =     $_POST['ramo'];
            $slogan =   trim($_POST['slogan']);
            $site =     trim($_POST['site']);
            $descricao = trim($_POST['descricao']);
            $cep =      $_POST['codigo_cep'];
            $numero =   trim($_POST['numero']);
            $complemento = trim($_POST['complemento']);
            $layout = $_POST['layout'];
            $telefone = preg_replace("/[()\s-]+/", "",$_POST['telefone']);
            $celular = $_POST['celular'];
            $imagem =  $_FILES['imagem'];
            if(!$this->validacao->ValidNomePagina($nome)){
                redirect("pagina/cadastrar/nomeinvalido");
            } elseif(!$this->validacao->ValidNatural($ramo)){
                redirect("pagina/cadastrar/ramoinvalido");
            } elseif(!$this->validacao->ValidSloganPagina($slogan)){
                redirect("pagina/cadastrar/sloganinvalido");
            } elseif(!$this->validacao->ValidSitePagina($site) && $site != "") {
                redirect("pagina/cadastrar/siteinvalido");
            } elseif(!$this->validacao->ValidDescPagina($descricao)) {
                redirect("pagina/cadastrar/descinvalido");
            } elseif(!$this->validacao->ValidNatural($cep)){
                redirect("pagina/cadastrar/cepinvalido");
            } elseif(!$this->validacao->ValidNumeroEnderecoPagina($numero) && $numero != ""){
                redirect("pagina/cadastrar/numeroinvalido");
            } elseif(!$this->validacao->ValidComplementoEndereco($complemento) && $complemento != ""){
                redirect("pagina/cadastrar/compinvalido");
            } elseif(!$this->validacao->ValidNatural($layout)){
                redirect("pagina/cadastrar/layoutinvalido");
            } elseif(!$this->validacao->ValidTelefone($telefone) && $telefone != ""){
                redirect("pagina/cadastrar/telefoneinvalido");
            } elseif(!$this->validacao->ValidCelular($celular) && $celular != "") {
                redirect("pagina/cadastrar/celinvalido");
            } elseif(!$this->validacao->ValidImagem($imagem['name'])){
                redirect("pagina/cadastrar/imginvalido");
            } elseif(!$this->pagmod->CadastrarPagina($nome, $ramo, $slogan , 
            $site, $descricao, $cep, $numero, $complemento, $layout, $telefone, $celular, $imagem)) {
                redirect("pagina/cadastrar/cadastroinvalido");
            } else {
                redirect("pagina/minhapagina");
            }
            
        } else {
            redirect("pagina/cadastrar");
        }
    }
    //MOSTRA A PAGINA CUJO PROPRIETÁRIO ADMINISTRA
    public function minhapagina(){
        //MEdida provisoria, o usuario visualiza a propria pagina
        $codigo = $this->pagmod->CarregarPaginaProprietario();
        if($codigo){
            $dados = $this->pagmod->CarregarDadosPagina($codigo);
            $dados['proprietario'] = true;
            // print_r($dados_pagina);
             $this->load->view('include/head_view');
             $this->load->view('include/header_view');
             $this->load->view('pagina/pagina_view', $dados);
             $this->load->view('include/footer_view');
        } else {
            redirect('home');
        }
    }
    
    public function configuracoes(){
        $codigo = $this->pagmod->CarregarPaginaProprietario();
        if($codigo){
            $dados = $this->pagmod->CarregarDadosPagina($codigo);
             
            $dados_preload = $this->pagmod->CarregarBoxLayoutRamo();
            $dados['opcoes_ramo'] = $dados_preload['opcoes_ramo'];
            $dados['opcoes_layout'] = $dados_preload['opcoes_layout'];
            // print_r($dados_pagina);
             $this->load->view('include/head_view');
             $this->load->view('include/header_view');
             $this->load->view('pagina/configuracoes_view', $dados);
             $this->load->view('include/footer_view');
        } else {
            redirect('home');
        }
    }
    
    public function criarproduto($erro = false){
        
        //Carrega o codigo da pagina cujo usuario atual é proprietário
        $codigo = $this->pagmod->CarregarPaginaProprietario();
        if($codigo){
            $dados = array('codigo' => $codigo);
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('pagina/criarproduto_view', $dados);
        $this->load->view('include/footer_view');
        } else {
            redirect('login');
        }
    }
    
    public function POSTcriarproduto(){
        //insere e valida os dados vindos do criarproduto
        $codigo = $this->pagmod->CarregarPaginaProprietario();
        if($codigo || (!isset($_POST))){
            $nome = addslashes(trim($_POST['nmProduto']));
            $desc = addslashes(trim($_POST['descProduto']));
            $this->load->library("validacao");
            if(!$this->validacao->ValidNomeProd($nome)){
                redirect("pagina/criarproduto/nomeinvalido");
            } elseif (!$this->validacao->ValidDescProd($desc)){
                redirect("pagina/criarproduto/descricaoinvalida");
            } elseif((!$this->validacao->ValidImagem($_POST['imagemUpload'])) || 
                    (!file_exists("src/imagens/temp/" + $_POST['imagemUpload']))){
                redirect("pagina/criarproduto/imageminvalida");
            } else {
                $resultado = $this->pagmod->CadastrarProduto($codigo, 
                        $_POST['imagemUpload'], $nome, $codigo);
                if($resultado){
                    redirect("pagina/minhapagina");
                } else {
                    redirect("pagina/criarproduto/falhacadastro");
                }
            }
        } else {
            redirect("home");
        }
    }
    
    public function deletarproduto($codigoProduto){
        $codigoPagina = $this->pagmod->CarregarPaginaProprietario();
        if(is_numeric($codigoPagina) && is_numeric($codigoProduto)){
            $this->pagmod->DeletarProduto($codigoPagina, $codigoProduto);
            redirect("pagina/minhapagina");
        } else {
            redirect("home");
        }
    }
}

