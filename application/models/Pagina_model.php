<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //FUNÇÃO: Carregar a página para o usuário com algumas informações
    //adicionais dependendo do tipo de acesso. Tipos:
    public function CarregarDadosPagina($codigo = false){
        $resultado_query = $this->db->query();
    }
}