<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if(!$this->status->verificarLogin()){
            redirect('login');
        }
    }
    
    //REDIRECIONA O USUARIO PARA AS AÇÕES DE Configuracoes OU Cadastrar
    public function index(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        if($_SESSION['is_dono'] == true){
               $this->load->view('pagina/minhapagina_view');
        }
        else{
            $this->load->view('pagina/criarpagina_view');
        }
        $this->load->view('include/footer_view');
    }
    
    //PERMITE AO USUÁRIO VISUALIZAR ALGUMA PAGINA ATRAVÉS DE UM CODIGO PASSADO
    //PELA URL.
    public function visualizar($codigo = false){
        $codigo = hexdec($codigo);
        if($codigo && is_numeric($codigo) && $codigo > 0){
             $this->load->model('pagina_model', 'pagmod');
        } else { // nenhum valor foi passado pela url
            echo "invalido2";
        }
    }
    //PERMITE AO USUÁRIO CRIAR UMA NOVA PAGINA VINGULADA A SUA CONTA
    public function cadastrar(){
        
    }
    //MOSTRA A PAGINA CUJO PROPRIETÁRIO ADMINISTRA
    public function configuracoes(){
        $this->load->view('include/head_view');
        $this->load->view('include/header_view');
        $this->load->view('pagina/comentarios_view');
        $this->load->view('include/footer_view');
    }

}

