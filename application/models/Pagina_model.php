<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    //FUNÇÃO: Carregar a página para o usuário com algumas informações
    //adicionais dependendo do tipo de acesso. Tipos:
    public function CarregarDadosPagina($codigo = false){
        $resultado_query = $this->db->query("SELECT P.cd_pagina as 'codigo', P.nm_pagina as 'nome', 
            P.nm_slogan as 'slogan', P.nm_descricao as 'descricao', R.nm_ramo as 'ramo', 
            E.nm_logradouro as 'logradouro', P.nr_endereco as 'numero', P.nm_complemento_endereco as 'complemento',
            B.nm_bairro as 'bairro', C.nm_cidade as 'cidade', U.sg_uf as 'uf',
            P.nm_caminho_imagem as 'imagem', P.nm_caminho_site as 'site', L.nm_cor as 'cor'
            FROM tb_pagina as P, tb_ramo as R, tb_logradouro as E, tb_bairro as B, tb_cidade as C, tb_uf = U, tb_layout as L
            WHERE P.cd_pagina = $codigo AND P.cd_ramo = R.cd_ramo AND P.cd_logradouro = E.cd_logradouro "
                . "AND B.cd_bairro = E.cd_bairro AND B.cd_cidade = C.cd_cidade AND C.cd_uf = U.cd_uf "
                . "AND P.cd_layout = L.cd_layout LIMIT 1;");
        
        if($resultado_query->num_rows() > 0){
            foreach($resultado_query->result() as $row){
                $resultado = array('codigo' => dechex($row->codigo), 'nome' => $row->nome,
                    'slogan' => $row->slogan, 'descricao'  => $row->descricao, 
                    'ramo'  => $row->ramo, 'logradouro'  => $row->logradouro,
                    'numero'  => $row->numero, 'complemento'  => $row->complemento,
                    'bairro'  => $row->bairro, 'cidade'  => $row->cidade, 
                    'uf'  => $row->uf, 'imagem'  => $row->imagem, 
                    'site'  => $row->site, 'cor'  => $row->cor);
            }
            return $resultado;
        } else { //nao existe uma pagina com o codigo especificado
            return false;
        }
    }
    
    public function CadastrarPagina($nome = false, $ramo = false, $slogan = false, 
            $site = false, $descricao = false, $cep = false, $numero = false, 
            $complemento = false, $layout = false, $contato1 = false, $contato2 = false,
            $imagem = false){
        //primeira etapa >> tratando os dados para serem inseridos
        $nome = addslashes(trim($nome));
        $slogan = addslashes(trim($slogan));
    }
}