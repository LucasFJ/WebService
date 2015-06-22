<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd" />
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml" 
      xmlns="http://www.w3.org/1999/xhtml" 
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml"
      prefix="og: http://ogp.me/ns#">
  <head>
    <title>Sniffoo</title>
    <meta name="description" content="Bem-vindo ao Sniffoo. 
        Encontre empresas e negócios próximos de sua região.">
    <meta name="keywords" content="site, design, tecnologia, região, página, divulgação, tcc, 
          baixada, publicidade, propaganda, variedades, apps, interativo, gabriel van loon, 
          agda luiza, lucas figueiredo, lucasfj, leo caratin, procura, mapa, empresa, negócio, 
          loja, comércio, compra, vende, etec, informatica, sistema">
    
    <script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '965166716868967',
      xfbml      : true,
      version    : 'v2.3'
    });
  };

//  (function(d, s, id){
//     var js, fjs = d.getElementsByTagName(s)[0];
//     if (d.getElementById(id)) {return;}
//     js = d.createElement(s); js.id = id;
//     js.src = "//connect.facebook.net/en_US/sdk.js";
//     fjs.parentNode.insertBefore(js, fjs);
//   }(document, 'script', 'facebook-jssdk'));
</script>
    
    <link rel="img_src" href="http://www.sniffoo.com.br/src/imagens/default/lucas.jpg" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Cadastro em Sniffoo" />
    <meta property="og:image" content="http://www.sniffoo.com.br/src/imagens/default/lucas.jpg" />
    <meta property="og:locale" content="pt-BR" />
    <meta property="og:url" content="http://www.sniffoo.com.br/cadastro" />
    <meta property="og:site_name" content="Sniffoo" />
    <meta property="fb:app_id" content="965166716868967" />
    <meta property="og:description" content="Site de buscas para micro e pequenas empresas." />
    
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