<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php
    $titulo = (isset($titulo)) ? $titulo : "Sniffoo";
    //foreach($javascript as $value){
    //   echo "<script type='text/javascript' src=". base_url("src/js/$value") ."></script>";
    //}
    ?>
    <title><?php echo $titulo; ?></title>
    
    <!-- Metas Facebook -->
    <meta property="og:locale" content="pt-BR">
    <meta property="og:title" content="Titulo" />
    <meta property="og:description" content="Encontre o que precisa com apenas alguns cliques" />
    <meta property="og:url" content="<?php base_url(); ?>" />
    <meta property="og:site_name" content="Nome do Site" />
    <meta property="og:image" content="<?php echo base_url('src/imagens/default/lucas.jpg'); ?>" />
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="800">
    <meta property="og:image:height" content="600">
        
        
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('src/imagens/default/sniffoo-fav.ico'); ?>" />
    
    <?php 
    $css = isset($css) ? $css : null;
    if(is_array($css)){
        echo "<link href='". base_url('src/css/materialize.min.css') ."' type='text/css' rel='stylesheet' media='screen,projection' />";
        foreach($css as $src){
        echo "<link href='". base_url('src/css/' . $src) ."' type='text/css' rel='stylesheet' media='screen,projection' />";
        }
    } else {
        echo "<link href='". base_url('src/css/materialize.min.css') ."' type='text/css' rel='stylesheet' media='screen,projection' />
              <link href='". base_url('src/css/style.css') ."' type='text/css' rel='stylesheet' media='screen,projection' />";
    }
    ?>
    
    
  </head>