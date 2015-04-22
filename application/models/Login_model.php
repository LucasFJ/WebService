<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function efetuarLogin($email = "", $senha = ""){
        
        if( !empty($email) && !empty($senha)){
            $senha = md5($senha);
            
            $dados_autenticados = $this->status->autenticarCadastro($email, $senha);
            if($dados_autenticados){
                
                $this->status->iniciarCookie( $dados_autenticados['user_email'], 
                        $dados_autenticados['user_senha']);
                $this->status->iniciarSessao( $dados_autenticados['user_nome'], 
                        $dados_autenticados['user_email'], $dados_autenticados['user_senha'],
                        $dados_autenticados['is_ativo'], $dados_autenticados['is_dono']);
                return true;
            } else { // não existe nenhum registro utilizando esses login e senha
                return false;
            }
        
        } else { // login ou senha estão vazios
            return false;
        }
    }
    
}

