<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function carregarFaixadas($nome = false, $ramo = false, $estado = false, 
            $cidade = false, $bairro = false, $ordenacao = false, $offset = 0){
        
        //Conteúdo buscado (Ainda não existe a tabela de avaliação)
        $strConsulta = "SELECT P.nm_pagina as 'nome', P.nm_slogan as 'slogan', "
                . "L.nm_logradouro as 'endereco', B.nm_bairro as 'bairro', P.nr_endereco as 'numero', "
                . "P.nm_caminho_imagem as 'imagem', P.cd_pagina = 'codigo',"
                . "C.nm_cidade as 'cidade', UF.sg_uf as 'estado' ";
        //Tabelas de origem
        $strConsulta += "FROM tb_pagina as 'P', tb_ramo as 'R', tb_logradouro as 'L', "
                . " tb_bairro as 'B', tb_cidade as 'C', tb_uf as 'UF' ";
        //Condições de busca
        $strConsulta += "WHERE L.cd_logradouro = P.cd_logradouro AND "
                . "L.cd_bairro = B.cd_bairro AND B.cd_cidade = C.cd_cidade AND "
                . "C.cd_uf = UF.cd_uf";
        if($nome) { //algum nome foi especificado?
            $strConsulta += "P.nm_pagina = '$nome' AND ";
        }
        if($ramo){ // algum ramo foi especificado?
            $strConsulta += "R.cd_ramo = $ramo AND ";
        }
        if($estado){ // algum estado foi especificado?
            $strConsulta += "E.cd_estado = $estado AND ";
        }
        if($cidade){ // alguma cidade foi especificada?
            $strConsulta += "C.cd_cidade = $cidade AND ";
        }
        if($bairro){ // algum bairro foi especificado?
            $strConsulta += "B.cd_bairro = $bairro ";
        }
        //modo de ordenação
        if($ordenacao) {
            $strConsulta += "ORDER BY $ordenacao";
        } else {
            $strConsulta += "ORDER BY P.nm_pagina ";
        }
        //limite e offset
        $strConsulta += "LIMIT 5 OFFSET $offset";
        
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
                    $resultado += $this->novaFaixada($nome, $slogan, $endereco, $bairro, $cidade, $estado, $numero, $imagem, $codigo);
                }
                echo $resultado;
            }
        } else {
            return false;
        }
    }
    
    private function novaFaixada($nome = "Nome", $slogan = "Slogan", $endereco = "Endereço",
            $bairro = "Bairro", $cidade = "Cidade", $estado = "Estado", $numero = 1234,
            $caminho_imagem = false, $codigo = 0){
        //INSIRA AQUI O CÓDIGO HTML PARA CADA FAIXADA QUE SERÁ EXIBIDA
    }
}

