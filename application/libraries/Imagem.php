<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem {
    
    public function __construct() {
    }
    
    protected $tipos = array("jpeg", "png");
    
    public function RealizarUpload($imagem, $destino, $novo_nome){
        $tipo_imagem   = $imagem['type'];
        $tmp_imagem     = $imagem['tmp_name'];
        $erro_imagem    = $imagem['error'];
        
        for ( $i = 0; $i < count( $erro_imagem ); $i++ ) {
            if ( $erro_imagem[$i] != 0 ) {
                    return false;
            } else {
                    if(in_array( $tipo_imagem[$i], $this->permitir_tipos)) {
                            if(move_uploaded_file($tmp_imagem[$i], "$destino/$novo_nome")) {
                                    return true;
                            } else {
                                    return false;
                            }
                    } else {
                            return false;
                    }
            }
        }
    }
    
    public $width = 300;
    public $height = 300;
    
    public function salvar($caminho, $file, $novoNome){
        //mudando o nome que o arquiva irá utilizar
        $file['name'] = $novoNome;
        //definindo o caminho de upload
        $uploadfile = $caminho.$file['name'];
        //Verificando o tipo da image: .jpg .png ou outros
        $array_tipo = (explode('/', $file['type']));
        $tipo = end($array_tipo);
        $tipo = strtolower($tipo);
        if (array_search($tipo, $this->tipos) === false){ 
            return false; //arquivo de tipo nao permitido
        } elseif (!move_uploaded_file($file['tmp_name'], $uploadfile)){
            return false; //erro durante o upload
        } else {
            //verificando se é necessario o redimensionamento
            list($width_orig, $height_orig) = getimagesize($uploadfile); 
            if($width_orig > $this->width || $height_orig > $this->height){
                $this->redimensionar($caminho, $file['name']);
            }
            return true; //ocorreu tudo como planejado.
        }
    }
    
    protected function redimensionar($caminho, $nomearquivo){
        $width = $this->width; 
        $height = $this->height;
        // Pegamos a largura e altura originais, além do tipo de imagem 
        list($width_orig, $height_orig, $tipo, $atributo) = getimagesize($caminho.$nomearquivo);
        // Se largura é maior que altura, dividimos a largura determinada pela original e 
        // multiplicamos a altura pelo resultado, para manter a proporção da imagem 
        if($width_orig > $height_orig){ 
            $height = ($width/$width_orig)*$height_orig;
        } elseif($width_orig < $height_orig) {
            $width = ($height/$height_orig)*$width_orig; 
        }
        
        // Criando a imagem com o novo tamanho
        $novaimagem = imagecreatetruecolor($width, $height); 
        switch($tipo){
            //TIPO GIF
            case 1: return false;
                break;
            //TIPO JPG
            case 2:
                $origem = imagecreatefromjpeg($caminho.$nomearquivo); 
                imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig); 
                imagejpeg($novaimagem, $caminho.$nomearquivo); 
                break;
            //IMAGEM PNG
            case 3:
                $origem = imagecreatefrompng($caminho.$nomearquivo);
                imagecopyresampled($novaimagem, $origem, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
                imagepng($novaimagem, $caminho.$nomearquivo); 
                break;
        } 
        // Destrói a imagem nova criada e já salva no lugar da original 
        imagedestroy($novaimagem); 
        // Destrói a cópia de nossa imagem original 
        imagedestroy($origem); 
    } 
}
