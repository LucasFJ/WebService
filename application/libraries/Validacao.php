<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Validacao {
    
    public function __construct() {
    }
    
    //Funcoes globais de validacao
    public function ValidImagem($str){
        $resultado = preg_match("/.png|.jpg$/i", $str);
        return $resultado;
    }
    
    public function ValidEmail($str){
        return filter_var($str, FILTER_VALIDATE_EMAIL);
    }
    
    //Validar dados dos produtos
    public function ValidNomeProd($str){
        $resultado = preg_match("/^[A-Za-zá-úÁ=Ú\s0-9]{1,35}$/i", $str);
        return $resultado;
    }
    
    public function ValidDescProd($str){
        $resultado = preg_match("/^[A-Za-zá-úÁ=Ú\s0-9]{1,35}$/i", $str);
        return $resultado;
    }
    
    
}