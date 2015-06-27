<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.1//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-2.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" version="XHTML+RDFa 1.1" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.w3.org/1999/xhtml http://www.w3.org/MarkUp/SCHEMA/xhtml-rdfa-2.xsd" lang="de" xml:lang="de" dir="ltr" xmlns:og="http://ogp.me/ns#" >
    <head>
    <title>Sniffoo</title>
    <meta name="description" content="Bem-vindo ao Sniffoo. Encontre empresas e negócios próximos de sua região." />
    <meta name="keywords" content="site, design, tecnologia, região, página, divulgação, tcc, baixada, publicidade, propaganda, variedades, apps, interativo, gabriel van loon, agda luiza, lucas figueiredo, lucasfj, leo caratin, procura, mapa, empresa, negócio, loja, comércio, compra, vende, etec, informatica, sistema" />
    
    <?php 
    if(isset($codigo)){
        echo'<meta property="og:url" content="'. base_url('pagina/visualizar/' . $codigo) .'" />
        <link rel="image_src" href="' . base_url('src/imagens/pagina/perfil/' . $imagem) . '" />
        <meta property="og:image" content="' . base_url('src/imagens/pagina/perfil/' . $imagem) .'" />
        <meta property="og:image:width" content="150" />
        <meta property="og:image:height" content="150" />
        <meta property="og:site_name" content="Sniffoo" />
        <meta property="og:title" content="'. $nome . '" />
        <meta property="og:description" content="'. $descricao .'" />';
        
    } else { 
        echo'<meta property="og:url" content="'. base_url() .'" />
        <link rel="image_src" href="' . base_url('src/imagens/default/sniffoo-logo-fundo.png') . '" />
        <meta property="og:image" content="' . base_url('src/imagens/default/sniffoo-logo-fundo.png') .'" />
        <meta property="og:image:width" content="150" />
        <meta property="og:image:height" content="150" />
        <meta property="og:site_name" content="Sniffoo" />
        <meta property="og:title" content="Sniffoo" />
        <meta property="og:description" content="Encontre empresas e negócios próximos de sua região." />';
    }
    
    ?>
    
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