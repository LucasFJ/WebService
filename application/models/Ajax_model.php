<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function carregarCartoes($nome = false, $ramo = false, $estado = false, 
            $cidade = false, $bairro = false, $ordenacao = false, $offset = 0){
        
        //Conteúdo buscado (Ainda não existe a tabela de avaliação)
        $strConsulta = "SELECT DISTINCT P.nm_pagina as 'nome', P.nm_slogan as 'slogan', "
                . " P.nr_telefone as 'telefone', P.nr_celular as 'celular', "
                . " L.nm_logradouro as 'endereco', B.nm_bairro as 'bairro',"
                . " P.nr_endereco as 'numero',P.nm_caminho_imagem as 'imagem',  "
                . "P.cd_pagina as 'codigo', C.nm_cidade as 'cidade', UF.sg_uf as 'estado',"
                . "COR.nm_cor as 'cor'";
        //Tabelas de origem
        $strConsulta .= " FROM tb_pagina as P, tb_ramo as R, tb_logradouro as L, tb_bairro as B, tb_cidade as C, tb_uf as UF, "
                . "tb_layout as COR ";
        //Condições de busca
        $strConsulta .= " WHERE L.cd_logradouro = P.cd_logradouro AND L.cd_bairro = B.cd_bairro"
                . " AND B.cd_cidade = C.cd_cidade AND C.cd_uf = UF.cd_uf AND P.cd_layout = COR.cd_layout ";
        if($nome) { //algum nome foi especificado?
            $strConsulta .= "AND P.nm_pagina LIKE '%$nome%' ";
        }
        if($ramo){ // algum ramo foi especificado?
            $strConsulta .= "AND P.cd_ramo = $ramo ";
        }
        if($estado){ // algum estado foi especificado?
            $strConsulta .= "AND UF.cd_uf = $estado ";
        }
        if($cidade){ // alguma cidade foi especificada?
            $strConsulta .= "AND C.cd_cidade = $cidade ";
        }
        if($bairro){ // algum bairro foi especificado?
            $strConsulta .= "AND B.cd_bairro = $bairro ";
        }
        //modo de ordenação
        if($ordenacao) {
            switch ($ordenacao){
                default :
                case 1: 
                case 2: $strConsulta .= "ORDER BY 1 ";
                    break;
                case 3: $strConsulta .= "ORDER BY 1 DESC ";
                    break;
            }
        } else {
            $strConsulta .= "ORDER BY 1 ";
        }
        //limite e offset
        $strConsulta .= " LIMIT 5 OFFSET $offset;";
        
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
                    $telefone = $row->telefone;
                    $celular = $row->celular;
                    $imagem = $row->imagem;
                    $codigo = $row->codigo;
                    $cor = $row->cor;
                     
                    //chamamos a função que vai inserir os dados no molde da faixada
                    $resultado .= $this->novoCartao($nome, $slogan, $endereco, $bairro, $cidade, $estado, $numero, $imagem, $codigo, 
                            $cor, $telefone, $celular);
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
            $imagem = false, $codigo = 0, $cor = 'deep-purple', $telefone = null, $celular = null){
        //INSIRA AQUI O CÓDIGO HTML PARA CADA FAIXADA QUE SERÁ EXIBIDA
        if($imagem == null || empty($imagem)){ $imagem = "harry-square.png"; }
        if(!$cor){ $cor = "deep-orange"; }
        $contato = (is_numeric($telefone) && is_numeric($celular)) ? "$telefone | $celular" : false;
        if(!$contato){
            $contato = (is_numeric($telefone)) ? $telefone : ((is_numeric($celular))  ? $celular  : "");
        }
        return "<div class='conteudo cartao'>"
                ."<div class='card-panel $cor darken-1 z-depth-1'>"
                    ."<div class='row cardConteudo valign-wrapper'>"
                    ."<div class='col s3 right-align cardImagem'>"
                    ."<img src='". base_url("src/imagens/pagina/perfil/$imagem") ."' class='circle imgServico z-depth-1'/>"
                    ."</div><div class='col s9 center-align cardInfo'>"
                        ."<div class='row white-text left-align cardTopo'>"
                            ."<span class='nomeServico'>$nome</span><br />"
                            ."<h6 class='sloganServico'>$slogan</h6>"
                            ."<h6 class='enderecoServico'>&nbsp;$bairro, $cidade - $estado</h6>"
                            ."<h6 class='enderecoServico'> &nbsp;<span class='telefone'>$telefone</span> <span class='celular'>$celular</span> </h6>"
                        ."</div><div class='row cardRodape valign-wrapper'>"
                        ."<div class='col s4 left-align  valign-wrapper cardRate'>"
                            ."<i class='mdi-action-star-rate white-text rateServico'></i>"
                            ."<i class='mdi-action-star-rate white-text rateServico'></i>"
                            ."<i class='mdi-action-star-rate white-text rateServico'></i>"
                            ."<i class='mdi-action-star-rate white-text rateServico'></i>"
                            ."<i class='mdi-action-star-rate white-text rateServico'></i>"
                        ."</div><div class='col s8 right-align cardBotoes'>"
                            ."<a href='". base_url("pagina/visualizar/$codigo")."' class='modal-trigger btn-floating waves-effect waves-light $cor darken-4 btnServico'><i class='mdi-action-info-outline'></i></a>"
                           // ."<a href='' class='btn-floating waves-effect waves-light  $cor darken-2 btnServico'><i class='mdi-maps-place iconeBotao'></i></a>"
                          //  ."<a href='#modalComentar' class='modal-trigger btn-floating waves-effect waves-light $cor darken-2 btnServico'><i class='mdi-communication-comment iconeBotao'></i></a>"
                          //  ."<a href='#modalCompartilhar' class='modal-trigger btn-floating waves-effect waves-light $cor darken-2 btnServico'><i class='mdi-social-share valign-wrapper iconeBotao'></i></a>"
                        ."</div></div></div></div></div></div>";
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
            return $resultado;
        } else {
            return "<option value='0' selected>Ramo da página</option>";
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
            return $resultado;
        } else {
            return "<option value='0' selected>Estado</option>";
        }
    }
    public function carregarOpcoesCidade($codigo = 1){
        $resultado_query = $this->db->query("SELECT DISTINCT C.cd_cidade as 'codigo', C.nm_cidade as 'nome' 
    	 FROM tb_uf as U, tb_cidade as C, tb_bairro as B, tb_logradouro as L, tb_pagina as P
         	 WHERE U.cd_uf = C.cd_uf AND C.cd_cidade = B.cd_cidade AND  
             	B.cd_bairro = L.cd_Bairro and P.cd_logradouro = L.cd_logradouro AND U.cd_uf = $codigo ORDER BY 2;");
        if($resultado_query->num_rows() > 0){
            $resultado = "<select name='cidade'  id='cidade' required onchange='CarregarBoxBairro()'><option value='0' selected>Cidade</option>";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome;
                $codigo = $row->codigo;
                $resultado .= "<option value='$codigo'>$nome</option>";
            }
            echo "$resultado </select>";
        } else {
            echo " ";
        }
    } 
    public function carregarOpcoesBairro($codigo = 1){
        $resultado_query = $this->db->query("SELECT DISTINCT B.cd_bairro as 'codigo',"
                . " B.nm_bairro as 'nome' FROM tb_uf as U, tb_cidade as C, tb_bairro as B,"
                . " tb_logradouro as L, tb_pagina as P WHERE U.cd_uf = C.cd_uf AND"
                . " C.cd_cidade = B.cd_cidade AND B.cd_bairro = L.cd_Bairro and P.cd_logradouro = L.cd_logradouro "
                . " AND C.cd_cidade = $codigo ORDER BY 2;");
        if($resultado_query->num_rows() > 0){
            $resultado = "<select name='bairro' id='bairro' required><option value='0' selected>Bairro</option>";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome;
                $codigo = $row->codigo;
                $resultado .= "<option value='$codigo'>$nome</option>";
            }
            echo "$resultado </select>";
        } else {
            echo " ";
        }
    }
    
    
    public function CriarImagemTemp($imagem, $imagemAntiga){
        $array_tipo = explode('.', $imagem['name']);
        $tipo = end($array_tipo);
        $tipo = strtolower($tipo);
        $nome_imagem = uniqid("Temp"); 
        $nome_imagem = "$nome_imagem". "." ."$tipo";
        $this->load->library('imagem');
        $resultado = $this->imagem->salvar("src/imagens/temp/", $imagem, $nome_imagem, "retangulo");
        if($resultado){
            if(!empty($imagemAntiga)){
                if(file_exists("src/imagens/temp/$imagemAntiga")){
                    unlink("src/imagens/temp/$imagemAntiga");
                }
            }
            return $nome_imagem;
        } else {
            return false;
        }
    }
    
    public function InserirComentario($codigoUsuario, $codigoPagina = false, $comentario = false){
        $comentario = urldecode($comentario);
        $resultado_query = $this->db->query("SELECT C.cd_usuario "
                . " FROM comenta as C "
                . " WHERE C.cd_usuario = $codigoUsuario AND C.cd_pagina = $codigoPagina LIMIT 1;");
        if($resultado_query->num_rows() > 0){ //substitui o comentario
            $resultado_query = $this->db->query("UPDATE comenta SET ds_comentario = '$comentario', "
                    . " dt_comentario = NOW() WHERE cd_usuario = $codigoUsuario AND cd_pagina = $codigoPagina;");

        } else { // cria um comentario
            $resultado_query = $this->db->query("INSERT INTO comenta (cd_usuario, cd_pagina, ds_comentario, dt_comentario) "
                    . " values ($codigoUsuario, $codigoPagina, '$comentario', NOW());"); 
        }
        //verificando se a criação ou alteração foi bem sucedida
        if($resultado_query){
            $this->CarregarComentarios($codigoPagina, 0, $codigoUsuario, true);
        } else {
            echo "Erro";
        }
    }
    
    public function CarregarComentarios($codigoPagina = false, $offset = 0, $codigoUsuario = false, $Proprio = false){
        $strSelect = "SELECT U.nm_usuario as 'nome', U.nm_sobrenome as 'sobrenome', U.nm_caminho_imagem as 'imagem', "
                . " C.ds_comentario as 'comentario', C.dt_comentario as 'data'"
                . " FROM tb_usuario as U, comenta as C, tb_pagina as P"
                . " WHERE U.cd_usuario = C.cd_usuario AND C.cd_pagina = P.cd_pagina AND C.cd_pagina = $codigoPagina ";
        if(is_numeric($codigoUsuario) && $Proprio == true){
            $strSelect .= "AND C.cd_usuario = $codigoUsuario LIMIT 1;";
        } else {
            $strSelect .= "AND C.cd_usuario <> $codigoUsuario ORDER BY 4 LIMIT 2 OFFSET $offset ;";
        }
        $resultado_query = $this->db->query($strSelect);
        if($resultado_query->num_rows() > 0){
            $retorno = " ";
            foreach($resultado_query->result() as $row){
                $nome = $row->nome ." ". $row->sobrenome;
                $data = date('H:i d/m/Y', strtotime($row->data));
                $imagem = $row->imagem;
                $comentario = $row->comentario;
                $retorno .= $this->NovoComentario($nome, $imagem, $comentario, $data, $Proprio, $codigoPagina);
            }
            echo $retorno;
        } else {
            echo "Vazio";
        }
    }
    
    public function NovoComentario($nome, $imagem, $comentario, $data, $isDono = false, $codigoPagina = 0){
    $imagem = (preg_match("/.png|.jpg$/i", $imagem)) ? base_url("src/imagens/usuario/$imagem") : base_url("src/imagens/default/default.png"); 
    if($isDono){
        $retorno = "<div class='card-panel z-depth-1 card-comentario'>";
    }else {
        $retorno = "<div class='card-panel z-depth-1 card-comentario comentario'>";
    }
    $retorno .= "<div class='row'>
        <div class='col s3 m3 l3 center-align'>
            <img src='$imagem' class='responsive-img materialboxed circle' />
        </div>  
        <div class='col s9 m9 l9col-informacoes'>
        <div class='row valign-wrapper row-informacoes'>
            <div class='col s10 m10 l10 left-align grey-text text-darken-4 comentario-nome'><strong>$nome</strong></div>";
            if($isDono){
                $retorno .= "<div class='col s2 m2 l2 right-align grey-text text-darken-3 comentario-excluir'><a href='#' onclick='ExcluirComentario($codigoPagina);'><i class='mdi-content-clear red-text small'></i></a></div>";
            }
            
    $retorno .= "</div><br/>
        <div class='row'>
            <div class='col s12 m12 l12 comentario-texto'>$comentario</div>
        </div><br/>
        <div class='row row-data'>
            <div class='col s12 m12 l12 left-align grey-text text-darken-2 comentario-data'>$data</div>
        </div>
        </div> 
    </div>
    </div>";
    return $retorno;
    }
    
    public function ExcluirComentario($codigoUsuario, $codigoPagina){
        $resultado_query = $this->db->query("DELETE FROM comenta "
                . " WHERE cd_usuario = $codigoUsuario AND cd_pagina = $codigoPagina;");
        if($resultado_query){
            echo " ";
        } else {
            echo "Erro";
        }
    }
    
    public function CarregarCodigoUsuario(){
        $email = $_SESSION['user_email'];
        $resultado_query = $this->db->query("SELECT cd_usuario as 'codigo'"
                . " FROM tb_usuario "
                . " WHERE nm_email = '$email' "
                . " LIMIT 1;");
        if($resultado_query->num_rows() > 0){
            foreach($resultado_query->result()  as $row){
                $codigoUsuario = $row->codigo;
            }
            return $codigoUsuario;
        } else {
            return false;
        } 
            
    }
    
    
    public function AvaliarPagina($codigoPagina, $codigoUsuario, $valorDado){
        if($valorDado < 5){
            echo $valorDado ." ". $codigoUsuario;
            $resultado_query = $this->db->query("select vl_avaliacao from avalia where"
                    . " cd_usuario = $codigoUsuario and cd_pagina = $codigoPagina limit 1;");
            if($resultado_query->num_rows() > 0){
                $resultado_query = $this->db->query("update avalia set vl_avaliacao = $valorDado
                     , dt_avaliacao = NOW() where cd_usuario = $codigoUsuario and cd_pagina = $codigoPagina;");
                
            } else {
                $resultado_query = $this->db->query("insert into avalia (cd_usuario, cd_pagina, dt_avaliacao, vl_avaliacao)"
                        . " values ($codigoUsuario, $codigoPagina, NOW(), $valorDado);");
            }
            
            if($resultado_query){
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
        
    }
    /* case 
		when  avg(A.vl_avaliacao) < 2 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/4  
      	when  avg(A.vl_avaliacao) < 3 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/3  
        when  avg(A.vl_avaliacao) < 4 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/2  
        when   avg(A.vl_avaliacao) < 6 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/1  
    end as 'ordenacao'
    
    public function TestandoAvg(){
        $strConsulta = "select avg(A.vl_avaliacao) as 'media',  case 
		when  avg(A.vl_avaliacao) < 2 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/4  
      	when  avg(A.vl_avaliacao) < 3 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/3  
        when  avg(A.vl_avaliacao) < 4 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/2  
        when   avg(A.vl_avaliacao) < 6 then (avg(A.vl_avaliacao) * count(A.cd_usuario))/1  
    end as 'ordenacao' FROM avalia as A WHERE cd_pagina = ";
        /* $resultado_query = $this->db->query("SELECT DISTINCT P.cd_pagina as 'codigo', avg(A.vl_avaliacao) as 'media', count(A.cd_usuario) as 'quantidade' 
	
     
    
	from tb_pagina as P, avalia as A
		where P.cd_pagina = A.cd_pagina; 
"); 
        $resultado_query = $this->db->query($strConsulta);
        if($resultado_query->num_rows() > 0){
            foreach($resultado_query->result() as $row){
                echo $row->nome." -- ". $row->media ." -- ". $row->quantidade ." -- ". "<br/> ";
            }
        } else {
            echo "retorno vazio";
        }
    } */
} 
