<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function carregarCartoes($nome = false, $ramo = false, $estado = false, 
            $cidade = false, $bairro = false, $ordenacao = false, $offset = 0){
        
        //Conteúdo buscado (Ainda não existe a tabela de avaliação)
        $strConsulta = "SELECT DISTINCT P.nm_pagina as 'nome', P.nm_slogan as 'slogan',"
                . " L.nm_logradouro as 'endereco', B.nm_bairro as 'bairro',"
                . " P.nr_endereco as 'numero',P.nm_caminho_imagem as 'imagem',  "
                . "P.cd_pagina as 'codigo', C.nm_cidade as 'cidade', UF.sg_uf as 'estado'";
        //Tabelas de origem
        $strConsulta .= " FROM tb_pagina as P, tb_ramo as R, tb_logradouro as L, tb_bairro as B, tb_cidade as C, tb_uf as UF";
        //Condições de busca
        $strConsulta .= " WHERE L.cd_logradouro = P.cd_logradouro AND L.cd_bairro = B.cd_bairro"
                . " AND B.cd_cidade = C.cd_cidade AND C.cd_uf = UF.cd_uf ";
        if($nome) { //algum nome foi especificado?
            $strConsulta .= "AND P.nm_pagina LIKE '%$nome%' ";
        }
        if($ramo){ // algum ramo foi especificado?
            $strConsulta .= "AND R.cd_ramo = $ramo ";
        }
        if($estado){ // algum estado foi especificado?
            $strConsulta .= "AND E.cd_estado = $estado ";
        }
        if($cidade){ // alguma cidade foi especificada?
            $strConsulta .= "AND C.cd_cidade = $cidade ";
        }
        if($bairro){ // algum bairro foi especificado?
            $strConsulta .= "AND B.cd_bairro = $bairro ";
        }
        //modo de ordenação
        if($ordenacao) {
            $strConsulta .= "ORDER BY $ordenacao ";
        } else {
            $strConsulta .= "ORDER BY 1 ";
        }
        //limite e offset
        $strConsulta .= "LIMIT 5 OFFSET $offset;";
        
        $this->efetuarCarregamento($strConsulta);
    }   
    private function efetuarCarregamento($strConsulta = false){
        if($strConsulta) {
            $resultado_query = $this->db->query($strConsulta);
            $resultado = "";
            if($resultado_query->num_rows() > 0){
                foreach($resultado_query->result() as $row){
                    $nome = $row->nome;
                    $slogan = $row->slogan;
                    $endereco = $row->endereco;
                    $bairro = $row->bairro;
                    $cidade = $row->cidade;
                    $estado = $row->estado;
                    $numero = $row->numero;
                    $imagem = $row->imagem;
                    $codigo = $row->codigo;
                    //chamamos a função que vai inserir os dados no molde da faixada
                    $resultado .= $this->novoCartao($nome, $slogan, $endereco, $bairro, $cidade, $estado, $numero, $imagem, $codigo);
                }
                echo $resultado;
            } else {
                echo "Vazio";
            }
        } else {
            echo "Vazio";
        }
    } 
    private function novoCartao($nome = "Nome", $slogan = "Slogan", $endereco = "Endereço",
            $bairro = "Bairro", $cidade = "Cidade", $estado = "Estado", $numero = 1234,
            $caminho_imagem = false, $codigo = 0){
        //INSIRA AQUI O CÓDIGO HTML PARA CADA FAIXADA QUE SERÁ EXIBIDA
        return "<div class='cartao'> $nome "
                . "<br/> $slogan </div> <br/>";
    }
    
    public function carregarOpcoesRamo(){
        $resultado_query = $this->db->query("SELECT DISTINCT R.cd_ramo as 'codigo', R.nm_ramo as 'nome' "
    	 ." FROM tb_ramo as R, tb_pagina as P "
         	." WHERE P.cd_ramo = R.cd_ramo ORDER BY 2;");
        if($resultado_query->num_rows() > 0){
            $resultado = "<option value='0' selected>Ramo da página</option>";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome;
                $codigo = $row->codigo;
                $resultado .= "<option value='$codigo'>$nome</option>";
            }
            echo $resultado;
        } else {
            echo "<script> alert('Não foi possivel carregar os ramos');</script>";
        }
    }
    public function carregarOpcoesEstado(){
        $resultado_query = $this->db->query("SELECT DISTINCT U.cd_uf as 'codigo', U.nm_uf as 'nome' 
    	 FROM tb_uf as U, tb_cidade as C, tb_bairro as B, tb_logradouro as L, tb_pagina as P
         	 WHERE U.cd_uf = C.cd_uf AND C.cd_cidade = B.cd_cidade AND 
             	B.cd_bairro = L.cd_Bairro and P.cd_logradouro = L.cd_logradouro ORDER BY 2;");
        if($resultado_query->num_rows() > 0){
            $resultado = "<option value='0' selected>Estado</option>";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome;
                $codigo = $row->codigo;
                $resultado .= "<option value='$codigo'>$nome</option>";
            }
            echo $resultado;
        } else {
            echo "<script> alert('Não foi possivel carregar os ramos');</script>";
        }
    }
    public function carregarOpcoesCidade($codigo = 1){
        $resultado_query = $this->db->query("SELECT DISTINCT C.cd_cidade as 'codigo', C.nm_cidade as 'nome' 
    	 FROM tb_uf as U, tb_cidade as C, tb_bairro as B, tb_logradouro as L, tb_pagina as P
         	 WHERE U.cd_uf = C.cd_uf AND C.cd_cidade = B.cd_cidade AND  
             	B.cd_bairro = L.cd_Bairro and P.cd_logradouro = L.cd_logradouro AND U.cd_uf = $codigo ORDER BY 2;");
        if($resultado_query->num_rows() > 0){
            $resultado = "<option value='0' selected>Cidade</option>";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome;
                $codigo = $row->codigo;
                $resultado .= "<option value='$codigo'>$nome</option>";
            }
            echo $resultado;
        } else {
            echo "<script> alert('Não foi possivel carregar os ramos');</script>";
        }
    } 
    public function carregarOpcoesBairro($codigo = 1){
        $resultado_query = $this->db->query("SELECT DISTINCT B.cd_bairro as 'codigo',"
                . " B.nm_bairro as 'nome' FROM tb_uf as U, tb_cidade as C, tb_bairro as B,"
                . " tb_logradouro as L, tb_pagina as P WHERE U.cd_uf = C.cd_uf AND"
                . " C.cd_cidade = B.cd_cidade AND B.cd_bairro = L.cd_Bairro and P.cd_logradouro = L.cd_logradouro "
                . " AND C.cd_cidade = $codigo ORDER BY 2;");
        if($resultado_query->num_rows() > 0){
            $resultado = "<option value='0' selected>Bairro</option>";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome;
                $codigo = $row->codigo;
                $resultado .= "<option value='$codigo'>$nome</option>";
            }
            echo $resultado;
        } else {
            echo "<script> alert('Não foi possivel carregar os ramos');</script>";
        }
    }
}

