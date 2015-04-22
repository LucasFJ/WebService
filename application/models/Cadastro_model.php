<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cadastro_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /*  FUNÇÂO: verificar se o usuário informou um email já cadastrado;
     *  Futuramente, com a implementação da biblioteca de EMAIL, o usuário
     *  receberá um e-mail informando um código que tem como finalidade ativar
     *  sua conta
     */
    public function cadastrarConta($email = null, $senha = null, $nome = null, 
            $sobrenome = null, $nascimento = null, $genero = null){
        
        if( $email != null && $senha != null && $nome != null && 
            $sobrenome != null && $nascimento != null && $genero != null){
            
            $disponivel = $this->disponibilidadeLogin($email);
            if($disponivel) {
                
                $senha = md5($senha); 
                $resultado_query = $this->db->query("insert into tb_usuario "
                        . "(nm_usuario, nm_sobrenome, nm_email, cd_senha, "
                        . " dt_cadastro, nm_ativo, dt_nascimento, nm_caminho_imagem,"
                        . " cd_genero) values"
                        . "('$nome', '$sobrenome', '$email', '$senha', now(), "
                        . "false, '$nascimento', null, $genero)");
                
                if($resultado_query->db->num_rows() > 0){
                    return true;
                } else { // mesmo sendo disponivel nao foi possivel cadastrar
                    return false;
                }
                
            } else { // o email informado ja esta sendo utilizado por outra conta
                return false;
            }
            
        } else { // há algum campo não preenchido;
            return false;
        }
        
    }
    
    public function disponibilidadeLogin($email = null){
        
        if($email){
            $resultado_query = $this->db->query("select nm_email from tb_usuario"
                    . " where nm_email = '$email' limit 1");
            if($resultado_query->num_rows() > 0){
                return false;
            } else { // nao há contas utilizando o email passado.
                return true;
            }
        } 
        return false;
    }
}
