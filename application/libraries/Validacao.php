<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validacao {
    
    public function __construct() {
    }
    
    //FUNCOES GLOBAIS DE VALIDACAO
    public function ValidImagem($str){
        $resultado = preg_match("/.png|.jpg$/i", $str);
        return $resultado;
    }
    
    public function ValidEmail($str){
        $conta = "/^[a-zA-Z0-9\._-]+@";
        $dominio = "[a-zA-Z0-9\._-]+.";
        $extensao = "([a-zA-Z]{2,4})$/";
        $expressao = $conta.$dominio.$extensao;
        $resultado = preg_match($expressao, $str);
        return $resultado;
        //return filter_var($str, FILTER_VALIDATE_EMAIL);
    }
    
    public function ValidTelefone($str){
         $resultado = preg_match("/^[0-9]{10}$/i", $str);
        return $resultado;
    }
    
    public function ValidCelular($str){
         $resultado = preg_match("/^[0-9]{11}$/i", $str);
        return $resultado;
    }
    
    public function ValidNatural($str){
        $resultado = preg_match("/^[0-9]{1,11}$/i", $str);
        return $resultado;
    }
    
    //VALIDAR DADOS DO USUARIO
    public function ValidNome($str){
        $resultado = preg_match("/^[A-Za-zà-úÀ-Ú\s]{2,20}$/i", $str);
        return $resultado;
    }
    //senha de no minimo 6 digitos e maximo 25
    //contendo  pelo menos uma letra minuscula, uma letra maiuscula e um algarismo: 
    public function ValidSenha($str){
        //$resultado = preg_match("/^.*(?=.{6,25})(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).*$/", $str);
        $resultado = preg_match("/^[A-Za-z0-9_\\/?&!@#$%&*+\-]{4,40}$/i", $str);
        return $resultado;
    }
    
    //VALIDAR DADOS DA PÁGINA
    public function ValidNomePagina($str){
        $resultado = preg_match("/^[ªº\.,'!?&+\-A-Za-zà-úÀ-Ú\s0-9]{2,25}$/i", $str);
        return $resultado; //
    }
    
    public function ValidSloganPagina($str){
        $resultado = preg_match("/^[ªº\.,'!?&+\-A-Za-zà-úÀ-Ú\s0-9]{2,40}$/i", $str);
        return $resultado;
    }
    
    public function ValidDescPagina($str){
        $resultado = preg_match("/^[\(\)\\/ªº\.,'!?@#$%*&+\-A-Za-zà-úÀ-Ú\s0-9]{2,180}$/i", $str);
        return $resultado;
    }
    
    public function ValidSitePagina($str){
        $resultado = preg_match("/^(www)((\.[A-Z0-9][A-Z0-9_-]*)+.(com|org|com.br|.net)$)(:(\d+))?\/?/i", $str);
        return $resultado;
    }
    
    public function ValidNumeroEnderecoPagina($str){
        $resultado = preg_match("/^[0-9]{1,7}$/i", $str);
        return $resultado;
    }
    
    public function ValidComplementoEndereco($str){
        $resultado = preg_match("/^[\.\-ºªA-Za-zà-úÀ-Ú\s0-9]{2,25}$/i", $str);
        return $resultado;
    }
    
    public function ValidDataNascimento($str){
        $resultado = preg_match("/^[,A-Za-zà-úÀ-Ú\s0-9]{10,30}$/i", $str);
        return $resultado;
    }
        
    //VALIDAR DADOS DO PRODUTO
    public function ValidNomeProd($str){
        $resultado = preg_match("/^['$#!%&\(\)\.A-Za-zà-úÀ-Ú\s0-9]{1,35}$/i", $str);
        return $resultado;
    }
    
    public function ValidDescProd($str){
        $resultado = preg_match("/^[\(\)\\/ªº\.,'!?@#$%*&+\-A-Za-zà-úÀ-Ú\s0-9]{2,200}$/i", $str);
        return $resultado;
    }
    
    public function ValidMensagemContato($str){
        $resultado = preg_match("/^[\(\)\\/ªº\.,'!?@#$%*&+\-A-Za-zà-úÀ-Ú\s0-9]{2,500}$/i", $str);
        return $resultado;
    }
}