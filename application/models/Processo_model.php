<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Processo_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    /*  FUNÇÃO: O SISTEMA IRÁ PROCURAR NA TABELA DE PROCESSOS A COMBINAÇÃO EXISTENTE
     *  DE CODIGO E CHAVE TENDO QUE SER OBRIGATORIO O VALOR DO TIPO SER IGUAL A 4;
     * CASO ENCONTRADO, O VALOR ATIVO DO USUARIO VINCULADO AO PROCESSO SERÁ MODIFICADO
     * E EM SEGUIDA O PROCESSO DELETADO PARA NAO SER REUTILIZADO.
     */ 
    public function RealizarVerificacao($codigo_processo = false, $codigo_chave = false)
                {
        $resultado_query = $this->db->query("SELECT cd_usuario FROM tb_processo WHERE"
                . " cd_processo = $codigo_processo AND cd_chave = '$codigo_chave' AND"
                . " cd_tipo = 1 LIMIT 1;");
        if($resultado_query->num_rows() == 1){
            foreach($resultado_query->result() as $row){
                $codigo_usuario = $row-> cd_usuario;
            }
            
            $this->db->query("UPDATE tb_usuario SET nm_ativo = true"
                    . " WHERE cd_usuario = $codigo_usuario;");
            $this->db->query("DELETE FROM tb_processo WHERE cd_processo = $codigo_processo;");     
            return true;
        } else { // O processo procurado não existe
            return false;
        }
    }
    // FUNÇÃO: ENVIA UM EMAIL PARA O USUARIO COM O URL PARA REALIZAR A VERIFICAÇÃO 
    public function NovaVerificacao($codigo_usuario = false){
        if(is_numeric($codigo_usuario)){
            /* Criando a tabela de verificação*/
            $chave = uniqid("$codigo_usuario", true);
            $this->db->query("INSERT INTO tb_processo"
                    . " (cd_usuario, cd_chave, cd_tipo) values "
                    . " ($codigo_usuario, '$chave', 1);"); //Fim inserção
            $resultado_query2 = $this->db->query("SELECT p.cd_processo AS 'processo', u.nm_usuario AS 'nome', u.nm_email AS 'email' "
                    . " FROM tb_processo as p, tb_usuario as u"
                    . " WHERE  p.cd_chave = '$chave' AND p.cd_tipo = 1 AND "
                    . " p.cd_usuario = u.cd_usuario AND u.cd_usuario = $codigo_usuario LIMIT 1;");
            if($resultado_query2->num_rows() > 0){
                foreach($resultado_query2->result() as $row){
                    $codigo_processo = $row->processo;
                    $nome_dest = $row->nome;
                    $email_dest = $row->email;
                }
                /* Enviando o email */
                $this->load->library('sender');
                $resultado = $this->sender->Validacao($nome_dest, $email_dest, $codigo_processo, $chave);
                if($resultado){
                    //echo "<script> alert('Enviou'); </script>";
                    return true;
                } else { // Falha no envio do email
                   // echo "<script> alert('Não Enviou'); </script>";
                    return false;
                }
            }else { // ocorreu um erro durante a criação de processo
                return false;
            }
        } { // o valor enviado nao é inteiro
            return false;
        }
    }
    
    
    
    public function NovaRecuperacaoSenha($email_usuario = false){
        $resultado_query = $this->db->query("SELECT cd_usuario FROM tb_usuario "
                . " WHERE nm_email = '$email_usuario' LIMIT 1;");
        if($resultado_query->num_rows() > 0){
            foreach($resultado_query->result() as $row){
                $codigo_usuario = $row->cd_usuario;
            }
            
            $chave = uniqid("$codigo_usuario", true);
            $this->db->query("INSERT INTO tb_processo"
                    . " (cd_usuario, cd_chave, cd_tipo) values "
                    . " ($codigo_usuario, '$chave', 2);");
            $resultado_query2 = $this->db->query("SELECT p.cd_processo AS 'processo', u.nm_usuario AS 'nome', u.nm_email AS 'email' "
                    . " FROM tb_processo as p, tb_usuario as u"
                    . " WHERE  p.cd_chave = '$chave' AND p.cd_tipo = 2 AND "
                    . " p.cd_usuario = u.cd_usuario AND u.cd_usuario = $codigo_usuario LIMIT 1;");
            if($resultado_query2->num_rows() > 0){
                foreach($resultado_query2->result() as $row){
                    $codigo_processo = $row->processo;
                    $nome_dest = $row->nome;
                    $email_dest = $row->email;
                }
                /* Enviando o email */
                $this->load->library('sender');
                $resultado = $this->sender->RecuperarSenha($nome_dest, $email_dest, $codigo_processo, $chave);
                if($resultado){
                    //echo "<script> alert('Enviou'); </script>";
                    return true;
                } else { // Falha no envio do email
                   // echo "<script> alert('Não Enviou'); </script>";
                    return false;
                }
            } else { //email nao cadastrado
                return false;
            } 
        } else { //email nao cadastrado
                return false;
        }   
    }
    
    public function RealizarRecuperacao($codigo_processo = false, $codigo_chave = false, $senha){
        if($codigo_chave && $senha && $codigo_processo){
            $senha = md5($senha);
            $resultado_query = $this->db->query("SELECT cd_usuario FROM tb_processo "
                    . " WHERE cd_processo = $codigo_processo AND cd_chave = '$codigo_chave' AND"
                    . " cd_tipo = 2 LIMIT 1;");
            if($resultado_query->num_rows() > 0) {
                foreach($resultado_query->result() as $row){
                    $codigo_usuario = $row->cd_usuario;
                }
                
                $this->db->query("UPDATE tb_usuario SET cd_senha = '$senha' WHERE "
                        . " cd_usuario = $codigo_usuario; ");
                $this->db->query("DELETE FROM tb_processo WHERE cd_processo = $codigo_processo;");
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function NovaExclusaoPagina($codigo_pagina){
        if(is_numeric($codigo_pagina)){
            /* Criando a tabela de verificação*/
            $resultado_query = $this->db->query("SELECT P.cd_usuario as 'codigo' "
                    . " FROM tb_pagina as P, tb_usuario as U "
                    . " WHERE P.cd_usuario = U.cd_usuario AND P.cd_pagina = $codigo_pagina LIMIT 1;");
            if($resultado_query->num_rows() > 0){
                foreach($resultado_query->result() as $row){
                    $codigo_usuario = $row->codigo;
                }
                $chave = uniqid("$codigo_usuario", true);
                $this->db->query("INSERT INTO tb_processo"
                        . " (cd_usuario, cd_chave, cd_tipo) values "
                        . " ($codigo_usuario, '$chave', 3);"); //Fim inserção
                $resultado_query2 = $this->db->query("SELECT p.cd_processo AS 'processo', u.nm_usuario AS 'nome', u.nm_email AS 'email' "
                        . " FROM tb_processo as p, tb_usuario as u"
                        . " WHERE  p.cd_chave = '$chave' AND p.cd_tipo = 3 AND "
                        . " p.cd_usuario = u.cd_usuario AND u.cd_usuario = $codigo_usuario LIMIT 1;");
                if($resultado_query2->num_rows() > 0){
                    foreach($resultado_query2->result() as $row){
                        $codigo_processo = $row->processo;
                        $nome_dest = $row->nome;
                        $email_dest = $row->email;
                    }
                    /* Enviando o email */
                    $this->load->library('sender');
                    $resultado = $this->sender->Exclusao($nome_dest, $email_dest, $codigo_processo, $chave);
                    if($resultado){
                        //echo "<script> alert('Enviou'); </script>";
                        return true;
                    } else { // Falha no envio do email
                       // echo "<script> alert('Não Enviou'); </script>";
                        return false;
                    }
                } else { // ocorreu um erro durante a criação de processo
                    return false;
                }
            } else {
                return false;
            }
    } else { // o valor enviado nao é inteiro
        return false;
    }
    }
    
    public function RealizarExclusaoPagina($codigo_processo = false, $codigo_chave = false){
        if($codigo_chave && $codigo_processo){
            $resultado_query = $this->db->query("SELECT P.cd_pagina as 'codigo'
                FROM tb_processo as PR, tb_usuario as U, tb_pagina as P
                    WHERE PR.cd_processo = $codigo_processo AND PR.cd_chave = '$codigo_chave' AND PR.cd_tipo = 3 AND
			PR.cd_usuario = U.cd_usuario AND U.cd_usuario = P.cd_usuario LIMIT 1;");
            if($resultado_query->num_rows() > 0){
                foreach($resultado_query->result() as $row) {
                    $codigo_pagina = $row->codigo;
                }
                $this->load->model("pagina_model", "pagmod");
                $resultado = $this->pagmod->ExcluirPagina($codigo_pagina);
                if($resultado) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function CancelarProcesso($codigo_processo = false, $codigo_chave = false){
        if($codigo_chave && $codigo_processo){
            $resultado_query = $this->db->query("DELETE FROM tb_processo "
                    . "WHERE cd_processo = $codigo_processo AND cd_chave = '$codigo_chave';");
            if($resultado_query) {
                return true;
            } else{
              return false;  
            } 
        } else {
            return false;
        }
    }
}