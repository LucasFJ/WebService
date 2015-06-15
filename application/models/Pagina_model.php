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
            P.nr_telefone as 'telefone', P.nr_celular as 'celular', 
            E.nm_logradouro as 'logradouro', E.cd_cep as 'cep', E.cd_logradouro as 'codigocep', P.nr_endereco as 'numero', P.nm_complemento_endereco as 'complemento',
            B.nm_bairro as 'bairro', C.nm_cidade as 'cidade', U.sg_uf as 'uf',
            P.nm_caminho_imagem as 'imagem', P.nm_caminho_site as 'site', L.nm_cor as 'cor'
            FROM tb_pagina as P, tb_ramo as R, tb_logradouro as E, tb_bairro as B, tb_cidade as C, tb_uf = U, tb_layout as L
            WHERE P.cd_pagina = $codigo AND P.cd_ramo = R.cd_ramo AND P.cd_logradouro = E.cd_logradouro "
                . "AND B.cd_bairro = E.cd_bairro AND B.cd_cidade = C.cd_cidade AND C.cd_uf = U.cd_uf "
                . "AND P.cd_layout = L.cd_layout LIMIT 1;");
        
        if($resultado_query->num_rows() > 0){
            foreach($resultado_query->result() as $row){
                $resultado = array('codigo' => $row->codigo, 'nome' => $row->nome,
                    'slogan' => $row->slogan, 'descricao'  => $row->descricao, 
                    'ramo'  => $row->ramo, 'logradouro'  => $row->logradouro,
                    'numero'  => $row->numero, 'complemento'  => $row->complemento,
                    'bairro'  => $row->bairro, 'cidade'  => $row->cidade, 
                    'uf'  => $row->uf, 'imagem'  => $row->imagem, 
                    'site'  => $row->site, 'cor'  => $row->cor,
                    'telefone' => $row->telefone,  'celular' => $row->celular, 
                    'cep' => $row->cep, 'codigo_logradouro' => $row->codigocep );
            }
            return $resultado;
        } else { //nao existe uma pagina com o codigo especificado
            return false;
        }
    }
    public function CarregarProdutosPagina($codigo = false){
        $resultado_query = $this->db->query("SELECT nm_produto as 'nome', cd_produto as 'codigo', "
                . "nm_descricao as 'descricao', nm_caminho_imagem as 'imagem' "
                . "FROM tb_produto as PR WHERE cd_pagina = $codigo");
       $produtos = null;
       if($resultado_query->num_rows() > 0){
           $index = 0;
           foreach($resultado_query->result() as $row){
               $produtos[0] = array('nome' => $row->nome, 'descricao' => $row->descricao,
                   'codigo' => $row->codigo, 'imagem' => $row->imagem);
               $index += 1;
           }
       } else {
           $produtos = false;
       }
       return $produtos;
    }
    
    public function CadastrarPagina($nome, $ramo, $slogan,$site, $descricao, $cep, $numero, 
            $complemento, $layout, $telefone, $celular, $imagem){
        //primeira etapa >> tratando os dados para serem inseridos
        $nome = addslashes($nome);
        $ramo = (is_numeric($ramo) && $ramo > 0) ? $ramo : 47;
        $slogan = addslashes($slogan);
        $descricao = addslashes($descricao); //escapa os espaços
        $cep = (is_numeric($cep) && $cep > 0) ? $cep : null;
        $numero = (is_numeric($numero) && $numero > 0) ? $numero : '';
        $complemento = addslashes($complemento);
        $layout = (is_numeric($layout) && $layout > 0) ? $layout : 1;
        $telefone = (is_numeric($telefone)) ? $telefone : null;
        $celular = (is_numeric($celular)) ? $celular : null;
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
            $nome_imagem = 'null';
            if(!empty($imagem['name'])){
                $array_tipo = explode('.', $imagem['name']);
                $tipo = end($array_tipo);
                $tipo = strtolower($tipo);
                $prefixo = "Page$codigo_prop";
                $nome_imagem = uniqid("$prefixo"); 
                $nome_imagem = "$nome_imagem.$tipo";
            }
            //inserir o usuario
            $resultado = $this->efetuarCadastro($nome, $ramo, $slogan, $site, $descricao, $cep, $numero, 
            $complemento, $layout, $telefone, $celular, $nome_imagem, $codigo_prop);
            if($resultado){
                if($nome_imagem){
                    $this->load->library('imagem');
                    $this->imagem->salvar("src/imagens/pagina/perfil/", $imagem, $nome_imagem);
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
            $complemento = null, $layout = 1, $telefone = false, $celular = false,
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
            if($telefone){
            $this->db->query("UPDATE tb_pagina SET nr_telefone = '$telefone' WHERE"
                    . " cd_pagina = $codigo_pagina;");
             }
        
            if($celular){
            $this->db->query("UPDATE tb_pagina SET nr_celular = '$celular' WHERE"
                    . " cd_pagina = $codigo_pagina;");
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
                . " tb_layout ORDER BY nm_cor_portugues;");
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
            return $codigo;
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
            return false;
        }
    }
    public function AlterarSite($novaUrl = "", $codigoPagina = false){
        $novaUrl  = trim($novaUrl);
        $novaUrl = urldecode($novaUrl);
        if($novaUrl && $codigoPagina && is_numeric($codigoPagina) 
                && ( preg_match("/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i", $novaUrl)
                ||   preg_match("/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i", $novaUrl)
                ||   $novaUrl == "")){
            $novaUrl = addslashes($novaUrl);
            $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . " nm_caminho_site = '$novaUrl' WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else {
                echo $novaUrl;
                return false;
            }
        } else {
            echo preg_match("/^(http|https|ftp):\/\/(([A-Z0-9][A-Z0-9_-]*)(\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i", $novaUrl);
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
    public function AlterarLocalidade($novaLocalidade = false, $codigoPagina = false){
        $novaLocalidade = explode("|", urldecode($novaLocalidade));
        if(is_numeric($codigoPagina) && is_array($novaLocalidade)){
            $codigo_cep = $novaLocalidade[0];
            $numero = $novaLocalidade[1];
            $complemento = $novaLocalidade[2];
            if(is_numeric($codigo_cep) && is_numeric($numero) && preg_match("/^[A-Za-zá-úÁ=Ú.\s0-9]+$/i", $complemento)){
                $resultado_query0 = $this->db->query("UPDATE tb_pagina SET "
                    . " cd_logradouro = $codigo_cep WHERE cd_pagina = $codigoPagina;");
                $resultado_query1 = $this->db->query("UPDATE tb_pagina SET "
                    . " nr_endereco = '$numero' WHERE cd_pagina = $codigoPagina;");
                $resultado_query2 = $this->db->query("UPDATE tb_pagina SET "
                    . " nm_complemento_endereco = '$complemento' WHERE cd_pagina = $codigoPagina;");
                if($resultado_query0 && $resultado_query1 && $resultado_query2){
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
    public function AlterarContato($novoContato = false, $codigoPagina = false){
        $novoContato = explode("|", urldecode($novoContato));
        if($novoContato && $codigoPagina && is_numeric($codigoPagina) && !empty($novoContato)){
            $telefone = trim($novoContato[0]);
            $celular = trim($novoContato[1]);
            if(is_numeric($telefone)){
                $strSetTelefone = " nr_telefone = '$telefone', ";
            } else {
                $strSetTelefone = " nr_telefone = null , ";
            }
            if(is_numeric($celular)){
                $strSetCelular = " nr_celular = '$celular' ";
            } else {
                $strSetCelular = " nr_celular = null ";
            }
             $resultado_query = $this->db->query("UPDATE tb_pagina SET "
                    . $strSetTelefone . $strSetCelular ." WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else {
                return false;
            }
            
        } else {
            return false;
        }
            
    }
    
    public function ExcluirPagina($codigoPagina = false){
        if(is_numeric($codigoPagina)){
            //DELETANDO OS PRODUTOS LIGADOS A PÁGINA
            $this->db->query("DELETE FROM tb_produto WHERE cd_pagina = $codigoPagina;");
            //DELETANDO A PÁGINA
            $resultado_query = $this->db->query("DELETE FROM tb_pagina "
                    . " WHERE cd_pagina = $codigoPagina;");
            if($resultado_query){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function AlterarImagem($codigoPagina = false, $imagem = false, $imagemAntiga = false){
        if(is_numeric($codigoPagina) && isset($imagem)){
            $array_tipo = explode('.', $imagem['name']);
            $tipo = end($array_tipo);
            $tipo = strtolower($tipo);
            $prefixo = "Page$codigoPagina";
            $nome_imagem = uniqid("$prefixo"); 
            $nome_imagem = "$nome_imagem". "." ."$tipo";
            
            $this->load->library('imagem');
            $resultado = $this->imagem->salvar("src/imagens/pagina/perfil/", $imagem, $nome_imagem);
            if($resultado){
                $this->db->query("UPDATE tb_pagina SET nm_caminho_imagem = '$nome_imagem'"
                    . " WHERE cd_pagina = $codigoPagina;");
                if(file_exists("src/imagens/pagina/perfil/$imagemAntiga")){
                    unlink("src/imagens/pagina/perfil/$imagemAntiga");
                }
                return $nome_imagem;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    //FUNCOES LIGADAS AO PRODUTO DA PAGINA
    public function CadastrarProduto($codigoPagina = false, $caminhoImagem = false, $nomeProduto, $descricaoProduto){
        if(is_numeric($codigoPagina) && (!empty($caminhoImagem)) && (!empty($nomeProduto)) && (!empty($descricaoProduto))){
            $resultado_query = $this->db->query("SELECT cd_produto as 'codigo' FROM tb_produto "
                    . "WHERE cd_pagina = $codigoPagina;");
            if($resultado_query->num_rows() < 9){
                $array_tipo = (explode('.', $caminhoImagem));
                $tipo = end($array_tipo);
                $tipo = strtolower($tipo);
                $novaImagem = uniqid("Prod");
                $novaImagem = "$novaImagem.$tipo";
                $resultado_query = $this->db->query("INSERT INTO tb_produto (nm_produto, nm_descricao, cd_pagina, nm_caminho_imagem) "
                        . " VALUES ('$nomeProduto', '$descricaoProduto', $codigoPagina, '$novaImagem');");
                if($resultado_query){
                    copy("src/imagens/temp/$caminhoImagem", "src/imagens/pagina/produto/$caminhoImagem");
                    rename("src/imagens/pagina/produto/$caminhoImagem", "src/imagens/pagina/produto/$novaImagem");
                    unlink("src/imagens/temp/$caminhoImagem");
                    return true;
                } else { //ocorreu um erro durante a inserção
                    return false;
                }
            } else { // o usuario ja possui 9 produtos no sistema e precisa deletar algum
                return false;
            }
        } else {
            return false; 
        }    
    }
    public function DeletarProduto($codigoPagina = false, $codigoProduto = false){
        if($codigoPagina && $codigoProduto){
            $resultado_query = $this->db->query("DELETE FROM tb_produto WHERE"
                    . " cd_produto = $codigoProduto AND cd_pagina = $codigoPagina;");
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