<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Status {
    
    protected $CI;
    
    public function __construct() {
         $this->CI =& get_instance();
         session_start();
         $this->CI->load->database();
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
            $dados_autenticados = $this->autenticarCadastro( $dados_sessao["user_nome"], 
                    $dados_sessao["user_login"], $dados_sessao["user_senha"]);
            if($dados_autenticados){
                $_SESSION['is_ativo'] = $dados_autenticados["is_ativo"];
                $_SESSION['is_dono'] = $dados_autenticados["is_dono"];
                return true;
            }
        }
        // 2ª etapa;
         $dados_cookies = $this->verificarCookie();
        if($dados_cookies){
            $dados_autenticados = $this->autenticarCadastro($dados_cookies['user_nome'],
                    $dados_cookies['user_login'], $dados_cookies['user_senha']);
            if($dados_autenticados){
              // 3ª etapa;
                $this->iniciarSessao($dados_autenticados['user_nome'], 
                        $dados_autenticados['user_login'], $dados_autenticados['user_senha'], 
                        $dados_autenticados['is_ativo'], $dados_autenticados['is_dono']);
                $this->iniciarCookie($dados_autenticados['user_nome'], 
                        $dados_autenticados['user_login'], $dados_autenticados['user_senha']);
                return true;
            }
        }
        // Não há session nem cookie com dados integros do usuário
        return false;
    }
    
    // Função: verificar se há registros de login salvos no browser
    public function verificarCookie(){
        if( !isset($_COOKIE['user_nome']) || !isset($_COOKIE['user_login']) 
               || !isset($_COOKIE['user_senha'])) {
            return false;
        }
        elseif( empty($_COOKIE['user_nome']) || empty($_COOKIE['user_login']) 
               || empty($_COOKIE['user_senha'])) {
            return false;
        }
        else{
            return array( 'user_nome' => $_COOKIE['user_nome'],
                'user_login' => $_COOKIE['user_login'],
                'user_senha' => $_COOKIE['user_senha']);
        }
    }
    //Função: cria um cookie para salvar os dados da session por um período
    //de tempo pré-definido
    public function iniciarCookie($user_nome = null, $user_login = null, 
            $user_senha = null){
        $expira = time() + ( 60 * 60 * 2); // Tempo Unix: 2 horas
        setcookie('user_nome', $user_nome, $expira);
        setcookie('user_login', $user_login, $expira);
        setcookie('user_senha', $user_senha, $expira);
        return true;
    }
    // Função: destroi os cookies que possuem dados de login do usuário
    public function fecharCookie(){
        setcookie('user_nome', '', time() - 3600);
        setcookie('user_login', '', time() - 3600);
        setcookie('user_senha', '', time() - 3600);
        return true;
    }
    //Função: verificar se os dados de login são condizentes com os 
    //encontrados no servidor
    public function autenticarCadastro($user_nome = null, $user_login = null,
            $user_senha = null){
        
        $resultado_query1 = $this->CI->db->query("SELECT nm_usuario, nm_email, "
                . " cd_senha, nm_ativo FROM tb_usuario where nm_usuario = '$user_nome' and"
                . " nm_email = '$user_login' and cd_senha = '$user_senha' limit 1");
        
        if($resultado_query1->num_rows() > 0) {
            foreach($resultado_query1->result() as $row){
                $nome = $row->nm_usuario;
                $login = $row->nm_email;
                $senha = $row->cd_senha;
                $ativo = $row->nm_ativo;
            }
            
            //$resultado_query2 = $this->CI->db->query('SELECT nm_usuario FROM '
            //        . 'tb_usuario, tb_pagina WHERE tb_usuario.cd_usuario = tb_pagina.cd_usuario limit 1');
            //if($resultado_query2->num_rows() > 0){
            //    $dono = true;
            //}
            //else {
                $dono = false;
            //} 
            return array('user_nome' => $nome, 
                'user_login' => $login, 
                'user_senha' => $senha,
                'is_ativo' => $ativo,
                'is_dono' => $dono);
                
        }
        else {
            return false;
        }
        
    }
    
    //Função: verificar se já existe uma sessao aberta pelo usuário
    public function verificarSessao(){ 
        if(!isset($_SESSION['user_nome']) ||  !isset($_SESSION['user_login']) 
                || !isset($_SESSION['user_senha'])) {
            return false;
        }
        
        if(empty($_SESSION['user_nome']) || empty($_SESSION['user_login']) 
                || empty($_SESSION['user_senha'])) {
            return false;
        }
        
        return array( 'user_nome' => $_SESSION['user_nome'],
            'user_login' => $_SESSION['user_login'],
            'user_senha' => $_SESSION['user_senha']);
    }
    //Função: cria uma nova sessao para o usuário utilizar
    public function iniciarSessao($user_nome = null, $user_login = null, 
            $user_senha = null, $is_ativo = false , $is_dono = false){    
        if( is_null($user_nome) || is_null($user_login) || is_null($user_senha)){
            return false;
        }
        
        $_SESSION['user_nome'] = $user_nome;
        $_SESSION['user_login'] = $user_login;
        $_SESSION['user_senha'] = $user_senha;
        $_SESSION['is_ativo'] = $is_ativo;
        $_SESSION['is_dono'] = $is_dono;
        return true;    
    }
    //Função: fecha a sessão sendo utilizada pelo usuario no momento
    public function fecharSessao(){
        unset( $_SESSION['user_nome']);
        unset( $_SESSION['user_login']);
        unset( $_SESSION['user_senha']);
        return true;
    }
}
/*
 * INFORMAÇÕES IMPORTANTES:
 * VARIÁVEIS PRESENTES NA SESSION:
 * -> user_nome  // nome do utilizador da conta
 * -> user_login // login do utilizador da conta
 * -> user_senha // senha do utilizador da conta
 * -> is_dono  // o usuário possui alguma pagina cadastrada?
 * -> is_ativo // o usuário confirmou o e-mail de validação de conta?
 * 
 * VARIÁVEIS PRESENTES NO COOKIE:
 * -> user_name // nome do utilizador da conta
 * -> user_login // login do utilizador da conta
 * -> user_senha // senha do utilizador da conta
 */
