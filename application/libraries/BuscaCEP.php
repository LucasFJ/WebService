<?php defined('BASEPATH') OR exit('No direct script access allowed');

class BuscaCEP {
    
    public function __construct() {
    }
    
    public function fazerConsulta($cep){
        if(isset($cep)){
            
            if(empty($cep)){
                echo "<script> alert('Informe o CEP!'); </script>";
                return false;
            }
            else{
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
                
                $logradouro = strip_tags($campoTabela[0][0]);
                $bairro = strip_tags($campoTabela[0][1]);
                $cidade = strip_tags($campoTabela[0][2]);
                $uf = strip_tags($campoTabela[0][3]);
                
                return array('logradouro' => $logradouro, 'bairro' => $bairro, 'cidade' => $cidade, 'uf' => $uf);
            }
            return false;
        }
        
    }
    
    
}