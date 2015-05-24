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
}

