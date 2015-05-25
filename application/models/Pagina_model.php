<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //FUNÇÃO: Carregar a página para o usuário com algumas informações
    //adicionais dependendo do tipo de acesso. Tipos:
    //  >> Tipo 1: Visualização - o usuário apenas poderá visualizar e terá disponivel
    //as funcionalidades de comentar, avaliar, denunciar e ir para o maps
    // >> Tipo 2: Administração - o usuário é o dono da pagina e vai
    // visualizar e alterar os dados sem poder executar as funcionalidades
    public function CarregarPagina($codigo = false, $tipo = false){
        
    }
}