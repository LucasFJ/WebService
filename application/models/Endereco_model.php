<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Endereco_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    //FUNÇÃO: retornar os dados de um determinado cep
    //1º - o cep está cadastrado no nosso banco?
    //2º - o cep está registrado no banco dos correios?
    public function retornarEndereco($cep){
        $codigo_logradouro = $this->verificarEnderecoBanco($cep);
        if(!$codigo_logradouro){
            //$codigo_logradouro = $this->verificarEnderecoCorreios($cep);
            return false;
        }
        if(!$codigo_logradouro){ //O CEP nao existe nem no banco nem nos Correios
            return false;
        } else {
            $dados_endereco = $this->buscarDadosEndereco($codigo_logradouro);
            return $dados_endereco;
        }
    }
    
    private function verificarEnderecoBanco($cep){
        $resultado_query = $this->db->query("SELECT cd_logradouro"
                . " FROM tb_logradouro "
                . " WHERE cd_cep = $cep LIMIT 1;");
        if($resultado_query->num_rows() > 0){
            foreach ($resultado_query->result() as $row){
                $codigo_logradouro = $row->cd_logradouro;
            }
            return $codigo_logradouro;
        } else {
            return false;
        }
    }
    
    private function verificarEnderecoCorreios($cep){
        $postCorreios = 'CEP=' . $cep . '&Metodo=listaLogradouro&TipoConsulta=cep';
        $cURL = curl_init('http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do');
            
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($cURL, CURLOPT_HEADER, 0);
        curl_setopt($cURL, CURLOPT_POST, 1);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $postCorreios);

        $saida = curl_exec($cURL);
        curl_close($cURL);
        $saida = utf8_encode($saida);

        $tabela = preg_match_all('/<td (.*?)<\/td>/i', $saida, $campoTabela);
        if(empty($tabela) || !$tabela){
            return false;
        } else {
            $logradouro = strip_tags($campoTabela[0][0]);
            $bairro = strip_tags($campoTabela[0][1]);
            $cidade = strip_tags($campoTabela[0][2]);
            $uf = strip_tags($campoTabela[0][3]);
            $codigo_logradouro = $this->cadastrarEnderecoBanco($cep, $logradouro, $bairro, $cidade, $uf);
            if($codigo_logradouro){
               return $codigo_logradouro;
            } else {
              return false;
            }
        }
    }
    
    //Verificação em cascata para verificar quais dados ja estão cadastrados e quais 
    //precisam cadastrar e gerar novos codigos
    private function cadastrarEnderecoBanco($cep, $logradouro, $bairro, $cidade, $uf){
        $result_query = $this->db->query("SELECT cd_uf FROM tb_uf WHERE sg_uf LIKE '$uf' LIMIT 1; ");
        //VERIFICAÇÃO DO UF
        if($result_query->num_rows() > 0){
            foreach ($result_query->result() as $row){
                $codigo_uf = $row->cd_uf;
            }
            //CADASTRAMENTO DA CIDADE
            $result_query = $this->db->query("SELECT cd_cidade FROM tb_cidade "
                    . " WHERE cd_uf = $codigo_uf AND nm_cidade = '$cidade' LIMIT 1;");
            if($result_query->num_rows() > 0){
                foreach ($result_query->result() as $row){
                    $codigo_cidade = $row->cd_cidade;
                }
            } else {
                $this->db->query("INSERT INTO tb_cidade (nm_cidade, cd_uf) values "
                        . " ('$cidade', $codigo_uf)");
                $result_query = $this->db->query("SELECT cd_cidade FROM tb_cidade "
                    . " WHERE cd_uf = $codigo_uf AND nm_cidade = '$cidade' LIMIT 1;");
                if($result_query->num_rows() > 0){
                    foreach ($result_query->result() as $row){
                        $codigo_cidade = $row->cd_cidade;
                    }
                }
            }
            //CADASTRAMENTO DO BAIRRO
            $result_query = $this->db->query("SELECT cd_bairro FROM tb_bairro "
                    . " WHERE cd_cidade = $codigo_cidade AND nm_bairro = '$bairro' LIMIT 1;");
            if($result_query->num_rows() > 0){
                foreach ($result_query->result() as $row){
                    $codigo_bairro = $row->cd_bairro;
                }
            } else {
                $this->db->query("INSERT INTO tb_bairro (nm_bairro, cd_cidade) values "
                        . " ('$bairro', $codigo_cidade)");
                $result_query = $this->db->query("SELECT cd_bairro FROM tb_bairro "
                    . " WHERE cd_cidade = $codigo_cidade AND nm_bairro = '$bairro' LIMIT 1;");
                if($result_query->num_rows() > 0){
                    foreach ($result_query->result() as $row){
                        $codigo_bairro = $row->cd_bairro;
                    }
                }
            }
            //CADASTRANDO LOGRADOURO
            $codigo_logradouro = false;
            $result_query = $this->db->query("SELECT cd_logradouro FROM tb_logradouro "
                    . " WHERE cd_bairro = $codigo_bairro AND nm_logradouro = '$logradouro' "
                    . " AND cd_cep = '$cep' LIMIT 1;");
            if($result_query->num_rows() > 0){
                foreach ($result_query->result() as $row){
                    $codigo_logradouro = $row->cd_logradouro;
                }
            } else {
                $this->db->query("INSERT INTO tb_logradouro (nm_logradouro, cd_cep, cd_bairro) VALUES "
                        . " ('$logradouro', '$cep', $codigo_bairro);");
                $result_query = $this->db->query("SELECT cd_logradouro FROM tb_logradouro "
                    . " WHERE cd_bairro = $codigo_bairro AND nm_logradouro = '$logradouro' "
                    . " AND cd_cep = '$cep' LIMIT 1;");
                if($result_query->num_rows() > 0){
                    foreach ($result_query->result() as $row){
                         $codigo_logradouro = $row->cd_logradouro;
                    }
                }
                return $codigo_logradouro;
            }
            
        } else {
            return false;
        }
    }
    
    private function buscarDadosEndereco($codigo_logradouro){
        $resultado_query = $this->db->query("SELECT nm_logradouro as 'logradouro', B.nm_bairro as 'bairro', C.nm_cidade as 'cidade', UF.sg_uf as 'uf'
	FROM tb_logradouro as L, tb_bairro as B, tb_cidade as C, tb_uf as UF
    	WHERE L.cd_logradouro = $codigo_logradouro AND L.cd_bairro = B.cd_bairro AND B.cd_cidade = C.cd_cidade AND C.cd_uf = UF.cd_uf
        	LIMIT 1;");
        if($resultado_query->num_rows() > 0){
            foreach ($resultado_query->result() as $row){
                $logradouro = $row->logradouro;
                $bairro = $row->bairro;
                $cidade = $row->cidade;
                $uf = $row->uf;
            }
            return "$logradouro+$bairro+$cidade+$uf+$codigo_logradouro";
        } else {
            return false;
        }
    }
}