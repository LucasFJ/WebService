<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    
    public function cadastrarConta($email = null, $senha = null, $nome = null, 
            $sobrenome = null, $nascimento = null, $genero = null){
        
        if( !$email == null && !$senha == null && !$nome == null && 
            !$sobrenome == null || !$nascimento == null && !$genero == null){
            
        } else { // há algum campo não preenchido;
            return "Preencha todos os campos do fomulário";
        }
        
    }
    
    public function verificarLogin($email = null){
        
        if($login){
            $resultado_query = $this->db->query("select nm_email from tb_usuario"
                    . " where nm_email = '$email' limit 1");
        } 
        
        return false;
    }
}
