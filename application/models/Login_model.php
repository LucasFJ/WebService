<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function efetuarLogin($login = "", $senha = ""){
        
        if( empty($login) || empty($senha)){
            $senha = md5($str);
            $login = mysql_real_escape_string($login);
            $senha = mysql_real_escape_string($senha);
            
            $dados_autenticados = $this->status->autenticarCadastro($login, $senha);
            if(!$dados_autenticados){
                return false;
            }
            
            $this->status->iniciarCookie($dados_autenticados['user_nome'], 
                    $dados_autenticados['user_login'], $dados_autenticados['user_senha']);
            $this->status->iniciarSessao($dados_autenticados['user_nome'], 
                    $dados_autenticados['user_login'], $dados_autenticados['user_senha'],
                    $dados_autenticados['is_ativo'], $dados_autenticados['is_dono']);
            
            return true;
        }
    }
    
}

