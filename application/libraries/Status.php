<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Status {
    
    protected $CI;
    
    public function __construct() {
         $this->CI =& get_instance();
         $this->CI->load->database();
         session_start();
    }
    
    //Função: verificar se o usuario está cadastrado no sistema seguindo uma 
    //série de verificações:
    // 1º - Verifica se já existe uma session aberta no sistema, se sim verifica
    // a integridade dos dados nela existente;
    // 2º - Verifica se existem dados de uma antiga session salvo nos cookies 
    // do browser do usuário e em seguida verifica a integridade dos dados;
    // 3º - Cria uma nova session ou então retorna o valor false;
    public function verificarLogin(){
        // 1ª etapa;
        $dados_sessao = $this->verificarSessao();
        if($dados_sessao){
            $dados_autenticados = $this->autenticarCadastro( $dados_sessao['user_email'], 
                    $dados_sessao['user_senha']);
            if($dados_autenticados){
                $_SESSION['user_nome'] = $dados_autenticados['user_nome'];
                $_SESSION['is_ativo'] = $dados_autenticados['is_ativo'];
                $_SESSION['is_dono'] = $dados_autenticados['is_dono'];
                return true;
            }
        } 
        // 2ª etapa;
        $dados_cookies = $this->verificarCookie();
        if($dados_cookies){
            $dados_autenticados = $this->autenticarCadastro($dados_cookies['user_email'], 
                    $dados_cookies['user_senha']);
            if($dados_autenticados){
              // 3ª etapa;
                $this->iniciarSessao($dados_autenticados['user_nome'], 
                        $dados_autenticados['user_email'], $dados_autenticados['user_senha'], 
                        $dados_autenticados['is_ativo'], $dados_autenticados['is_dono']);
                
                $this->iniciarCookie( $dados_autenticados['user_email'], 
                        $dados_autenticados['user_senha']);
                return true;
            }
        }
        // Não há session nem cookie com dados integros do usuário
        return false;
    }
    
    // Função: verificar se há registros de login salvos no browser
    public function verificarCookie(){
        if(!isset($_COOKIE['user_email']) || !isset($_COOKIE['user_senha'])) {
            return false;
        }
        elseif($_COOKIE['user_email'] == null || $_COOKIE['user_senha'] == null) {
            return false;
        }
        else{
            return array('user_email' => $_COOKIE['user_email'],
                'user_senha' => $_COOKIE['user_senha']);
        }
    }
    //Função: cria um cookie para salvar os dados da session por um período
    //de tempo pré-definido
    public function iniciarCookie($user_email = null, $user_senha = null){
        $expira = time() + ( 60 * 60 * 2); // Tempo Unix: 2 horas
        setcookie('user_email', $user_login, $expira);
        setcookie('user_senha', $user_senha, $expira);
        return true;
    }
    // Função: destroi os cookies que possuem dados de login do usuário
    public function fecharCookie(){
       // setcookie('user_nome');
       // setcookie('user_login');
        try {
            $_COOKIE['user_login'] = null;
            $_COOKIE['user_senha'] = null;
            return true;
        } catch(Exception $x){ 
            return false; 
        }
    }
    //Função: verificar se os dados de login são condizentes com os 
    //encontrados no servidor
    public function autenticarCadastro( $user_email = null, $user_senha = null){
        
        $resultado_query1 = $this->CI->db->query("SELECT nm_usuario, nm_email, "
                . " cd_senha, nm_ativo, cd_usuario FROM tb_usuario where "
                . " nm_email = '$user_email' and cd_senha = '$user_senha' limit 1");
        
        if($resultado_query1->num_rows() > 0) {
            foreach($resultado_query1->result() as $row){
                $nome = $row->nm_usuario;
                $email = $row->nm_email;
               $senha = $row->cd_senha;
                $ativo = $row->nm_ativo;
                $codigo = $row->cd_usuario;
            }
            
            //$resultado_query2 = $this->CI->db->query("SELECT nm_usuario FROM "
            //        . "tb_usuario, tb_pagina WHERE tb_usuario.cd_usuario = tb_pagina.cd_usuario "
            //     . " and tb_usuario.cd_usuario = $codigo limit 1");
            //if($resultado_query2->num_rows() > 0){
            //    $dono = true;
            //}
            //else {
                $dono = false;
            //} 
        
             
            return array('user_nome' => $nome, 
                'user_email' => $email, 
                'user_senha' => $senha,
                'is_ativo' => $ativo,
                'is_dono' => $dono);
                
        }
        else { // não há nenhum registro com o email e senha especificados
            return false;
        }
        
    }
    
    //Função: verificar se já existe uma sessao aberta pelo usuário
    public function verificarSessao(){ 
        if( !isset($_SESSION['user_email']) || !isset($_SESSION['user_senha'])) {
            return false;
        }
        elseif($_SESSION['user_email'] == null || $_SESSION['user_senha'] == null) {
            return false;
        }
        else {
        return array('user_email' => $_SESSION['user_email'],
            'user_senha' => $_SESSION['user_senha']);
        }
    }
    //Função: cria uma nova sessao para o usuário utilizar
    public function iniciarSessao($user_nome = null, $user_email = null, 
            $user_senha = null, $is_ativo = false , $is_dono = false){    
        if( is_null($user_nome) || is_null($user_email) || is_null($user_senha)){
            return false;
        }
        else {
            $_SESSION['user_nome'] = $user_nome;
            $_SESSION['user_email'] = $user_email;
            $_SESSION['user_senha'] = $user_senha;
            $_SESSION['is_ativo'] = $is_ativo;
            $_SESSION['is_dono'] = $is_dono;
            return true;   
        }
    }
    
    //Função: fecha a sessão sendo utilizada pelo usuario no momento
    public function fecharSessao(){
        $_SESSION['user_nome'] = null;
        $_SESSION['user_email'] = null;
        $_SESSION['user_senha'] = null;
        $_SESSION['is_ativo'] = null;
        $_SESSION['is_dono'] = null;
         
        return session_destroy();
    }
}
/*
 * INFORMAÇÕES IMPORTANTES:
 * VARIÁVEIS PRESENTES NA SESSION:
 * -> user_email // login do utilizador da conta
 * -> user_senha // senha do utilizador da conta
 * -> user_nome  // nome do utilizador da conta
 * -> is_dono  // o usuário possui alguma pagina cadastrada?
 * -> is_ativo // o usuário confirmou o e-mail de validação de conta?
 * 
 * VARIÁVEIS PRESENTES NO COOKIE:
 * -> user_login // login do utilizador da conta
 * -> user_senha // senha do utilizador da conta
 */
