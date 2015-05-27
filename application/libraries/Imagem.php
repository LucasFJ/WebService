<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Imagem {
    
    public function __construct() {
    }
    
    public $permitir_tipos  = array('image/jpeg', 'image/png');
    
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
}
