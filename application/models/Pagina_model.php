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
            E.nm_logradouro as 'logradouro', E.cd_cep as 'cep', P.nr_endereco as 'numero', P.nm_complemento_endereco as 'complemento',
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
                    'site'  => $row->site, 'cor'  => $row->cor,
                    'contato1' => false,  'contato2' => false, 
                    'cep' => $row->cep );
            }
            $resultado_query = $this->db->query("SELECT nr_contato FROM tb_contato"
                    . " WHERE cd_pagina = $codigo LIMIT 2;");
            if($resultado_query->num_rows() > 0){
                $cont = 1;
                foreach($resultado_query->result() as $row){
                    if($cont == 1){
                        $resultado['contato1'] = $row->nr_contato;
                        $cont++;
                    } else {
                        $resultado['contato2'] = $row->nr_contato;
                    }
                }
            }
            return $resultado;
        } else { //nao existe uma pagina com o codigo especificado
            return false;
        }
    }
    public function CarregarProdutosPagina($codigo = false){
        $resultado_query = $this->db->query("SELECT nm_produto as 'nome', cd_produto as 'codigo', "
                . "nm_descricao as 'descricao' "
                . "FROM tb_produto as PR WHERE cd_pagina = $codigo");
       $produtos = null;
       if($resultado_query->num_rows() > 0){
           $index = 0;
           foreach($resultado_query->result() as $row){
               $produtos[0] = array('nome' => $row->nome, 'descricao' => $row->descricao,
                   'codigo' => $row->codigo);
               $index += 1;
           }
       } else {
           $produtos = false;
       }
       return $produtos;
    }
    
    public function CadastrarPagina($nome, $ramo, $slogan,$site, $descricao, $cep, $numero, 
            $complemento, $layout, $contato1, $contato2, $imagem){
        //primeira etapa >> tratando os dados para serem inseridos
        $nome = addslashes(trim($nome));
        $ramo = (is_numeric($ramo) && $ramo > 0) ? $ramo : 1;
        $slogan = addslashes(trim($slogan));
        $descricao = addslashes(trim($descricao)); //escapa os espaços
        $cep = (is_numeric($cep) && $cep > 0) ? $cep : null;
        $numero = (is_numeric($numero)) ? $numero : '';
        $complemento = addslashes(trim($complemento));
        $layout = (is_numeric($layout) && $layout > 0) ? $layout : 1;
        $contato1 = (is_numeric($contato1)) ? $contato1 : null;
        $contato2 = (is_numeric($contato2)) ? $contato2 : null;
        //segunda etapa >> adquirir o codigo do usuario proprietário
        $email = $_SESSION['user_email']; $senha = $_SESSION['user_senha'];
        $resultado_query = $this->db->query("SELECT cd_usuario FROM tb_usuario "
                . " WHERE nm_email = '$email' AND cd_senha = '$senha' LIMIT 1;");
        if($resultado_query->num_rows() > 0){
            $codigo_prop = '';
            foreach($resultado_query->result() as $row){
                $codigo_prop = $row->cd_usuario;
            }
            //preparar a string de imagem para caso ela tenha sido enviada
            $caminho_imagem = 'null';
            if(!empty($imagem['name'][0])){
                $caminho_imagem = uniqid("IPP$codigo_prop") . "." . end(explode('/', $imagem['type'][0]));
            }
            //inserir o usuario
            $resultado = $this->efetuarCadastro($nome, $ramo, $slogan, $site, $descricao, $cep, $numero, 
            $complemento, $layout, $contato1, $contato2, $caminho_imagem, $codigo_prop);
            if($resultado){
                if($caminho_imagem){
                    $this->load->library('imagem');
                    $this->imagem->RealizarUpload($imagem, base_url("src/imagens/pagina/perfil"), $caminho_imagem);
                }
                return true;
            } else { //ocorreu um erro durante a inserção
                return false;
            }
            //fazer upload da imagem
        } else { //O usuario nao esta em uma session valida
            return false;
        }
    }
    private function efetuarCadastro($nome = null, $ramo = 1, $slogan = '', 
            $site = '', $descricao = '', $cep = 1, $numero = '', 
            $complemento = null, $layout = 1, $contato1 = false, $contato2 = false,
            $imagem = null, $codigo_prop = null){
        
        $this->db->query("INSERT INTO tb_pagina (nm_pagina, "
                . "cd_ramo, nm_slogan, nm_caminho_site, nm_descricao, cd_logradouro, "
                . "nr_endereco, nm_complemento_endereco, cd_layout, nm_caminho_imagem, "
                . "cd_usuario, dt_cadastro)"
                . " VALUES ('$nome', $ramo, '$slogan', '$site', '$descricao', $cep, '$numero', "
                . "'$complemento', $layout, '$imagem', $codigo_prop, NOW());");
        
        $resultado_query = $this->db->query("SELECT cd_pagina FROM tb_pagina as P, tb_usuario as U"
                . " WHERE U.cd_usuario = $codigo_prop AND U.cd_usuario = P.cd_usuario"
                . " LIMIT 1;");
        
        if($resultado_query->num_rows() > 0){
            $codigo_pagina = null;
            foreach($resultado_query->result() as $row){
                $codigo_pagina = $row->cd_pagina;
            }
            if($contato1){
            $this->db->query("INSERT INTO tb_contato (nr_contato, cd_pagina) VALUES "
                    . "('$contato1', $codigo_pagina);");
             }
        
            if($contato2){
            $this->db->query("INSERT INTO tb_contato (nr_contato, cd_pagina) VALUES "
                    . "('$contato2', $codigo_pagina);");
            }
            return true;
        } else { // por algum motivo o insert deu erro
            return false;
        }
    }
    
    public function CarregarBoxLayoutRamo(){
        $opcoes_ramo =  array();
        $opcoes_layout = array();
        $resultado_query = $this->db->query("SELECT cd_layout, nm_cor, nm_cor_portugues FROM"
                . " tb_layout ORDER BY nm_cor;");
        if($resultado_query->num_rows() > 0){
            $index = 0;
            foreach($resultado_query->result() as $row){
                $opcoes_layout[$index] = array('codigo' => $row->cd_layout,
                    'cor_port' => $row->nm_cor_portugues,
                    'cor' => $row->nm_cor);
                $index += 1;
              /* $opcoes_layout .= "<div class='col l2 center-align'>
                    <input value='$row->cd_layout' name='layout' type='radio' id='cor$row->cd_layout' class='orange-text'/>
                    <label for='cor$row->cd_layout'>$row->nm_cor_portugues</label>
                </div>"; */
              
            }
        }
        $resultado_query2 = $this->db->query("SELECT cd_ramo, nm_ramo FROM"
                . " tb_ramo ORDER BY nm_ramo;");
        if($resultado_query2->num_rows() > 0){
            $index = 0;
            $outro = array('codigo' => null, 'ramo' => null);
            foreach($resultado_query2->result() as $row){
              //$opcoes_ramo .= "<option value='$row->cd_ramo'>$row->nm_ramo</option>";
                if($row->nm_ramo != "Outros"){
                    $opcoes_ramo[$index] = array("codigo" => $row->cd_ramo, 
                        'ramo' => $row->nm_ramo);
                    $index += 1;
                } else {
                    $outro['codigo'] = $row->cd_ramo;
                    $outro['ramo'] = $row->nm_ramo;
                }
            }
            $opcoes_ramo[$index] = $outro;
        }
        return array('opcoes_ramo' => $opcoes_ramo, 'opcoes_layout' => $opcoes_layout);
    }
    public function CarregarPaginaProprietario(){
        $email = $_SESSION['user_email'];
        $resultado_query = $this->db->query("SELECT P.cd_pagina as 'codigo'"
                . " FROM tb_pagina as P, tb_usuario as U "
                . " WHERE P.cd_usuario = U.cd_usuario AND U.nm_email = '$email'"
                . " LIMIT 1;");
        if($resultado_query->num_rows() > 0){
            foreach($resultado_query->result()  as $row){
                $codigo = $row->codigo;
            }
            return dechex($codigo);
        }else {
            return false;
        }
    }
    
    //FUNÇÕES DE ALTERAÇÃO CHAMADAS PELOS AJAX
    public function AlterarNome($novoNome = false, $codigoPagina = false){
        if($novoNome && $codigoPagina && is_numeric($codigoPagina) && !empty($novoNome)){
            $novoNome = urldecode($novoNome);
            $novoNome = str_replace("%27", "'", $novoNome);
            $novoNome = addslashes(strip_tags(trim($novoNome)));
            $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " nm_pagina = '$novoNome' WHERE cd_pagina = $codigoPagina;");
            if($resultado_query) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }   
    
    public function AlterarSlogan($novoSlogan = false, $codigoPagina = false){
        if($novoSlogan && $codigoPagina && is_numeric($codigoPagina) && !empty($novoSlogan)){
            $novoSlogan = urldecode($novoSlogan);
            $novoSlogan = addslashes(strip_tags(trim($novoSlogan)));
            $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " nm_slogan = '$novoSlogan' WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function AlterarDescricao($novaDesc = false, $codigoPagina = false){
        if($novaDesc && $codigoPagina && is_numeric($codigoPagina) && !empty($novaDesc)){
            //$novaDesc = $this->ArrumarStringUrl($novaDesc);
            $novaDesc = urldecode($novaDesc);
            $novaDesc = addslashes(trim($novaDesc));
            $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " nm_descricao = '$novaDesc' WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else{
                return false;
            }
        } else {
            echo "Aqui";
            return false;
        }
    }
    public function AlterarSite($novaUrl = "", $codigoPagina = false){
        $novaUrl  = trim($novaUrl);
        if($novaUrl && $codigoPagina && is_numeric($codigoPagina) 
                && (ereg("([a-zA-Z]{3,})://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?", $novaUrl) || 
                ereg("([a-zA-Z]{3,})://([\w-]+\.)+[\w-]+(/[\w- ./?%&=]*)?", $novaUrl) || $novaUrl == "")){
            $novaUrl = addslashes(trim($novaUrl));
            $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " nm_caminho_imagem = '$novaUrl' WHERE cd_pagina = $codigoPagina;");
            if($resultado_query->num_rows() > 0){
                return $novaUrl;
            } else
            {
                return false;
            }
        } else {
            return false;
        }
    }
    public function AlterarRamo($novoRamo = false, $codigoPagina = false){
        if(is_numeric($novoRamo) && is_numeric($codigoPagina)){
             $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " cd_ramo = $novoRamo WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function AlterarNumero($novoNumero = false, $codigoPagina = false){
        if(is_numeric($novoNumero) && is_numeric($codigoPagina)){
            $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " nr_endereco = '$novoNumero' WHERE cd_pagina = $codigoPagina;");
            if($resultado_query->num_rows() > 0){
                return $novoNumero;
            } else
            {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function AlterarLayout($novoLayout = false, $codigoPagina = false){
        if(is_numeric($novoLayout) && is_numeric($codigoPagina)){
             $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " cd_layout = $novoLayout WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}