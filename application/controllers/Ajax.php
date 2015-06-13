<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller{

    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('home');
        }
        $this->load->model('ajax_model', 'ajaxmod');
    }
    
    public function index(){
        redirect('home');
    }
    
    public function carregarCartoes($offset = 0, $ramo = false, $estado = false, 
            $cidade = false, $bairro = false, $ordenacao = false, $nome = 0){
        if(is_numeric($offset) && is_numeric($ramo) && is_numeric($estado) && is_numeric($cidade) 
                && is_numeric($bairro) && is_numeric($ordenacao)){
            if($nome != 0){
                $nome = addslashes($nome);
            }
            $this->ajaxmod->carregarCartoes($nome, $ramo, $estado, $cidade, $bairro, $ordenacao, $offset);
        } else { // algum dos dados passados pela URL são inválidos
            echo "Vazio";
        }
    }
    
    public function carregarOpcoesRamo(){
       $this->ajaxmod->carregarOpcoesRamo();
    }
    
     public function carregarOpcoesEstado(){
       $this->ajaxmod->carregarOpcoesEstado();
    }
    
    public function carregarOpcoesCidade($codigo = false){
       if(is_numeric($codigo)){
           $this->ajaxmod->carregarOpcoesCidade($codigo);
       } else{
           echo "<option value='0' selected>Cidade</option>";
       }
    }
    
    public function carregarOpcoesBairro($codigo = false){
       if(is_numeric($codigo)){
           $this->ajaxmod->carregarOpcoesBairro($codigo);
       } else{
           echo "<option value='0' selected>Bairro</option>";
       }
    }
    
    public function carregarEndereco($cep = false){
        if(!is_numeric($cep)){
            echo "Erro";
        } else {
            $this->load->model('endereco_model', 'endmod');
            $resultado = $this->endmod->retornarEndereco($cep);
            if($resultado){
                echo $resultado;
            } else {
                echo "Erro";
            }
        }
    }
    
    public function AlterarDadoPagina($tipo = false, $codigoPagina = false, $valorDado = false){
        $this->load->model("pagina_model", "pagmod");
        
        //verificando se a pessoa que esta alterando a pagina é realmente a dona 
        //que se encontra logada no servidor ou um SQL injection direto na classe AJAX
        $isSecure = ($this->pagmod->CarregarPaginaProprietario() == dechex($codigoPagina)) ? true : false;       
        $retorno = false;
        if(!empty($tipo) && !empty($codigoPagina) && !empty($valorDado) && $isSecure){        
            switch ($tipo){
               case 1: $retorno = $this->pagmod->AlterarNome($valorDado, $codigoPagina); 
                    break; //nome
                case 2: $retorno = $this->pagmod->AlterarSlogan($valorDado, $codigoPagina); 
                    break; //slogan;
               case 3:  $retorno = $this->pagmod->AlterarDescricao($valorDado, $codigoPagina);
                    break;//descrição;
               case 4: $retorno = $this->pagmod->AlterarSite($valorDado, $codigoPagina);
                   break;//site;
               case 5: $retorno = $this->pagmod->AlterarRamo($valorDado, $codigoPagina);
                   break;//ramo;
               case 6: $retorno = $this->pagmod->AlterarLayout($valorDado, $codigoPagina); 
                   break;//layout ;
                case 7: $retorno = $this->pagmod->AlterarLocalidade($valorDado, $codigoPagina); 
                    break; //localidade;
               case 8: $retorno = $this->pagmod->AlterarContato($valorDado, $codigoPagina);
                    break; // telefone e celular
            }
            if($retorno) {
                echo "Funcionou";
            } else {
                echo "Erro";
            }
        } else {
            echo "Erro";
        }
    }
    
    public function ExcluirPagina($codigoPagina){
        $this->load->model("pagina_model", "pagmod");
        $isSecure = ($this->pagmod->CarregarPaginaProprietario() == dechex($codigoPagina)) ? true : false;
        if(is_numeric($codigoPagina) && $isSecure){
            $this->load->model("processo_model", "process");
            $resultado = $this->process->NovaExclusaoPagina($codigoPagina);
            if($resultado) {
                echo "Funcionou";
            } else {
                echo "Erro";
            }
        } else {
            echo "Erro";
        }
    }
    
    public function AlterarImagemPagina($codigoPagina){
        $this->load->model("pagina_model", "pagmod");
        $isSecure = ($this->pagmod->CarregarPaginaProprietario() == dechex($codigoPagina)) ? true : false;       
        $retorno = false;
        if(!empty($codigoPagina) && $isSecure && isset($_POST)){
            if(isset($_FILES['imagem'])){
               $imagem = $_FILES['imagem'];
               $imagemAntiga = $_POST['imagemantiga'];
               $retorno = $this->pagmod->AlterarImagem($codigoPagina, $imagem, $imagemAntiga);
               if($retorno){
                   echo $retorno;
               } else {
                   echo "Erro";
               }
            } else {
                echo "Erro";
            }   
        } else {
            echo "Erro";
        }
    }
}
/*
if(!empty($codigoPagina) && $isSecure && isset($_POST)){
            if(isset($_FILES['imagem'])){
                $imagem = $_FILES['imagem'];
                $imagemAntiga = $_POST['imagemantiga'];
                $this->pagmod->AlterarImagem($codigo, $imagem, $imagemAntiga);
                
            }   
        } */